<?php
class user_model extends My_model{

	function __construct()
	{
		$this->table='user';
	}
		function verify_user($cond)
	{
		$q=$this
		->db
		->limit(1)
		->get_where($this->table,$cond);
		if ($q->num_rows > 0) {
			return $q->row();
		}
		return false;
	}
	function get_user_id($cond){
		$res=$this
		->db
		->get_where($this->table,$cond);
		if ($res->num_rows > 0) {
			return $res;
		}
		else{
			return false;
		}
	}
}
?>