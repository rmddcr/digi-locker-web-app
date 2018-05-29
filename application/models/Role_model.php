<?php
class Role_model extends CI_Model{


    function get_all_roles()
    {
        $this->db->where(array('show'=>1));
        $query = $this->db->get('role');
        return $query->result_array();
    }

}

?>