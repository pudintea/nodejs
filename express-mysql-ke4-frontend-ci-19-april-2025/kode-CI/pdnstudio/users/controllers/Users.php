<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
		$this->data =[];
		parent::__construct();
		$this->pudin_dev->pdn_is_login();
		$this->pudin_dev->pdn_is_admin();
		$this->load->model('Users_models', 'M_pdn');
	}
	
    public function ClassNama()		{ return 'users'; }
    public function Author()		{ return 'Pudin S I'; }
	
	public function index()
	{
		$this->data['pdn_title'] 		= 'Data Users';
		$this->data['pdn_url'] 			= base_url($this->ClassNama());
		$this->data[$this->ClassNama()] = 'active';
		$this->template->pdn_load('template/sbadmin','table', $this->ClassNama().'/table_kode', $this->data);
		//output to json format
		// header('Content-type: application/json');
		// echo json_encode($data);
	}
	public function data_json()
	{
		$draw   = $this->input->post('draw');
		$start  = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];

		// Bungkus parameter untuk dikirim ke model
		$params = [
			'draw' => $draw,
			'start' => $start,
			'length' => $length,
			'search' => $search,
		];

		// Panggil model yang pakai Guzzle
		$response = $this->M_pdn->getDatatbles($params);

		// Langsung teruskan response JSON dari Express backend
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
}
