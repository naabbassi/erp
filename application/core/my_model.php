<?php
class My_model extends CI_model{

	public $table;
	function __construct()
	{
		parent::__construct();
	}
	function all(){
		$res=$this->db->get($this->table)->result();
		return $res;
	}
	function count($cond){
		$query = $this->db->get_where($this->table, $cond);
		$count = $query->num_rows();
		return $count;
	}
	function select($cond,$order="",$limit=""){
		if ($limit !="") { $this->db->limit($limit); }
		$res=$this->db->get_where($this->table,$cond);
		return $res->result();
	}
	function select_row($cond){
		$res=$this->db->get_where($this->table,$cond);
		return $res->row();
	}
	function insert($data){
		return $this->db->insert($this->table,$data);
	}
	function update($data,$cond){
		return $this->db->where($cond)->update($this->table,$data);
	}
	function delete($cond){
		return $this->db->where($cond)->delete($this->table);
	}
	function findbyid($id){
		return $this->db->where('id',$id)->limit(1)->get($this->table)->row();
	}
	function findbyfield($field,$value){
		return $this->db->where($field,$value)->limit(1)->get($this->table)->row();
	}
	function exist($cond){
		$query = $this->db->get_where($this->table, $cond);
		$count = $query->num_rows();
		if($count == 1){
			return true;
		}
		else {
			return false;
		}
	}
	function sum($field,$cond){
		$query=$this
		->db
		->select_sum($field)
		->get_where($this->table,$cond);
    	return $query->row();
	}
	function avg($field,$cond){
		$query=$this
		->db
		->select_avg($field)
        ->get_where($this->table,$cond);
    	return $query->row();
	}
	function multiple($field1,$field2,$cond){
		$res=$this->db->get_where($this->table,$cond);
		$total=0;
		foreach ($res->result() as $key) {
			$t1=$key->$field1;
			$t2=$key->$field2;
			$tot=$t1 * $t2;
			$total= $total + $tot;
			$tot=0;
		}
		return $total;
	}
	function get_first(){
		return $this->db->where('id','1')->get($this->table);
	}
}
?>
