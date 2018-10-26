<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Product extends CI_Controller {

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

        # Menu active
		$data['me_active'] = 'product';

        $this->load->vars($data);
    }

	public function index()
	{
		# Load view
		$this->load->view('account/index');
	}

	function list_category()
	{
		#Variable common		
		$select = 'cat_id, cat_name, cat_image, cat_image1, cat_desc, cat_publish, COUNT(*) AS total';
		$where = 'cat_publish IS TRUE AND pro_publish IS TRUE';
		$sort = 'cat_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = 'product';
		$join1 = 'INNER';
		$on1 = 'pro_cate = cat_id';

		$list_cate = $this->category_model->fetch_join2($select, $join1, $table1, $on1, '', '', '', $where, '', '', 0, 0, false, 'cat_id');
		$data['list_cate'] = $list_cate;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/product/list_cate', $data);
	}

	function category()
	{
		$num = 0;
		if ($this->uri->segment(1) !== FALSE 
			&& $this->uri->segment(1) == 'danh-muc' 
			&& $this->uri->segment(2) !== FALSE 
			&& $this->uri->segment(2) != '') {
			$segment = explode('-', $this->uri->segment(2));
			$num = (int)$segment[0];
		} else {
			redirect(base_url() . 'danh-muc', 'location');
			die;
		}	

		#Variable common
		$select = 'product.*';
		$where = 'pro_publish IS TRUE';
		$sort = 'pro_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$param = trim(strtolower($this->uri->segment(4)));        
        if (trim($this->uri->segment(3)) && trim($this->uri->segment(3)) == 'sap-xep' && $param && $param != '') {
        	switch ($param) {
        		case 'moi-nhat':                    
                    $sort = 'pro_id';  $by = "DESC";
                    break;

                case 'cu-nhat':                    
                    $sort = 'pro_id'; $by = "ASC";
                    break;

                case 'gia-tang':                    
                    $sort = 'pro_cost'; $by = "ASC";
                    break;

                case 'gia-giam':  $by = "DESC";                   
                    $sort = 'pro_cost';
                    break;               
        		
        		default:
        			$sort = 'pro_id'; $by = "DESC";
        			break; 
        	}        	
        }

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;

		if($num > 0) {
			$where .= ' AND pro_cate = '. $num;
		}

		$cat_pro = $this->product_model->fetch($select, $where, $sort, $by);
		$data['cat_pro'] = $cat_pro;

		#Show name category
		$cate = $this->category_model->get('cat_id, cat_name', 'cat_id = '. $num);
		$data['cate'] = $cate;
		$data['show_title'] = $cate->cat_name;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> $cate->cat_name,
			'link2'	=> '/danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name),
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/product/category', $data);
	}

	# Get all product
	function all_product()
	{
		#Variable common
		$select = 'product.*';
		$where = 'pro_publish IS TRUE';
		$sort = 'pro_id';
		$by = 'ASC';
		$start = 0;
		// $limit = obj_on_page;
		$limit = 6;
		$pageSort = '';		
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;

		$action = array('search', 'keyword', 'sort', 'by', 'trang', 'status');
        $getVar = $this->uri->uri_to_assoc(3, $action);
		#Search & Sort
		
		#Begin: Panigation
		#If have page
		if ($getVar['trang'] != FALSE && (int)$getVar['trang'] > 0) {
			# Pagination by page num 1, 2, 3, 4,...
        	# Setting constant K = 20 to get start correctest        	
			$p = (int)$getVar['trang'];
			$start = ($p * ($limit / 2)) + (($p - 2) * ($limit / 2));
			$pageSort .= '/trang/'. $start;
		} else {
			$p = 0;
			$start = 0; 
		}
		$this->load->library('pagination');
		$total = count($this->product_model->fetch('pro_id', $where));
		$config['base_url'] = base_url() .'san-pham/tat-ca-san-pham/trang/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['cur_page'] = $p; // Default cur_page = 0
		$this->pagination->initialize($config);				
		$data['page'] = $this->pagination->create_links();
		#End: Panigation
		$data['stt'] = $start;

		$all_pro = $this->product_model->fetch($select, $where, $sort, $by, $start, $limit);
		$data['all_pro'] = $all_pro;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> 'Tất cả sản phẩm',
			'link2'	=> '/san-pham/tat-ca-san-pham',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/product/all_product', $data);
	}

	# Get detail product
	function product()
	{
		$num = 0;
		if ($this->uri->segment(1) !== FALSE 
			&& $this->uri->segment(1) == 'san-pham' 
			&& $this->uri->segment(2) !== FALSE 
			&& $this->uri->segment(2) != '') {
			$segment = explode('-', $this->uri->segment(2));
			$num = (int)$segment[0];
		} else {
			redirect(base_url(), 'location');
			die;
		}

		# Counter view product
		$this->db->query("UPDATE `product` SET `pro_view` = `pro_view` + 1 WHERE `product`.`pro_id` = $num");

		$select = 'product.*';
		$where = 'pro_publish IS TRUE';

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;

		if($num > 0) {
			$where .= ' AND pro_id = '. $num;
		}

		$product = $this->product_model->get($select, $where);
		$data['product'] = $product;
		/**************************************************/
		# Get relative product
		$pro_in = '0';		
		if ($product && $product->pro_relative != '') {
			$pro_in = $product->pro_relative;
		}			
		$re_pro = $this->product_model->fetch('pro_id, pro_name, pro_image, pro_dir', 'pro_publish IS TRUE AND pro_id IN ('. $pro_in .')');
		$data['re_pro'] = $re_pro;
		/**************************************************/
		# Get product the same category
		$where1 = 'pro_publish IS TRUE AND pro_cate = '. $product->pro_cate .' AND pro_id <> '. $product->pro_id;
		$pro_in_cat = $this->product_model->fetch($select, $where1);
		$data['pro_in_cat'] = $pro_in_cat;
		/**************************************************/

		#Show name category
		$cate = $this->category_model->get('cat_id, cat_name', 'cat_id = '. $product->pro_cate);

		# Add session product curent viewed
		$viewed = $this->session->userdata('viewed');

		if (empty($viewed)) {
            $viewed = array();
            $pro_viewed = array();
			$pro_viewed['idv'] 	 	= $product->pro_id;
			$pro_viewed['namev'] 	= $product->pro_name;
			$pro_viewed['imagev']   = explode(',', $product->pro_image)[0];
			$pro_viewed['dirv']   	= $product->pro_dir;
			$pro_viewed['pricev']   = ($product->DISCOUNT == 0) ? $product->pro_cost : ($product->pro_cost - $product->DISCOUNT);

			array_push($viewed, $pro_viewed);						
			$this->session->set_userdata('viewed', $viewed);
			$this->session->mark_as_temp('viewed', 60*60*24*7);
        } else {
        	$ar = array();
        	foreach ($viewed as $kv => $itemView) {        		
        		$ar[] = (int)$itemView['idv'];
        	}

            if ( ! in_array($product->pro_id, $ar)) {
                $pro_viewed = array();
				$pro_viewed['idv'] 	 	= $product->pro_id;
				$pro_viewed['namev'] 	= $product->pro_name;
				$pro_viewed['imagev']   = explode(',', $product->pro_image)[0];
				$pro_viewed['dirv']   	= $product->pro_dir;
				$pro_viewed['pricev']   = ($product->DISCOUNT == 0) ? $product->pro_cost : ($product->pro_cost - $product->DISCOUNT);
				array_push($viewed, $pro_viewed);			
				$this->session->set_userdata('viewed', $viewed);
				$this->session->mark_as_temp('viewed', 60*60*24*7);
            }
        }

        # Get session viewed product current
		$viewed = $this->session->userdata('viewed');

		if (empty($viewed)) {
			$data['pro_viewed'] = array();
		}

		$apv = array();
		$listpv = '0';
		foreach ($viewed as $vv) {
			$apv[] = (int)$vv['idv'];
		}
		if ($apv) {
			$listpv = implode(',', $apv);
		}

		$select = 'product.*';
		$where = 'pro_publish IS TRUE';

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;

		if($listpv != '') {
			$where .= ' AND pro_id IN ('. $listpv .')';
		}

		$pro_viewed = $this->product_model->fetch($select, $where);
		$data['pro_viewed'] = $pro_viewed;
		/**************************************************/

		// $this->session->sess_destroy();
		// echo '<pre>';
		// print_r($pro_viewed);
		// echo '</pre>'; die;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> $cate->cat_name,
			'link2'	=> '/danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name),
			'lv3'	=> $product->pro_name,
			'link3'	=> '/san-pham/'. $product->pro_id .'-'. RemoveSign($product->pro_name)
		);
		$data['brcrum'] = $brcrum;
		
		# Load view
		$this->load->view('account/product/detail', $data);
	}

	function viewed_current()
	{
		# Get session viewed product current
		$viewed = $this->session->userdata('viewed');

		if (empty($viewed)) {
			redirect(base_url(), 'location');
			die;
		}

		$apv = array();
		$listpv = '0';
		foreach ($viewed as $vv) {
			$apv[] = (int)$vv['idv'];
		}
		if ($apv) {
			$listpv = implode(',', $apv);
		}

		$select = 'product.*';
		$where = 'pro_publish IS TRUE';

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;

		if($listpv != '') {
			$where .= ' AND pro_id IN ('. $listpv .')';
		}

		$pro_viewed = $this->product_model->fetch($select, $where);
		$data['pro_viewed'] = $pro_viewed;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> 'Sản phẩm mới xem',
			'link2'	=> '/san-pham/xem-gan-day',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/product/viewed', $data);
	}

	function product_favorite()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url() .'tai-khoan/dang-nhap', 'location');
			die;
		}

		$select = 'product.*';
		$where = 'pro_publish IS TRUE AND lp_user = '. $this->session->userdata('sessionUser');
		$table = 'love_product';
		$on = 'love_product.lp_product = product.pro_id';
		$join = 'INNER';

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';       	
       	$select .= $select_promo;		

		$pro_favo = $this->product_model->fetch_join1($select, $join, $table, $on, $where);
		$data['pro_favo'] = $pro_favo;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> 'Sản phẩm yêu thích',
			'link2'	=> '/tai-khoan/san-pham-thich',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/product/favorited', $data);
	}

	function product_view()
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url() .'tai-khoan/dang-nhap', 'location');
			die;
		}

		$viewed = $this->session->userdata('viewed');

		$strid = '0';
		if(! empty($viewed)) {
			$idv = array(); 
			foreach ($viewed as $value) {
				$idv[] = $value['idv'];
			}

			if ($idv && !empty($idv)) {
				$strid = implode(',', $idv);
			}
		}

		$select = 'product.*';
		$where = 'pro_publish IS TRUE AND pro_id IN ('. $strid .')';
		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';       	
       	$select .= $select_promo;		

		$pro_view = $this->product_model->fetch($select, $where);
		$data['pro_view'] = $pro_view;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> 'Sản phẩm xem gần đây',
			'link2'	=> '/tai-khoan/san-pham-xem',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/product/myviewed', $data);
	}

	function addtofav()
	{
		$pid = (int)$this->input->post('pid');
		$user = (int)$this->session->userdata('sessionUser');
		if ($pid > 0 && $user > 0) {
			$this->load->model('love_product_model');
			$favo = $this->love_product_model->get('lp_id', 'lp_product = '. $pid .' AND lp_user = '. $user);
			if ($favo && count($favo) >= 1) {
				echo '2'; exit();
			} else {
				$dataAdd = array('lp_user' => $user, 'lp_product' => $pid, 'lp_lovedate' => date('Y-m-d H:i:s'));
				if ($this->love_product_model->add($dataAdd)) {
					echo '1'; exit();
				}
			}			
		}

		echo '0'; exit();
	}

	function removefav($id = 0)
	{
		if ( ! $this->session->userdata('sessionUser')) {
			redirect(base_url(), 'location');
			die;
		}

		if ((int)$id > 0) {
			$this->load->model('love_product_model');
			if ($this->love_product_model->delete_multi_where('lp_product = '. (int)$id .' AND lp_user = '. $this->session->userdata('sessionUser'))) {
				$this->session->set_flashdata('sessionSuccess', 'Bạn vừa xóa sản phẩm yêu thích thành công!');
			} else {
				$this->session->set_flashdata('sessionError', 'Xóa sản phẩm yêu thích không thành công. Vui lòng kiểm tra lại!');
			}
			redirect(base_url() .'tai-khoan/san-pham-thich', 'location');
			die;
		}
	}

	function notifytome()
	{
		$pid = (int)$this->input->post('pid');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$user = $this->session->userdata('sessionUser') ? (int)$this->session->userdata('sessionUser') : 0;
		if ($pid > 0 && ($email != '' || $mobile != '' || $user > 0)) {

			if ($user > 0) {
				$this->load->model('user_model');
				$u = $this->user_model->get('us_username, us_mobile, us_email', 'us_id = '. $user);
				$email = $u->us_email;
				$mobile = $u->us_mobile;
			}

			$dataAdd = array(
				'np_user' => $user, 
				'np_product' => $pid, 
				'np_createdate' => date('Y-m-d H:i:s'), 
				'np_type' => 1,
				'np_mobile' => $mobile,
				'np_email' => $email,
				'np_status' => 1
			);
			$this->load->model('notify_product_model');
			if ($this->notify_product_model->add($dataAdd)) {
				echo '1'; exit();
			}			
		}

		echo '0'; exit();
	}

	function callme()
	{
		$pid = (int)$this->input->post('pid');
		$mobile = $this->input->post('mobile');
		$user = (int)$this->input->post('user');

		if ($pid > 0 && $mobile != '') {
			$email = '';
			if ($user > 0) {
				$this->load->model('user_model');
				$u = $this->user_model->get('us_username, us_mobile, us_email', 'us_id = '. $user);
				$email = $u->us_email;
			}
			
			$dataAdd = array(
				'np_user' => $user,
				'np_product' => $pid,
				'np_createdate' => date('Y-m-d H:i:s'),
				'np_type' => 2,
				'np_mobile' => $mobile,
				'np_email' => $email,
				'np_status' => 1
			);

			$this->load->model('notify_product_model');
			if ($this->notify_product_model->add($dataAdd)) {
				echo '1'; exit();
			}
		}

		echo '0'; exit();
	}

	// Get for search
	function search_product()
	{
		$q = trim(html_escape($this->input->post('q')));
		#Variable common
		$select = 'product.*';
		$where = 'pro_publish IS TRUE';
		$sort = 'pro_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;

		if ($q && $q != '') {
			$where .= ' AND pro_name LIKE "%'. $q .'%"';
		}

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';
       	
       	$select .= $select_promo;		

		$search_pro = $this->product_model->fetch($select, $where);
		$data['search_pro'] = $search_pro;

		$data['q'] = $q;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Sản phẩm',
			'link1' => '/danh-muc',
			'lv2'	=> 'Tìm sản phẩm',
			'link2'	=> '/san-pham/tim-kiem',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Load view
		$this->load->view('account/product/search_product', $data);
	}

	// Get for Ajax
	function get_product()
	{
		$q = trim(html_escape($this->input->post('q')));
		$result = array();
		$result['error'] = false;
		
		$select = 'product.pro_id, product.pro_name, product.pro_image, product.pro_dir, product.pro_cost';
		$where = 'pro_publish IS TRUE';

		if ($q && $q != '') {
			$where .= ' AND pro_name LIKE "%'. $q .'%"';
		}

		# SQL have promotion for product => number money discount
		$select_promo = ', IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT';       	
       	$select .= $select_promo;		

		$get_pro = $this->product_model->fetch($select, $where);

		if ($get_pro) {
			include_once $_SERVER['DOCUMENT_ROOT'] ."/smart_resize_image.function.php";
			$rss = array();		
			foreach ($get_pro as $k => $v) {
				if (! isset($result[$k])) {$result[$k] = array();}
				$rss['link'] = '/san-pham/'. $v->pro_id .'-'. RemoveSign($v->pro_name);
				$rss['name'] = $v->pro_name;
				$rss['cost'] = number_format(($v->DISCOUNT > 0) ? $v->pro_cost - $v->DISCOUNT : $v->pro_cost, 0, '.', '.') .'đ';
				if ($v->pro_name != '' && ! file_exists('media/images/product/'. $v->pro_dir .'/thumbnail_55_'. explode(',', $v->pro_image)[0])) {
					smart_resize_image('media/images/product/'. $v->pro_dir .'/'. explode(',', $v->pro_image)[0], null, 55, 55, false, 'media/images/product/'. $v->pro_dir .'/thumbnail_55_'. explode(',', $v->pro_image)[0], false , false ,100);
				}
				$rss['image'] = 'media/images/product/'. $v->pro_dir .'/thumbnail_55_'. explode(',', $v->pro_image)[0];
				$result[$k] = $rss;
			}
		}

		echo json_encode($result); exit();		
	}

}
