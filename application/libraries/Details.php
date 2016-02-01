<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Details {

 	function get_title($sub_id,$detail_id){
 		if ($sub_id !=0 & $sub_id > 0 & $detail_id > 0) {
 			$CI =& get_instance();
			$CI->load->model('sub_accounts_model'); 
 			$count=$CI->sub_accounts_model->count(array('id'=>$sub_id));
 			if ($count != 1) { exit(); }
 			$sub = $CI->sub_accounts_model->findbyid($sub_id);
 			switch ($sub->detail_kind) {
 				case '0':
 					return '';
 					break;
 				case '1':
 					$CI->load->model('independent_model'); 
 					$res=$CI->independent_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				case '2':
 				 	$CI->load->model('customer_model'); 
 					$res=$CI->customer_model->findbyid($detail_id);
 					return $res->f_name.' '.$res->m_name;
 					break;
 				case '3':
 					$CI->load->model('revolving_model'); 
 					$res=$CI->revolving_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				case '4':
 					$CI->load->model('personnels_model'); 
 					$res=$CI->personnels_model->findbyid($detail_id);
 					return $res->name.' '.$res->family;
 					break;
 				case '5':
 					$CI->load->model('owners_model'); 
 					$res=$CI->owners_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				case '6':
 					$CI->load->model('fix_assets_model'); 
 					$res=$CI->fix_assets_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				case '7':
 					$CI->load->model('banks_model'); 
 					$res=$CI->banks_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				case '8':
 					$CI->load->model('general_model'); 
 					$res=$CI->general_model->findbyid($detail_id);
 					return $res->title;
 					break;
 				default:
 					return '';
 					break;
 			}
 		}
 	}
function get_code($sub_id,$detail_id){
 		if ($sub_id !=0 & $sub_id > 0 & $detail_id > 0) {
 			$CI =& get_instance();
			$CI->load->model('sub_accounts_model'); 
 			$count=$CI->sub_accounts_model->count(array('id'=>$sub_id));
 			if ($count != 1) { exit(); }
 			$sub = $CI->sub_accounts_model->findbyid($sub_id);
 			switch ($sub->detail_kind) {
 				case '0':
 					return '';
 					break;
 				case '1':
 					$CI->load->model('independent_model'); 
 					$res=$CI->independent_model->findbyid($detail_id);
 					return '1'.$res->id;
 					break;
 				case '2':
 				 	$CI->load->model('customer_model'); 
 					$res=$CI->customer_model->findbyid($detail_id);
 					return '2'.$res->id;
 					break;
 				case '3':
 					$CI->load->model('revolving_model'); 
 					$res=$CI->revolving_model->findbyid($detail_id);
 					return '3'.$res->id;
 					break;
 				case '4':
 					$CI->load->model('personnels_model'); 
 					$res=$CI->personnels_model->findbyid($detail_id);
 					return '4'.$res->id;
 					break;
 				case '5':
 					$CI->load->model('owners_model'); 
 					$res=$CI->owners_model->findbyid($detail_id);
 					return '5'.$res->id;
 					break;
 				case '6':
 					$CI->load->model('fix_assets_model'); 
 					$res=$CI->fix_assets_model->findbyid($detail_id);
 					return '6'.$res->id;
 					break;
 				case '7':
 					$CI->load->model('banks_model'); 
 					$res=$CI->banks_model->findbyid($detail_id);
 					return '7'.$res->id;
 					break;
 				case '8':
 					$CI->load->model('general_model'); 
 					$res=$CI->general_model->findbyid($detail_id);
 					return '8'.$res->id;
 					break;
 				default:
 					return '';
 					break;
 			}
 		}
 	} 	
 	function get_list($cond){
 		$CI =& get_instance();
        $CI->load->database();
 		$CI->db->select('sub_accounts.id,detail_kind', FALSE);
		$CI->db->select('accounting_record_items.id,sub_id', FALSE);
		$CI->db->where('accounting_record_items.id',$cond);
		$CI->db->from('accounting_record_items');
		$CI->db->join('sub_accounts', 'sub_accounts.id = accounting_record_items.sub_id');
		$query = $CI->db->get();;
		$results = $query->result_array();
		return $results;
 	}
 }
 