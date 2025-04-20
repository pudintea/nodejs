<?php  if ( ! defined('__PUDINTEA__')) exit('No direct script access allowed');
/**
*
* Author:  Pudin S I
* 	pudin.alazhar@gmail.com
*
*/

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Bo_Models extends CI_Model
{
    private $_api_url;
	function __construct(){
		parent::__construct();
		    date_default_timezone_set('Asia/Jakarta');
            $this->_api_url = 'localhost:4000';
	}
	
	/**
     * return _retval
     *
     * @var Boolean
     **/
    private $_retval = NULL;

    /**
     * return _result
     *
     * @var Boolean
     **/
    private $_result = FALSE;

    /**
     * return _retarr
     *
     * @var Array
     **/
    private $_retarr = array();

    function get_auth($email='', $password){
        $client = new Client();
        try {
            $response = $client->request('POST', $this->_api_url.'/bo', [
				'headers' => ['Content-Type' => 'application/json'],
				'json' => [
					'email' => $email,
					'password' => $password
				]
			]);
            $hasil = $response->getBody()->getContents();
        } catch (ClientException $e) {
            $hasil = $e->getResponse()->getBody()->getContents();
        }
		// Hasilnya adalah data json
		return $hasil;
    }
	
	
}
