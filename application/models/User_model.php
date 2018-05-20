<?php
class User_model extends CI_Model{

    public function get_all_users(){


       // $query = $this->db->get('user');
        $this->db->select('user.user_name ,role.role_name');
        $this->db->from('user');
        $this->db->join('role' , 'user.role_id = role.id');
        $query = $this->db->get();
        return $query->result_array();

    }



    public function register($username,$password){
        // User data array
        $data = array(
            'user_name' => $username,
            'password_hash' => $password,
            'role_id' => '0'


        );
        // Insert user
        return $this->db->insert('user', $data);
    }
    // Log user in
    public function login($username, $password){
        // Validate
        $this->db->where('user_name', $username);
        $this->db->where('password_hash', $password);
        $result = $this->db->get('user');


        if($result->num_rows() == 1){
            $user = array(
                'username' => $result->row(0)->user_name,
                'privilage_level' => $result->row(0)->role_id
            );

            $this->session->set_userdata('user',$user);

            return true;

        } else {
            return false;
        }
    }
}
