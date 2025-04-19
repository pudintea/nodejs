<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		$this->data =[];
		parent::__construct();
		$this->pudin_dev->pdn_is_login();
		$this->load->model('Dashboard_Models', 'M_pdn');
	}
	
    public function ClassNama()		{ return 'dashboard'; }
    public function Author()		{ return 'Pudin S I'; }
	
	public function index()
	{
		$this->data['pdn_title'] 		= 'Dashboard';
		$this->data['pdn_url'] 			= $this->ClassNama();
		$this->data[$this->ClassNama()] = 'active';
		$this->template->pdn_load('template/sbadmin',$this->ClassNama().'/table',$this->ClassNama().'/table_kode', $this->data);
	}
}
