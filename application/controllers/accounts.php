<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

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
	function general(){
		$this->load->model('general_model');
		$this->load->view('accounts/new_general');
	}
	function new_general(){
		if($this->input->post()){
			$data=array(
				'title'=> $this->input->post('title'),
				'user_id'=> $_SESSION['user_id']
				);
			$this->load->model('general_model');
			$res=$this->general_model->insert($data);
			if ($res) {
				$this->session->set_flashdata('new_general','<div class="alert alert-success" >هەژماری نوێ بە سەرکەوتویی پاشکەوت کرا.</div>');
			} else {
				$this->session->set_flashdata('new_general','<div class="alert alert-danger" >هەژماری نوێ بە سەرکەوتویی پاشکەوت نەبۆ</div>');
			}
		}
			redirect('accounts/general');
	}
	function edit_general(){
		if ($this->uri->segment(3)) {
		$this->load->model('general_model');
		$this->load->view('accounts/edit_general');
		}
	}
	function update_general(){
		if($this->input->post() && $this->uri->segment(3)){
			$data=array(
				'title'=> $this->input->post('title'),
				'user_id'=> $_SESSION['user_id']
				);
			$this->load->model('general_model');
			$res=$this->general_model->update($data,array('id'=>$this->uri->segment(3)));
			if ($res) {
				$this->session->set_flashdata('update_general','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
			} else {
				$this->session->set_flashdata('update_general','<div class="alert alert-danger"> >گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
			}
		}
		$this->load->model('sub_accounts_model');
		redirect('accounts/general');
	}
	function delete_general(){
		$this->session->set_flashdata('delete_general','<div class="alert alert-success">ئەم بەشە لە ژێر چاککردن دایە.</div>');
	}
	function independent(){
			$this->load->model('independent_model');
			$this->load->model('sub_accounts_model');
			$this->load->view('accounts/new_independent');
		}
		function new_independent(){
			if($this->input->post()){
				$data=array(
					'sub_id'=> $this->input->post('sub_id'),
					'title'=> $this->input->post('title'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('independent_model');
				$res=$this->independent_model->insert($data);
				if ($res) {
					$this->session->set_flashdata('new_independent','<div class="alert alert-success" >هەژماری نوێ بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('new_independent','<div class="alert alert-danger" >هەژماری نوێ بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			}
				$this->load->model('sub_accounts_model');
				redirect('accounts/independent');
		}
		function edit_independent(){
			if ($this->uri->segment(3)) {
			$this->load->model('independent_model');
			$this->load->model('sub_accounts_model');
			$this->load->view('accounts/edit_independent');
			}
		}
		function update_independent(){
			if($this->input->post() && $this->uri->segment(3)){
				$data=array(
					'title'=> $this->input->post('title'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('independent_model');
				$res=$this->independent_model->update($data,array('id'=>$this->uri->segment(3)));
				if ($res) {
					$this->session->set_flashdata('update_independent','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('update_independent','<div class="alert alert-danger"> >گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			}
			$this->load->model('sub_accounts_model');
			redirect('accounts/independent');
		}
		function delete_independent(){
			$this->session->set_flashdata('delete_independent','<div class="alert alert-warning">ئەم بەشە لە ژێر چاککردن دایە.</div>');
		}
		function fix_assets(){
			$this->load->model('fix_assets_model');
			$this->load->view('accounts/new_fix');
		}
		function new_fix_asset(){
			if ($this->input->post()) {
				$data=array(
					'title' => $this->input->post('title'),
					'position' => $this->input->post('position'),
					'responsible' => $this->input->post('responsible'),
					'purchase_date' => $this->input->post('purchase_date'),
					'depreciation_method' => $this->input->post('depreciation_method'),
					'asset_purchase_price' => $this->input->post('asset_purchase_price'),
					'asset_life' => $this->input->post('asset_life'),
					'accumulated_depreciation' => $this->input->post('accumulated_depreciation'),
					'description' => $this->input->post('description'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('fix_assets_model');
				$res=$this->fix_assets_model->insert($data);
				if ($res) {
					$this->session->set_flashdata('new_asset','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('new_asset','<div class="alert alert-danger"> >گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			}
			redirect('accounts/fix_assets');
		}
		function edit_fix_asset(){
			if (is_numeric($this->uri->segment(3))) {
				$this->load->model('fix_assets_model');
				$this->load->view('accounts/edit_fix_asset');
			}
		}
		function update_fix_asset(){
			if (is_numeric($this->uri->segment(3))) {
				$data=array(
					'title' => $this->input->post('title'),
					'position' => $this->input->post('position'),
					'responsible' => $this->input->post('responsible'),
					'purchase_date' => $this->input->post('purchase_date'),
					'depreciation_method' => $this->input->post('depreciation_method'),
					'asset_purchase_price' => $this->input->post('asset_purchase_price'),
					'asset_life' => $this->input->post('asset_life'),
					'accumulated_depreciation' => $this->input->post('accumulated_depreciation'),
					'description' => $this->input->post('description'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('fix_assets_model');
				$res=$this->fix_assets_model->update($data,array('id'=>$this->uri->segment(3)));
				if ($res) {
					$this->session->set_flashdata('update_asset','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('update_asset','<div class="alert alert-danger">گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			} else {
					$this->session->set_flashdata('update_asset','<div class="alert alert-danger">هەلە رۆی داوە...Update ID not valid</div>');
				}
			redirect('accounts/fix_assets');
		}
		function delete_fix_asset(){
			if (is_numeric($this->uri->segment(3))) {
				$this->load->model('fix_assets_model');
				$res=$this->fix_assets_model->delete(array('id'=>$this->uri->segment(3)));
				if ($res) {
					echo '<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>';
				} else {
					echo '<div class="alert alert-danger">گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>';
				}
			} else {
				echo '<div class="alert alert-danger">ID Not Valid ...!</div>';
			}
		}
	function stock_holders(){
			$this->load->model('owners_model');
			$this->load->view('accounts/new_owner');
		}
		function new_stock_holder(){
			if ($this->input->post()) {
				$data=array(
					'title' => $this->input->post('title'),
					'name' => $this->input->post('name'),
					'family' => $this->input->post('family'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'equity_percent' => $this->input->post('equity_percent'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('owners_model');
				$res=$this->owners_model->insert($data);
				if ($res) {
					$this->session->set_flashdata('new_asset','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('new_asset','<div class="alert alert-danger"> >گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			}
			redirect('accounts/stock_holders');
		}
		function edit_stock_holder(){
			if (is_numeric($this->uri->segment(3))) {
				$this->load->model('owners_model');
				$this->load->view('accounts/edit_owner');
			}
		}
		function update_stock_holder(){
			if (is_numeric($this->uri->segment(3))) {
				$data=array(
					'title' => $this->input->post('title'),
					'name' => $this->input->post('name'),
					'family' => $this->input->post('family'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'equity_percent' => $this->input->post('equity_percent'),
					'user_id'=> $_SESSION['user_id']
					);
				$this->load->model('owners_model');
				$res=$this->owner_model->update($data,array('id'=>$this->uri->segment(3)));
				if ($res) {
					$this->session->set_flashdata('update_asset','<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>');
				} else {
					$this->session->set_flashdata('update_asset','<div class="alert alert-danger">گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>');
				}
			} else {
					$this->session->set_flashdata('update_asset','<div class="alert alert-danger">هەلە رۆی داوە...Update ID not valid</div>');
				}
			redirect('accounts/stock_holders');
		}
		function delete_stock_holder(){
			if (is_numeric($this->uri->segment(3))) {
				$this->load->model('owners_model');
				$res=$this->owners_model->delete(array('id'=>$this->uri->segment(3)));
				if ($res) {
					echo '<div class="alert alert-success"> گۆرانگاری  بە سەرکەوتویی پاشکەوت کرا.</div>';
				} else {
					echo '<div class="alert alert-danger">گۆرانگاری بە سەرکەوتویی پاشکەوت نەبۆ</div>';
				}
			} else {
				echo '<div class="alert alert-danger">ID Not Valid ...!</div>';
			}
		}
}