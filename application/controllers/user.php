<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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

        #Load helper
        $this->load->helper('custom');
       
        # Load library
        $this->load->library('encrypt');
        
        #Load model
        $this->load->model('infous_model');
        $this->load->model('content_model');
        $this->load->model('user_model');
        $this->load->model('category_model');
        $this->load->model('show_home_model');

        # Get info us
        $infous = $this->infous_model->get('*', 'info_id = 1');
        $data['infous'] = $infous;

        # Get content guide
        $content = $this->content_model->fetch('con_id, con_title, con_type', 'con_type = 3 AND con_publish = 1');
        $data['content'] = $content;

        # Get category
        $cate_menu = $this->category_model->fetch_join2('cat_id, cat_name, cat_image, COUNT(*) as count', 'INNER', 'product', 'pro_cate = cat_id', '', '', '', 'cat_publish IS TRUE AND pro_publish IS TRUE', '', '', 0, 0, false, 'cat_id');
        $data['cate_menu'] = $cate_menu;

        # Update number access website
        $this->db->query('UPDATE `counter` SET `cou_num` = `cou_num` + 1 WHERE `counter`.`cou_id` = 1 AND `counter`.`cou_publish` IS TRUE');

        # Get show home        
        $show_home = $this->show_home_model->get('*');
        $data['show_home'] = $show_home;

        $this->load->vars($data);
    }

	public function index()
	{
		
		# Load view
		$this->load->view('account/index');
	}

	function signup()
	{
		if ($this->input->post('ususername') 
			&& $this->input->post('ususername') != '' 
			&& $this->input->post('usemailmobile') 
			&& $this->input->post('usemailmobile') != '' 
			&& $this->input->post('uspassword') 
			&& $this->input->post('uspassword') != ''
			&& $this->input->post('usrepassword') 
			&& $this->input->post('usrepassword') != '') {

			if ($this->input->post('uspassword') != $this->input->post('usrepassword'))	{
				$this->session->set_flashdata('sessionError', 'Xác nhận mật khẩu không đúng. Vui lòng kiểm tra lại!');
				redirect(base_url() . 'tai-khoan/dang-ky', 'location');
				die;
			}

			$email = ''; $mobile = ''; $salt = ''; $password = '';
			$salt = $this->encrypt->random_key(8);
			$password = $this->encrypt->encode(trim(html_escape($this->input->post('uspassword'))), $salt);

			# Load lib form_email & set $email , $mobile
			$this->load->library('form_validation');
			if($this->form_validation->valid_email(trim(html_escape($this->input->post('usemailmobile'))))){
				$email = trim(html_escape($this->input->post('usemailmobile')));
			} else {
				$mobile = trim(html_escape($this->input->post('usemailmobile')));
			}

			$dataAdd = array(
				'us_username' => trim(html_escape($this->input->post('ususername'))),
				'us_password' => $password,
				'us_salt' => $salt,
				'us_email' => $email,
				'us_mobile' => $mobile,
				'us_origpass' => trim(html_escape($this->input->post('uspassword'))),
				'us_createdate' => date('Y:m:d H:i:s'),				
				'us_group' => 2,
				'us_publish' => true				
			);

			if ($this->user_model->add($dataAdd)) {
				$this->session->set_flashdata('sessionSuccess', 'Bạn vừa đăng ký thành viên thành công!');
			} else {
				$this->session->set_flashdata('sessionError', 'Đăng ký thành viên không thành công. Vui lòng kiểm tra lại!');
			}
			redirect(base_url() . 'tai-khoan/cap-nhat?tv='. trim(html_escape($this->input->post('ususername'))) .'&ma='. (int)$this->db->insert_id(), 'location');
			die;	

		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Đăng ký',
			'link1' => '/tai-khoan/dang-ky',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;
		# Load view
		$this->load->view('account/user/signup', $data);
	}

	function update_signup()
	{
		$new_user = $this->user_model->get('*', 'us_id = '. (int)$_REQUEST['ma'] .' AND us_username = "'. $_REQUEST['tv'] .'"');
		
		if(! $new_user || $new_user->us_id < 0) {
			$this->session->set_flashdata('sessionError', 'Đăng ký thành viên không thành công. Vui lòng kiểm tra lại!');
			redirect(base_url() . 'tai-khoan/dang-ky', 'location');
			die;
		}

		if ($this->input->post('usfullname') && $this->input->post('usfullname') != '') {
			$email = $new_user->us_email; $mobile = $new_user->us_mobile; $image = ''; $msg = '';
			$fullname = trim(html_escape($this->input->post('usfullname')));
			
			if ($new_user->us_email == '') {
				$email = trim(html_escape($this->input->post('usemail')));
			} else {
				$mobile = trim(html_escape($this->input->post('usmobile')));
			}

			if ($_FILES['usimage'] && $_FILES['usimage']['name'] != '') {
				$path = 'media/images/avatar';
				if (! is_dir($path)) {
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
	            
	            if ($this->upload->do_upload('usimage')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $image = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			$dataUpdate = array(
				'us_fullname' => $fullname,
				'us_email' => $email,
				'us_mobile' => $mobile,
				'us_avatar' => $image,
				'us_lastlogin' => date('Y:m:d H:i:s'),
				'us_update' => date('Y:m:d H:i:s')
			);

			if ($this->user_model->update($dataUpdate, 'us_id = '. $new_user->us_id)) {
				$this->session->set_flashdata('sessionSuccess', 'Bạn vừa cập nhật thông tin thành công!');
			} else {
				$this->session->set_flashdata('sessionError', 'Cập nhật thông tin không thành công. Vui lòng kiểm tra lại!');
			}

			# Login account	
			$sessionLogin = array(
                'sessionUser' => (int)$new_user->us_id,
                'sessionGroup' => (int)$new_user->us_group,
                'sessionUsername' => $new_user->us_username,
                'sessionName' => $fullname,
                'sessionAvatar' => ($image != '') ? $image : $new_user->us_avatar
            );

            $this->session->set_userdata($sessionLogin);

			redirect(base_url() . 'tai-khoan/thong-tin', 'location');
			die;
		}

		$data['new_user'] = $new_user;
		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Đăng ký',
			'link1' => '/tai-khoan/dang-ky',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/user/signup_continue', $data);
	}
	
	function ajax_check_user()
	{
		$username = $this->input->post('username'); 
		if($username != ''){
			$user = $this->user_model->get('us_id', 'us_username = "'. $username .'"');
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
		if($email != ''){
			$user = $this->user_model->get('us_id', 'us_email = "'. $email .'"');
			if(count($user) >= 1) {
				echo '1'; 
				exit();
			}			
		}
		echo '0';
		exit();
	}

	function signin()
	{
		if ($this->input->post('username') && $this->input->post('username') != ''
		&& $this->input->post('password') && $this->input->post('password') != '') {
			$user = $this->user_model->get('*', 'us_username = "'. trim(html_escape($this->input->post('username'))) .'" OR us_email = "'. trim(html_escape($this->input->post('username'))) .'"');

			if ($user && $user->us_id > 0 && count($user) == 1) {
				
				if ($user->us_publish == 0) {
					$this->session->set_flashdata('sessionError', 'Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ với quản trị! <a href="'. base_url() .'lien-he">Tại đây</a>');
					redirect(base_url() . 'tai-khoan/dang-nhap', 'location');
					die;
				}

				$pass = trim(html_escape($this->input->post('password')));
				$decode_pass =  $this->encrypt->decode(trim($user->us_password), $user->us_salt);
				if ($pass == $decode_pass) {
					$sessionLogin = array(
                        'sessionUser'      	=>      (int)$user->us_id,
                        'sessionAvatar'     =>      $user->us_avatar,
                        'sessionUsername'   =>      $user->us_username,
                        'sessionName'     	=>      $user->us_fullname
                    );
					$this->session->set_userdata($sessionLogin);
					$this->user_model->update(array('us_lastlogin' => date('Y-m-d H:i:s')), 'us_id = '.(int)$user->us_id);
               
					#Login success
					redirect(base_url() .'tai-khoan/thong-tin', 'location');
					die;					
				} else {
					$this->session->set_flashdata('sessionError', 'Mật khẩu không đúng. Vui lòng kiểm tra lại hoặc chọn quên mật khẩu! <a href="'. base_url() .'tai-khoan/quen-mat-khau">Tại đây</a>');
					redirect(base_url() . 'tai-khoan/dang-nhap', 'location');
					die;
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Tài khoản không đúng. Vui lòng kiểm tra lại!');
				redirect(base_url() . 'tai-khoan/dang-nhap', 'location');
				die;
			}
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Đăng nhập',
			'link1' => '/tai-khoan/dang-nhap',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/user/signin', $data);
	}

	# Login & Checkout order
	function signin_and_checkout()
	{
		if($this->session->userdata('sessionUser')){
			redirect(base_url() .'dat-hang', 'location');
			die;
		}

		if ($this->input->post('username') && $this->input->post('username') != ''
		&& $this->input->post('password') && $this->input->post('password') != '') {
			$user = $this->user_model->get('*', 'us_username = "'. trim(html_escape($this->input->post('username'))) .'" OR us_email = "'. trim(html_escape($this->input->post('username'))) .'"');

			if ($user && $user->us_id > 0 && count($user) == 1) {
				
				if ($user->us_publish == 0) {
					$this->session->set_flashdata('sessionError', 'Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ với quản trị! <a href="'. base_url() .'lien-he">Tại đây</a>');
					redirect(base_url() . 'tai-khoan/dang-nhap', 'location');
					die;
				}

				$pass = trim(html_escape($this->input->post('password')));
				$decode_pass =  $this->encrypt->decode(trim($user->us_password), $user->us_salt);
				if ($pass == $decode_pass) {
					$sessionLogin = array(
                        'sessionUser'      	=>      (int)$user->us_id,
                        'sessionAvatar'     =>      $user->us_avatar,
                        'sessionUsername'   =>      $user->us_username,
                        'sessionName'     	=>      $user->us_fullname
                    );
					$this->session->set_userdata($sessionLogin);
					$this->user_model->update(array('us_lastlogin' => date('Y-m-d H:i:s')), 'us_id = '.(int)$user->us_id);
               
					#Login success
					redirect(base_url() .'dat-hang', 'location');
					die;					
				} else {
					$this->session->set_flashdata('sessionError', 'Mật khẩu không đúng. Vui lòng kiểm tra lại hoặc chọn quên mật khẩu! <a href="'. base_url() .'tai-khoan/quen-mat-khau">Tại đây</a>');
					redirect(base_url() . 'dat-hang', 'location');
					die;
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Tài khoản không đúng. Vui lòng kiểm tra lại!');
				redirect(base_url() . 'dat-hang', 'location');
				die;
			}
		}
	}

	function ajax_signin()
	{
		$result = array();
		$result['error'] = false;
		$result['msg'] = '';
		$result['uid'] = 0;

		if($this->session->userdata('sessionUser')){
			$result['error'] = true;
			$result['msg'] = 'Thành viên này đã đăng nhập rồi!';
		} else {
			if ($this->input->post('username') && $this->input->post('username') != ''
			&& $this->input->post('password') && $this->input->post('password') != '') {
				$user = $this->user_model->get('*', 'us_username = "'. trim(html_escape($this->input->post('username'))) .'" OR us_email = "'. trim(html_escape($this->input->post('username'))) .'"');

				if ($user && $user->us_id > 0 && count($user) == 1) {
					
					if ($user->us_publish == 0) {
						$result['error'] = true;
						$result['msg'] = 'Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ với quản trị! <a href="'. base_url() .'lien-he">Tại đây</a>';						
					}

					$pass = trim(html_escape($this->input->post('password')));
					$decode_pass =  $this->encrypt->decode(trim($user->us_password), $user->us_salt);
					if ($pass == $decode_pass) {
						$sessionLogin = array(
	                        'sessionUser'      	=>      (int)$user->us_id,
	                        'sessionAvatar'     =>      $user->us_avatar,
	                        'sessionUsername'   =>      $user->us_username,
	                        'sessionName'     	=>      $user->us_fullname
	                    );
						$this->session->set_userdata($sessionLogin);
						$this->user_model->update(array('us_lastlogin' => date('Y-m-d H:i:s')), 'us_id = '. (int)$user->us_id);
						$result['uid'] = (int)$user->us_id;							
					} else {
						$result['error'] = true;
						$result['msg'] = 'Mật khẩu không đúng. Vui lòng kiểm tra lại hoặc chọn quên mật khẩu! <a href="'. base_url() .'tai-khoan/quen-mat-khau">Tại đây</a>';						
					}
				} else {
					$result['error'] = true;
					$result['msg'] = 'Tài khoản không đúng. Vui lòng kiểm tra lại!';					
				}
			}
		}

		// $username = $this->input->post('username');
		// $password = $this->input->post('password');	

		echo json_encode($result);
		exit();
	}

	function signout()
	{
		if( ! $this->session->userdata('sessionUser')){
			redirect(base_url(), 'location');
			die;
		}
		// $this->session->sess_destroy();
		$this->session->unset_userdata('sessionUser');
		$this->session->unset_userdata('sessionAvatar');
		$this->session->unset_userdata('sessionUsername');
		$this->session->unset_userdata('sessionName');
		$this->session->unset_userdata('sessionSuccess');
		$this->session->unset_userdata('sessionError');
		redirect(base_url(), 'location');
		die;
	}

	function forgetpass()
	{
		if ($this->input->post('emailpass') && $this->input->post('emailpass') != '') {
			$this->session->set_flashdata('sessionSuccess', 'Chức năng đang phát triển.');
			redirect(base_url() . 'tai-khoan/dang-ky', 'location');
			die;
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Quên mật khẩu',
			'link1' => '/tai-khoan/quen-mat-khau',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/user/forgetpass', $data);
	}
	
	function my_info()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		$my_info = $this->user_model->get('*', 'us_id = '. $this->session->userdata('sessionUser') .' AND us_publish IS TRUE');
		$data['my_info'] = $my_info;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thông tin cá nhân',
			'link1' => '/tai-khoan/thong-tin',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;


		# Load view
		$this->load->view('account/user/my_info', $data);
	}

	function changepass()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		if ($this->input->post('currentpass') && $this->input->post('currentpass') != ''
			&& $this->input->post('newpass') && $this->input->post('newpass') != ''
			&& $this->input->post('renewpass') && $this->input->post('renewpass') != ''
		) {
			if (trim(html_escape($this->input->post('newpass'))) == trim(html_escape($this->input->post('renewpass')))) {
				$user = $this->user_model->get('*', 'us_id = '. $this->session->userdata('sessionUser') .' AND us_origpass = "'. trim(html_escape($this->input->post('currentpass'))) .'" AND us_publish IS TRUE');
				if ($user && count($user) == 1) {
					$salt = $this->encrypt->random_key(8);	 
					$pass = $this->encrypt->encode(trim(html_escape($this->input->post('newpass'))), $salt);
					$dataUpdate = array(
						'us_password' => $pass, 
						'us_salt' => $salt, 
						'us_origpass' => trim(html_escape($this->input->post('newpass'))),
						'us_update' => date('Y-m-d H:i:s')
					);

					if($this->user_model->update($dataUpdate, 'us_id = '. $this->session->userdata('sessionUser'))){
						$this->session->set_flashdata('sessionSuccess', 'Chúc mừng bạn, bạn vừa đổi mật khẩu thành công!');
						redirect(base_url() . 'tai-khoan/thong-tin', 'location');
						die;
					} else {
						$this->session->set_flashdata('sessionError', 'Đổi mật khẩu không thành công. Vui lòng nhập lại!');
						redirect(base_url() . 'tai-khoan/doi-mat-khau', 'location');
						die;
					}
					
				} else {
					$this->session->set_flashdata('sessionError', 'Mật khẩu hiện tại không đúng. Vui lòng nhập lại!');
					redirect(base_url() . 'tai-khoan/doi-mat-khau', 'location');
					die;
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Mật khẩu xác nhận không giống nhau. Vui lòng nhập lại!');
				redirect(base_url() . 'tai-khoan/doi-mat-khau', 'location');
				die;
			}
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thông tin cá nhân',
			'link1' => '/tai-khoan/thong-tin',
			'lv2'	=> 'Đổi mật khẩu',
			'link2'	=> '/tai-khoan/doi-mat-khau',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/user/changepass', $data);
	}

	function edit_delivery()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		$usdeli = $this->user_model->get('us_id, us_fullname, us_address, us_mobile', 'us_id = '. $this->session->userdata('sessionUser'));
		if (($this->input->post('usfullname') && $this->input->post('usfullname') != '')
			|| ($this->input->post('usaddress') && $this->input->post('usaddress') != '')
			|| ($this->input->post('usmobile') && $this->input->post('usmobile') != '')
		) {			
			$dataUpdate = array(
				'us_fullname' => (trim(html_escape($this->input->post('usfullname'))) != '') ? trim(html_escape($this->input->post('usfullname'))) : $usdeli->us_fullname,
				'us_address' => (trim(html_escape($this->input->post('usaddress'))) != '') ? trim(html_escape($this->input->post('usaddress'))) : $usdeli->us_address,
				'us_mobile' => (trim(html_escape($this->input->post('usmobile'))) != '') ? trim(html_escape($this->input->post('usmobile'))) : $usdeli->us_mobile,
				'us_update' => date('Y-m-d H:i:s')
			);

			if ($this->user_model->update($dataUpdate, 'us_id = '. $this->session->userdata('sessionUser'))) {
				$this->session->set_flashdata('sessionSuccess', 'Chúc mừng bạn, bạn vừa đổi thông tin giao nhận thành công!');
				redirect(base_url() . 'tai-khoan/thong-tin', 'location');
				die;
			} else {
				$this->session->set_flashdata('sessionError', 'Đổi thông tin giao nhận không thành công. Vui lòng nhập lại!');
				redirect(base_url() . 'tai-khoan/sua-giao-nhan', 'location');
				die;
			}
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thông tin cá nhân',
			'link1' => '/tai-khoan/thong-tin',
			'lv2'	=> 'Sửa thông tin giao nhận',
			'link2'	=> '/tai-khoan/sua-giao-nhan',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		$data['usdeli'] = $usdeli;
		# Load view
		$this->load->view('account/user/editdelivery', $data);
	}

	function edit_info()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		$usinfo = $this->user_model->get('*', 'us_id = '. $this->session->userdata('sessionUser'));

		if (($this->input->post('usfullname') && $this->input->post('usfullname') != '')
			|| ($this->input->post('usaddress') && $this->input->post('usaddress') != '')
			|| ($this->input->post('usmobile') && $this->input->post('usmobile') != '')
		) {	

			$msg = ''; $image = '';
			# Upload image if have
			if ($_FILES['usimage'] && $_FILES['usimage']['name'] != '') {
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
	            
	            if ($this->upload->do_upload('usimage')) {
	                if ($this->upload->data('is_image') == TRUE) {
	                    $image = $this->upload->data('file_name');
	                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
	                    @unlink($path .'/'. $this->upload->data('file_name'));
	                }
	            } else {	                	
                	$msg = $this->upload->display_errors('<p>', '</p>');   	
                }
			}

			$dataUpdate = array(
				'us_fullname' => (trim(html_escape($this->input->post('usfullname'))) != '') ? trim(html_escape($this->input->post('usfullname'))) : $usinfo->us_fullname,
				'us_address' => (trim(html_escape($this->input->post('usaddress'))) != '') ? trim(html_escape($this->input->post('usaddress'))) : $usinfo->us_address,
				'us_mobile' => (trim(html_escape($this->input->post('usmobile'))) != '') ? trim(html_escape($this->input->post('usmobile'))) : $usinfo->us_mobile,
				'us_email' => (trim(html_escape($this->input->post('usemail'))) != '') ? trim(html_escape($this->input->post('usemail'))) : $usinfo->us_email,
				'us_age' => html_escape($this->input->post('usage')),
				'us_avatar' => $image,
				'us_gen' => (int)$this->input->post('usgen'),
				'us_update' => date('Y-m-d H:i:s')
			);

			if ($this->user_model->update($dataUpdate, 'us_id = '. $this->session->userdata('sessionUser'))) {
				$this->session->set_flashdata('sessionSuccess', 'Chúc mừng bạn, bạn vừa đổi thông tin cá nhân thành công! '. $msg);
				redirect(base_url() . 'tai-khoan/thong-tin', 'location');
				die;
			} else {
				$this->session->set_flashdata('sessionError', 'Đổi thông tin cá nhân không thành công. Vui lòng nhập lại! '. $msg);
				redirect(base_url() . 'tai-khoan/sua-thong-tin', 'location');
				die;
			}
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thông tin cá nhân',
			'link1' => '/tai-khoan/thong-tin',
			'lv2'	=> 'Sửa thông tin cá nhân',
			'link2'	=> '/tai-khoan/sua-thong-tin',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		$data['usinfo'] = $usinfo;
		# Load view
		$this->load->view('account/user/editinfo', $data);
	}

	function ajax_del_ava_user()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		if ($this->input->post('image') != '') {
			$path = 'media/images/avatar';
			if(file_exists($path .'/'. $this->input->post('image'))) {
				@unlink($path .'/'. $this->input->post('image'));
			}
			$this->user_model->update(array('us_avatar' => ''), 'us_id = '. $this->session->userdata('sessionUser'));
			echo '1'; exit();
		}
		echo '0'; exit();
	}

	function subscribe()
	{
		if($_REQUEST['registeremail'] && $_REQUEST['registeremail'] != ''){
			$this->load->model('register_email_model');
			$this->load->library('user_agent');
			$dataAdd = array(
				're_email' => trim(html_escape($this->input->post('registeremail'))),
				're_ipaddress' => $this->getRealIpAddr(),			
				're_device' => $this->agent->agent_string(),				
				're_note' => 'Người dùng đăng ký nhận tin.',				
				're_createdate' => date('Y-m-d H:i:s'),				
				're_status' => 0,				
				're_publish' => 0				
			);

			if ($this->register_email_model->add($dataAdd)) {
				$this->session->set_flashdata('sessionSuccess', 'Chúc mừng bạn, bạn vừa đăng ký nhận bản tin thành công!');
			} else {
				$this->session->set_flashdata('sessionError', 'Đăng ký nhận bản tin không thành công. Vui lòng kiểm tra thử lại!');
			}
		} else {
			$this->session->set_flashdata('sessionError', 'Đăng ký nhận bản tin không thành công. Vui lòng kiểm tra thử lại!');
		}

		redirect(base_url(), 'location');
		die;
	}

	function getRealIpAddr()
	{
		if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	public function ip()
    {
        $ipaddress = '';
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if(! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(! empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if(! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if(! empty($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if(! empty($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

}
