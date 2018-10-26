<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Content extends CI_Controller {

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
        $this->load->model('product_model');
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

	function news()
	{
		# Menu active
		$data['me_active'] = 'news';

		$select = '*';
		$where = 'con_type = 1 AND con_publish IS TRUE';

		$li_news = $this->content_model->fetch($select, $where);
		$data['li_news'] = $li_news;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Tin tức',
			'link1' => '/tin-tuc',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/content/news', $data);
	}

	function blogs()
	{
		# Menu active
		$data['me_active'] = 'blogs';

		$select = '*';
		$where = 'con_type = 2 AND con_publish IS TRUE';

		$li_news = $this->content_model->fetch($select, $where);
		$data['li_news'] = $li_news;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Blogs',
			'link1' => '/blogs',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/content/blogs', $data);
	}

	function promotion()
	{
		# Menu active
		$data['me_active'] = 'promo';

		$select = '*';
		$where = 'con_type = 3 AND con_publish IS TRUE';

		$li_news = $this->content_model->fetch($select, $where);
		$data['li_news'] = $li_news;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Khuyến mãi',
			'link1' => '/khuyen-mai',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/content/promotion', $data);
	}

	function detail()
	{
		$num = 0;
		if ($this->uri->segment(1) !== FALSE 
			&& $this->uri->segment(1) == 'tin-tuc' 
			&& $this->uri->segment(2) !== FALSE 
			&& $this->uri->segment(2) != '') {
			$segment = explode('-', $this->uri->segment(2));
			$num = (int)$segment[0];
		} else {
			redirect(base_url(), 'location');
			die;
		}

		# Counter view content		
		$this->db->query("UPDATE `content` SET `con_view` = `con_view` + 1 WHERE `content`.`con_id` = $num");

		# Menu active
		$data['me_active'] = 'news';

		$select = '`content`.*';
		$where = '`con_publish` IS TRUE';

		if ($num > 0) {
			$where .= ' AND `con_id` = '. $num;
		}

		$news = $this->content_model->get($select, $where);
		if (! $news) {
			$this->session->set_flashdata('sessionError', 'Bài viết này chưa được kích hoạt. Vui lòng chọn nội dung khác!!');
			redirect(base_url() .'tin-tuc', 'location');
			die;
		}

		$data['news'] = $news;

		# Get list content relative
		$li_re_news = $this->content_model->fetch('con_id, con_title', 'con_publish IS TRUE', 'con_id', 'DESC' , $num + 1, 5);
		$data['li_re_news'] = $li_re_news;

		$_cate_name = ''; $_cate_link = '';
		if ($news && $news->con_type == 1) {
			$_cate_name = 'Tin tức';
			$_cate_link = '/tin-tuc';
		} else if ($news && $news->con_type == 2) {
			$_cate_name = 'Blogs';
			$_cate_link = '/blogs';
		} else if ($news && $news->con_type == 3) {
			$_cate_name = 'Khuyến mãi';
			$_cate_link = '/khuyen-mai';
		} else if ($news && $news->con_type == 4) {
			$_cate_name = 'Hướng dẫn';
			$_cate_link = '/huong-dan';
		}

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> $_cate_name,
			'link1' => $_cate_link,
			'lv2'	=> $news->con_title,
			'link2'	=> $_cate_link .'/'. $news->con_id .'-'. RemoveSign($news->con_title),
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		#Load view
		$this->load->view('account/content/detail', $data);
	}
}
