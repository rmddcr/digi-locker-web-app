<?php
class Locker_model extends CI_Model{

    public function get_all_plants(){
        return $this->db->get('plant')->result();
    }

    function get_filtered_lockers($status, $locker_no, $plant)
    {
        $query = 'SELECT l.id ,l.locker_no, l.status ,p.name as plant FROM locker AS l JOIN plant AS p ON l.plant_id = p.id WHERE 1 ';
        if($status != "" AND $status != "all")
        {
            $query = $query."AND l.status = '".addslashes($status)."' ";
        }
        
        if($locker_no != "")
        {
            $query = $query."AND l.locker_no = ".$locker_no." ";
        }
        if($plant != "" AND $plant != "all")
        {
            $query = $query."AND p.id = '".addslashes($plant)."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_lockers()
    {
        $query = 'SELECT l.id, l.locker_no, l.status, p.name as plant FROM locker AS l JOIN plant AS p ON l.plant_id = p.id';
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_locker_owner($locker_id)
    {
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, ehl.assigned_time, ehl.assigned_by FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no JOIN shift as s ON e.shift_id=s.id JOIN team as t ON e.team_id=t.id JOIN plant as p ON t.plant_id=p.id  WHERE ehl.locker_id = '.$locker_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_locker_owner_history($locker_id)
    {
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, ehlh.assigned_time, ehlh.assigned_by, ehlh.unassigned_time, ehlh.unassigned_by FROM employee as e JOIN employee_has_locker_history as ehlh ON e.epf_no = ehlh.employee_epf_no JOIN shift as s ON e.shift_id=s.id JOIN team as t ON e.team_id=t.id JOIN plant as p ON t.plant_id=p.id WHERE ehlh.locker_id = '.$locker_id;
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_locker_by_id($locker_id)
    {
        $query = 'SELECT l.id, l.locker_no, l.status, l.status_changed_by, l.status_changed_time, l.comment, p.name as plant, p.id as plant_id FROM locker as l JOIN plant as p ON l.plant_id = p.id WHERE l.id = '.$locker_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function change_locker_state($state, $locker_id, $user, $employee_id=NULL)
    {
        $this->db->trans_begin();
        if($state == 'fix' || $state == 'unlock')
        {//set free // if previous show otherwise no 
            $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_id = '.$locker_id;
            $query = $this->db->query($query);
            $owner = $query->row();
            if(isset($owner))
            {
                $query = 'UPDATE locker SET status = "in_use", status_changed_time= "'.date('Y-m-d H:i:s',time()).'",status_changed_by = "'.$user.'" WHERE id = '.$locker_id;
                $query = $this->db->query($query);
                if(!$query) return false;

            } else {
                $query = 'UPDATE locker SET status = "free", status_changed_time= "'.date('Y-m-d H:i:s',time()).'",status_changed_by = "'.$user.'" WHERE id = '.$locker_id;
                $query = $this->db->query($query);
                if(!$query) return false;
            }

        }else if($state == 'broken' || $state == 'locked'){//set state
            //here employee_id parameter is used as comment dont confuse 
            $query = 'UPDATE locker SET status = "'.$state.'", status_changed_time= "'.date('Y-m-d H:i:s',time()).'",status_changed_by = "'.$user.'", comment = "'.addslashes($employee_id).'" WHERE id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) return false;
        
        }else if($state == 'unassign'){
            
            $query = 'SELECT * FROM employee as e JOIN employee_has_locker as ehl ON e.epf_no = ehl.employee_epf_no WHERE ehl.locker_id = '.$locker_id;
            $query = $this->db->query($query);
            $owner = $query->row();
            
            $query1 = 'INSERT INTO employee_has_locker_history(employee_epf_no,locker_id,assigned_time,assigned_by,unassigned_by) VALUES ('.$owner->employee_epf_no.' ,'.$locker_id.', "'.$owner->assigned_time.'","'.$owner->assigned_by.'","'.$user.'")';
            $query1 = $this->db->query($query1);
            if($query1 != 1) return false;

            $query = 'UPDATE employee SET has_locker = FALSE WHERE epf_no = '.$owner->employee_epf_no;
            $query = $this->db->query($query);
            if(!$query) return false;

            $query = 'DELETE FROM employee_has_locker WHERE locker_id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) return false;

            $query = 'UPDATE locker SET status = "free", status_changed_time= "'.date('Y-m-d H:i:s',time()).'",status_changed_by = "'.$user.'" WHERE id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) return false;
        
        }else if($state == 'assign' && $employee_id != NULL){
            
            $query = 'INSERT INTO employee_has_locker(employee_epf_no,locker_id,assigned_by) VALUES ('.$employee_id.' ,'.$locker_id.', "'.$user.'")';
            $query = $this->db->query($query);
            if($query != 1) return false;

            $query = 'UPDATE employee SET has_locker = TRUE WHERE epf_no = '.$employee_id;
            $query = $this->db->query($query);
            if(!$query) return false;
            
            $query = 'UPDATE locker SET status = "in_use", status_changed_time= "'.date('Y-m-d H:i:s',time()).'",status_changed_by = "'.$user.'" WHERE id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) return false;

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

    function add_new_locker($locker_no, $plant, $user)
    {
        $query = 'INSERT into locker(locker_no, plant_id, status_changed_by) VALUES ('.$locker_no.', '.$plant.', "'.$user.'")';
        $query = $this->db->query($query);
        if($query != 1) return false;

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

    function remove_locker($locker_id)
    {
        $this->db->trans_begin();
        $query = 'DELETE FROM employee_has_locker_history WHERE locker_id = '.$locker_id;
        $query = $this->db->query($query);

        $query = 'SELECT employee_epf_no FROM employee_has_locker WHERE locker_id = '.$locker_id;
        $query = $this->db->query($query);
        $owner = $query->row();

        if(isset($owner))
        {
            $query = 'DELETE FROM employee_has_locker WHERE locker_id = '.$locker_id;
            $query = $this->db->query($query);
            if(!$query) return false;

            $query = 'UPDATE employee SET has_locker = FALSE WHERE epf_no = '.$owner->employee_epf_no;
            $query = $this->db->query($query);
            if(!$query) return false;
        }

        $query = 'DELETE FROM locker WHERE id = '.$locker_id;
        $query = $this->db->query($query);
        if(!$query) return false;



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
}

?>