<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Auth extends CI_Session
{
    var $CI;
    var $_model;

    function __construct()
    {
        parent::__construct();
        $CI = '';
        $CI =& get_instance();
        $this->_model = $CI;
        $this->_model->load->database();
        $this->_model->load->model("user_m");
    }

    function is_Admin()
    {

        $info = $this->_model->user_m->getInfo($this->userdata("id"));

        if ($this->is_Login() && $info['group_id'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function is_Active($id)
    {
        if ($this->_model->user_m->actived($id))
            return TRUE;
        else
            return FALSE;
    }

    function is_Login()
    {

        if ($this->userdata("email") && $this->userdata("email") != ""
            && $this->userdata("id") && $this->userdata("id") != ""
        )
            return TRUE;
        else
            return FALSE;
    }

    function __get($var)
    {
        return $this->userdata($var);

    }


}