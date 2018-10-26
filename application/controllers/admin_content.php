<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_content extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	var $data = array();
	function __construct()
    {
        parent::__construct();

        # Check login admin
  		if(!$this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin/login', 'location');
			die;
		}
		#Load helper
        $this->load->helper('custom');
        
        #Load model        
        $this->load->model('content_model');

        # Total new register email
        $query = $this->db->query('SELECT re_id FROM registry_email WHERE re_status = 0');
        $data['newmail'] = $query->num_rows();
        $query->free_result();

        # Total new order
        $this->db->cache_off();
        $query1 = $this->db->query('SELECT `o_id` FROM `order` WHERE `o_status` = 1');
        $data['neworder'] = $query1->num_rows();
        $query1->free_result();

        # Return data
        $this->load->vars($data);
    }

	public function index()
	{
		#Load view
		$this->load->view('admin/index');
	}

	function content()
	{
		#Variable common
		$select = 'content.*, category.`cat_id`, category.`cat_name`';
		$where = 'con_type = 1';
		$sort = 'con_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = 'category';
		$join1 = 'INNER';
		$on1 = 'category.`cat_id` = content.`con_catid`';

		$list_content = $this->content_model->fetch_join1($select, $join1, $table1, $on1, $where);
        $data['list_content'] = $list_content;

        #Load view
        $this->load->view('admin/content/list_content', $data);
	}

	function action_content($content = 0)
	{
		$title_show = '';
		$this->load->model('category_model');
		$li_cate = $this->category_model->fetch('*', 'cat_publish = 1');
		if ($content > 0) {
			$title_show = 'Sửa';
			$con_edit = $this->content_model->get('*', 'con_id = '. $content);
			
			# Post data
			if ($this->input->post('contitle') && $this->input->post('contitle') != '') {

				$image = $con_edit->con_image; $msg = '';
				
				if($_FILES['conimage'] && $_FILES['conimage']['name'] != ''){
					$path = 'media/images/content';
					if (!is_dir($path)) {
		            	$old = umask(0);
		                @mkdir($path, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($path .'/index.html', '<p>Directory access is forbidden.</p>');
		            }

		            $config['upload_path'] = $path .'/';
		            $config['allowed_types'] = ACCEPTIMG;	            
		            $config['max_size'] = MAXUPLOAD;#KB	
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);
		            
		            if ($this->upload->do_upload('conimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }	
		                $msg = '';
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }
				}

				$dataEdit = array(
					'con_title' => trim(html_escape($this->input->post('contitle'))),
					'con_intro' => html_escape($this->input->post('conintro')),
					'con_image' => $image,
					'con_detail' => html_escape($this->input->post('condetail')),
					'con_tags' => trim(html_escape($this->input->post('contags'))),
					'con_editdate' => date('Y-m-d H:i:s'),
					'con_type' => (int)$this->input->post('contype'),
					'con_catid' => ((int)$this->input->post('contype') == 1) ? (int)$this->input->post('concatid') : 0,
					'con_publish' => ((int)$this->input->post('conpublish') == 1) ? true : false
				);

				if($this->content_model->update($dataEdit, 'con_id = '. $content)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa dữ liệu nội dung thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa dữ liệu nội dung không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/content', 'location');
				// redirect(base_url() . trim(uri_string(), '/'), 'location');
				die;

			} else {
				$data['con_edit'] = $con_edit;
			}
		} else {
			$title_show = 'Thêm';
			# Post data
			if($this->input->post('contitle') && $this->input->post('contitle') != ''){
				$image = ''; $msg = '';
				if($_FILES['conimage'] && $_FILES['conimage']['name'] != ''){
					$path = 'media/images/content';
					if (!is_dir($path)) {
		            	$old = umask(0);
		                @mkdir($path, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($path .'/index.html', '<p>Directory access is forbidden.</p>');
		            }

		            $config['upload_path'] = $path .'/';
		            $config['allowed_types'] = ACCEPTIMG;	            
		            $config['max_size'] = MAXUPLOAD;#KB	            

		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);
		            
		            if ($this->upload->do_upload('conimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }              
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }	                
				}

				$dataAdd = array(
					'con_title' => trim(html_escape($this->input->post('contitle'))),
					'con_intro' => html_escape($this->input->post('conintro')),
					'con_image' => $image,
					'con_detail' => html_escape($this->input->post('condetail')),
					'con_tags' => trim(html_escape($this->input->post('contags'))),
					'con_createdate' => date('Y-m-d H:i:s'),
					'con_editdate' => date('Y-m-d H:i:s'),
					'con_type' => (int)$this->input->post('contype'),
					'con_catid' => ((int)$this->input->post('contype') == 1) ? (int)$this->input->post('concatid') : 0,
					'con_publish' => ((int)$this->input->post('conpublish') == 1) ? true : false,
					'con_user' => $this->session->userdata('sessionUserAdmin')
				);

                if($this->content_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm nội dung mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm nội dung mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/content', 'location');
				// redirect(base_url() . trim(uri_string(), '/'), 'location');
				die;
			}			
		}

		$data['title_show'] = $title_show;
		$data['li_cate'] = $li_cate;
		#Load view
        $this->load->view('admin/content/action_content', $data);
	}

	function delete_content($content = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/content', 'location');
		// redirect(base_url() . trim(uri_string(), '/'), 'location');
		die;
	}

	function publish_content()
	{
		$con_id = (int)$this->input->get('con');
		$act = (int)$this->input->get('act');

		if($con_id > 0){
			$this->content_model->update(array('con_publish' => $act), 'con_id = '. $con_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái bài viết thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Bài viết không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/content', 'location');
		// redirect(base_url() . trim(uri_string(), '/'), 'location');
		die;
	}

	function ajax_del_img_cont()
	{
		$img = $this->input->post('img');
		$conid = (int)$this->input->post('conid');
		if($img && $img != '' && $conid > 0){
			$path = 'media/images/content';
			if(file_exists($path .'/'. $img)){
				@unlink($path .'/'. $img);
			}
			$this->content_model->update(array('con_image' => ''), 'con_id = '. $conid);
			echo '1'; 
			exit();
		}
		echo '0';
		exit();
	}

	function blogs(){
		#Variable common
		$select = 'content.*, user.us_id, user.us_username';
		$where = 'con_type = 2';
		$sort = 'con_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = 'user';
		$join1 = 'INNER';
		$on1 = 'user.`us_id` = content.`con_user`';

		$list_blogs = $this->content_model->fetch_join1($select, $join1, $table1, $on1, $where);
        $data['list_blogs'] = $list_blogs;

        #Load view
        $this->load->view('admin/content/list_blogs', $data);
	}

	function promotion(){
		#Variable common
		$select = '*';
		$where = 'con_type = 3';
		$sort = 'con_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_promotion = $this->content_model->fetch($select, $where);
        $data['list_promotion'] = $list_promotion;

        #Load view
        $this->load->view('admin/content/list_promotion', $data);
	}

	function guide(){
		#Variable common
		$select = '*';
		$where = 'con_type = 4';
		$sort = 'con_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_guide = $this->content_model->fetch($select, $where);
        $data['list_guide'] = $list_guide;

        #Load view
        $this->load->view('admin/content/list_guide', $data);
	}

	function collection(){
		#Variable common
		$select = '*';
		$where = 'con_type = 4';
		$sort = 'con_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_guide = $this->content_model->fetch($select, $where);
        $data['list_guide'] = $list_guide;

        #Load view
        $this->load->view('admin/content/list_guide', $data);
	}
}
