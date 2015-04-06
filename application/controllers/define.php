<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Define extends CI_Controller {

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
	function storage(){
		$this->load->model('storage_model');
		$this->load->view('define/new_storage');
	}
	function new_storage(){
		if ($this->input->post()) {
			$data=array(
				'title'=>$this->input->post('title'),
				'manager'=>$this->input->post('manager'),
				'phone'=>$this->input->post('phone'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('storage_model');
			$result=$this->storage_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی بنکەی نوێ سەرکەوتوانە بۆ';
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
			}
			$this->load->view('define/new_storage',$return);
		}
	}
	function edit_storage(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('storage_model');
			$this->load->view('define/edit_storage',$data);
		} else {
			echo 'Record ID not find.!';
		}
	}
	function update_storage(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'title'=>$this->input->post('title'),
				'manager'=>$this->input->post('manager'),
				'phone'=>$this->input->post('phone'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('storage_model');
			$result=$this->storage_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
			}
			$this->load->view('define/new_storage',$return);
		}
	}
	function delete_storage(){
		if($this->uri->segment(3)){
			$this->load->model('storage_model');
			$this->storage_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function cat(){
		$this->load->model('cat_model');
		$this->load->view('define/new_cat');
	}
	function new_cat(){
		if ($this->input->post()) {
			$data=array(
				'title'=>$this->input->post('title'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('cat_model');
			$result=$this->cat_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی بنکەی نوێ سەرکەوتوانە بۆ';
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
			}
			$this->load->view('define/new_cat',$return);
		}
	}
	function edit_cat(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('cat_model');
			$this->load->view('define/edit_cat',$data);
		} else {
			echo 'Record ID not find...!';
		}
	}
	function update_cat(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'title'=>$this->input->post('title'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('cat_model');
			$result=$this->cat_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
			}
				$this->load->view('define/new_cat',$return);
		}
	}
	function delete_cat(){
		if($this->uri->segment(3)){
			$this->load->model('cat_model');
			$this->cat_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function customer(){
		$this->load->model('customer_model');
		$this->load->model('storage_model');
		$this->load->view('define/new_customer');
	}
	function new_customer(){
		echo '<br><br><br><br><br><br>';
		echo base_url().'/uploads/';
		$config['upload_path'] = base_url().'/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['max_size'] = 0;
        $config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->model('customer_model');
		if (!$this->upload->do_upload())
		{
			$return = array('message' => $this->upload->display_errors());
			$this->load->view('define/new_customer', $return);
		}
		elseif($this->input->post())
		{
			$data = $this->upload->data();
			$db_data = array(
					'f_name'=>$this->input->post('f_name'),
					'm_name'=>$this->input->post('m_name'),
					'l_name'=>$this->input->post('l_name'),
					'phone'=>$this->input->post('phone'),
					'email'=>$this->input->post('email'),
					'address'=>$this->input->post('address'),
					'suporter'=>$this->input->post('suporter'),
					'image'=>$data['file_name'],
					'user_id'=>$_SESSION['user_id']
					);
			if($this->customer_model->insert($db_data)){
				$return['message']='زیاد کردنی موشتەری نوێ سەرکەوتوانە بۆs';
				$this->load->view('define/new_customer', $return);
			}
		}
	}
	function edit_customer(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('centers_model');
			$this->load->model('customer_model');
			$this->load->view('define/edit_customer',$data);
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
			$this->load->model('customer_model');
			$result=$this->customer_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
				$this->load->view('define/new_customer',$return);
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
				$this->load->view('define/new_customer',$return);
			}
		}
	}
	function delete_customer(){
		if($this->uri->segment(3)){
			$this->load->model('customer_model');
			$this->customer_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function product(){
		$this->load->model('cat_model');
		$this->load->model('product_model');
		$this->load->view('define/new_product');
	}
	function new_product(){
		if ($this->input->post()) {
			$data=array(
				'cat_id'=>$this->input->post('cat_id'),
				'title'=>$this->input->post('title'),
				'unit_scale'=>$this->input->post('scale'),
				'price'=>$this->input->post('price'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('product_model');
			$result=$this->product_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی کاڵای نوێ سەرکەوتوانە بۆ';
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
			}
			$this->load->model('cat_model');
			$this->load->view('define/new_product',$return);
		}
	}
	function edit_product(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('cat_model');
			$this->load->model('product_model');
			$this->load->view('define/edit_product',$data);
		} else {
			echo 'Record ID not find.!';
		}
	}
	function update_product(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'cat_id'=>$this->input->post('cat_id'),
				'title'=>$this->input->post('title'),
				'unit_scale'=>$this->input->post('scale'),
				'price'=>$this->input->post('price'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('product_model');
			$this->load->model('cat_model');
			$result=$this->product_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
			}
			$this->load->view('define/new_product',$return);
		}
	}
	function delete_product(){
		if($this->uri->segment(3)){
			$this->load->model('product_model');
			$this->product_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
	function unit(){
		$this->load->model('unit_model');
		$this->load->model('product_model');
		$this->load->view('define/new_unit');
	}
	function new_unit(){
		if ($this->input->post()) {
			$data=array(
				'product_id'=>$this->input->post('product_id'),
				'title'=>$this->input->post('title'),
				'scale'=>$this->input->post('scale'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('unit_model');
			$this->load->model('product_model');
			$result=$this->unit_model->insert($data);
			if ($result > 0 ) {
				$return['message']='زیاد کردنی بنکەی نوێ سەرکەوتوانە بۆ';
			} else {
				$return['message']='زیاد کردن سەرکەوتو نەبۆ';
			}
			$this->load->view('define/new_unit',$return);
		}
	}
	function edit_unit(){
		$edit_id=$this->uri->segment(3);
		if (!empty($edit_id)) {
			$data['edit_id']=$edit_id;
			$this->load->model('unit_model');
			$this->load->model('product_model');
			$this->load->view('define/edit_unit',$data);
		} else {
			echo 'Record ID not find.!';
		}
	}
	function update_unit(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'product_id'=>$this->input->post('product_id'),
				'title'=>$this->input->post('title'),
				'scale'=>$this->input->post('scale'),
				'user_id'=>$_SESSION['user_id']
				);
			$this->load->model('unit_model');
			$this->load->model('product_model');
			$result=$this->unit_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($result > 0 ) {
				$return['message']='گوڕانکاری بە سەرکەوتویی پاشەکەوت کڕا';
				$this->load->view('define/new_unit',$return);
			} else {
				$return['message']='گوڕانکارێکان سەرکەوتۆ نەبۆن.';
				$this->load->view('define/new_unit',$return);
			}
		}
	}
	function delete_unit(){
		if($this->uri->segment(3)){
			$this->load->model('units_model');
			$this->units_model->delete(array('id'=>$this->uri->segment(3)));
		} else {
			echo "ئاکامەکە سەرکەوتۆ نەبۆ. !";
		}
	}
}
