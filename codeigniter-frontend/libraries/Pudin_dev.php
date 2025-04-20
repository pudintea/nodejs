<?php if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/*
 * ***************************************************************
 *  Script 		: Belajar Codeigniter
 *  Version 	: 3.1.11
 *  Date 		: 01 Maret 2020
 *  Author 		: Pudin Saepudin Ilham Development Ciamis
 *  Email 		: najzmitea@gmail.com
 *  Description : Seorang Petani yang suka dengan teknologi.
 *  Blog 		: https://www.pdn.my.id / https://anibarstudio.blogspot.com.
 *  Github 		: https://github.com/pudintea.
 * ***************************************************************
 */
class Pudin_dev {
	
	// SET SUPER GLOBAL
	protected $CI;
    	protected $cookie_nama;
	public function __construct() {
		$this->CI =& get_instance();
		$this->cookie_nama =  $this->CI->config->item('jwt_cookie_nama');
	}

	function decode_jwt_payload($jwt) {
		$parts = explode('.', $jwt);
		if (count($parts) !== 3) {
			return false;
		}
	
		$payload = $parts[1];
		$decoded = base64_decode(strtr($payload, '-_', '+/'));
		return json_decode($decoded, true);
	}

	public function pdn_is_login()
	{
		$pdn_data_login = $this->CI->input->cookie('pdn_cookie_applogin', TRUE);
		$payload = $this->decode_jwt_payload($pdn_data_login);
		if (!$pdn_data_login) {
			//echo "Anda Harus Logout.";
			redirect(base_url('bo/logout'));
		}
	}

	public function pdn_get_cookie($apa = '')
	{
		$pdn_data_login = $this->CI->input->cookie('pdn_cookie_applogin', TRUE);
		$payload = $this->decode_jwt_payload($pdn_data_login);
		if($pdn_data_login){
			switch ($apa) {
				case 'id':
					return $payload['id'];
				break;
				case 'nama':
						return $payload['nama'];
				break;
				case 'email':
					return $payload['email'];
				break;
				case 'level':
					return $payload['level'];
				break;
				case 'token':
					return $payload['token'];
				break;
				default:
						echo 'error';
			};
		};
	}

	public function clear_all_cookies() {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                delete_cookie($name);
            }
        }
    }
	
	public function pdn_is_admin()
	{
		$pdn_data_login = $this->CI->input->cookie('pdn_cookie_applogin', TRUE);
		$payload = $this->decode_jwt_payload($pdn_data_login);
		
		if($payload['level'] != 'Admin'){
			redirect(base_url('bo/logout'));
		}
	}
	
	public function pdn_is_guest()
	{
		$pdn_data_cookie = $this->CI->input->cookie($this->cookie_nama, TRUE);
		$key = $this->CI->config->item('jwt_key');
		$pdnjwt_decoded = JWT::decode($pdn_data_cookie, new Key($key, 'HS256'));

		$pdn_data 	= $pdnjwt_decoded->data;
		//DATA
		$auth_level = $pdn_data->pdn_level;
		
		if($auth_level != 'Guest'){
			redirect(base_url('bo/logout'));
		}
	}
	
}