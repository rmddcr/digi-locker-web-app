<?php
class User_model extends CI_Model{


    public function get_specified_user($user_id){


        // $query = $this->db->get('user');
        $this->db->select('user.user_name ,role.role_name, user.request_password_reset, user.password_reset');
        $this->db->from('user');
        $this->db->join('role' , 'user.role_id = role.id');
        $this->db->where(array('user.user_name'=>$user_id, 'user.active'=>1));
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_all_users(){


       // $query = $this->db->get('user');
        $this->db->select('user.user_name ,role.role_name, user.password_reset, user.request_password_reset');
        $this->db->where('user.active',1);
        $this->db->from('user');
        $this->db->join('role' , 'user.role_id = role.id');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_all_new_users(){


        // $query = $this->db->get('user');
        $this->db->select('user.user_name ,role.role_name');
        $this->db->from('user');
        $this->db->join('role' , 'user.role_id = role.id');
        $this->db->where(array('user.role_id'=>'0','user.active'=>'1'));
        $query = $this->db->get();
        return $query->result_array();

    }

    public function delete_user($user_id)
    {
        $query = 'UPDATE user SET active = 0 WHERE user_name = "'.addslashes($user_id).'"';
        $query = $this->db->query($query);
        if(!$query) return false;

        return true;
    }

    public function update_user_role($user_id, $role_id)
    {
        $query = 'UPDATE user SET role_id = '.$role_id.' WHERE user_name = "'.addslashes($user_id).'"';
        $query = $this->db->query($query);
        if(!$query) return false;

        return true;
    }

    public function set_password_reset_on($user_id)
    {
        $query = 'UPDATE user SET password_reset = 1 WHERE user_name = "'.addslashes($user_id).'"';
        $query = $this->db->query($query);
        if(!$query) return false;

        return true;
    }

    public function request_password_change($user_id)
    {
        $query = 'SELECT user_name FROM user WHERE user_name = "'.addslashes($user_id).'"';
        $query = $this->db->query($query);
        $query = $query->row();

        if(isset($query))
        {
            $query = 'UPDATE user SET request_password_reset = 1 WHERE user_name = "'.addslashes($user_id).'"';
            $query = $this->db->query($query);
            if(!$query) return false;

            return true;
        }

        return false;
        
    }

    public function reset_password($username, $password_hash, $password_salt)
    {
        $data = array(
            'password_hash' => $password_hash,
            'password_salt'  => $password_salt,
            'request_password_reset'  => 0,
            'password_reset' => 0,
            'user_name' => $username
        );

        $query = $this->db->replace('user', $data);
        if(!$query) return false;

        return true;
    }


    public function register($username, $password_hash, $password_salt){
        // User data array
        $data = array(
            'user_name' => $username,
            'password_hash' => $password_hash,
            'password_salt' => $password_salt,
            'role_id' => '0'
        );
        // Insert user
        return $this->db->insert('user', $data);
    }
    // Log user in
    public function login($username, $password){
        // Validate
        $this->db->where(array('user_name'=>$username,'active'=>1));
        $result = $this->db->get('user');

        if($result->num_rows() == 1){
            if($result->row(0)->password_reset == '1')
            {
                $user = array(
                    'username' => $result->row(0)->user_name,
                    'password_reset' => true
                    );

                $this->session->set_userdata('user_rest',$user);
                return false;
            }

            $password_salt = $result->row(0)->password_salt;
            $password_hash_now = hash('sha256', $password.$password_salt);

            //check password matches
            if($password_hash_now != $result->row(0)->password_hash)
                return false;

            //get main page of user
            $this->db->where('id', $result->row(0)->role_id);
            $main_page = $this->db->get('role');

            //set all to user data
            $user = array(
                'username' => $result->row(0)->user_name,
                'privilage_level' => $result->row(0)->role_id,
                'access' => $this->get_access($result->row(0)->role_id),
                'main_page' => $main_page->row()->main_page,
            );

            $this->session->set_userdata('user',$user);

            return true;

        } else {
            return false;
        }
    }

    public function get_access($role_id)
    {
        $this->db->where('role_id', $role_id);
        $access = $this->db->get('access');

        $access = $access->result();

        $ret = array();
        foreach ($access as $a) {
            $ret[$a->object] = true;
        }
        return $ret;
    }
}
