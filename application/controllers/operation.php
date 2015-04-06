<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operation extends CI_Controller {
	
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

	function sale(){
		$this->load->model('storage_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('cat_model');
		$this->load->view('operation/new_sale');
	}
	function new_item(){
		if ($this->input->post()) {
			$data=array(
				'id'          => $this->input->post('product_id'),
				'name'        => $this->input->post('unit_id'),
				'qty'         => $this->input->post('quantity'),
				'price'       => $this->input->post('price'),
				'options' => array('storage_id' => $this->input->post('storage_id'))
				);
			$this->cart->insert($data);
			echo 'success';
		} else {
			echo 'error in recived data.!';	
		}
	}
	function items_table(){
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('storage_model');
		$this->load->view('operation/cart_items_table');
	}
	function delete_table_item(){
		if ($this->uri->segment(3)) {
			$data=array(
				'rowid'        => $this->uri->segment(3),
				'qty'          => 0
				);
			$this->cart->update($data);
		} else {
			echo "Invalid Data..!";
		}
	}
	function sale_invoice(){
		if ($this->input->post() &&  $this->cart->total_items() > 0) {
			$data=array(
				'customer_id'  =>$this->input->post('customer_id'),
				'title'        =>$this->input->post('title'),
				'discount'    =>$this->input->post('discount'),
				'date_time'    =>$this->input->post('date_time'),
				'description'  =>$this->input->post('description'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_model');
			$res=$this->sale_model->insert($data);
			if ($res == 1) {
				$sale_id=$this->db->insert_id();
				$this->load->model('sale_details_model');
				foreach ($this->cart->contents() as $item) {
					$options=$this->cart->product_options($item['rowid']);
					$data_item=array(
						'sale_id'     => $sale_id,
						'storage_id'  => $options['storage_id'],
						'product_id'  => $item['id'],
						'unit_id'     => $item['name'],
						'quantity'    => $item['qty'],
						'price'  => $item['price'],
						'user_id'     => $_SESSION['user_id']
						);
					$this->sale_details_model->insert($data_item);
				}
				$this->cart->destroy();
				$data['message']='<div class="alert alert-success">پاشکەوت کردن سەرکەوتۆ بۆ..!</div>';
				if (isset($_SESSION['payment']['type']) && isset($_SESSION['payment']['amount'])) {
				$this->load->model('payment_model');
				date_default_timezone_set('UTC');
				$payment=array(
					'sale_id'  => $sale_id,
					'type'        =>$_SESSION['payment']['type'],
					'amount'      =>$_SESSION['payment']['amount'],
					'description' =>$_SESSION['payment']['description'],
					'date_time'   =>$_SESSION['payment']['date'],
					'user_id'     => $_SESSION['user_id']
					);
				$this->payment_model->insert($payment);
			}
			} else {
				$data['message']='<div class="alert alert-danger">Unable to save invoice details..!</div>';
			}
		} else {
			$data['message']='<div class="alert alert-danger">Invalid Data..!</div>';
		}
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('storage_model');
		$this->load->view('operation/new_sale',$data);
	}
	function payment(){
		if ($this->input->post()) {
			$_SESSION['payment']['type']=$this->input->post('payment_type');
			$_SESSION['payment']['amount']=$this->input->post('payment_amount');
			$_SESSION['payment']['date']=$this->input->post('payment_date');
			$_SESSION['payment']['description']=$this->input->post('payment_description');
			return true;
		} else {
			return false;
		}
	}
	function load_payment_table(){
		$this->load->view('operation/payment_table');
	}
	function payment_delete(){
		unset($_SESSION['payment']);
	}
	function load_product(){
		if ($this->uri->segment(3)) {
			$this->load->model('product_model');
			$this->load->view('operation/load_products');
		}
	}
	function load_units(){
		if ($this->uri->segment(3)) {
			$this->load->model('unit_model');
			$this->load->view('operation/load_units');
		}
	}
	function sale_list(){
		$this->load->model('customer_model');
		$this->load->model('sale_model');
		$this->load->model('sale_details_model');
		$this->load->model('payment_model');
		if($this->input->post()){
			$this->load->view('operation/ajax_sale_list');
		} else {
			$this->load->view('operation/sale_list');
		}
	}
	function sale_show(){
		$this->load->model('customer_model');
		$this->load->model('sale_model');
		$this->load->model('sale_details_model');
		$this->load->model('payment_model');
		$this->load->model('company_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('operation/sale_view');
	}
}	
