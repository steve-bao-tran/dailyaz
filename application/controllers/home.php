<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

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

}
