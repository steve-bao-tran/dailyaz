<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {

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

		# Load library
		$this->load->library('encrypt');
        
        #Load model
        $this->load->model('infous_model');
        $this->load->model('content_model');
        $this->load->model('user_model');

        $infous = $this->infous_model->get('*', 'info_id = 1');
        $data['infous'] = $infous;

        $content = $this->content_model->fetch('con_id, con_title, con_type', 'con_type = 3 AND con_publish = 1');
        $data['content'] = $content; 

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

	function user()
	{
		# Variable
		$select = '*';
		$where = '';

		$list_user = $this->user_model->fetch($select, $where);
		$data['list_user'] = $list_user;
		#Load view
		$this->load->view('admin/user/list_user', $data);
	}	

	function action_user($user = 0)
	{
		$title_show = '';		
		if ($user > 0) {
			$title_show = 'Sửa';
			$user_edit = $this->user_model->get('*', 'us_id = '. $user);
			
			# Post data
			if ($this->input->post('ususername') && $this->input->post('ususername') != '') {
				$image = $user_edit->us_avatar; $msg = '';				
				if($_FILES['usavatar'] && $_FILES['usavatar']['name'] != ''){
					$path = 'media/images/avatar';
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
		            
		            if ($this->upload->do_upload('usavatar')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }
				}

				# Create pass if have edit pass
				$salt = $user_edit->us_salt;
				$password = $user_edit->us_password;
				$origpass = $user_edit->us_origpass;
				if ($this->input->post('usorigpass') && trim(html_escape($this->input->post('usorigpass'))) != '') {
					$origpass = trim(html_escape($this->input->post('usorigpass')));
					$password = $this->encrypt->encode($origpass, $salt);
				}

				$dataEdit = array(
					'us_username' => trim(html_escape($this->input->post('ususername'))),
					'us_password' => $password,
					'us_origpass' => $origpass,
					'us_fullname' => trim(html_escape($this->input->post('usfullname'))),
					'us_avatar' => $image,
					'us_email' => trim(html_escape($this->input->post('usemail'))),
					'us_mobile' => trim(html_escape($this->input->post('usmobile'))),
					'us_address' => trim(html_escape($this->input->post('usaddress'))),
					'us_gen' => (int)$this->input->post('usgen'),									
					'us_age' => trim(html_escape($this->input->post('usage'))),
					'us_group' => (int)$this->input->post('usgroup'),
					'us_update' => date('Y-m-d H:i:s'),
					'us_publish' => ((int)$this->input->post('uspublish') == 1) ? true : false
				);

				if($this->user_model->update($dataEdit, 'us_id = '. $user)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa dữ liệu thành viên thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa dữ liệu thành viên không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/user', 'location');
				die;

			} else {
				$data['user_edit'] = $user_edit;
			}
		} else {
			$title_show = 'Thêm';
			# Post data
			if($this->input->post('ususername') && $this->input->post('ususername') != ''){
				# Upload image
				$image = ''; $msg = '';
				if($_FILES['usavatar'] && $_FILES['usavatar']['name'] != ''){
					$path = 'media/images/avatar';
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
		            
		            if ($this->upload->do_upload('usavatar')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }              
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }	                
				}

				# Create salt
				$salt = $this->encrypt->random_key(8);
				$password = $this->encrypt->encode(trim(html_escape($this->input->post('usorigpass'))), $salt);

				$dataAdd = array(
					'us_username' => trim(html_escape($this->input->post('ususername'))),
					'us_password' => $password,
					'us_salt' => $salt,
					'us_origpass' => trim(html_escape($this->input->post('usorigpass'))),
					'us_fullname' => trim(html_escape($this->input->post('usfullname'))),
					'us_avatar' => $image,
					'us_email' => trim(html_escape($this->input->post('usemail'))),
					'us_mobile' => trim(html_escape($this->input->post('usmobile'))),
					'us_address' => trim(html_escape($this->input->post('usaddress'))),
					'us_gen' => (int)$this->input->post('usgen'),									
					'us_age' => trim(html_escape($this->input->post('usage'))),
					'us_group' => (int)$this->input->post('usgroup'),
					'us_createdate' => date('Y-m-d H:i:s'),
					'us_update' => date('Y-m-d H:i:s'),
					'us_publish' => ((int)$this->input->post('uspublish') == 1) ? true : false
				);

                if($this->user_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm thành viên mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm thành viên mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/user', 'location');
				die;
			}
		}

		$data['title_show'] = $title_show;		
		#Load view
        $this->load->view('admin/user/action_user', $data);
	}

	function delete_user($user = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/user', 'location');
		die;
	}

	function publish_user()
	{
		$us_id = (int)$this->input->get('user');
		$act = (int)$this->input->get('act');

		if($us_id > 0){
			$this->user_model->update(array('us_publish' => $act), 'us_id = '. $us_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái thành viên thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Thành viên không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/user', 'location');
		die;
	}

	function ajax_del_img_user()
	{
		$img = $this->input->post('img');
		$usid = (int)$this->input->post('usid');
		if($img && $img != '' && $usid > 0){
			$path = 'media/images/avatar';
			if(file_exists($path .'/'. $img)){
				@unlink($path .'/'. $img);
			}
			$this->user_model->update(array('us_avatar' => ''), 'us_id = '. $usid);
			echo '1'; 
			exit();
		}
		echo '0';
		exit();
	}

	function ajax_check_user()
	{
		$username = $this->input->post('username');		
		$usid = (int)$this->input->post('usid');		
		if($username != ''){
			$where = 'us_username = "'. $username .'"';
			if($usid > 0){
				$where .= ' AND us_id NOT IN ("'. $usid .'")';
			}			
			$user = $this->user_model->get('us_id', $where);
			if(count($user) >= 1) {
				echo '1'; 
				exit();
			}			
		}
		echo '0';
		exit();
	}

	function ajax_check_email()
	{
		$email = $this->input->post('email');
		$usid = (int)$this->input->post('usid');		
		if($email != ''){
			$where = 'us_email = "'. $email .'"';
			if($usid > 0){
				$where .= ' AND us_id NOT IN ("'. $usid .'")';
			}			
			$mail = $this->user_model->get('us_id', $where);
			if(count($mail) >= 1) {
				echo '1'; 
				exit();
			}			
		}
		echo '0';
		exit();
	}

	function ajax_check_mobile()
	{
		$mobile = $this->input->post('mobile');
		$usid = (int)$this->input->post('usid');		
		if($mobile != ''){
			$where = 'us_mobile = "'. $mobile .'"';
			if($usid > 0){
				$where .= ' AND us_id NOT IN ("'. $usid .'")';
			}			
			$mobi = $this->user_model->get('us_id', $where);
			if(count($mobi) >= 1) {
				echo '1'; 
				exit();
			}			
		}
		echo '0';
		exit();
	}

	function customer()
	{
		# Variable
		$select = '*';
		$where = '';

		$this->load->model('receiver_model');
		$list_customer = $this->receiver_model->fetch($select, $where);
		$data['list_customer'] = $list_customer;
		#Load view
		$this->load->view('admin/user/list_customer', $data);
	}

	function delete_customer($customer = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/customer', 'location');
		die;
	}

	function publish_customer()
	{
		$rc_id = (int)$this->input->get('customer');
		$act = (int)$this->input->get('act');

		if($rc_id > 0){
			$this->load->model('receiver_model');
			$this->receiver_model->update(array('rc_publish' => $act), 'rc_id = '. $rc_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái khách hàng thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Khách hàng không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/customer', 'location');
		die;
	}

}
