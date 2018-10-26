<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_email extends CI_Controller {

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

        # Check login admin
  		if(!$this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin/login', 'location');
			die;
		} 
        
        #Load model        
        $this->load->model('register_email_model');

        # Total new register email
        $query = $this->db->query('SELECT re_id FROM registry_email WHERE re_status = 0');
        $data['newmail'] = $query->num_rows();
        $query->free_result();

        # Total new order
        $this->db->cache_off();
        $query1 = $this->db->query('SELECT `o_id` FROM `order` WHERE `o_status` = 1');
        $data['neworder'] = $query1->num_rows();
        $query1->free_result();

         # Total new contact
        $this->db->cache_off();
        $query2 = $this->db->query('SELECT `ct_id` FROM `contact` WHERE `ct_status` = 1');
        $data['newcontact'] = $query2->num_rows();
        $query2->free_result();

        # Return data
        $this->load->vars($data);
    }

	public function index()
	{
		#Load view
		$this->load->view('admin/index');
	}

	function email()
	{
		# Update status new registry email
		$this->register_email_model->update(array('re_status' => 1));
		$query = $this->db->query('SELECT re_id FROM registry_email WHERE re_status = 0');
        $data['newmail'] = $query->num_rows();

        $isReport = $this->input->get_post('excel', 0) == 1 ? FALSE : TRUE;
		$filter['where']['re_publish'] = 1;
		$data['listemail'] = $this->register_email_model->getLits($filter);
		if ($isReport == FALSE) {
            $this->_excel($data['listemail']);
            exit();
        }
		
		#Variable common
		$select = '*';
		$where = '';
		$sort = 're_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_email = $this->register_email_model->fetch($select, $where); 
        $data['list_email'] = $list_email;
        #Load view
        $this->load->view('admin/email/list_email', $data);
	}

	function delete_email($email = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/list-email', 'location');
		die;
	}

	function publish_email()
	{
		$re_id = (int)$this->input->get('mail');
		$act = (int)$this->input->get('act');

		if($re_id > 0){
			$this->register_email_model->update(array('re_publish' => $act), 're_id = '. $re_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái thư điện tử thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Thư điện tử không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/list-email', 'location');
		die;
	}

	private function  _excel($data, $showID = false)
    {
        require_once(APPPATH .'libraries/xlsxwriter.class.php');
        $filename = "report email.xlsx";
        header('Content-disposition: attachment; filename="'. XLSXWriter::sanitize_filename($filename) .'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $header = array(
            'Email' => 'string'
        );
        $excel = array();
        foreach ($data as $item) {
            $row = array();           
            array_push($row, $item['re_email']);
            array_push($excel, $row);
        }
        $writer = new XLSXWriter();
        $writer->setAuthor('Steve Tran');
        $writer->writeSheet($excel, 'Sheet1', $header);
        $writer->writeToStdOut();
    }

    function contact()
    {  
		#Variable common
		$select = '*';
		$where = '';
		$sort = 'ct_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$this->load->model('contact_model');
		$list_contact = $this->contact_model->fetch($select, $where); 
        $data['list_contact'] = $list_contact;

        #Load view
        $this->load->view('admin/email/list_contact', $data);
    }

}
