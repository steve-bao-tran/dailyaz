<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_home extends CI_Controller {

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
  		if( ! $this->session->userdata('sessionUserAdmin')){
			redirect(base_url() .'admin/login', 'location');
			die;
		} 
		
		#Load library		
        $this->load->helper('url'); 
        
        #Load model       
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
		// $this->load->view('welcome_message');
		$this->load->view('admin/index');
	}

	function images()
	{
		$path = 'media/images';		
		$cur_dir = 'images';
		#Read directory sub				
		$parent = $this->input->get('pa');
		$dir = $this->input->get('dir');
		if($parent && $dir && $parent != '' && $dir != ''){
			$path = $parent .'/'. $dir;
			$cur_dir = $dir;
		}

		#Upload image
		if ($this->input->post('submitimg') && $this->input->post('submitimg') == 'upload') {		
			if($_FILES['uploadimg'] && $_FILES['uploadimg']['name'] != '') {
				$config['upload_path'] = $path .'/';
	            $config['allowed_types'] = ACCEPTIMG;	            
	            $config['max_size'] = MAXUPLOAD;#KB - default 25Mb
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            if(! $this->upload->do_multi_upload('uploadimg')){
	            	$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_flashdata('sessionError', 'Đăng hình thất bại. Vui lòng thử lại. '. $msg);
				} else {
					$msg = $this->upload->data('file_name');
					$this->session->set_flashdata('sessionSuccess', 'Đăng hình thành công! '. $msg);
				}
			}
		}		

		$result = $this->readfolder($path);
		$data['list_image'] = $result;
		$data['path'] = $path;
		$data['cur_dir'] = $cur_dir;		
				
		#Load view
		$this->load->view('admin/media/images', $data);	
	}

	function documents()
	{
		$path = 'media/documents';		
		$cur_dir = 'documents';	
		
		#Read directory sub				
		$parent = $this->input->get('pa');
		$dir = $this->input->get('dir');
		if($parent && $dir && $parent != '' && $dir != ''){
			$path = $parent .'/'. $dir;
			$cur_dir = $dir;
		}

		#Upload image
		if ($this->input->post('submitdoc') && $this->input->post('submitdoc') == 'upload') {
			if($_FILES['uploaddoc'] && $_FILES['uploaddoc']['name'] != '') {
				$config['upload_path'] = $path .'/';
	            $config['allowed_types'] = ACCEPTDOC;	            
	            $config['max_size'] = MAXUPLOAD;#KB - default 25Mb
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            if(! $this->upload->do_multi_upload('uploaddoc')){
	            	$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_flashdata('sessionError', 'Đăng tài liệu thất bại. Vui lòng thử lại. '. $msg);
				} else {
					$msg = $this->upload->data('file_name');
					$this->session->set_flashdata('sessionSuccess', 'Đăng tài liệu thành công! '. $msg);
				}
			}
		}		

		$result = $this->readfolder($path);
		$data['list_doc'] = $result;
		$data['path'] = $path;
		$data['cur_dir'] = $cur_dir;		
				
		#Load view
		$this->load->view('admin/media/docs', $data);		
	}

	function videos()
	{
		$path = 'media/videos';		
		$cur_dir = 'videos';	
		
		#Read directory sub				
		$parent = $this->input->get('pa');
		$dir = $this->input->get('dir');
		if($parent && $dir && $parent != '' && $dir != ''){
			$path = $parent .'/'. $dir;
			$cur_dir = $dir;
		}

		#Upload video
		if ($this->input->post('submitvideo') && $this->input->post('submitvideo') == 'upload') {
			if($_FILES['uploadvideo'] && $_FILES['uploadvideo']['name'] != '') {
				$config['upload_path'] = $path .'/';
	            $config['allowed_types'] = ACCEPTVIDEO;	            
	            $config['max_size'] = MAXUPLOAD;#KB - default 25Mb
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            if(! $this->upload->do_multi_upload('uploadvideo')){
	            	$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_flashdata('sessionError', 'Đăng video thất bại. Vui lòng thử lại. '. $msg);
				} else {
					$msg = $this->upload->data('file_name');
					$this->session->set_flashdata('sessionSuccess', 'Đăng video thành công! '. $msg);
				}
			}
		}		

		$result = $this->readfolder($path);
		$data['list_video'] = $result;
		$data['path'] = $path;
		$data['cur_dir'] = $cur_dir;		
				
		#Load view
		$this->load->view('admin/media/videos', $data);		
	}

	function musics()
	{
		$path = 'media/musics';		
		$cur_dir = 'musics';	
		
		#Read directory sub				
		$parent = $this->input->get('pa');
		$dir = $this->input->get('dir');
		if($parent && $dir && $parent != '' && $dir != ''){
			$path = $parent .'/'. $dir;
			$cur_dir = $dir;
		}

		#Upload audio
		if ($this->input->post('submitmusic') && $this->input->post('submitmusic') == 'upload') {
			if($_FILES['uploadmusic'] && $_FILES['uploadmusic']['name'] != '') {
				$config['upload_path'] = $path .'/';
	            $config['allowed_types'] = ACCEPTAUDIO;	            
	            $config['max_size'] = MAXUPLOAD;#KB - default 25Mb
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            if(! $this->upload->do_multi_upload('uploadmusic')){
	            	$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_flashdata('sessionError', 'Đăng nhạc thất bại. Vui lòng thử lại. '. $msg);
				} else {
					$msg = $this->upload->data('file_name');
					$this->session->set_flashdata('sessionSuccess', 'Đăng nhạc thành công! '. $msg);
				}
			}
		}		

		$result = $this->readfolder($path);
		$data['list_music'] = $result;
		$data['path'] = $path;
		$data['cur_dir'] = $cur_dir;		
				
		#Load view
		$this->load->view('admin/media/musics', $data);		
	}

	function readfolder($path, $type = 'both')
	{
		$res = array();
		$resd = array();
		$of = opendir($path);

		while ($fi = readdir($of)) {
			if($fi == '.' || $fi == '..') continue;
			if(is_file($path.'/'.$fi) && ($type == 'file' || $type == 'both')){
				$res[] = [
					'name' => $fi,
					'path' => $path.'/'.$fi,
					'size' => filesize($path.'/'.$fi),
					'created' => filectime($path.'/'.$fi),
					'type' => 'File',
					'extens' => pathinfo($path.'/'.$fi)['extension']
				];
			}

			if(is_dir($path.'/'.$fi) && ($type == 'dir' || $type == 'both')){
				$resd[] = [
					'name' => $fi,
					'path' => $path.'/'.$fi,
					'size' => filesize($path.'/'.$fi),
					'created' => filectime($path.'/'.$fi),
					'type' => 'Folder',
					'extens' => 'NA'
				];
			}
		}
		$total = array_merge($res, $resd);

		return $total;
	}

	function listFolderFiles($dir)
	{
	    $fileInfo     = scandir($dir);
	    $allFileLists = [];

	    foreach ($fileInfo as $folder) {
	        if ($folder !== '.' && $folder !== '..') {
	            if (is_dir($dir . DIRECTORY_SEPARATOR . $folder) === true) {
	                $allFileLists[$folder] = listFolderFiles($dir . DIRECTORY_SEPARATOR . $folder);
	            } else {
	                $allFileLists[$folder] = $folder;
	            }
	        }
	    }

	    return $allFileLists;
	} 

	function deleteobj()
	{
		$link = $this->input->post('link');
		$num = (int)$this->input->post('num');
		if($link){
			// Delete file
			if($num == 0){
				$link = trim($link);
				if(file_exists($link)){
					@unlink($link);
					echo '0';
					exit();
				}				
			} 

			// Delete folder
			if($num == 1){
				$link = trim($link);
				if(is_dir($link)){
					@rmdir($link);
					echo '1';
					exit();
				}
			}
		}
		echo '-1';
		exit();
	}

	function createobj()
	{
		$link = $this->input->post('link');
		$name = $this->input->post('name');
		if($link && $name){
			// Craete directory
			$link = trim($link);
			$name = html_escape(trim($name));
			if( ! file_exists($link .'/'. $name)){
				$old = umask(0);
				@mkdir($link .'/'. $name, 0777);
				umask($old);	
				echo '1';
				exit();
			} else {
				echo '0'; exit();
			}			
		}
		echo '-1';
		exit();
	}

	function newicon()
	{
		$path = 'templates/images';			
		$cur_dir = 'images';	
		
		#Read directory sub				
		$parent = $this->input->get('pa');
		$dir = $this->input->get('dir');
		if($parent && $dir && $parent != '' && $dir != ''){
			$path = $parent .'/'. $dir;
			$cur_dir = $dir;
		}

		#Upload images
		if ($this->input->post('submitimg') && $this->input->post('submitimg') == 'upload') {		
			if($_FILES['uploadimg'] && $_FILES['uploadimg']['name'] != '') {
				$config['upload_path'] = $path .'/';
	            $config['allowed_types'] = ACCEPTIMG;	            
	            $config['max_size'] = MAXUPLOAD;#KB - default 25Mb
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            if(! $this->upload->do_multi_upload('uploadimg')){
	            	$msg = $this->upload->display_errors('<p>', '</p>');
					$this->session->set_flashdata('sessionError', 'Đăng hình thất bại. Vui lòng thử lại. '. $msg);
				} else {
					$msg = $this->upload->data('file_name');
					$this->session->set_flashdata('sessionSuccess', 'Đăng hình thành công! '. $msg);
				}
			}
		}		

		$result = $this->readfolder($path);
		$data['list_images'] = $result;
		$data['path'] = $path;
		$data['cur_dir'] = $cur_dir;		
				
		#Load view
		$this->load->view('admin/media/logo', $data);		
	}

	function system_info()
	{
		// Get cURL resource 
		// Resource http://codular.com/curl-with-php
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://localhost:3000/products',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		//echo '<pre>'; 
		//print_r($resp);
		//echo '</pre>';

		$data1 = json_decode($resp, true); // parse JSON -> Array
		// Get use   $data[n]['field_name'];

		$data2 = json_decode($resp); // switch JSON -> Object
		// Get use   $data[n]->field_name;
		$data['dulieu'] = $data2;
		# Load view
		$this->load->view('admin/system/info', $data);	
	}

}
