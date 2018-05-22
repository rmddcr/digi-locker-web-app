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
        $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_locker_no = '.$locker_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_locker_owner_history($locker_id)
    {
        $query = 'SELECT * FROM employee as e JOIN employee_has_locker_history as ehlh ON e.epf_no = ehlh.employee_epf_no WHERE ehlh.locker_locker_no = '.$locker_id;
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_locker_by_id($locker_id)
    {
        $query = 'SELECT l.locker_no, l.status, s.name as section FROM locker as l JOIN section as s ON l.section_id = s.id WHERE l.locker_no = '.$locker_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function change_locker_state($state, $locker_id, $employee_id=NULL)
    {
        $this->db->trans_begin();
        if($state == 'fix' || $state == 'unlock')
        {//set free // if previous show otherwise no 
            $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_locker_no = '.$locker_id;
            $query = $this->db->query($query);
            $owner = $query->row();
            if(isset($owner))
            {
                $query = 'UPDATE locker SET status = "in_use" WHERE locker_no = '.$locker_id;
                $query = $this->db->query($query);
                if($query->num_rows() != 1) return false;

            } else {
                $query = 'UPDATE locker SET status = "free" WHERE locker_no = '.$locker_id;
                $query = $this->db->query($query);
                if($query->num_rows() != 1) return false;
            }

        }else if($state == 'broken' || $state == 'locked'){//set state
            $query = 'UPDATE locker SET status = "'.$state.'" WHERE locker_no = '.$locker_id;
            $this->db->query($query);
            if($query->num_rows() != 1) return false;
        
        }else if($state == 'unassign'){
            $user = $_SESSION['user']['username'];
            
            $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_locker_no = '.$locker_id;
            $query = $this->db->query($query);
            $owner = $query->row();
            
            $query1 = 'INSERT INTO employee_has_locker_history(employee_epf_no,locker_locker_no,assigned_time,assigned_by,unassigned_by) VALUES ('.$employee_id.' ,'.$locker_id.', '.$owner->assigned_time.',"'.$owner->assigned_by.'","'.$user.'")';
            $this->db->query($query1);
            if($query1->num_rows() != 1) return false;

            $query = 'DELETE FROM employee_has_locker WHERE locker_locker_no = '.$locker_id;
            $this->db->query($query);
            if($query->num_rows() != 1) return false;

            $query = 'UPDATE locker SET status = "free" WHERE locker_no = '.$locker_id;
            $query = $this->db->query($query);
            if($query->num_rows() != 1) return false;
        
        }else if($state == 'assign' && $employee_id != NULL){
            $use = $_SESSION['user']['username'];
            
            $query = 'INSERT INTO employee_has_locker(employee_epf_no,locker_locker_no,assigned_by) VALUES ('.$employee_id.' ,'.$locker_id.', "'.$user.'")';
            $this->db->query($query);
            if($query->num_rows() != 1) return false;
            
            $query = 'UPDATE locker SET status = "in_use" WHERE locker_no = '.$locker_id;
            $query = $this->db->query($query);
            if($query->num_rows() != 1) return false;

        }else{
            return false;
        }


        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function add_locker($locker_no, $plant, $section_id){
        // User data array
        $data = array(
            'locker_no' => $locker_no,
            'section_id' => $section_id,
            'status' => 'free'


        );
        // Insert user
        return $this->db->insert('locker', $data);
    }
}

?>