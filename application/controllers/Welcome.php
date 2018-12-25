<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        
        #Load model
        $this->load->model('infous_model');
        $this->load->model('content_model');
        $this->load->model('category_model');
        $this->load->model('show_home_model');
        $this->load->model('user_model');

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

        # Menu active
        $data['me_active'] = 'home';

        $this->load->vars($data);
    }

	public function index()
	{
        # Get category
        $cate_home = $this->category_model->fetch('cat_id, cat_name, cat_image1', 'cat_publish IS TRUE', 'cat_id', 'ACS');
        $data['cate_home'] = $cate_home;        

        # Get list style
        $this->load->model('style_attribute_model');
        $style_home = $this->style_attribute_model->fetch('*', 'sty_publish IS TRUE');
        $data['style_home'] = $style_home;        
        // echo '<pre>'; print_r(phpinfo()); echo '</pre>'; die;
		#Load view
		$this->load->view('account/index', $data);
	}

    function contactus()
    { 
        # Menu active
        $data['me_active'] = 'contact';

        if ($this->session->userdata('sessionUser')) {
            $user = $this->user_model->get('*', 'us_publish IS TRUE AND us_id = '. $this->session->userdata('sessionUser'));
            $data['user'] = $user;
        }

        // list($width, $height, $type, $attr) = getimagesize("./fe6257278635d5ddb21aed07b677cf4c.gif");
        // echo "Image width " . $width;
        // echo "Image height " . $height;
        // echo "Image type " . $type;
        // echo "Attribute " . $attr;
        // die;

        $this->load->library('upload');
        $configU['upload_path']          = 'media';
        $configU['allowed_types']        = 'gif|jpg|png';
        $configU['max_size']             = 500;
        $configU['max_width']            = 1024;
        $configU['max_height']           = 1024;           
        $configU['encrypt_name'] = TRUE;             
        $configU['max_size'] = MAXUPLOAD;#KB
        //$this->load->library('upload', $config);       

        $this->load->library('upload', $configU);
        $this->upload->initialize($configU);        

        if ( ! $this->upload->do_upload('images')) {
            $error = array('error' => $this->upload->display_errors()); 
        } else {
            $data = array('upload_data' => $this->upload->data()); 
            $this->load->library('image_lib');
            $config['image_library']    = 'gd2';
            $config['source_image']     = 'media/'. $this->upload->data('file_name');  
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = FALSE;
            $config['width']            = 600;
            $config['height']           = 600;   
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            die('Thanh cong');           
        }        

        if ($this->input->post('name_contact') && $this->input->post('name_contact') != '') {
            if (1) {
                # Send mail to admin
                $folder = folderWeb;
                require_once($_SERVER['DOCUMENT_ROOT'] . $folder .'/PHPMailer/src/PHPMailer.php');
                require_once($_SERVER['DOCUMENT_ROOT'] . $folder .'/PHPMailer/src/Exception.php');
                require_once($_SERVER['DOCUMENT_ROOT'] . $folder .'/PHPMailer/src/OAuth.php');
                require_once($_SERVER['DOCUMENT_ROOT'] . $folder .'/PHPMailer/src/POP3.php');
                require_once($_SERVER['DOCUMENT_ROOT'] . $folder .'/PHPMailer/src/SMTP.php');

                // $sender = GUSER;                
                $sender = $this->session->userdata('sessionUser') ? $user->us_email : trim(html_escape($this->input->post('email_contact')));                
                // $sendname = GNAME;
                $sendname = $this->session->userdata('sessionUser') ? $user->us_fullname : trim(html_escape($this->input->post('name_contact')));
                $receiver = 'stevetran.bao@gmail.com';
                $receiname = 'Quản trị '. Company;
                $subject = trim(html_escape($this->input->post('name_contact')));
                $body = trim(html_escape($this->input->post('content_contact')));

                $return = $this->smtpmailer($sender, $sendname, $receiver, $receiname, $subject, $body);

                # Add contact into database
                $dataPost = array(
                    'ct_name' => trim(html_escape($this->input->post('title_contact'))),
                    'ct_fullname' => $this->session->userdata('sessionUser') ? $user->us_fullname : trim(html_escape($this->input->post('name_contact'))),
                    'ct_email' => $this->session->userdata('sessionUser') ? $user->us_email : trim(html_escape($this->input->post('email_contact'))),
                    'ct_mobile' => $this->session->userdata('sessionUser') ? $user->us_mobile : trim(html_escape($this->input->post('phone_contact'))),
                    'ct_address' => $this->session->userdata('sessionUser') ? $user->us_address : trim(html_escape($this->input->post('address_contact'))),
                    'ct_detail' => trim(html_escape($this->input->post('content_contact'))),
                    'ct_status' => 1,
                    'ct_createdate' => date('Y-m-d H:i:s')
                );

                $this->load->model('contact_model');
                if ($return && $this->contact_model->add($dataPost)) {
                    $this->session->set_flashdata('sessionSuccess', 'Bạn vừa gửi liên hệ đến quản trị thành công!');
                } else {
                    $this->session->set_flashdata('sessionError', 'Gửi liên hệ không thành công. Vui lòng kiểm tra lại!');
                }

                redirect(base_url(), 'location');
                die;
            } else {
                $this->session->set_flashdata('sessionError', 'Mã xác nhận không đúng. Vui lòng kiểm tra lại!');
                redirect(base_url() . trim(uri_string(), '/'), 'location');
                die;
            }
        } else {
            #BEGIN: Create captcha
            $this->load->library('captcha');
            $codeCaptcha = $this->captcha->code(6);
            $data['captcha'] = $codeCaptcha;
            $this->session->set_flashdata('sessionCaptchaContact', $codeCaptcha);
            $imageCaptcha = 'templates/captcha/'. md5(microtime()) .'.'. rand(10, 10000) .'captcha.jpg';
            $this->session->set_flashdata('sessionPathCaptchaContact', $imageCaptcha);
            $this->captcha->create($codeCaptcha, $imageCaptcha);
            if(file_exists($imageCaptcha)) {
                $data['imageCaptchaContact'] = $imageCaptcha;
            }
            #END: Create captcha
        }

        # Breadcrum
        $brcrum = array(
            'lv1'   => 'Liên hệ',
            'link1' => '/lien-he',
            'lv2'   => '',
            'link2' => '',
            'lv3'   => '',
            'link3' => ''
        );
        $data['brcrum'] = $brcrum;

        #Load view
        $this->load->view('account/contact/contact', $data);
    }

    function smtpmailer($sender = '', $sendname = '', $receiver = '', $receiname = '', $subject = '', $body = '', $reply = RUSER){
        $mail = new PHPMailer(true);                    // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 1;                        // Enable verbose debug output
            $mail->isSMTP();                             // Set mailer to use SMTP
            $mail->CharSet = 'utf-8';                             
            $mail->Host = SMTPHOST;                      // Specify main and backup SMTP servers
            $mail->Mailer = SMTP;                        // Specify main and backup SMTP servers
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
            $mail->isHTML(true);                        // Set email format to HTML
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
}
