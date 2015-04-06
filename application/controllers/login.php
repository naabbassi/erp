<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
	}
	public function index()
	{	
		$data='';
		if ($this->input->post()) {
			$user=$this->user_model->verify_user(
				array(
					'username'=>$this->input->post('username'),
					'password'=>sha1($this->input->post('password'))
					)
				);
			if ($user !== false) {
				$_SESSION['user_id']=$user->user_id;
				$_SESSION['username']=$user->username;
				$_SESSION['password']=$user->password;
				redirect('file');
				exit();
			}
			else{
				$data['login']='Username and Password Not Valid';
			}
		}
		if (isset($_SESSION['user_id'])) {
			$res=$this->user_model->verify_user(
				array(
					'user_id'=>$_SESSION['user_id'],
					'username'=>$_SESSION['username'],
					'password'=>$_SESSION['password']
					)
				);
			if ($res !== false) {
				redirect('file');
				exit();
			}
			else{
				session_destroy();
				$data['session']='Session Not valid or expired';
			}
		}
			$this->load->view('login_view',$data);
	} 
	public function logout(){
		session_destroy();
		$data['logout']='';
		$this->load->view('login_view',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */