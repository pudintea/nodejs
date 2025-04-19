<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Password_models extends CI_Model
{
	function __construct(){
		parent::__construct();
        $this->pudin_dev->pdn_is_login();
	}

    private $nama_tb = 'users';
    private $nama_id = 'id_users';
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
	

    function update($_id='', $update_data='')
    {
        if (empty ($_id)) {
            return false;
        }

        $this->db->where($this->nama_id, $_id);
        $this->_result = $this->db->update($this->nama_tb, $update_data);

        if ($this->_result) {
            return $this->_result;
        }
    }
	
}
// Saepudin Ilham, Application/models/Mymodel.php 

