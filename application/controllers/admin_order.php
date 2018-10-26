<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order extends CI_Controller {

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
        
        #Load helper
        $this->load->helper('custom');

        #Load model        
        $this->load->model('order_model');
        $this->load->model('content_model');        

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
		#Load view
		$this->load->view('admin/index');
	}

	function order()
	{
		#Variable common
		$select = '*';
		$where = '`o_id` > 0';
		$sort = '`o_id`';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;

		# data join
		$table1 = 'status_shipping';
		$join1 = 'INNER';
		$on1 = 'status_shipping.sh_id = `order`.`o_status`';
		$table2 = 'receiver';
		$join2 = 'INNER';
		$on2 = 'receiver.rc_id = `order`.`o_receiver`';
		/**************************************************************************/
		# Filter
		if ($this->input->post('search_order') != FALSE && $this->input->post('search_order') != '') {
			if ($this->input->post('ord_id') != FALSE && $this->input->post('ord_id') != '') {
				$where .= ' AND `o_id` = '. (int)trim($this->input->post('ord_id'));
				$data['ord_id'] = (int)trim($this->input->post('ord_id'));
			}

			if ($this->input->post('ord_name') != FALSE && $this->input->post('ord_name') != '') {
				$where .= ' AND `rc_fullname` LIKE "%'. trim($this->input->post('ord_name')) .'%"';
				$data['ord_name'] = trim($this->input->post('ord_name'));
			}

			if ($this->input->post('ord_mobile') != FALSE && $this->input->post('ord_mobile') != '') {
				$where .= ' AND `rc_mobile` LIKE "%'. trim($this->input->post('ord_mobile')) .'%"';
				$data['ord_mobile'] = trim($this->input->post('ord_mobile'));
			}

			if ($this->input->post('ord_status') != FALSE && $this->input->post('ord_status') > 0) {
				$where .= ' AND `o_status` = '. (int)$this->input->post('ord_status');
				$data['ord_status'] = (int)$this->input->post('ord_status');
			}

			if ($this->input->post('ord_fromdate') != FALSE && $this->input->post('ord_fromdate') != '') {
				$where .= ' AND DATE_FORMAT(`o_date`, "%Y-%m-%d") >= "'. $this->input->post('ord_fromdate') .'"';
				$data['ord_fromdate'] = $this->input->post('ord_fromdate');
			}

			if ($this->input->post('ord_todate') != FALSE && $this->input->post('ord_todate') != '') {
				$where .= ' AND DATE_FORMAT(`o_date`, "%Y-%m-%d") <= "'. $this->input->post('ord_todate') .'"';
				$data['ord_todate'] = $this->input->post('ord_todate');
			}

		}

		/**************************************************************************/
		# Get list status shipping
		$this->load->model('status_shipping_model');
		$li_ship = $this->status_shipping_model->fetch('*', '', 'sh_id', 'ACS');
		$data['li_ship'] = $li_ship;
		/**************************************************************************/
		$list_order = $this->order_model->fetch_join2($select, $join1, $table1, $on1, $join2, $table2, $on2, $where);
        $data['list_order'] = $list_order;
        /**************************************************************************/
  		// echo '<pre>';
		// print_r($list_order);
		// echo '</pre>'; die;

        #Load view
        $this->load->view('admin/showcart/list_order', $data);
	}

	function detail_order($oid = 0)
	{
		if ($oid <= 0) {
			$this->session->set_flashdata('sessionError', 'Mã đơn hàng không tồn tại. Vui lòng kiểm tra lại!');
			redirect(base_url() .'admin/order', 'location');
			die;
		} 

		$title_show = PREORDERNAME . $oid;
		$data['title_show'] = $title_show;

		# Get list status shipping
		$this->load->model('status_shipping_model');
		$li_ship = $this->status_shipping_model->fetch('*', '', 'sh_id', 'ACS');
		$data['li_ship'] = $li_ship;

		// Join 4 table: order, product, showcart, receiver
		$select = 'p.pro_id, p.pro_name, p.pro_image, p.pro_dir, p.pro_cost, p.pro_weight, p.pro_instock';
		$select .= ', s.`sc_id`, s.`sc_product`, s.`sc_quantity`, s.`sc_price_orig`, s.`sc_price`';		
		$where = 'o.`o_id` = '. $oid;
		$from = '`order` AS o';
		$table1 = 'showcart AS s';
		$on1 = 's.`sc_orderid` = o.`o_id`';
		$table2 = 'product AS p';
		$on2 = 'p.`pro_id` = s.`sc_product`';
		$table3 = 'receiver AS r';
		$on3 = 'r.`rc_id` = o.`o_receiver`';
		
		$showcart = $this->order_model->fetch_order($select, $where, $from, $table1, $on1, $table2, $on2, $table3, $on3);
		$data['showcart'] = $showcart;

		$selectg = 'o.*, r.*, ss.*';
		$whereg = 'o.`o_id` = '. $oid;
		$fromg = '`order` AS o';
		$table1g = 'status_shipping AS ss';
		$on1g = 'ss.`sh_code` = o.`o_status`';
		$table2g = 'receiver AS r';
		$on2g = 'r.`rc_id` = o.`o_receiver`';

		$order = $this->order_model->get_order($selectg, $whereg, $fromg, $table1g, $on1g, $table2g, $on2g);
		$data['order'] = $order;

		// echo '<pre>';
		// print_r($order);
		// echo '</pre>'; die;

		#Load view
        $this->load->view('admin/showcart/detail_order', $data);
	}

	function change_status_order()
	{
		$oid = (int)$this->input->post('orderidmodal');
		$status = (int)$this->input->post('statusorder');
		$reason = $this->input->post('reasoncancel') ? $this->input->post('reasoncancel') : '';
		
		if ($oid && $status && in_array($status, array(1,2,3,4,5))) {
			if ($this->order_model->update(array('o_status' => $status), 'o_id = '. $oid)) {
				$this->session->set_flashdata('sessionSuccess', 'Chuyển trạng thái đơn hàng thành công!!');
			} else {
				$this->session->set_flashdata('sessionError', 'Chuyển trạng thái đơn hàng không thành công. Vui lòng kiểm tra lại!');
			}			
		} else if ($oid && $status && in_array($status, array(98,99))) {
			if ($reason != FALSE && $reason != '') {
				if ($this->order_model->update(array('o_status' => $status, 'o_reason_cancel' => $reason), 'o_id = '. $oid)) {
					$this->load->model('showcart_model');
					$ord = $this->showcart_model->fetch('*', 'sc_orderid = '. $oid);
					foreach ($ord as $ko => $vo) {
						$this->load->model('product_model');
						$this->product_model->update(array('pro_instock' => 'pro_instock' + (int)$vo->sc_quantity, 'pro_buy' => 'pro_buy' - (int)$vo->sc_quantity), 'pro_id = '. (int)$vo->sc_product);
					}
					
					$this->session->set_flashdata('sessionSuccess', 'Chuyển trạng thái đơn hàng thành công!!');
				} else {
					$this->session->set_flashdata('sessionError', 'Chuyển trạng thái đơn hàng không thành công. Vui lòng kiểm tra lại!');
				}
			}
		} else {
			$this->session->set_flashdata('sessionError', 'Mã đơn hàng không tồn tại. Vui lòng kiểm tra lại!');
		}
		
		redirect(base_url() .'admin/detail-order/'. $oid, 'location');
		die;
	}
	
}
