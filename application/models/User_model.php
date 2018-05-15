<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model
{

    public function __construct()
    {

    }

    public function set_user_data()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'role_id' => $this->input->post('role_id')
        );
        $this->db->insert('user', $data);
    }
}




