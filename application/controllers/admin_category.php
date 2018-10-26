<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_category extends CI_Controller {

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
        
        #Load model        
        $this->load->model('category_model');

        # Total new register email
        $query = $this->db->query('SELECT re_id FROM registry_email WHERE re_status = 0');
        $data['newmail'] = $query->num_rows();
        $query->free_result();

        # Total new order
        $this->db->cache_off();
        $query1 = $this->db->query('SELECT `o_id` FROM `order` WHERE `o_status` = 1');
        $data['neworder'] = $query1->num_rows();
        $query1->free_result();
        
        # Return value
        $this->load->vars($data);
    }

	public function index()
	{
		#Load view
		$this->load->view('admin/index');
	}

	function category()
	{
		#Variable common
		$select = '*';
		$where = '';
		$sort = 'cat_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_category = $this->category_model->fetch($select, $where);
        $data['list_category'] = $list_category;

        #Load view
        $this->load->view('admin/category/list_category', $data);
	}

	function action_category($category = 0)
	{
		$title_show = '';
		if ($category > 0) {
			$title_show = 'Sửa';
			$cat_edit = $this->category_model->get('*', 'cat_id = '. $category);
			
			# Post data
			if ($this->input->post('catname') && $this->input->post('catname') != '') {

				$image = $cat_edit->cat_image; 
				$image1 = $cat_edit->cat_image1; 
				$msg = '';
				
				if($_FILES['catimage'] && $_FILES['catimage']['name'] != ''){
					$path = 'media/images/category';
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
		            
		            if ($this->upload->do_upload('catimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }			                
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }
				}

				if($_FILES['catimage1'] && $_FILES['catimage1']['name'] != ''){
					$path = 'media/images/category';
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
		            
		            if ($this->upload->do_upload('catimage1')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image1 = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }			                
		            } else {	                	
	                	$msg .= $this->upload->display_errors('<p>', '</p>');   	
	                }
				}

				$dataEdit = array(
					'cat_name' => trim(html_escape($this->input->post('catname'))),
					'cat_image' => $image,
					'cat_image1' => $image1,
					'cat_desc' => html_escape($this->input->post('catdesc')),
					'cat_publish' => ((int)$this->input->post('catpublish') == 1) ? true : false
				);

                if($this->category_model->update($dataEdit, 'cat_id = '. $category)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa danh mục mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa danh mục mới không thành công! '. $msg);
				}
				
				redirect(base_url() . 'admin/category', 'location');
				die;

			} else {
				$data['cat_edit'] = $cat_edit;
			}
		} else {
			$title_show = 'Thêm';
			# Post data
			if($this->input->post('catname') && $this->input->post('catname') != ''){
				$image = ''; $msg = ''; $image1 = '';
				if($_FILES['catimage'] && $_FILES['catimage']['name'] != ''){
					$path = 'media/images/category';
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
		            
		            if ($this->upload->do_upload('catimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }              
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }	                
				}

				if($_FILES['catimage1'] && $_FILES['catimage1']['name'] != ''){
					if ($image == '') {
						$path = 'media/images/category';
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
					}				
		            
		            if ($this->upload->do_upload('catimage1')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image1 = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }              
		            } else {	                	
	                	$msg .= $this->upload->display_errors('<p>', '</p>');   	
	                }	                
				}

				$dataAdd = array(
					'cat_name' => trim(html_escape($this->input->post('catname'))),
					'cat_image' => $image,
					'cat_image1' => $image1,
					'cat_desc' => html_escape($this->input->post('catdesc')),
					'cat_publish' => ((int)$this->input->post('catpublish') == 1) ? true : false
				);

                if($this->category_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm danh mục mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm danh mục mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/category', 'location');
				die;
			}			
		}

		$data['title_show'] = $title_show;
		#Load view
        $this->load->view('admin/category/action_category', $data);
	}

	function delete_category($category = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/category', 'location');
		die;
	}

	function publish_category()
	{
		$cat_id = (int)$this->input->get('cat');
		$act = (int)$this->input->get('act');

		if($cat_id > 0){
			$this->category_model->update(array('cat_publish' => $act), 'cat_id = '. $cat_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái danh mục thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Danh mục không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/category', 'location');
		die;
	}

	function ajax_del_img_cat()
	{
		$img = $this->input->post('img');
		$catid = (int)$this->input->post('catid');
		$num = $this->input->post('num') ? (int)$this->input->post('num') : 0;
		if($img && $img != '' && $catid > 0){
			$path = 'media/images/category';
			if(file_exists($path .'/'. $img)){
				@unlink($path .'/'. $img);
			}
			$del = 'cat_image';
			if ($num == 1) {
				$del = 'cat_image1';
			}
			$this->category_model->update(array($del => ''), 'cat_id = '. $catid);
			echo '1'; 
			exit();
		}
		echo '0';
		exit();
	}

}
