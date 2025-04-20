<?php defined('__PUDINTEA__') OR exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Users_models extends CI_Model
{
    private $_api_url;
	function __construct(){
		parent::__construct();
		    date_default_timezone_set('Asia/Jakarta');
            $this->pudin_dev->pdn_is_login();
            $this->_api_url = $this->config->item('pdn_api_url');
	}

    function get_auth(){
        $pdn_data_login = $this->input->cookie('pdn_cookie_applogin', TRUE);
        return $pdn_data_login;
    }
	
    function getAllUser(){
		$client = new Client();
		$url = $this->_api_url.'/users';
		try {
			$response = $client->request('GET', $url, [
				'headers' => [
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->get_auth(),
				],
			]);
			// Tampilkan response body
			$hasil = $response->getBody()->getContents();
		} catch (ClientException $e) {
			// Tampilkan pesan error lebih detail
			$hasil = $e->getResponse()->getBody()->getContents();
		}
        // Biar hasilnya array
		return json_decode($hasil);
	}

    function getDatatbles($params){
		$client = new Client();
		$url = $this->_api_url.'/datatables';
		try {
			$response = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->get_auth(),
				],
                'json' => $params,
			]);
			// Tampilkan response body
			$hasil = $response->getBody()->getContents();
		} catch (ClientException $e) {
			// Tampilkan pesan error lebih detail
			$hasil = $e->getResponse()->getBody()->getContents();
		}
        // Biar hasilnya array
		return json_decode($hasil);
	}

	function simpanUser($params){
		$client = new Client();
		$url = $this->_api_url.'/users';
		try {
			$response = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->get_auth(),
				],
                'json' => $params,
			]);
			// Tampilkan response body
			$hasil = $response->getBody()->getContents();
		} catch (ClientException $e) {
			// Tampilkan pesan error lebih detail
			$hasil = $e->getResponse()->getBody()->getContents();
		}
        // Biar hasilnya array
		return json_decode($hasil);
	}

}
// Saepudin Ilham, Application/models/Mymodel.php 

