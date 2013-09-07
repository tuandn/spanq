<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 02/07/2013
 * Time: 00:07
 * To change this template use File | Settings | File Templates.
 */

class Login_m extends MY_Model{

    public function __construct(){
        parent::__construct();
    }

    public function validate($email, $pass){

        // Prep the query
        $this->db->where('Email', $email);
        $this->db->where('Password', $pass);

        // Run the query
        $query = $this->db->get('users');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'Id' => $row->Id,
                'Name' => $row->Name,
                'Email' => $row->Email,
                'Phone' => $row->Phone,
                'RoleId' => $row->RoleId,
                'GroupId' => $row->GroupId,
                'Password' => $row->Password,
            );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}