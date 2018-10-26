<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Setting extends CI_Controller {

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
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // In Vietnam

        # Check login admin
  		if(!$this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin/login', 'location');
			die;
		}
        
        #Load model
        $this->load->model('infous_model');       

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
		$this->load->view('account/index');
	}

	function setting()
	{
		# Variable
		$select = '*';
		$where = '';

		// $list_user = $this->user_model->fetch($select, $where);
		// $data['list_user'] = $list_user;
		#Load view
		$this->load->view('admin/user/list_user');
	}

	function infous()
	{
		$select = '*';
		$where = '';

		$infous = $this->infous_model->get($select, $where);
		$data['infous'] = $infous;
		#Load view
		$this->load->view('admin/setting/infous', $data);
	}

	function settup_infous()
	{

	}	

	function settup_home()
	{
		$this->load->model('show_home_model');

		$show_home = $this->show_home_model->get('*', 'sh_id = 1');
		if (! $show_home) {
			$this->show_home_model->add(array('sh_createdate' => date('Y-m-d H:i:s')));
			$show_home = $this->show_home_model->get('*', 'sh_id = 1');
		}

		if ((isset($_FILES['shslide1']) && $_FILES['shslide1']['name'] != '')
			|| (isset($_FILES['shslide2']) && $_FILES['shslide2']['name'] != '')
			|| (isset($_FILES['shslide3']) && $_FILES['shslide3']['name'] != '')
			|| (isset($_FILES['shslide4']) && $_FILES['shslide4']['name'] != '')
			|| ($this->input->post('shurlslide1') && $this->input->post('shurlslide1') != '') 
			|| ($this->input->post('shurlslide2') && $this->input->post('shurlslide2') != '')
			|| ($this->input->post('shurlslide3') && $this->input->post('shurlslide3') != '')
			|| ($this->input->post('shurlslide4') && $this->input->post('shurlslide4') != '')			
			|| (isset($_FILES['shadver1']) && $_FILES['shadver1']['name'] != '')
			|| (isset($_FILES['shadver2']) && $_FILES['shadver2']['name'] != '')
			|| (isset($_FILES['shadver3']) && $_FILES['shadver3']['name'] != '')
			|| ($this->input->post('shurladver1') && $this->input->post('shurladver1') != '')
			|| ($this->input->post('shurladver2') && $this->input->post('shurladver2') != '')
			|| ($this->input->post('shurladver3') && $this->input->post('shurladver3') != '')
		){
			$shslide1 = $show_home->sh_slide1; 
			$shslide2 = $show_home->sh_slide2; 
			$shslide3 = $show_home->sh_slide3; 
			$shslide4 = $show_home->sh_slide4;
			$shadver1 = $show_home->sh_adver1; 
			$shadver2 = $show_home->sh_adver2; 
			$shadver3 = $show_home->sh_adver3; 
			$msg = '';
			$path = 'media/images/advertise';
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

			if ($_FILES['shslide1'] && $_FILES['shslide1']['name'] != '') {
				if ($this->upload->do_upload('shslide1')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shslide1 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shslide2'] && $_FILES['shslide2']['name'] != '') {
				if ($this->upload->do_upload('shslide2')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shslide2 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shslide3'] && $_FILES['shslide3']['name'] != '') {
				if ($this->upload->do_upload('shslide3')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shslide3 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shslide4'] && $_FILES['shslide4']['name'] != '') {
				if ($this->upload->do_upload('shslide4')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shslide4 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shadver1'] && $_FILES['shadver1']['name'] != '') {
				if ($this->upload->do_upload('shadver1')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shadver1 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shadver2'] && $_FILES['shadver2']['name'] != '') {
				if ($this->upload->do_upload('shadver2')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shadver2 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			if ($_FILES['shadver3'] && $_FILES['shadver3']['name'] != '') {
				if ($this->upload->do_upload('shadver3')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $shadver3 = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			$dataUpdate = array(
				'sh_slide1' => $shslide1,
				'sh_url_slide1' => trim(html_escape($this->input->post('shurlslide1'))),
				'sh_slide2' => $shslide2,
				'sh_url_slide2' => trim(html_escape($this->input->post('shurlslide2'))),
				'sh_slide3' => $shslide3,
				'sh_url_slide3' => trim(html_escape($this->input->post('shurlslide3'))),
				'sh_slide4' => $shslide4,
				'sh_url_slide4' => trim(html_escape($this->input->post('shurlslide4'))),
				'sh_adver1' => $shadver1,
				'sh_url_adver1' => trim(html_escape($this->input->post('shurladver1'))),
				'sh_adver2' => $shadver2,
				'sh_url_adver2' => trim(html_escape($this->input->post('shurladver2'))),
				'sh_adver3' => $shadver3,
				'sh_url_adver3' => trim(html_escape($this->input->post('shurladver3'))),
				'sh_update' => date('Y-m-d H:i:s')
			);

			if ($this->show_home_model->update($dataUpdate)) {
				$this->session->set_flashdata('sessionSuccess', 'Sửa dữ liệu trang chủ thành công! '. $msg);
			} else {
				$this->session->set_flashdata('sessionError', 'Sửa dữ liệu trang chủ không thành công! '. $msg);
			}
			redirect(base_url() . trim(uri_string(), '/'), 'location');
			die;

		}

		$data['show_home'] = $show_home;
		#Load view
		$this->load->view('admin/setting/show_home', $data);
	}

	function ajax_del_show_home()
	{
		$img = $this->input->post('img');
		$pos = $this->input->post('pos');

		if ($img && $img != '' && $pos && $pos != '') {
			$this->load->model('show_home_model');
			$show = $this->show_home_model->get('*', 'sh_id = 1');
			$path = 'media/images/advertise';
			if (file_exists($path .'/'. $img)) {
				@unlink($path .'/'. $img);
			}

			if ($pos == 's1') {
				$this->show_home_model->update(array('sh_slide1' => ''));
			} else if ($pos == 's2') {
				$this->show_home_model->update(array('sh_slide2' => ''));
			} else if ($pos == 's3') {
				$this->show_home_model->update(array('sh_slide3' => ''));
			} else if ($pos == 's4') {
				$this->show_home_model->update(array('sh_slide4' => ''));
			} else if ($pos == 'a1') {
				$this->show_home_model->update(array('sh_adver1' => ''));
			} else if ($pos == 'a2') {
				$this->show_home_model->update(array('sh_adver2' => ''));
			} else if ($pos == 'a3') {
				$this->show_home_model->update(array('sh_adver3' => ''));
			}

			echo '1'; exit();
		}
		echo '0'; exit();
	}

	function edit_config()
	{
		
		#Load view
		$this->load->view('admin/setting/edit_config', $data);
	}

}
