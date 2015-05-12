<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		if( ! ini_get('date.timezone') )
		{
		   date_default_timezone_set('GMT');
		}
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
		$this->load->view('welcome_message');
	}
	function accounting_record_report(){
		$this->load->model('accounting_record_items_model');
		$this->load->model('accounting_record_model');
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('ledger_accounts_model');
		$this->load->model('sub_accounts_model');
		$this->load->view('reports/accountig_record_report');
	}
	function invoice_list(){
		$this->load->model('invoice_model');
		$this->load->view('reports/invoice_list_report');
	}
	function trial_balancesheet(){
		$this->load->model('group_accounts_model');
		$this->load->model('accounting_record_items_model');
		$this->load->model('accounting_record_model');
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('ledger_accounts_model');
		$this->load->model('sub_accounts_model');
		$this->load->view('reports/trial_balancesheet');
	}
	function accounts_report(){
		$this->load->model('group_accounts_model');
		$this->load->model('accounting_record_items_model');
		$this->load->model('accounting_record_model');
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('ledger_accounts_model');
		$this->load->model('sub_accounts_model');
		$this->load->view('reports/accounts_report');
	}
	function accounts_report_prepare(){
		$this->load->model('group_accounts_model');
		$this->load->model('accounting_record_items_model');
		$this->load->model('accounting_record_model');
		$this->load->model('ledger_accounts_model');
		$this->load->model('sub_accounts_model');
		if ($this->input->post('group_id') > 0 & $this->input->post('ledger_id') > 0 & $this->input->post('sub_id') > 0 & $this->input->post('detail_id') > 0 ) {
			$this->load->view('reports/detail_accounts_report');
		} elseif ($this->input->post('group_id') > 0 & $this->input->post('ledger_id') > 0 & $this->input->post('sub_id') > 0 ) {
			$this->load->view('reports/sub_accounts_report');
		} elseif ($this->input->post('group_id') > 0 & $this->input->post('ledger_id') > 0 ) {
			$this->load->view('reports/ledger_accounts_report');
		}
	}
	function load_details(){
		$this->load->model('sub_accounts_model');
		$this->load->model('independent_model');
		$this->load->model('customer_model');
		$this->load->model('revolving_model');
		$this->load->model('personnels_model');
		$this->load->model('owners_model');
		$this->load->model('fix_assets_model');
		$this->load->model('banks_model');
		$this->load->model('general_model');
		$this->load->view('reports/load_details');
	}
	function products_report(){
		$this->load->model('sale_model');
		$this->load->model('sale_details_model');
		$this->load->model('purchase_details_model');
		$this->load->model('customer_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('reports/products_report');
	}
	function inventory_report(){
		$this->load->model('product_model');
		$this->load->model('cat_model');
		$this->load->model('purchase_model');
		$this->load->model('income_items_model');
		$this->load->model('storage_output_model');
		$this->load->view('reports/inventory_report');
	}
	function customer_report(){
		$this->load->model('customer_product_view_model');
		$this->load->model('payment_model');
		$this->load->model('sale_details_model');
		$this->load->model('purchase_details_model');
		$this->load->model('customer_model');
		$this->load->model('product_model');
		$this->load->model('unit_model');
		$this->load->view('reports/customer_report');
	}
}

