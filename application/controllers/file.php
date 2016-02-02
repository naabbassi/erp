<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('user_model');
		if (isset($_SESSION['username'])) {
			$res=$this
			->user_model
			->verify_user(
				array(
					'user_id'=>$_SESSION['user_id'],
					'username'=>$_SESSION['username'],
					'password'=>$_SESSION['password']
					)
				);
			if ($res == false) { redirect('logout'); exit(); }
		}
		else
		{
			redirect('logout');
		}
	}
	public function index()
	{
		$this->load->view('nav');
	}
	function error404(){
		$this->load->view('404');
	}
	function backup(){
		if( ! ini_get('date.timezone') )
			{
			   date_default_timezone_set('GMT');
			}
		$this->load->dbutil();
		$config = array(
                'ignore'      => array('customer_product_view'),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
              );
		$backup =& $this->dbutil->backup($config);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('ERP_BackUp_'.date('Y/m/d').'.zip',$backup);
		$data['message']='BakcUp File was created successfuly';
		redirect('file',$data);
	}
	function center(){
		$this->load->model('cat_model');
		$this->load->view('define/new_cat');
	}
	function new_center(){
		if ($this->input->post()) {
			$data=array(
				'title'=>$this->input->post('title'),
				'manager'=>$this->input->post('manager'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'email'=>$this->input->post('email')
				);
			$this->load->model('centers_model');
			$result=$this->centers_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی بنکەی نوێ سەرکەوتوانە بۆ';
				$this->load->view('define/new_center',$return);
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
				$this->load->view('define/new_center',$return);
			}
		}
	}
	function edit_center(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('centers_model');
			$this->load->view('define/edit_center',$data);
		} else {
			echo 'Record ID not find.!';
		}
	}
	function update_center(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'title'=>$this->input->post('title'),
				'manager'=>$this->input->post('manager'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'email'=>$this->input->post('email')
				);
			$this->load->model('centers_model');
			$result=$this->centers_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
				$this->load->view('define/new_center',$return);
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
				$this->load->view('define/new_center',$return);
			}
		}
	}
	function delete_center(){
		if($this->uri->segment(3)){
			$this->load->model('centers_model');
			$this->centers_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function customer(){
		$this->load->model('customers_model');
		$this->load->model('centers_model');
		$this->load->view('define/new_customer');
	}
	function new_customer(){
		if ($this->input->post()) {
			$data=array(
				'center_id'=>$this->input->post('center_id'),
				'name'=>$this->input->post('name'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'suporter'=>$this->input->post('suporter')
				);
			$this->load->model('centers_model');
			$this->load->model('customers_model');
			$result=$this->customers_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی بنکەی نوێ سەرکەوتوانە بۆs';
				$this->load->view('file/new_customer',$return);
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
				$this->load->view('file/new_customer',$return);
			}
		}
	}
	function edit_customer(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('centers_model');
			$this->load->model('customers_model');
			$this->load->view('file/edit_customer',$data);
		} else {
			echo 'Record ID not find.!';
		}
	}
	function update_customer(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'center_id'=>$this->input->post('center_id'),
				'name'=>$this->input->post('name'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'suporter'=>$this->input->post('suporter')
				);
			$this->load->model('centers_model');
			$this->load->model('customers_model');
			$result=$this->customers_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
				$this->load->view('file/new_customer',$return);
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
				$this->load->view('file/new_customer',$return);
			}
		}
	}
	function delete_customer(){
		if($this->uri->segment(3)){
			$this->load->model('customers_model');
			$this->customers_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function user(){
		$this->load->model('user_model');
		$this->load->view('file/user_view');
	}
}
