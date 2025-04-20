<?php defined('__PUDINTEA__') OR exit('No direct script access allowed');

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
		$search = $this->input->post('search')['value'] ?? '';
		$order   = $this->input->post('order');
		$columns = $this->input->post('columns');

		$params = [
			'draw' => $draw,
			'start' => $start,
			'length' => $length,
			'search' => $search,
			'order' => $order,
			'columns' => $columns
		];

		// Ambil data dari model (Guzzle ke Express backend)
		$response = $this->M_pdn->getDatatbles($params);

		// Siapkan hasil akhir untuk DataTables
		$data_rows = [];

		foreach ($response->data as $item) {
			$row = [];
			$row[] = $item->no;
			$row[] = $item->nama;
			$row[] = $item->email;
			$row[] = $item->level;

			// Action tombol Edit dan Hapus
			$row[] = '
				<a href="' . base_url('users/edit/' . $item->id) . '" class="btn btn-circle btn-sm btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
				<a href="' . base_url('users/delete/' . $item->id) . '" class="btn btn-circle btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></a>
			';

			$data_rows[] = $row;
		}

		$output = [
			'draw' => intval($response->draw),
			'recordsTotal' => $response->recordsTotal,
			'recordsFiltered' => $response->recordsFiltered,
			'data' => $data_rows
		];

		header('Content-Type: application/json');
		echo json_encode($output);
	}
	function tambah(){
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == FALSE){

			$this->data['pdn_title'] 		= 'Data Users';
			$this->data['pdn_page'] 		= 'Simpan';
			$this->data['pdn_uform'] 		= base_url($this->ClassNama().'/tambah');
			$this->data['pdn_url'] 			= base_url($this->ClassNama());
			$this->data[$this->ClassNama()] = 'active';

			$this->data['nama'] = [
				'name' 			=> 'nama',
				'id' 			=> 'nama',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Nama Lengkap',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('nama'),
			];
			$this->data['email'] = [
				'name' 			=> 'email',
				'id' 			=> 'email',
				'type' 			=> 'email',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Email Address',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('email'),
			];
			$this->data['password1'] = [
				'name' 			=> 'password1',
				'id' 			=> 'password1',
				'type' 			=> 'password',
				'class' 		=> 'form-control form-control-user',
				'placeholder' 	=> 'Password',
				'required' 		=> 'required',
			];
			$this->data['password2'] = [
				'name' 			=> 'password2',
				'id' 			=> 'password2',
				'type' 			=> 'Password',
				'class' 		=> 'form-control form-control-user mt-3',
				'placeholder' 	=> 'Repeat Password',
				'required' 		=> 'required',
			];

			$this->template->load('template/sbadmin','tambah', $this->data);
		}else{
			$pdn_data['nama'] 		= htmlspecialchars($this->input->post('nama', true));
			$pdn_data['email'] 		= htmlspecialchars($this->input->post('email', true));
			$pdn_data['password'] 	= $this->input->post('password1');
			$pdn_data['level'] 		= $this->input->post('level', true);

			// Panggil model yang pakai Guzzle
			$response = $this->M_pdn->simpanUser($pdn_data);

			if ($response->status == 'success'){
				$message = "Data berhasil ditambah!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}else{
				$message = "MAAF, Data tidak berhasil ditambahkan!";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama().'/tambah'), 'refresh');
			}
			// header('Content-Type: application/json');
			// echo json_encode($response);
		}
	}
	
}
