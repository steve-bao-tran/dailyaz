<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_product extends CI_Controller {

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
        $this->load->model('product_model');
        $this->load->model('style_attribute_model');
        $this->load->model('color_attribute_model');
        
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

	function product()
	{
		#Variable common
		$select = 'product.*, category.`cat_id`, category.`cat_name`';
		$where = '';
		$sort = 'pro_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = 'category';
		$join1 = 'INNER';
		$on1 = 'category.`cat_id` = product.`pro_cate`';

		$list_product = $this->product_model->fetch_join1($select, $join1, $table1, $on1, $where);
        $data['list_product'] = $list_product;

        #Load view
        $this->load->view('admin/product/list_product', $data);
	}

	function action_product($product = 0)
	{
		$title_show = '';
		$this->load->model('category_model');
		$li_cate = $this->category_model->fetch('*', 'cat_publish = 1');
		$li_color = $this->color_attribute_model->fetch('col_id, col_name', 'col_publish IS TRUE');
		$li_style = $this->style_attribute_model->fetch('sty_id, sty_name', 'sty_publish IS TRUE');

		if ($product > 0) {
			$title_show = 'Sửa';			
			$pro_edit = $this->product_model->get('*', 'pro_id = '. $product);

			# Get list product in category, default: Cate id = 7 (Phụ kiện khác)
			$list_pro_relative = $this->product_model->fetch('pro_id, pro_name, pro_cate', 'pro_cate = '. (int)$pro_edit->pro_cate .' AND pro_id NOT IN ("'. (int)$pro_edit->pro_id .'")');
			# Post data
			if ($this->input->post('proname') && $this->input->post('proname') != '') {
				
				# UPLOAD AVATAR, CREATE THUMBNAIL 380x380, 174x174, 75x75, 55x55
				$image = $pro_edit->pro_image; $msg = '';
				if(($_FILES['proimage1'] && $_FILES['proimage1']['name'] != '')
					|| ($_FILES['proimage2'] && $_FILES['proimage2']['name'] != '')
					|| ($_FILES['proimage3'] && $_FILES['proimage3']['name'] != '')
					|| ($_FILES['proimage4'] && $_FILES['proimage4']['name'] != '')
					|| ($_FILES['proimage5'] && $_FILES['proimage5']['name'] != '')
				){
					$path = 'media/images/product';
					$dir = $pro_edit->pro_dir;
					if (!is_dir( $path.'/'. $dir)) {
		            	$old = umask(0);
		                @mkdir($path.'/'. $dir, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($path.'/'. $dir .'/index.html', '<p>Directory access is forbidden.</p>');
		            }

		            $config['upload_path'] = $path .'/'. $dir;
		            $config['allowed_types'] = ACCEPTIMG;	            
		            $config['encrypt_name'] = TRUE;	            
		            $config['max_size'] = MAXUPLOAD;#KB
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);
		           
		            for ( $j = 1; $j <= 5; $j++ ) {
			            if ($this->upload->do_upload('proimage'. $j)) {
			            	if($j == 1 || $image == ''){
								$image = $this->upload->data('file_name');
		                	} else {
		                		$image .= ','. $this->upload->data('file_name');
		                	}
			                $msg .= '';
			              	// $src = $path .'/'. $dir .'/'. $this->upload->data('file_name');
			              	// if(file_exists($src)){
			              	// $this->load->library('image_lib');
		            			// $this->load->helper('thumbnail');
		            			// $w = 300; $h = 300;
		            			// $sizeImage = size_thumbnail($src, $w, $h);
				             	// $configImage['source_image'] = $src;
				             	// $configImage['new_image'] = $path . '/'. $dir .'/thumbnail_'. $this->upload->data('file_name');
					            // $configImage['width'] = $sizeImage['width'];
					            // $configImage['height'] = $sizeImage['height'];
					            // $this->image_lib->initialize($configImage);
					            // $this->image_lib->resize();
					            // $this->image_lib->clear();
		               		// }
			            } else {	                	
		                	$msg .= $this->upload->display_errors('<p>', '</p>');   	
		                }
	                }       
				}

				# UPLOAD DOCUMENT
				$doc = $pro_edit->pro_doc; 
				if($_FILES['prodoc'] && $_FILES['prodoc']['name'] != ''){
					$pathdoc = 'media/documents';
					if ( ! is_dir( $pathdoc)) {
		            	$old = umask(0);
		                @mkdir($pathdoc, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($pathdoc .'/index.html', '<p>Directory access is forbidden.</p>');
		            }
		            $config['upload_path'] = $pathdoc;
		            $config['allowed_types'] = '*';	            
		            $config['max_size'] = MAXUPLOAD;#KB	
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);

		            $files = $_FILES;
		            $num = count($_FILES['prodoc']['name']);

		            for($i = 0; $i < $num; $i++ ){
		            	$this->upload->initialize($config);
		            	$_FILES['prodoc']['name'] = $files['prodoc']['name'][$i];
		            	$_FILES['prodoc']['type'] = $files['prodoc']['type'][$i];
		            	$_FILES['prodoc']['tmp_name'] = $files['prodoc']['tmp_name'][$i];
		            	$_FILES['prodoc']['error'] = $files['prodoc']['error'][$i];
		            	$_FILES['prodoc']['size'] = $files['prodoc']['size'][$i];	            	
		            	if ( ! $this->upload->do_upload('prodoc')) {
		                	$msg .= $this->upload->display_errors('<p>', '</p>');                    
		                } else {
		                	$msg .= '';		                	
		                	if($doc == ''){
								$doc = $this->upload->data('file_name');
		                	} else {
		                		$doc .= ','. $this->upload->data('file_name');
		                	}	                	
		                }
		            }           
				}

				# PRODUCT RELATIVE
				$relative = '';				
				$rel_arr = array();
				if(isset($_REQUEST['prorelative'])){
					foreach ($_REQUEST['prorelative'] as $pr => $vpr) {
						$rel_arr[] = $vpr;
					}
				}
				$relative = implode(',', $rel_arr);				

				$dataEdit = array(
					'pro_name' => trim(html_escape($this->input->post('proname'))),
					'pro_sku' => trim(html_escape($this->input->post('prosku'))),
					'pro_image' => $image,
					'pro_detail' => html_escape($this->input->post('prodetail')),
					'pro_tags' => trim(html_escape($this->input->post('protags'))),
					'pro_cost' => (int)$this->input->post('procost'),
					'pro_instock' => (int)$this->input->post('proinstock'),
					'pro_cate' => (int)$this->input->post('procate'),
					'pro_relative' => $relative,
					'pro_saleoff' => (int)$this->input->post('prosaleoff'),
					'pro_beginsale' => ((int)$this->input->post('prosaleoff') > 0) ? $this->input->post('probeginsale') : '',
					'pro_endsale' => ((int)$this->input->post('prosaleoff') > 0) ? $this->input->post('proendsale') : '',
					'pro_percent' => ((int)$this->input->post('prosaleoff') > 0) ?  (int)$this->input->post('propercent') : 0,
					'pro_weight' => (int)$this->input->post('proweight'),
					'pro_length' => (int)$this->input->post('prolength'),
					'pro_width' => (int)$this->input->post('prowidth'),
					'pro_height' => (int)$this->input->post('proheight'),
					'pro_video' => trim(html_escape($this->input->post('provideo'))),
					'pro_doc' => $doc,
					'pro_hlight' => (int)$this->input->post('prohlight'),
					'pro_editdate' => date('Y-m-d H:i:s'),
					'pro_color' => (int)$this->input->post('procolor'),
					'pro_forsex' => (int)$this->input->post('proforsex'),
					'pro_style' => (int)$this->input->post('prostyle'),
					'pro_publish' => ((int)$this->input->post('propublish') == 1) ? true : false
				);

                if($this->product_model->update($dataEdit, 'pro_id = '. $product)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa hàng hóa mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa hàng hóa mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/product', 'location');
				die;
			} else {
				$data['pro_edit'] = $pro_edit;
			}
		} else {
			$title_show = 'Thêm';
			# Get list product in category, default: Cate id = 7 (Phụ kiện khác)
			$list_pro_relative = $this->product_model->fetch('pro_id, pro_name, pro_cate', 'pro_cate = 7');

			# Post data
			if($this->input->post('proname') && $this->input->post('proname') != ''){
				# UPLOAD AVATAR, CREATE THUMBNAIL 380x380, 174x174, 75x75, 55x55
				$image = ''; $msg = ''; $dir = date('dmY');
				if(($_FILES['proimage1'] && $_FILES['proimage1']['name'] != '')
					|| ($_FILES['proimage2'] && $_FILES['proimage2']['name'] != '')
					|| ($_FILES['proimage3'] && $_FILES['proimage3']['name'] != '')
					|| ($_FILES['proimage4'] && $_FILES['proimage4']['name'] != '')
					|| ($_FILES['proimage5'] && $_FILES['proimage5']['name'] != '')
				){
					$path = 'media/images/product';					
					if (!is_dir( $path .'/'. $dir)) {
		            	$old = umask(0);
		                @mkdir($path .'/'. $dir, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($path .'/'. $dir .'/index.html', '<p>Directory access is forbidden.</p>');
		            }

		            $config['upload_path'] = $path .'/'. $dir;
		            $config['allowed_types'] = ACCEPTIMG;
		            $config['encrypt_name'] = TRUE;	            
		            $config['max_size'] = MAXUPLOAD;#KB
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);
		           
		            for ( $j = 1; $j <= 5; $j++ ) {
			            if ($this->upload->do_upload('proimage'. $j)) {
			            	if($j == 1 || $image == ''){
								$image = $this->upload->data('file_name');
		                	} else {
		                		$image .= ','. $this->upload->data('file_name');
		                	}
			                $msg .= '';
			              	// $src = $path .'/'. $dir .'/'. $this->upload->data('file_name');
			              	// if(file_exists($src)){
			              		// $this->load->library('image_lib');
		            			// $this->load->helper('thumbnail');
		            			// $w = 300; $h = 300;
		            			// $sizeImage = size_thumbnail($src, $w, $h);
				             	// $configImage['source_image'] = $src;
				             	// $configImage['new_image'] = $path . '/'. $dir .'/thumbnail_'. $this->upload->data('file_name');
				             	// $configImage['width'] = $sizeImage['width'];
				             	// $configImage['height'] = $sizeImage['height'];
				             	// $this->image_lib->initialize($configImage);
					            // $this->image_lib->resize();
					            // $this->image_lib->clear();
		               		// }
			            } else {	                	
		                	$msg .= $this->upload->display_errors('<p>', '</p>');   	
		                }		                
	                }       
				}

				# UPLOAD DOCUMENT
				$doc = ''; 
				if($_FILES['prodoc'] && $_FILES['prodoc']['name'] != ''){
					$pathdoc = 'media/documents';
					if ( ! is_dir( $pathdoc)) {
		            	$old = umask(0);
		                @mkdir($pathdoc, 0777);
		                umask($old);
		                $this->load->helper('file');
		                @write_file($pathdoc .'/index.html', '<p>Directory access is forbidden.</p>');
		            }
		            $config['upload_path'] = $pathdoc;
		            $config['allowed_types'] = '*';	            
		            $config['max_size'] = MAXUPLOAD;#KB	            

		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);

		            $files = $_FILES;
		            $num = count($_FILES['prodoc']['name']);

		            for($i = 0; $i < $num; $i++ ){
		            	$this->upload->initialize($config);
		            	$_FILES['prodoc']['name'] = $files['prodoc']['name'][$i];
		            	$_FILES['prodoc']['type'] = $files['prodoc']['type'][$i];
		            	$_FILES['prodoc']['tmp_name'] = $files['prodoc']['tmp_name'][$i];
		            	$_FILES['prodoc']['error'] = $files['prodoc']['error'][$i];
		            	$_FILES['prodoc']['size'] = $files['prodoc']['size'][$i];	            	
		            	if ( ! $this->upload->do_upload('prodoc')) {
		                	$msg .= $this->upload->display_errors('<p>', '</p>');                    
		                } else {
		                	$msg .= '';	                	
		                	$upload_re = $this->upload->data('file_name');
		                	if($i == 0){
								$doc = $upload_re;
		                	} else {
		                		$doc .= ','. $upload_re;
		                	}	                	
		                }
		            }           
				}

				# CREATE CODE PRODUCT
				$code = '';
				$this->load->library('encrypt');
				$code = $this->encrypt->random_key(32);

				# PRODUCT RELATIVE
				$relative = '';	
				$rel_arr = array();			
				if(isset($_REQUEST['prorelative'])){
					foreach ($_REQUEST['prorelative'] as $pr => $vpr) {
						$rel_arr[] = $vpr;
					}
				}
				$relative = implode(',', $rel_arr);
				
				$dataAdd = array(
					'pro_name' => trim(html_escape($this->input->post('proname'))),
					'pro_sku' => trim(html_escape($this->input->post('prosku'))),
					'pro_image' => $image,
					'pro_detail' => html_escape($this->input->post('prodetail')),
					'pro_tags' => trim(html_escape($this->input->post('protags'))),
					'pro_cost' => (int)$this->input->post('procost'),
					'pro_instock' => (int)$this->input->post('proinstock'),
					'pro_cate' => (int)$this->input->post('procate'),
					'pro_relative' => $relative,
					'pro_saleoff' => (int)$this->input->post('prosaleoff'),
					'pro_beginsale' => ((int)$this->input->post('prosaleoff') > 0) ? $this->input->post('probeginsale') : '',
					'pro_endsale' => ((int)$this->input->post('prosaleoff') > 0) ? $this->input->post('proendsale') : '',
					'pro_percent' => ((int)$this->input->post('prosaleoff') > 0) ?  (int)$this->input->post('propercent') : 0,
					'pro_weight' => (int)$this->input->post('proweight'),
					'pro_length' => (int)$this->input->post('prolength'),
					'pro_width' => (int)$this->input->post('prowidth'),
					'pro_height' => (int)$this->input->post('proheight'),
					'pro_video' => trim(html_escape($this->input->post('provideo'))),
					'pro_doc' => $doc,
					'pro_hlight' => (int)$this->input->post('prohlight'),
					'pro_code' => $code,
					'pro_createdate' => date('Y-m-d H:i:s'),
					'pro_editdate' => date('Y-m-d H:i:s'),
					'pro_dir' => date('dmY'),
					'pro_color' => (int)$this->input->post('procolor'),
					'pro_forsex' => (int)$this->input->post('proforsex'),
					'pro_style' => (int)$this->input->post('prostyle'),
					'pro_publish' => ((int)$this->input->post('propublish') == 1) ? true : false
				);

                if($this->product_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm hàng hóa mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm hàng hóa mới không thành công! '. $msg);
				}

				redirect(base_url() .'admin/product', 'location');
				die;
			}			
		}

		$data['title_show'] = $title_show;
		$data['li_cate'] = $li_cate;
		$data['li_color'] = $li_color; 
		$data['li_style'] = $li_style;		
		$data['list_pro_relative'] = $list_pro_relative;
		#Load view
        $this->load->view('admin/product/action_product', $data);
	}

	function delete_product($product = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/product', 'location');
		die;
	}

	function publish_product()
	{
		$pro_id = (int)$this->input->get('pro');
		$act = (int)$this->input->get('act');

		if($pro_id > 0){
			$this->product_model->update(array('pro_publish' => $act), 'pro_id = '. $pro_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái hàng hóa thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Hàng hóa không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/product', 'location');
		die;
	}

	function ajax_del_img_pro()
	{
		$img = $this->input->post('img');
		$proid = (int)$this->input->post('proid');
		$pro = $this->product_model->get('*', 'pro_id = '. $proid);
		if($proid > 0 && $img != '' && $pro){			
			$pathimg = 'media/images/product';
			$dir = $pro->pro_dir;
			if(file_exists($pathimg .'/'. $dir .'/'. $img)){
				@unlink($pathimg .'/'. $dir .'/'. $img);
			}

			if(file_exists($pathimg .'/'. $dir .'/thumbnail_380_'. $img)){
				@unlink($pathimg .'/'. $dir .'/thumbnail_380_'. $img);
			}

			if(file_exists($pathimg .'/'. $dir .'/thumbnail_174_'. $img)){
				@unlink($pathimg .'/'. $dir .'/thumbnail_174_'. $img);
			}

			if(file_exists($pathimg .'/'. $dir .'/thumbnail_75_'. $img)){
				@unlink($pathimg .'/'. $dir .'/thumbnail_75_'. $img);
			}

			if(file_exists($pathimg .'/'. $dir .'/thumbnail_55_'. $img)){
				@unlink($pathimg .'/'. $dir .'/thumbnail_55_'. $img);
			}

			$_pro_img = explode(',', $pro->pro_image);
			for ($a = 0; $a < count($_pro_img); $a++ ) {
				if($_pro_img[$a] == $img){
					unset($_pro_img[$a]); break;
				}
			}
			$strimg = implode(',', $_pro_img);
			$this->product_model->update(array('pro_image' => $strimg), 'pro_id = '. $proid);

			echo '1';
			exit();
		}
		echo '0';
		exit();
	}

	function ajax_del_doc_pro()
	{
		$name = $this->input->post('name');
		$proid = (int)$this->input->post('proid');
		$_pro = $this->product_model->get('pro_id, pro_doc', 'pro_id = '. $proid);
		if($proid > 0 && $name != '' && $_pro){
			$pathdoc = 'media/documents';
			if(file_exists($pathdoc .'/'. $name)){
				@unlink($pathdoc .'/'. $name);
			}
			
			$_pro_doc = explode(',', $_pro->pro_doc);
			for($d = 0; $d < count($_pro_doc); $d++ ) {
				if($_pro_doc[$d] == $name){
					unset($_pro_doc[$d]); break;
				}
			}
			$strdoc = implode(',', $_pro_doc);
			$this->product_model->update(array('pro_doc' => $strdoc), 'pro_id = '. $proid);
		
			echo '1';
			exit();
		}
		echo '0';
		exit();
	}

	function ajax_get_rela_pro()
	{
		$procat = (int)$this->input->post('procat');
		$proid = (int)$this->input->post('proid');
		$return = array();
		if($procat > 0){
			$where = 'pro_cate = '. $procat;
			if($proid > 0){
				$where .= ' AND pro_id NOT IN ("'. $proid .'")';
			}

			$return = $this->product_model->fetch('pro_id AS PID, pro_name AS PNAME, pro_cate AS PCATE', $where);
		} else {
			$return['error'] = 1;
			$return['msg'] = 'Có lỗi xảy ra. Vui lòng thử lại!!';
		}
		echo json_encode($return);
        exit();
	}

	function style()
	{
		#Variable common
		$select = '*';
		$where = '';
		$sort = 'sty_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_style = $this->style_attribute_model->fetch($select, $where);
        $data['list_style'] = $list_style;

        #Load view
        $this->load->view('admin/product/list_style', $data);
	}

	function action_style($style = 0)
	{
		$title_show = '';		
		
		if ($style > 0) {
			$title_show = 'Sửa';			
			$sty_edit = $this->style_attribute_model->get('*', 'sty_id = '. $style);

			# Post data
			if ($this->input->post('styname') && $this->input->post('styname') != '') {
				
				# UPLOAD AVATAR
				$image = $sty_edit->sty_image; $msg = '';
				if ($_FILES['styimage'] && $_FILES['styimage']['name'] != '') {
					$path = 'media/images/style';					
					if (!is_dir( $path)) {
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
		            
		            if ($this->upload->do_upload('styimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }	
		                $msg = '';
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }
	            }

				$dataEdit = array(
					'sty_name' => trim(html_escape($this->input->post('styname'))),					
					'sty_image' => $image,
					'sty_note' => html_escape($this->input->post('stynote')),					
					'sty_url_image' => html_escape($this->input->post('styurlimage')),
					'sty_update' => date('Y-m-d H:i:s'),
					'sty_publish' => ((int)$this->input->post('stypublish') == 1) ? true : false
				);

                if($this->style_attribute_model->update($dataEdit, 'sty_id = '. $style)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa phong cách mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa phong cách mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/style', 'location');
				die;
			} else {
				$data['sty_edit'] = $sty_edit;
			}
		} else {
			$title_show = 'Thêm';
			
			# Post data
			if($this->input->post('styname') && $this->input->post('styname') != ''){
				# UPLOAD AVATAR
				$image = ''; $msg = '';
				if ($_FILES['styimage'] && $_FILES['styimage']['name'] != '') {
					$path = 'media/images/style';					
					if (!is_dir( $path)) {
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
		            
		            if ($this->upload->do_upload('styimage')) {
		                if ($this->upload->data('is_image') == TRUE) {
		                    $image = $this->upload->data('file_name');
		                } elseif (file_exists($path .'/'. $this->upload->data('file_name'))) {
		                    @unlink($path .'/'. $this->upload->data('file_name'));
		                }	
		                $msg = '';
		            } else {	                	
	                	$msg = $this->upload->display_errors('<p>', '</p>');   	
	                }
	            }				
				
				$dataAdd = array(
					'sty_name' => trim(html_escape($this->input->post('styname'))),					
					'sty_image' => $image,
					'sty_note' => html_escape($this->input->post('stynote')),					
					'sty_url_image' => html_escape($this->input->post('styurlimage')),					
					'sty_createdate' => date('Y-m-d H:i:s'),
					'sty_update' => date('Y-m-d H:i:s'),
					'sty_publish' => ((int)$this->input->post('stypublish') == 1) ? true : false
				);

                if($this->style_attribute_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm phong cách mới thành công! '. $msg);
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm phong cách mới không thành công! '. $msg);
				}

				redirect(base_url() . 'admin/style', 'location');
				die;
			}			
		}

		$data['title_show'] = $title_show;
		#Load view
        $this->load->view('admin/product/action_style', $data);
	}

	function delete_style($style = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/style', 'location');
		die;
	}

	function publish_style()
	{
		$style_id = (int)$this->input->get('style');
		$act = (int)$this->input->get('act');

		if($style_id > 0){
			$this->style_attribute_model->update(array('sty_publish' => $act), 'sty_id = '. $style_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái phong cách thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Phong cách không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/style', 'location');
		die;
	}

	function ajax_del_img_style()
	{
		$img = $this->input->post('img');
		$styid = (int)$this->input->post('styid');
		$style = $this->style_attribute_model->get('*', 'sty_id = '. $styid);
		if($styid > 0 && $img != '' && $style){			
			$pathimg = 'media/images/style';
			if(file_exists($pathimg .'/'. $img)){
				@unlink($pathimg .'/'. $img);
			}
			$this->style_attribute_model->update(array('sty_image' => ''), 'sty_id = '. $styid);

			echo '1';
			exit();
		}
		echo '0';
		exit();
	}

	function color()
	{
		#Variable common
		$select = '*';
		$where = '';
		$sort = 'col_id';
		$by = 'ASC';
		$start = 0;
		$limit = obj_on_page;
		#Data join
		$table1 = '';
		$join1 = '';
		$on1 = '';

		$list_color = $this->color_attribute_model->fetch($select, $where);
        $data['list_color'] = $list_color;

        #Load view
        $this->load->view('admin/product/list_color', $data);
	}

	function action_color($color = 0)
	{
		$title_show = '';
		
		if ($color > 0) {
			$title_show = 'Sửa';			
			$col_edit = $this->color_attribute_model->get('*', 'col_id = '. $color);

			# Post data
			if ($this->input->post('colname') && $this->input->post('colname') != '') {	
				$dataEdit = array(
					'col_name' => trim(html_escape($this->input->post('colname'))),	
					'col_note' => html_escape($this->input->post('colnote')),
					'col_publish' => ((int)$this->input->post('colpublish') == 1) ? true : false
				);

                if($this->color_attribute_model->update($dataEdit, 'col_id = '. $color)){
					$this->session->set_flashdata('sessionSuccess', 'Sửa màu sắc mới thành công!');
				} else {
					$this->session->set_flashdata('sessionError', 'Sửa màu sắc mới không thành công!');
				}

				redirect(base_url() . 'admin/color', 'location');
				die;
			} else {
				$data['col_edit'] = $col_edit;
			}
		} else {
			$title_show = 'Thêm';
			
			# Post data
			if($this->input->post('colname') && $this->input->post('colname') != ''){
				$dataAdd = array(
					'col_name' => trim(html_escape($this->input->post('colname'))),
					'col_note' => html_escape($this->input->post('colnote')),
					'col_createdate' => date('Y-m-d H:i:s'),					
					'col_publish' => ((int)$this->input->post('colpublish') == 1) ? true : false
				);

                if($this->color_attribute_model->add($dataAdd)){
					$this->session->set_flashdata('sessionSuccess', 'Thêm mùa sắc mới thành công!');
				} else {
					$this->session->set_flashdata('sessionError', 'Thêm màu sắc mới không thành công!');
				}

				redirect(base_url() . 'admin/color', 'location');
				die;
			}			
		}

		$data['title_show'] = $title_show;
		#Load view
        $this->load->view('admin/product/action_color', $data);
	}

	function delete_color($color = 0)
	{
		$this->session->set_flashdata('sessionSuccess', 'Chức năng đang được phát triển!');
		redirect(base_url() . 'admin/color', 'location');
		die;
	}

	function publish_color()
	{
		$color_id = (int)$this->input->get('color');
		$act = (int)$this->input->get('act');

		if($color_id > 0){
			$this->color_attribute_model->update(array('col_publish' => $act), 'col_id = '. $color_id);
			$this->session->set_flashdata('sessionSuccess', 'Bạn vừa chuyển trạng thái màu sắc thành công!');
		} else {
			$this->session->set_flashdata('sessionError', 'Mùa sắc không tồn tại. Vui lòng kiểm tra lại!');
		}
		redirect(base_url() . 'admin/color', 'location');
		die;
	}
}
