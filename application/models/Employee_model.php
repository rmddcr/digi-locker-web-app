<?php
class Employee_model extends CI_Model{
    function get_all_plants()
    {
        return $this->db->get('plant')->result();
    }

    function get_all_teams()
    {
        return $this->db->get('team')->result();
    }

    function get_all_shifts()
    {
        return $this->db->get('shift')->result();
    }

    function get_filtered_employees($epf_no, $name, $team, $shift, $plant)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE 1 ';
        if($epf_no != "")
        {
            $query = $query."AND e.epf_no = ".$epf_no." ";
        }
        
        if($name != "")
        {
            $query = $query."AND e.name LIKE '%".addslashes($name)."%' ";
        }

        if($team != "" && $team != "all")
        {
            $query = $query."AND t.id = '".$team."' ";
        }

        if($shift != "" && $shift != "all")
        {
            $query = $query."AND s.id = '".$shift."' ";
        }

        if($plant != "" && $plant != "all")
        {
            $query = $query."AND p.id = '".$plant."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_employees()
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id ';
        $query = $this->db->query($query);
        return $query->result();
    }


    function get_employee_by_id($employee_id)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id  WHERE e.epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_employee_current_locker($employee_id)
    {
        $query = 'SELECT l.id, l.locker_no, l.plant_id as plant_id, p.name as plant, ehl.assigned_by, ehl.assigned_time  FROM locker as l JOIN employee_has_locker as ehl ON l.id = ehl.locker_id JOIN plant as p ON l.plant_id = p.id WHERE ehl.employee_epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    function get_employee_locker_history($employee_id)
    {
        $query = 'SELECT l.id, l.locker_no, l.plant_id as plant_id, p.name as plant, ehlh.assigned_by, ehlh.assigned_time, ehlh.unassigned_by, ehlh.unassigned_time  FROM locker as l JOIN employee_has_locker_history as ehlh ON l.id = ehlh.locker_id JOIN plant as p ON l.plant_id = p.id WHERE ehlh.employee_epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_employees_without_lockers($plant)
    {
        $query = 'SELECT e.has_locker, e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE e.has_locker = FALSE AND p.id ='.$plant;
        $query = $this->db->query($query);
        return $query->result();
    }

    function add_employee($epf_no, $name, $plant_id, $team_id, $shift_id)
    {
        $result['status'] = "failed";
        $result['error'] = "Failed to add employee due to <strong> unknown error </strong>";
        
        $this->db->trans_begin();

        $query = 'SELECT epf_no FROM employee WHERE epf_no = '.addslashes($epf_no);
        $query = $this->db->query($query);
        $employee = $query->row();
        if(isset($employee))
        {
            $result['error'] = "Failed to add employee due to <strong> Employee with EPF number ".$epf_no." already exists</strong>";
            return $result; 
        }

        $query = 'SELECT t.id FROM team as t JOIN plant as p ON t.plant_id = p.id WHERE t.id = '.$team_id.' AND p.id = '.$plant_id;
        $query = $this->db->query($query);
        $plant = $query->row();
        if(!isset($plant))
        {   
            $query = 'SELECT name FROM plant where id = '.$plant_id;
            $query = $this->db->query($query);
            $plant = $query->row();
            $result['error'] = "Failed to add employee due to <strong> Team selected is not in Plant ".$plant->name."</strong>";
            return $result; 
        }

        $query = 'INSERT into employee(epf_no, name, team_id, shift_id) VALUES ('.$epf_no.', "'.addslashes($name).'", '.$team_id.', '.$shift_id.')';
        $query = $this->db->query($query);
        if($query != 1) return $result;



        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $result['error'] = "Failed to add employee due to <strong> Database error </strong>";
                return $result;
        }
        else
        {
                $this->db->trans_commit();
                $result['status'] = "success";
                $result['employee_id'] = $epf_no;
                return $result;
        }

        
    }


}

?>