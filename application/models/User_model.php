<?php
class User_model extends CI_Model{
    public function register($enc_password){
        // User data array
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
            'zipcode' => $this->input->post('zipcode'),
            'sms_notify' => $this->input->post('sms_notify'),

        );
        // Insert user
        return $this->db->insert('Users', $data);
    }
    // Log user in
    public function login($username, $password){
        // Validate
        $this->db->where('user_name', $username);
        $this->db->where('password_hash', $password);
        $result = $this->db->get('user');


        if($result->num_rows() == 1){
            $user = array('username' => $result->row(0)->user_name, 'privilage_level' => $result->row(0)->role_id);
            $this->session->set_userdata('user',$user);

            return true;

        } else {
            return false;
        }
    }
}
