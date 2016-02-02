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
	function purchase()
	{
		$this->load->model('storage_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('cat_model');
		$this->load->view('operation/new_purchase');
	}
	function purchase_invoice(){
		if ($this->input->post() &&  $this->cart->total_items() > 0) {
			$data=array(
				'customer_id'  =>$this->input->post('customer_id'),
				'invoice_no'   =>$this->input->post('invoice_no'),
				'title'        =>$this->input->post('title'),
				'discount'     =>$this->input->post('discount'),
				'date_time'    =>$this->input->post('date_time'),
				'description'  =>$this->input->post('description'),
				'user_id'      => $_SESSION['user_id']
				);
			$this->load->model('purchase_model');
			$res=$this->purchase_model->insert($data);
			if ($res == 1) {
				$purchase_id=$this->db->insert_id();
				$this->load->model('purchase_details_model');
				foreach ($this->cart->contents() as $item) {
					$options=$this->cart->product_options($item['rowid']);
					$data_item=array(
						'purchase_id'     => $purchase_id,
						'storage_id'  => $options['storage_id'],
						'product_id'  => $item['id'],
						'unit_id'     => $item['name'],
						'quantity'    => $item['qty'],
						'price'  => $item['price'],
						'user_id'     => $_SESSION['user_id']
						);
					$this->purchase_details_model->insert($data_item);
				}
				$this->cart->destroy();
				$data['message']='<div class="alert alert-success">پاشکەوت کردن سەرکەوتۆ بۆ..! '.$purchase_id.'</div>';
				if (isset($_SESSION['payment']['type']) && isset($_SESSION['payment']['amount'])) {
				$this->load->model('purchase_payment_model');
				date_default_timezone_set('UTC');
				$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'purchase_id' =>$purchase_id,
					'type'        =>$_SESSION['payment']['type'],
					'amount'      =>$_SESSION['payment']['amount'],
					'description' =>$_SESSION['payment']['description'],
					'date_time'   =>$_SESSION['payment']['date'],
					'user_id'     => $_SESSION['user_id']
					);
				$payment_res=$this->purchase_payment_model->insert($payment);
				if($payment_res){unset($_SESSION['payment']);}
			}
			} else {
				$data['message']='<div class="alert alert-danger">Unable to save invoice details..!</div>';
			}
		} else {
			$data['message']='<div class="alert alert-danger">Invalid Data..!</div>';
		}
		$this->load->model('cat_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('storage_model');
		$this->load->view('operation/new_purchase',$data);
	}
	function purchase_list(){
		$this->load->model('customer_model');
		$this->load->model('purchase_model');
		$this->load->model('purchase_details_model');
		$this->load->model('purchase_payment_model');
		if($this->input->post()){
			$this->load->view('operation/ajax_purchase_list');
		} else {
			$this->load->view('operation/purchase_list');
		}
	}
	function purchase_show(){
		$this->load->model('customer_model');
		$this->load->model('purchase_model');
		$this->load->model('purchase_details_model');
		$this->load->model('purchase_payment_model');
		$this->load->model('company_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('operation/purchase_view');
	}
	function edit_purchase(){
		$this->load->model('purchase_model');
		$this->load->model('purchase_details_model');
		$this->load->model('storage_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('cat_model');
		$this->load->view('operation/purchase_edit');
	}
	function edit_purchase_detail(){
		if ($this->uri->segment(3)) {
			$this->load->model('purchase_model');
			$this->load->model('purchase_details_model');
			$this->load->model('storage_model');
			$this->load->model('product_model');
			$this->load->model('unit_model');
			$this->load->model('customer_model');
			$this->load->model('cat_model');
			$this->load->view('operation/edit_purchase_detail_item');
		}
	}
	function update_purchase_item(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'storage_id'  => $this->input->post('storage_id'),
				'product_id'  => $this->input->post('product_id'),
				'unit_id'     => $this->input->post('unit_id'),
				'quantity'    => $this->input->post('quantity'),
				'price'  	  => $this->input->post('price'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('purchase_details_model');
			$res=$this->purchase_details_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($res) {
				echo "<div class='alert alert-success'>گورانکارێکان پاشکەوت کرا.</div>";
			} else {
				echo "<div class='alert alert-warning'>ئەنجامەکان سەرکەوتو نەبۆ.</div>";
			}
		} else {
			echo "<div class='alert alert-warning'>ئەنجامەکان سەرکەوتو نەبۆ.</div>";
		}
	}
	function new_purchase_detail(){
		if ($this->uri->segment(3)) {
			$this->load->model('purchase_model');
			$this->load->model('purchase_details_model');
			$this->load->model('storage_model');
			$this->load->model('product_model');
			$this->load->model('unit_model');
			$this->load->model('customer_model');
			$this->load->model('cat_model');
			$this->load->view('operation/new_purchase_detail_item');
		} else {
			echo "<div class='alert alert-warning'>داتای ناردراو ڕەوا نێ.</div>";
		}
	}
	function update_purchase_detail(){
		if ($this->input->post() && $this->uri->segment(3)) {
		$data=array(
				'customer_id'  =>$this->input->post('customer_id'),
				'title'        =>$this->input->post('title'),
				'invoice_no'   =>$this->input->post('invoice_no'),
				'discount'     =>$this->input->post('discount'),
				'date_time'    =>$this->input->post('date_time'),
				'description'  =>$this->input->post('description'),
				'user_id'      => $_SESSION['user_id']
				);
			$this->load->model('purchase_model');
			$res=$this->purchase_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($res) {
				echo "<div class='alert alert-success'>گورانکاری سەرکەوتو بۆ.</div>";
			} else {
				echo "<div class='alert alert-warning'>گورانکاری سەرکەوتو نبۆ.</div>";
			}
		} else {
			echo "<div class='alert alert-warning'>گورانکاری سەرکەوتو نبۆ.</div>";
		}
	}
	function insert_purchase_item(){
		if ($this->uri->segment(3) && $this->input->post()) {
			$data=array(
						'purchase_id'     => $this->uri->segment(3),
						'storage_id'  => $this->input->post('storage_id'),
						'product_id'  => $this->input->post('product_id'),
						'unit_id'     => $this->input->post('unit_id'),
						'quantity'    => $this->input->post('quantity'),
						'price'       => $this->input->post('price'),
						'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('purchase_details_model');
			$this->purchase_details_model->insert($data);
		}
	}
	function delete_purchase_item(){
		if ($this->uri->segment(3)) {
			$this->load->model('purchase_details_model');
			$this->purchase_details_model->delete(array('id'=>$this->uri->segment(3)));
		}
	}
	function purchase_payment(){
		$this->load->model('purchase_model');
		$this->load->model('customer_model');
		$this->load->model('purchase_payment_model');
		$this->load->view('operation/new_purchase_payment');
	}
	function load_purchase_invoice_list(){
		$this->load->model('purchase_model');
		$this->load->view('operation/load_purchase_invoice_list');
	}
	function new_purchase_payment(){
		if ($this->input->post()) {
		$this->load->model('sale_model');
		$this->load->model('customer_model');
		$this->load->model('purchase_payment_model');
		$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'purchase_id'     =>$this->input->post('purchase_id'),
					'type'        =>$this->input->post('payment_type'),
					'amount'      =>$this->input->post('payment_amount'),
					'description' =>$this->input->post('payment_description'),
					'date_time'   =>$this->input->post('payment_date'),
					'user_id'     => $_SESSION['user_id']
					);
		$res=$this->purchase_payment_model->insert($payment);
		if ($res == 1) {
			$this->session->set_flashdata('new_payment' , "<div class='alert alert-success'>Data was saved successfuly</div>");
		} else {
			$this->session->set_flashdata('new_payment' , "<div class='alert alert-danger'>operation was not successfuly</div>");
		}
		$this->load->view('operation/new_purchase_payment');
		}
	}
	function delete_purchase_payment()
	{
		echo "<div class='alert alert-danger'>you haven't permission to delete payments</div>";
	}
	function edit_purchase_payment(){
		if ($this->uri->segment(3)) {
			$this->load->model('purchase_payment_model');
			$this->load->model('customer_model');
			$this->load->model('purchase_model');
			$this->load->view('operation/edit_purchase_payment');
		}
	}
	function update_purchase_payment(){
		if ($this->input->post() && $this->uri->segment(3)) {
		$this->load->model('purchase_model');
		$this->load->model('customer_model');
		$this->load->model('purchase_payment_model');
		$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'purchase_id'     =>$this->input->post('purchase_id'),
					'type'        =>$this->input->post('payment_type'),
					'amount'      =>$this->input->post('payment_amount'),
					'description' =>$this->input->post('payment_description'),
					'date_time'   =>$this->input->post('payment_date'),
					'user_id'     => $_SESSION['user_id']
					);
		$res=$this->purchase_payment_model->update($payment,array('id'=>$this->uri->segment(3)));
		if ($res == 1) {
			$this->session->set_flashdata('update_payment',"<div class='alert alert-success'>گوڕانکاری ئەنجام دڕا.  </div>");
		} else {
			$this->session->set_flashdata('update_payment',"<div class='alert alert-danger'>گورانکاری سەرکەوتۆ نەبو.</div>");
		}
		redirect('operation/purchase_payment',$result);
		}
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
				$data['message']='<div class="alert alert-success">پاشکەوت کردن سەرکەوتۆ بۆ..! '.$sale_id.'</div>';
				if (isset($_SESSION['payment']['type']) && isset($_SESSION['payment']['amount'])) {
				$this->load->model('payment_model');
				date_default_timezone_set('UTC');
				$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'sale_id'     =>$sale_id,
					'type'        =>$_SESSION['payment']['type'],
					'amount'      =>$_SESSION['payment']['amount'],
					'description' =>$_SESSION['payment']['description'],
					'date_time'   =>$_SESSION['payment']['date'],
					'user_id'     => $_SESSION['user_id']
					);
				$payment_res=$this->payment_model->insert($payment);
				if($payment_res){unset($_SESSION['payment']);}
			}
			} else {
				$data['message']='<div class="alert alert-danger">Unable to save invoice details..!</div>';
			}
		} else {
			$data['message']='<div class="alert alert-danger">Invalid Data..!</div>';
		}
		$this->load->model('cat_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('storage_model');
		$this->load->view('operation/new_sale',$data);
	}
	function ajax_payment(){
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
	function load_ajax_payment_table(){
		$this->load->view('operation/payment_table');
	}
	function ajax_payment_delete(){
		unset($_SESSION['payment']);
	}
	function sale_back(){
		$this->load->model('sale_back_model');
		$this->load->model('customer_model');
		$this->load->model('sale_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('operation/sale_back');
	}
	function sale_back_save(){
		if ($this->input->post()) {
			$sale_back=array(
				'sale_id' => $this->input->post('sale_id'),
				'product_id' => $this->input->post('product_id'),
				'unit_id' => $this->input->post('unit_id'),
				'quantity' => $this->input->post('quantity'),
				'date_time' => $this->input->post('date_time'),
				'description' => $this->input->post('description'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_back_model');
			$res=$this->sale_back_model->insert($sale_back);
			if ($res == 1) {
				$result['message']="<div class='alert alert-success'>Data was saved successfuly</div>";
			} else {
				$result['message']="<div class='alert alert-success'>Data was saved successfuly</div>";
			}
			$this->load->model('customer_model');
			$this->load->model('sale_model');
			$this->load->view('operation/sale_back',$result);
		}
	}
	function delete_sale_back(){
		if ($this->uri->segment(3)) {
			$this->load->model('sale_back_model');
			$res=$this->sale_back_model->delete(array('id'=>$this->uri->segment(3)));
			if ($res) {
				echo "<div class='alert alert-success'>Item was deleted successfuly</div>";
			} else {
				echo "<div class='alert alert-warning'>operation was unsuccessfuly</div>";
			}
		} else {
			echo "<div class='alert alert-success'>Error in received data.!</div>";
		}
	}
	function edit_sale_back(){
		$this->load->model('sale_back_model');
		$this->load->model('customer_model');
		$this->load->model('sale_model');
		$this->load->model('sale_details_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('operation/edit_sale_back');
	}
	function sale_back_update(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$sale_back=array(
				'sale_id' => $this->input->post('sale_id'),
				'product_id' => $this->input->post('product_id'),
				'unit_id' => $this->input->post('unit_id'),
				'quantity' => $this->input->post('quantity'),
				'date_time' => $this->input->post('date_time'),
				'description' => $this->input->post('description'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_back_model');
			$res=$this->sale_back_model->update($sale_back,array('id'=>$this->uri->segment(3)));
			if ($res) {
				$result['message']="<div class='alert alert-success'>گورانکارێکان پاشکەوت کرا.</div>";
			} else {
				$result['message']="<div class='alert alert-warning'>ئەنجامەکان سەرکەوتو نەبۆ.</div>";
			}
			$this->load->model('customer_model');
			$this->load->model('sale_model');
			$this->load->model('product_model');
			$this->load->model('unit_model');
			$this->load->view('operation/sale_back',$result);
		}
	}
	function load_invoice_list(){
		$this->load->model('sale_model');
		$this->load->view('operation/load_invoice_list');
	}
	function load_invoice_products(){
		$this->load->model('sale_details_model');
		$this->load->model('product_model');
		$this->load->view('operation/load_invoice_products');
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
	function payment(){
		$this->load->model('sale_model');
		$this->load->model('customer_model');
		$this->load->model('payment_model');
		$this->load->view('operation/new_payment');
	}
	function new_payment(){
		if ($this->input->post()) {
		$this->load->model('sale_model');
		$this->load->model('customer_model');
		$this->load->model('payment_model');
		$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'sale_id'     =>$this->input->post('sale_id'),
					'type'        =>$this->input->post('payment_type'),
					'amount'      =>$this->input->post('payment_amount'),
					'description' =>$this->input->post('payment_description'),
					'date_time'   =>$this->input->post('payment_date'),
					'user_id'     => $_SESSION['user_id']
					);
		$res=$this->payment_model->insert($payment);
		if ($res == 1) {
			$this->session->set_flashdata('new_payment' , "<div class='alert alert-success'>Data was saved successfuly</div>");
		} else {
			$this->session->set_flashdata('new_payment' , "<div class='alert alert-danger'>operation was not successfuly</div>");
		}
		$this->load->view('operation/new_payment');
		}
	}
	function delete_payment(){
			echo "<div class='alert alert-warning'>you haven't permission to delete payments</div>";
	}
	function edit_payment(){
		if ($this->uri->segment(3)) {
			$this->load->model('payment_model');
			$this->load->model('customer_model');
			$this->load->model('sale_model');
			$this->load->view('operation/edit_payment');
		}
	}
	function update_payment(){
		if ($this->input->post() && $this->uri->segment(3)) {
		$this->load->model('sale_model');
		$this->load->model('customer_model');
		$this->load->model('payment_model');
		$payment=array(
					'customer_id' =>$this->input->post('customer_id'),
					'sale_id'     =>$this->input->post('sale_id'),
					'type'        =>$this->input->post('payment_type'),
					'amount'      =>$this->input->post('payment_amount'),
					'description' =>$this->input->post('payment_description'),
					'date_time'   =>$this->input->post('payment_date'),
					'user_id'     => $_SESSION['user_id']
					);
		$res=$this->payment_model->update($payment,array('id'=>$this->uri->segment(3)));
		if ($res == 1) {
			$this->session->set_flashdata('update_payment',"<div class='alert alert-success'>گوڕانکاری ئەنجام دڕا.  </div>");
		} else {
			$this->session->set_flashdata('update_payment',"<div class='alert alert-danger'>گورانکاری سەرکەوتۆ نەبو.</div>");
		}
		redirect('operation/payment',$result);
		}
	}
	function edit_sale(){
		$this->load->model('sale_model');
		$this->load->model('sale_details_model');
		$this->load->model('storage_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->model('customer_model');
		$this->load->model('cat_model');
		$this->load->view('operation/sale_edit');
	}
	function update_sale_detail(){
		if ($this->input->post() && $this->uri->segment(3)) {
		$data=array(
				'customer_id'  =>$this->input->post('customer_id'),
				'title'        =>$this->input->post('title'),
				'discount'    =>$this->input->post('discount'),
				'date_time'    =>$this->input->post('date_time'),
				'description'  =>$this->input->post('description'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_model');
			$res=$this->sale_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($res) {
				echo "<div class='alert alert-success'>گورانکاری سەرکەوتو بۆ.</div>";
			} else {
				echo "<div class='alert alert-warning'>گورانکاری سەرکەوتو نبۆ.</div>";
			}
		} else {
			echo "<div class='alert alert-warning'>گورانکاری سەرکەوتو نبۆ.</div>";
		}
	}
	function update_sale_item(){
		if ($this->input->post() && $this->uri->segment(3)) {
			$data=array(
				'storage_id'  => $this->input->post('storage_id'),
				'product_id'  => $this->input->post('product_id'),
				'unit_id'     => $this->input->post('unit_id'),
				'quantity'    => $this->input->post('quantity'),
				'price'  	  => $this->input->post('price'),
				'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_details_model');
			$res=$this->sale_details_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($res) {
				echo "<div class='alert alert-success'>گورانکارێکان پاشکەوت کرا.</div>";
			} else {
				echo "<div class='alert alert-warning'>ئەنجامەکان سەرکەوتو نەبۆ.</div>";
			}
		} else {
			echo "<div class='alert alert-warning'>ئەنجامەکان سەرکەوتو نەبۆ.</div>";
		}
	}
	function edit_sale_detail(){
		if ($this->uri->segment(3)) {
			$this->load->model('sale_model');
			$this->load->model('sale_details_model');
			$this->load->model('storage_model');
			$this->load->model('product_model');
			$this->load->model('unit_model');
			$this->load->model('customer_model');
			$this->load->model('cat_model');
			$this->load->view('operation/edit_detail_item');
		}
	}
	function new_sale_detail(){
		if ($this->uri->segment(3)) {
			$this->load->model('sale_model');
			$this->load->model('sale_details_model');
			$this->load->model('storage_model');
			$this->load->model('product_model');
			$this->load->model('unit_model');
			$this->load->model('customer_model');
			$this->load->model('cat_model');
			$this->load->view('operation/new_detail_item');
		} else {
			echo "<div class='alert alert-warning'>داتای ناردراو ڕەوا نێ.</div>";
		}
	}
	function insert_sale_item(){
		if ($this->uri->segment(3) && $this->input->post()) {
			$data=array(
						'sale_id'     => $this->uri->segment(3),
						'storage_id'  => $this->input->post('storage_id'),
						'product_id'  => $this->input->post('product_id'),
						'unit_id'     => $this->input->post('unit_id'),
						'quantity'    => $this->input->post('quantity'),
						'price'       => $this->input->post('price'),
						'user_id'     => $_SESSION['user_id']
				);
			$this->load->model('sale_details_model');
			$this->sale_details_model->insert($data);
		}
	}
	function delete_sale_item(){
		if ($this->uri->segment(3)) {
			$this->load->model('sale_details_model');
			$this->sale_details_model->delete(array('id'=>$this->uri->segment(3)));
		}
	}

}
