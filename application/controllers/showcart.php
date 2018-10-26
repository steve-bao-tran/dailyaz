<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Showcart extends CI_Controller {

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
        // $this->db->query('UPDATE `counter` SET `cou_num` = `cou_num` + 1 WHERE `counter`.`cou_id` = 1 AND `counter`.`cou_publish` IS TRUE');

        # Get show home        
        $show_home = $this->show_home_model->get('*');
        $data['show_home'] = $show_home;

        # Menu active
		// $data['me_active'] = 'product';

        $this->load->vars($data);
    }

	public function index()
	{
		# Load view
		$this->load->view('account/index');
	}

	# Add cart
	function add()
	{
		$cart = $this->session->userdata('cart'); // Session Cart
		$pid = (int)$this->input->post('pid');	// ID product
		$qty = ($this->input->post('qty')) ? (int)$this->input->post('qty') : 1; // Number in cart			
		$result = array();
		$result['error'] = FALSE;

		$arrid = array();
		$num = 0;
		$numpro = 0;
		if (empty($cart)) {
			$cart = array();
		} else {
			foreach ($cart as $kc => $vc) {
				$arrid[] = $vc['idc'];
				$num += (int)$vc['quantityc'];
				if ($pid == $vc['idc']) {
					$numpro += (int)$vc['quantityc'];					
				}
			}
		}

		$product = $this->product_model->get('product.*, IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT', 'pro_publish IS TRUE AND pro_id = '. $pid);

		if ($pid > 0 && $product) {

			if ($numpro + $qty <= $product->pro_instock) {
			
				if ($num + $qty <= LIMITADDCART && $qty > 0) {

					if (! isset($cart[$product->pro_id])) {
                        $cart[$product->pro_id] = array();
                    }
					
					if (! in_array($pid, $arrid)) {
						$arcart = array();
						$arcart['idc'] = $product->pro_id;
						$arcart['namec'] = $product->pro_name;
						$arcart['imagec'] = explode(',', $product->pro_image)[0];
						$arcart['dirc'] = $product->pro_dir;
						$arcart['quantityc'] = $qty;
						$arcart['pricec'] = ($product->pro_saleoff == 1) ? ($product->pro_cost - $product->DISCOUNT) : $product->pro_cost;						
						$cart[$product->pro_id] = $arcart;
						$this->session->set_userdata('cart', $cart);

					} else {						
						$this->session->unset_userdata($cart[$product->pro_id]);
						$arcart = array();
						$arcart['idc'] = $product->pro_id;
						$arcart['namec'] = $product->pro_name;
						$arcart['imagec'] = explode(',', $product->pro_image)[0];
						$arcart['dirc'] = $product->pro_dir;
						$arcart['quantityc'] = $numpro + $qty;
						$arcart['pricec'] = ($product->pro_saleoff == 1) ? ($product->pro_cost - $product->DISCOUNT) : $product->pro_cost;						
						$cart[$product->pro_id] = $arcart;
						$this->session->set_userdata('cart', $cart);
					}
					
					$result['message'] = $product->pro_name .' đã được thêm vào giỏ hàng. Xem <a style="color:red;" href="'. base_url() .'gio-hang"><i class="fa fa-shopping-cart fa-fw"></i>giỏ hàng</a>';
					$this->session->set_flashdata('sessionSuccess', $product->pro_name . ' đã được thêm vào giỏ hàng. Xem <a style="color:red;" href="'. base_url() .'gio-hang"><i class="fa fa-shopping-cart fa-fw"></i>giỏ hàng</a>');	
					$result['num'] = $num + $qty;
				} else {
					$result['error'] = TRUE;
	                $result['message'] = 'Số lượng sản phẩm trong giỏ hàng vượt quá số lượng quy định. Vui lòng nhập số khác!!';
	                $this->session->set_flashdata('sessionError', 'Số lượng sản phẩm trong giỏ hàng vượt quá số lượng quy định. Vui lòng nhập số khác!!');
				}
			} else {
				$result['error'] = TRUE;
	            $result['message'] = 'Số lượng sản phẩm trong kho không đủ. Vui lòng nhập số lượng khác!!';
	            $this->session->set_flashdata('sessionError', 'Số lượng sản phẩm trong kho không đủ. Vui lòng nhập số lượng khác!!');
			}

		} else {
			$result['error'] = TRUE;
            $result['message'] = 'Sản phẩm không tồn tại. Vui lòng chọn sản phẩm khác!!';
            $this->session->set_flashdata('sessionError', 'Sản phẩm không tồn tại. Vui lòng chọn sản phẩm khác!!');
		}

		echo json_encode($result);
		exit();
	}

	# Update cart, copy from Add cart, differen have no : sub 1 product
	function update_cart()
	{
		$cart = $this->session->userdata('cart'); // Session Cart
		$pid = (int)$this->input->post('pid');	// ID product need update
		$qty = ($this->input->post('qty')) ? (int)$this->input->post('qty') : 1; // Number in Cart
		$no = ($this->input->post('no')) ? (int)$this->input->post('no') : 0; // Add 1 or Sub 1 to Cart
		$result = array();
		$result['error'] = FALSE;
		
		$num = 0;
		$numpro = 0;
		if (! empty($cart)) {
			foreach ($cart as $kc => $vc) {				
				$num += (int)$vc['quantityc'];
				if ($pid == $vc['idc']) {
					$numpro += (int)$vc['quantityc'];
					if ($no == 0) {
						$num -= (int)$vc['quantityc'];
						$numpro -= (int)$vc['quantityc'];
					} else {
						$num = $num + $no - (int)$vc['quantityc'];
						$numpro = $numpro + $no - (int)$vc['quantityc'];
					}
				}
			}

			$product = $this->product_model->get('product.*, IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT', 'pro_publish IS TRUE AND pro_id = '. $pid);

			if ($pid > 0 && $product) {

				if ($numpro + $qty <= $product->pro_instock) {
				
					if ($num + $qty <= LIMITADDCART && $qty > 0) {

						if (! isset($cart[$product->pro_id])) {
	                        $cart[$product->pro_id] = array();
	                    }					
						$this->session->unset_userdata($cart[$product->pro_id]);
						$arcart = array();
						$arcart['idc'] = $product->pro_id;
						$arcart['namec'] = $product->pro_name;
						$arcart['imagec'] = explode(',', $product->pro_image)[0];
						$arcart['dirc'] = $product->pro_dir;
						$arcart['quantityc'] = $numpro + $qty; // Change
						$arcart['pricec'] = ($product->pro_saleoff == 1) ? ($product->pro_cost - $product->DISCOUNT) : $product->pro_cost;						
						$cart[$product->pro_id] = $arcart;
						$this->session->set_userdata('cart', $cart);						
						
						$result['message'] = $product->pro_name .' đã được cập nhật vào giỏ hàng. Xem <a style="color:red;" href="'. base_url() .'gio-hang"><i class="fa fa-shopping-cart fa-fw"></i>giỏ hàng</a>';
						$this->session->set_flashdata('sessionSuccess', $product->pro_name .' đã được cập nhật vào giỏ hàng. Xem <a style="color:red;" href="'. base_url() .'gio-hang"><i class="fa fa-shopping-cart fa-fw"></i>giỏ hàng</a>');	
						$result['num'] = $num + $qty; // Change
					} else {
						$result['error'] = TRUE;
		                $result['message'] = 'Số lượng sản phẩm trong giỏ hàng vượt quá số lượng quy định. Vui lòng nhập số khác!!';
		                $this->session->set_flashdata('sessionError', 'Số lượng sản phẩm trong giỏ hàng vượt quá số lượng quy định. Vui lòng nhập số khác!!');
					}
				} else {
					$result['error'] = TRUE;
		            $result['message'] = 'Số lượng sản phẩm trong kho không đủ. Vui lòng nhập số lượng khác!!';
		            $this->session->set_flashdata('sessionError', 'Số lượng sản phẩm trong kho không đủ. Vui lòng nhập số lượng khác!!');
				}

			} else {
				$result['error'] = TRUE;
	            $result['message'] = 'Sản phẩm không tồn tại. Vui lòng chọn sản phẩm khác!!';
	            $this->session->set_flashdata('sessionError', 'Sản phẩm không tồn tại. Vui lòng chọn sản phẩm khác!!');
			}
		} else {
			$result['error'] = TRUE;
			$result['message'] = 'Giỏ hàng không tồn tại. Vui lòng kiểm tra lại!!';
	        $this->session->set_flashdata('sessionError', 'Giỏ hàng không tồn tại. Vui lòng kiểm tra lại!!');
		}		

		echo json_encode($result);
		exit();
	}

	function delete_cart($pid = 0)
	{
		if ($pid > 0) {
			$cart = $this->session->userdata('cart');
			$arrid = array();			
			if (! empty($cart)) {
				if (! isset($cart[$pid])) {
					$cart[$pid] = array();
				}

				foreach ($cart as $kc => $vc) {
					$arrid[] = $vc['idc'];
				}

				if (! empty($arrid)){
					if (in_array($pid, $arrid)) {						
						unset($cart[$pid]);
						$this->session->set_userdata('cart', $cart);
						$this->session->set_flashdata('sessionSuccess', 'Bạn vừa xóa sản phẩm trong giỏ hàng của bạn thành công!');						
					} else {
						$this->session->set_flashdata('sessionError', 'Có lỗi xảy ra, sản phẩm không tồn tại trong giỏ hàng của bạn!. Vui lòng kiểm tra lại!!');
					}
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Có lỗi xảy ra, sản phẩm không tồn tại trong giỏ hàng của bạn!. Vui lòng kiểm tra lại!!');
			}
		} else {
			$this->session->set_flashdata('sessionError', 'Có lỗi xảy ra, sản phẩm không tồn tại trong giỏ hàng của bạn!. Vui lòng kiểm tra lại!!');
		}

		redirect(base_url() . 'gio-hang', 'location');
		die;
	}

	function buynow()
	{
			
	}	
	
	function cart()
	{
		// $cart = $this->session->userdata('cart');

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Giỏ hàng',
			'link1' => '/gio-hang',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/showcart/cart', $data);
	}

	function checkout()
	{
		// $cart = $this->session->userdata('cart');
		if ($this->session->userdata('sessionUser')) {
			$this->load->model('user_model');
			$user = $this->user_model->get('*', 'us_publish IS TRUE AND us_id = '. $this->session->userdata('sessionUser'));
			if (! empty($user)) {
				$data['user'] = $user;
			} else {
				$this->session->set_flashdata('sessionError', 'Thành viên chưa được kích hoạt. Vui lòng liên hệ với quản trị viên!!');
				redirect(base_url() . 'dat-hang', 'location');
				die;
			}
		}
		
		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thanh toán',
			'link1' => '/dat-hang',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/showcart/checkout', $data);
	}

	function checkout_register()
	{
		// $cart = $this->session->userdata('cart');
		$createacc = true;
		if ($this->uri->segment(1) !== FALSE 
			&& $this->uri->segment(1) == 'dat-hang' 
			&& $this->uri->segment(2) !== FALSE 
			&& $this->uri->segment(2) == 'khong-tao-tai-khoan') {
			$createacc = false;
		}

		$data['createacc'] = $createacc;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thanh toán',
			'link1' => '/dat-hang',
			'lv2'	=> '',
			'link2'	=> '',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;

		# Menu active
		$data['me_active'] = 'home';

		# Load view
		$this->load->view('account/showcart/checkout_register', $data);
	}

	# Make Order
	function order()
	{
		if ($this->input->post('chfullname') 
			&& $this->input->post('chfullname') != ''
			&& $this->input->post('chaddress') 
			&& $this->input->post('chaddress') != ''
			&& $this->input->post('chmobile') 
			&& $this->input->post('chmobile') != ''
		) {

			$cart = $this->session->userdata('cart');
			$createacc = ($this->input->post('createacc')) ? (int)$this->input->post('createacc') : 0;
			$this->load->model('user_model');
			$this->load->model('receiver_model');
			$this->load->model('order_model');
			$this->load->model('showcart_model');
			$this->load->library('encrypt');

			if (! empty($cart)) {

				$user = 0; 
				$receiver = 0;
				$cost = 0;
				$cost_promos = 0;
				$quantity = 0;

				if ($this->session->userdata('sessionUser')) {
					$user = $this->session->userdata('sessionUser');
				}				

				// Create user
				if ($createacc && $createacc == 1) {
					if ($this->input->post('chusername') 
						&& $this->input->post('chusername') != ''
						&& $this->input->post('chpassword') 
						&& $this->input->post('chpassword') != '') {
						$salt = $this->encrypt->random_key(8);
						$password = $this->encrypt->encode(trim(html_escape($this->input->post('chpassword'))), $salt);

						$dataUser = array(
							'us_username' => trim(html_escape($this->input->post('chusername'))),
							'us_password' => $password,
							'us_salt' => $salt,
							'us_origpass' => trim(html_escape($this->input->post('chpassword'))),
							'us_fullname' => trim(html_escape($this->input->post('chfullname'))),
							'us_email' => trim(html_escape($this->input->post('chemail'))),
							'us_mobile' => trim(html_escape($this->input->post('chmobile'))),
							'us_address' => trim(html_escape($this->input->post('chaddress'))),
							'us_gen' => 3,
							'us_group' => 2,
							'us_createdate' => date('Y-m-d H:i:s'),
							'us_update' => date('Y-m-d H:i:s'),
							'us_publish' => true
						);

						$this->user_model->add($dataUser);
						$user = (int)$this->db->insert_id();
					}					
				}

				// Create receiver
				$dataRecei = array(
					'rc_fullname' => trim(html_escape($this->input->post('chfullname'))),
					'rc_address' => trim(html_escape($this->input->post('chaddress'))),
					'rc_mobile' => trim(html_escape($this->input->post('chmobile'))),
					'rc_email' => trim(html_escape($this->input->post('chemail'))),
					'rc_note' => trim(html_escape($this->input->post('chnote'))),
					'rc_createdate' => date('Y-m-d H:i:s'),
					'rc_user' => $user,
					'rc_publish' => true
				);

				if ($this->receiver_model->add($dataRecei)) {

					# TH 1: Create receiver success
					$receiver = (int)$this->db->insert_id();

					foreach ($cart as $kc => $vc) {
						$product = $this->product_model->get('product.*, IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT', 'pro_publish IS TRUE AND pro_id = '. $kc);
						$cost += $product->pro_cost * $vc['quantityc'];
						$cost_promos += ($product->pro_cost - $product->DISCOUNT) * $vc['quantityc'];
						$quantity += $vc['quantityc'];
					}

					$ocode = $this->encrypt->random_key(64);						

					// Create order
					$dataOrder = array(
						'o_code' => $ocode,
						'o_date' => date('Y-m-d H:i:s'),
						'o_user' => $user,
						'o_receiver' => $receiver,
						'o_cost' => $cost,
						'o_cost_promos' => $cost_promos,
						'o_quantity' => $quantity,
						'o_status' => 1,
						'o_change_status_date' => date('Y-m-d H:i:s'),
						'o_is_ship' => 0,
						'o_fee_ship' => 0,
						'o_payment_status' => 0
					);

					if ($this->order_model->add($dataOrder)) {
						// Get order ID, current add
						$orderid = (int)$this->db->insert_id();

						foreach ($cart as $kcs => $vcs) {
							$pro = $this->product_model->get('product.*, IF(product.pro_saleoff IS TRUE AND CURDATE() >= product.pro_beginsale AND CURDATE() <= product.pro_endsale, CAST(product.pro_percent AS DECIMAL (15, 5)) * product.pro_cost / 100, 0) AS DISCOUNT', 'pro_publish IS TRUE AND pro_id = '. $kcs);

							// Create showcart
							$dataShowCart = array(
								'sc_product' => $pro->pro_id,
								'sc_orderid' => $orderid,
								'sc_cate_product' => $pro->pro_cate,
								'sc_quantity' => $vcs['quantityc'],
								'sc_price_orig' => $pro->pro_cost,								
								'sc_price' => ($pro->pro_cost - $pro->DISCOUNT),
								'sc_date' => date('Y-m-d H:i:s'),
								'sc_discount' => $pro->DISCOUNT							
							);

							if ($this->showcart_model->add($dataShowCart)) {
								// Update number pro_buy to product
								$this->product_model->update(array('pro_buy' => $pro->pro_buy + $vcs['quantityc'], 'pro_instock' => $pro->pro_instock - $vcs['quantityc']), 'pro_id = '. $pro->pro_id);
							}
						}
						
						// Cancel session cart
						$this->session->unset_userdata('cart');

						// Send mail to customer & to admin	
						

						// Redirect success
						$this->session->set_flashdata('sessionSuccess', 'Đặt hàng thành công. Cảm ơn quý khách, chúc quý khách một ngày vui vẻ!');	
						redirect(base_url() .'dat-hang-thanh-cong?oid='. $orderid .'&otoken='. $ocode, 'location');
						die;
					} else {
						$this->session->set_flashdata('sessionError', 'Đặt hàng không thành công. Vui lòng kiểm tra lại!');
						redirect(base_url() .'dat-hang', 'location');
						die;
					}
				} else {

					# TH 2: Create receiver failed
					$this->session->set_flashdata('sessionError', 'Tạo người nhận hàng không thành công. Vui lòng kiểm tra lại!');
					redirect(base_url() .'dat-hang', 'location');
					die;
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Giỏ hàng không tồn tại. Vui lòng kiểm tra lại!');
				redirect(base_url() .'dat-hang', 'location');
				die;
			}
		} else {

			$this->session->set_flashdata('sessionError', 'Dữ liệu đặt hàng không đúng. Vui lòng kiểm tra lại!');
			redirect(base_url() .'dat-hang', 'location');
			die;
		}
	}

	function orderSuccess()
	{
		$otoken = ''; 
		$oid = 0;
		if (isset($_REQUEST['oid']) 
			&& (int)$_REQUEST['oid'] > 0 
			&& isset($_REQUEST['otoken']) 
			&& $_REQUEST['otoken'] != ''
		) {
			$otoken = $_REQUEST['otoken'];
			$oid = (int)$_REQUEST['oid'];
			$this->load->model('order_model');

			// Join 4 table: order, product, showcart, receiver or (user)
			$select = 'o.`o_id`, o.`o_code`, o.`o_date`, o.`o_user`, o.`o_receiver`, o.`o_status`,o.`o_payment_status`';
			$select .= ', p.pro_id, p.pro_name, p.pro_image, p.pro_dir, p.pro_cost';
			$select .= ', s.`sc_id`, s.`sc_product`, s.`sc_quantity`, s.`sc_price_orig`, s.`sc_price`';
			$select .= ', r.`rc_id`, r.`rc_fullname`, r.`rc_email`, r.`rc_mobile`, r.`rc_address`, r.`rc_note`';
			$where = 'o.`o_id` = '. $oid .' AND o.`o_code` = "'. $otoken .'"';
			$from = '`order` AS o';
			$table1 = 'showcart AS s';
			$on1 = 's.`sc_orderid` = o.`o_id`';
			$table2 = 'product AS p';
			$on2 = 'p.`pro_id` = s.`sc_product`';
			$table3 = 'receiver AS r';
			$on3 = 'r.`rc_id` = o.`o_receiver`';
			
			$order = $this->order_model->fetch_order($select, $where, $from, $table1, $on1, $table2, $on2, $table3, $on3);			

			$ord = $this->order_model->fetch_join1('`order`.*, status_shipping.sh_name', 'INNER', 'status_shipping', 'status_shipping.sh_code = `order`.`o_status`', 'o_id = '. $oid, '', '', 0, 1)[0];

			$select = '';
			if ($ord && $ord->o_user > 0) {				
				$select = 'SELECT us_username, rc_id, rc_fullname, rc_address, rc_email, rc_mobile FROM user LEFT JOIN receiver ON user.`us_id` = receiver.`rc_user` WHERE us_publish IS TRUE AND rc_id = '. (int)$ord->o_receiver;
			} else {
				$select = 'SELECT rc_id, rc_fullname, rc_address, rc_email, rc_mobile FROM receiver WHERE rc_id = '. (int)$ord->o_receiver;
			}
			
			$this->db->cache_off();
			$query = $this->db->query($select);
			$new_user = $query->row();
			$query->free_result();

			$data['order'] = $order;			
			$data['ord'] = $ord;
			$data['new_user'] = $new_user;
			// echo '<pre>';
			// print_r($ord);
			// echo '</pre>'; die;

			# Breadcrum
			$brcrum = array(
				'lv1' 	=> 'Đặt hàng thành công',
				'link1' => '/dat-hang-thanh-cong?oid='. $oid .'&otoken='. $otoken,
				'lv2'	=> '',
				'link2'	=> '',
				'lv3'	=> '',
				'link3'	=> ''
			);
			$data['brcrum'] = $brcrum;

			# Menu active
			$data['me_active'] = 'home';

			# Load view
			$this->load->view('account/showcart/order_success', $data);

		} else {
			redirect(base_url() .'404-loi', 'location');
			die;
		}
	}

	function cancel_order()
	{
		$oid = (int)$this->input->post('orderid');
		$reason = $this->input->post('reasoncancel');
		if ($oid && $reason != FALSE && $reason != '') {
			$this->load->model('order_model');
			$this->load->model('showcart_model');
			$order = $this->order_model->get('o_id, o_code', 'o_id = '. $oid);
			if ($order) {
				if ($this->order_model->update(array('o_status' => 99, 'o_change_status_date' => date('Y-m-d H:i:s'), 'o_reason_cancel' => $reason, 'o_cancel_date' => date('Y-m-d H:i:s')), 'o_id = '. $oid)
				) {
					// Cập nhật số lượng sản phẩm lại
					$showcart = $this->showcart_model->fetch('*', 'sc_orderid = '. $oid);
					foreach ($showcart as $kc => $vc) {
						$this->product_model->update(array('pro_instock' => 'pro_instock' + (int)$vc->sc_quantity, 'pro_buy' => 'pro_buy' - (int)$vc->sc_quantity), 'pro_id = '. (int)$vc->sc_product);
					}
					
					// Gửi mail khách hàng, shop
					$this->session->set_flashdata('sessionSuccess', 'Bạn vừa hủy đơn hàng thành công.');
				} else {
					$this->session->set_flashdata('sessionError', 'Hủy đơn hàng không thành công. Vui lòng kiểm tra lại!');
				}
			} else {
				$this->session->set_flashdata('sessionError', 'Đơn hàng không tồn tại. Vui lòng kiểm tra lại!');
			}

		} else {
			$this->session->set_flashdata('sessionError', 'Hủy đơn hàng không thành công. Vui lòng kiểm tra lại!');
		}

		redirect(base_url() .'dat-hang-thanh-cong?oid='. $oid .'&otoken='. $order->o_code, 'location');
		die;
	}

	function my_order()
	{
		if (! $this->session->userdata('sessionUser')) {
			redirect(base_url() .'tai-khoan/dang-nhap', 'location');
			die;
		}

		// $select = 'o.`o_id`, o.`o_user`, o.`o_date`, o.`o_status`, o.`o_change_status_date`, o.`o_reason_cancel`, o.`o_cancel_date`, o.`o_payment_status`';
		// $select .= ', p.pro_id, p.pro_name, p.pro_image, p.pro_dir';
		// $select .= ', s.`sc_id`, s.`sc_quantity`, s.`sc_price_orig`, s.`sc_price`';	

		// $where = '';
		// $sort = '';
		// $by = '';
		// $start = 0;
		// $limit = 0;
		// $this->load->model('showcart_model');
		// $where = 'o.`o_user` = '. $this->session->userdata('sessionUser');

		// $from = 'showcart AS s';
		// $table1 = '`order` AS o';
		// $on1 = 's.`sc_orderid` = o.`o_id`';
		// $table2 = 'product AS p';
		// $on2 = 'p.`pro_id` = s.`sc_product`';
		// $table3 = '';
		// $on3 = '';

		// $my_order = $this->showcart_model->fetch_showcart($select, $where, $from, $table1, $on1, $table2, $on2, $table3, $on3);
		// $data['my_order'] = $my_order;
		$this->load->model('order_model');
		$this->load->model('showcart_model');
		$my_order = $this->order_model->fetch('`o_id`, `o_user`, `o_date`, `o_status`, `o_change_status_date`', '`o_user` = '. $this->session->userdata('sessionUser'));

		// $oarr = array(); 
		$o_arr = array();
		foreach ($my_order as $ko => $vo) {
			$o_arr[$vo->o_id] = array();
			$de_order = $this->showcart_model->fetch_join1('showcart.*, product.pro_name, product.pro_dir, product.pro_image', 'INNER', 'product', 'pro_id = sc_product' ,'sc_orderid = '. $vo->o_id);
			$o_arr[$vo->o_id] = $de_order;
			$o_arr[$vo->o_id]['oid'] = $vo->o_id;			 
			$o_arr[$vo->o_id]['ouser'] = $vo->o_user;			 
			$o_arr[$vo->o_id]['odate'] = $vo->o_date;			 
			$o_arr[$vo->o_id]['ostatus'] = $vo->o_status;			 
			$o_arr[$vo->o_id]['ochangestatus'] = $vo->o_change_status_date;			 
		}

		// echo '<pre>';
		// print_r($o_arr);
		// echo '</pre>'; die;
		$data['my_order'] = $o_arr;

		# Breadcrum
		$brcrum = array(
			'lv1' 	=> 'Thông tin cá nhân',
			'link1' => '/tai-khoan/thong-tin',
			'lv2'	=> 'Đơn hàng của tôi',
			'link2'	=> '/tai-khoan/don-hang',
			'lv3'	=> '',
			'link3'	=> ''
		);
		$data['brcrum'] = $brcrum;
		# Load view
		$this->load->view('account/showcart/my_order', $data);
	}

	function get_order($oid = 0)
	{
		if (! $this->session->userdata('sessionUser')) {
			redirect(base_url() .'tai-khoan/dang-nhap', 'location');
			die;
		}

		$select = '`o`.*, r.*';
		$where = '`o`.`o_user` = '. (int)$this->session->userdata('sessionUser') .' AND `o`.`o_id` = '. $oid;
		$from = '`order` AS o';
		$table1 = 'receiver AS r';		
		$on1 = 'r.rc_id = `o`.`o_receiver`';

		$this->load->model('order_model');
		$order = $this->order_model->get_order($select, $where, $from, $table1, $on1);		

		if ($oid > 0 && $order && $order->o_id > 0) {

			$sel_c = 's.*, p.pro_name, p.pro_image, p.pro_dir';
			$whe_c = 's.sc_orderid = '. $oid;
			$from_c = 'showcart AS s';
			$table1_c = 'product AS p';
			$on1_c = 'p.pro_id = s.sc_product';

			$this->load->model('showcart_model');
			$detail = $this->showcart_model->fetch_showcart($sel_c, $whe_c, $from_c, $table1_c, $on1_c);

			// echo '<pre>';
			// print_r($detail);
			// echo '</pre>'; die;

			$data['order'] = $order;
			$data['detail'] = $detail;
			$data['oid'] = $oid;
			# Breadcrum
			$brcrum = array(
				'lv1' 	=> 'Thông tin cá nhân',
				'link1' => '/tai-khoan/thong-tin',
				'lv2'	=> 'Đơn hàng của tôi',
				'link2'	=> '/tai-khoan/don-hang',
				'lv3'	=> 'Mã đơn hàng: '. PREORDERNAME . $oid,
				'link3'	=> '/tai-khoan/don-hang/'. $oid
			);
			$data['brcrum'] = $brcrum;
			# Load view
			$this->load->view('account/showcart/get_order', $data);
		} else {
			$this->session->set_flashdata('sessionError', 'Đơn hàng này không tồn tại. Vui lòng kiểm tra lại!');
			redirect(base_url() .'tai-khoan/don-hang', 'location');
			die;
		}
	}

	function cancelsess()
	{
		// $this->session->sess_destroy();
		$this->session->unset_userdata('cart');
	}
}
