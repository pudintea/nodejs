<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	function __construct(){
		$this->data =[];
		parent::__construct();
		$this->pudin_dev->pdn_is_login();
		$this->load->model('Password_models', 'M_pdn_pass');
	}
	
    public function ClassNama()		{ return 'password'; }
    public function Author()		{ return 'Pudin S I'; }
	
	public function index()
	{
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[repassword]',[
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek, minimal 8 karakter!',
		]);
		$this->form_validation->set_rules('repassword', 'Password', 'required|trim|matches[repassword]');
		if ($this->form_validation->run() == FALSE)
        {
		$this->data['pdn_title'] 		= 'Ganti Password';
		$this->data['pdn_url'] 			= $this->ClassNama();
		$this->data[$this->ClassNama()] = 'active';

		$this->data['password1'] = [
			'name' 			=> 'password1',
			'id' 			=> 'password1',
			'type' 			=> 'password',
			'class' 		=> 'form-control',
			'placeholder' 	=> 'Password',
			'required' 		=> 'required',
		];

		$this->data['repassword'] = [
			'name' 			=> 'repassword',
			'id' 			=> 'repassword',
			'type' 			=> 'password',
			'class' 		=> 'form-control',
			'placeholder' 	=> 'Re Password',
			'required' 		=> 'required',
		];

		$this->template->pdn_load('template/sbadmin','pass', $this->ClassNama().'/pass_kode', $this->data);

		}else{
			// Karena ini pakai JWT, jadi ngambil data dari cookie
			$id_user 			= $this->pudin_dev->pdn_get_cookie('id');

			//echo $id_user ;
			$password1			= htmlspecialchars($this->input->post('password1', true));
			$repassword			= htmlspecialchars($this->input->post('repassword', true));

			if ($password1 != $repassword){
				$message = "MAAF, Password tidak sama!";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}

			$pdn_update['users_password'] = password_hash($password1, PASSWORD_DEFAULT);
			$proses_update = $this->M_pdn_pass->update($id_user, $pdn_update);

			if ($proses_update){
				$message = "Ganti Password Berhasil!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}else{
				$message = "MAAF, Ganti Password gagal!";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}


		}
	}
}
