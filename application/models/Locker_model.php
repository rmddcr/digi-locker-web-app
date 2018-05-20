<?php
class Locker_model extends CI_Model{

    function get_filtered_lockers($status, $locker_no, $section)
    {
        $query = 'SELECT l.locker_no, l.status, s.name as section FROM locker AS l JOIN section AS s ON l.section_id = s.id WHERE 1 ';
        if($status != "" AND $status != "all")
        {
            $query = $query."AND l.status = '".addslashes($status)."' ";
        }
        
        if($locker_no != "")
        {
            $query = $query."AND l.locker_no = ".$locker_no." ";
        }
        if($section != "")
        {
            $query = $query."AND s.name LIKE '".addslashes($section)."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_lockers()
    {
        $query = 'SELECT l.locker_no, l.status, s.name as section FROM locker AS l JOIN section AS s ON l.section_id = s.id';
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_locker_owner($locker_id)
    {
        $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_id = '.$locker_id;
        $query = $this->db->query($query);
        return $query->result();
    }
}

?>