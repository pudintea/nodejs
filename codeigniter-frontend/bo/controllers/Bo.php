<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Bo extends CI_Controller {
	function __construct()
	{
		$this->data = [];
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function title()		{return 'Login Frontend';}
	public function author()	{return 'Pudin S I';}
	public function MainModel()	{return 'Bo_Models';}
	public function contact()	{return 'najzmitea@gmail.com';}
	public function ClassNama()	{return 'bo';}
	
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->data['pdn_title'] = $this->title();
			$this->data['pdn_url'] = $this->ClassNama();

			$this->data['email'] = [
				'name' 				=> 'email',
				'id' 				=> 'email',
				'type' 				=> 'email',
				'class' 			=> 'form-control form-control-user',
				'placeholder' 		=> 'Enter Email Address...',
				'required' 			=> 'required',
				'aria-describedby' 	=> 'emailHelp',
				'value' 			=> $this->form_validation->set_value('nama'),
			];
			$this->data['password'] = [
				'name' 			=> 'password',
				'id' 			=> 'password',
				'type' 			=> 'password',
				'class' 		=> 'form-control form-control-user',
				'placeholder' 	=> 'Password',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('password'),
			];

			$this->load->view('login', $this->data);
		}else{
			// Validasi berhasil
			$this->_login();
		}
	}
	
	private function _login(){
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$this->load->model($this->MainModel(),'M_pdn');

		//Hasilnya sudah berbentuk json
		$output	= $this->M_pdn->get_auth($email, $password);
		$kearray = json_decode($output, true);

		if ($kearray['status'] == 'success'){
			$token_jwt = $kearray['token'];
			$token_exp 	= time() + 3600; // Detik
			// Set Cookie JWT
			set_cookie($this->config->item('jwt_cookie_nama'), $token_jwt, $token_exp);

			// Redirest Ke Dashboard Setelah Login
			$message = $kearray['message'];
			$this->session->set_flashdata('success', $message);
			redirect(base_url('dashboard'), 'refresh');
		}else{
			$message = "Login tidak berhasil!";
			$this->session->set_flashdata('error', $message);
			redirect(base_url('bo'), 'refresh');
		}

		//output to json format
		// header('Content-type: application/json');
		// echo $output;
	}
	
	
	public function logout(){
		//DELET COOKIE
		delete_cookie('pdn_cookie_applogin');
		delete_cookie('pdn_session_cookie');
		delete_cookie('ci_session');

		$this->pudin_dev->clear_all_cookies();

		$message = "You have been logged out!";
		$this->session->set_flashdata('success', $message);
		redirect(base_url('bo'), 'refresh');
	}
}
