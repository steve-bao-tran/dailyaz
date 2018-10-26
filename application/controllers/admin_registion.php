<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_registion extends CI_Controller {

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

        #Load libraries
        $this->load->library('encryption'); 
        $this->load->library('encrypt');
        $this->load->library('hash');
        $this->load->helper('url');
        
        #Load model
        $this->load->model('user_model');

        include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php'; 
		include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST']; 
    }

	public function index()
	{		
		$this->load->view('admin/index');
	}

	public function login()
	{
		if($this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin', 'location');
			die;
		}

		#BEGIN: Login admin
		if($this->input->post('username') && trim($this->input->post('username')) != '' && $this->input->post('password') && trim($this->input->post('password')) != ''){
			$username = trim(strtolower(html_escape($this->input->post('username'))));			
			$user_admin = $this->user_model->get('*', 'us_username = "'. $username . '" AND us_group = 1');
			if(count($user_admin) === 1){
				$pass = trim(html_escape($this->input->post('password')));
				$decode_pass =  $this->encrypt->decode(trim($user_admin->us_password), $user_admin->us_salt);
				if($pass == $decode_pass){
					$sessionLogin = array(
                        'sessionUserAdmin'      	=>      (int)$user_admin->us_id,
                        'sessionAvatarAdmin'     	=>      $user_admin->us_avatar,
                        'sessionUsernameAdmin'     	=>      $user_admin->us_username,
                        'sessionNameAdmin'     		=>      $user_admin->us_fullname
                    );
					$this->session->set_userdata($sessionLogin);
					$this->user_model->update(array('us_lastlogin' => date('Y-m-d H:i:s')), 'us_id = '.(int)$user_admin->us_id);
               
					#Login success
					redirect(base_url() .'admin', 'location');
					die;					
				} else {
					#Password incorrect
					$this->session->set_flashdata('sessionErrorLoginAdmin', 'Mật khẩu không đúng. Vui lòng đăng nhập lại.');
				}
			} else {
				#User not exist
				$this->session->set_flashdata('sessionErrorLoginAdmin', 'Tên người dùng này không đúng. Vui lòng đăng nhập lại.');
			}			
		}
		
		#END: Login admin
		$this->load->view('admin/registion/login');
	}

	function logout()
	{
		if(!$this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin/login', 'location');
			die;
		}
		$this->session->sess_destroy();
		redirect(base_url() .'admin/login', 'location');
		die;
	}

	function forgetpass()
	{
		if($this->input->post('email') != ''){
			$user = $this->user_model->get('us_id, us_username, us_name', 'us_email = "'. $this->input->post('email') .'" AND us_status = 1 AND us_group IN (1,2,3,4,5)');
			if($user && count($user) == 1){
				# Create authorized code
				$this->load->model('authorized_model');
				$code = $this->encrypt->random_key(64);
				$dataAdd = array(
					'ac_code' => $code,
					'ac_email' => trim(html_escape($this->input->post('email'))),
					'ac_during' => 600,
					'ac_create_date' => date('Y-m-d H:i:s')
				);  
				// $this->authorized_model->add($dataAdd);

				# Create link verify
				$link = base_url() .'admin/verify?mail='. trim(html_escape($this->input->post('email'))) .'&token='. $code; 

				# Config send mail forget pass
				$sender = GUSER; 
				$sendname = GNAME; 
				$receiver = $this->input->post('email');
				$receiname = $user->us_name;
				$subject = 'Thư xác nhận quên mật khẩu trang quản trị CI-WEB';
				$body = '';
				$body .= '<div marginwidth="0" marginheight="0" style="background-color:#fafafa">
							<center>
  								<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="height:100%!important;margin:0;padding:0;width:100%!important">
      								<tbody>
      									<tr>
            								<td align="center" valign="top" style="padding-top:20px">
              									<table border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #dddddd">
									                <tbody><tr>
									                    <td align="center" valign="top">
									                        <table border="0" cellpadding="10" cellspacing="0" width="100%">
									                        <tbody><tr>
									                            <td style="background-color:#fafafa;text-align:center">
									                                <img src="https://ci6.googleusercontent.com/proxy/jUysmTG_pWFlZs1eA3ubCUd5B7QazUI_abKeEo1GczBCiAdoObSHiMYot1KUKJQgdNK1MUDfAU4mtAAPmXt0VX35ddIkDxUGktkPvPZFlAYsHDW3RdW3QzQNxw5ZNkqKkbVIj_gf2bX2ynvtJLc08yrlwA=s0-d-e1-ft#https://openlearning.scdn5.secure.raxcdn.com/media-de034ae/images/OpenLearning-Logo-Small.png" class="CToWUd">
									                            </td>
									                        </tr>
									                        </tbody></table>
									                    </td>
									                </tr>
                								<tr>
                    						<td align="center" valign="top">
                        
						                    <table border="0" cellpadding="20" cellspacing="0" width="100%" style="background-color:#ffffff">
						                        <tbody><tr>
						                            <td valign="top" style="background-color:#ffffff">
						                                <div style="color:#505050;font-family:Helvetica;font-size:13px;line-height:150%;text-align:left">
						                                
						                                    <p>
						                                        Chào '. $user->us_name .',
						                                    </p>
						                                    <p>
						                                       	Đây là thứ lấy lại mật khẩu trên trang quản trị mà bạn vừa yêu cầu, từ website CI-WEB!
						                                    </p>
						                                    <p>
						                                        Để nhận lại, <span class="il">mật khẩu</span> bạn vui lòng nhấn vào đường dẫn sau::
						                                    </p>
						                               </div>
						                            </td>
						                        </tr>
						                        <tr>
						                            <td align="center" valign="top" style="padding-top:0;padding-bottom:30px">
						                                <table border="0" cellspacing="0" style="background-color:#61beb2;border:0;border-collapse:separate!important;border-radius:3px;width:100%">
						                                    <tbody><tr>
						                                        <td valign="middle" style="text-align:center">
						                                            <a href="'. $link .'"><span class="il">Xác thực</span> Địa chỉ email »</a>

						                                        </td>
						                                    </tr>
						                                </tbody></table>
						                            </td>
						                        </tr>
						                        </tbody></table>
						                        
						                    </td>
						                </tr>
						                <tr>
						                    <td align="center" valign="top">
						                        
						                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="m_8163397206458285099templateFooter">
						                        <tbody><tr>
						                            <td valign="top" style="color:#707070;font-family:Helvetica;font-size:12px;line-height:125%;text-align:center">

						                                
						                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
						                                <tbody><tr>
						                                    <td valign="top">
						                                        <div>
						                                        Nếu bạn có bất cứ thắc mắc gì, hãy liên hệ với chúng tôi qua <a href="mailto:'. RUSER .'" style="color:#61beb2" target="_blank">'. RUSER .'</a>
						                                        </div>
						                                    </td>
						                                </tr>
						                                <tr>
						                                    <td valign="top">
						                                        <div>
						                                            <em>Copyright © 2017-2018 CI-WEB Ltd, All rights reserved.</em>
						                                            <br>
						                                            Thiết kế bởi Steve Tran. Hân hạnh & Rất mong gặp lại!...
						                                            <br>
						                                        </div>
						                                    </td>
						                                </tr>
						                                </tbody></table>
						                                

						                            </td>
						                        </tr>
						                        </tbody></table>
						                        
						                    </td>
						                </tr>
						                </tbody></table>
						                <br>
            								</td>
            							</tr>
        							</tbody>
        						</table>
			        		</center>
			        	<div class="yj6qo"></div><div class="adL">
			    	</div></div>';

				$return = $this->smtpmailer($sender, $sendname, $receiver, $receiname, $subject, $body);
				if($return){
					echo '2'; exit();
				} else {
					echo '3'; exit();
				}				
			}
			echo '1'; exit();
		}

		echo '0'; exit();
	}

	function smtpmailer($sender = '', $sendname = '', $receiver = '', $receiname = '', $subject = '', $body = '', $reply = RUSER)
	{
    	$mail = new PHPMailer(true);                    // Passing `true` enables exceptions
    	try {
		    //Server settings
		    $mail->SMTPDebug = 0;                        // Enable verbose debug output
		    $mail->isSMTP();							 // Set mailer to use SMTP
		    $mail->CharSet = 'utf-8';                             
		    $mail->Host = SMTPHOST;  					 // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                      // Enable SMTP authentication
		    $mail->Username = GUSER;                     // SMTP username
		    $mail->Password = GPWD;                      // SMTP password
		    $mail->SMTPSecure = SMTPSERCURITY;           // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = SMTPPORT;                      // TCP port to connect to

		    //Recipients, or multiple recipient
		    $mail->setFrom($sender, $sendname);
		 
		    $mail->addAddress($receiver, $receiname);	    	
		    
		    $mail->addReplyTo($reply, 'Information');
		    
		    //Content
		    $mail->isHTML(true);               			// Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $body;

		    $mail->send();
		    //echo 'Message has been sent';
		    return true;
		} catch (Exception $e) {
		    //echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		    return false;
		}
	}

	function verify_passadmin()
	{
		$data = array();
		$issus = '';
		$token = trim(html_escape($this->input->get('token')));
		$mail = trim(html_escape($this->input->get('mail')));
		
		if($token && $token != '' && $mail && $mail != '') {
			$this->load->model('authorized_model');
			$authorized = $this->authorized_model->get('*', 'ac_email = "'. $mail .'" AND ac_code = "'. $token .'"');
			if($authorized){
				if(strtotime($authorized->ac_create_date) + $authorized->ac_during >= time()){
					
				} else {
					$issus = 'Token bạn yêu cầu hết thời hạn nhận lại mật khẩu. Vui lòng lấy cái mới!';
				}
			} else {
				$issus = 'Email hoặc token xác thực bạn nhận yêu cầu không đúng. Vui lòng thử lại!';
			}
		} else {
			$issus = 'Đường dẫn lấy mật khẩu không đúng. Vui lòng thử lại!';
		}

		$data['mail'] = $mail;
		$data['issus'] = $issus;
		#load view
		$this->load->view('admin/account/verifychangepass', $data);
	}

	function changepassadmin()
	{
		$pass = trim(html_escape($this->input->post('password')));
		$repass = trim(html_escape($this->input->post('repassword')));
		$mail = trim(html_escape($this->input->post('mail')));
		$issus = '';
		$data = array();
		if($pass && $pass != '' && $repass && $repass != ''){
			if($pass === $repass){
				$salt = $this->encrypt->random_key(8);
				$password = $this->encrypt->encode($pass, $salt);
				$dataUpdate = array('us_password' => $password, 'us_salt' => $salt, 'us_pass_ori' => $pass);
				if(! $this->user_model->update($dataUpdate, 'us_email = "'. $mail .'" AND us_group IN (1,2,3,4,5)')){
					$this->session->set_flashdata('sessionErrorChangePass', 'Đổi mật khẩu thất bại. Vui lòng nhập lại!..');
					redirect(base_url() . trim(uri_string(), '/'), 'location');
				}

			} else {				
				$this->session->set_flashdata('sessionErrorChangePass', 'Mật khẩu xác nhận không đúng. Vui lòng nhập lại!..');
				redirect(base_url() . trim(uri_string(), '/'), 'location');
			}
		} else {			
			$this->session->set_flashdata('sessionErrorChangePass', 'Bạn chưa nhập mật khẩu mới. Vui lòng nhập lại!..');
			redirect(base_url() . trim(uri_string(), '/'), 'location');
		}

		#Load view
		$this->load->view('admin/account/changepassadmin', $data);
	}

}
