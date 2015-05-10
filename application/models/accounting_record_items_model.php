<?php
class accounting_record_items_model extends My_model{

	function __construct()
	{
		$this->table='accounting_record_details';
	}
	function get_total_session_debit(){
		$total=0;
		foreach ($_SESSION['record_items'] as $key) {
			$total=$total+$key['debit'];
		}
		return $total;
	}
	function get_total_session_credit(){
		$total=0;
		foreach ($_SESSION['record_items'] as $key) {
			$total=$total+$key['credit'];
		}
		return $total;
	}
}
?>