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
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE 1 ';
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
            $query = $query."AND t.id = '".addslashes($team)."' ";
        }

        if($shift != "" && $shift != "all")
        {
            $query = $query."AND s.id = '".addslashes($shift)."' ";
        }

        if($plant != "" && $plant != "all")
        {
            $query = $query."AND p.id = '".addslashes($plant)."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_employees()
    {
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id ';
        $query = $this->db->query($query);
        return $query->result();
    }


    public function get_employee_by_id($employee_id)
    {
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id  WHERE e.epf_no = '.$employee_id;
        $query = $this->db->query($query);
        return $query->row();
    }

    public function get_employee_current_locker()
    {

    }

    public function get_employee_locker_history()
    {

    }

    function get_employees_without_lockers($plant)
    {
        $query = 'SELECT e.epf_no, e.name, t.name as team, s.name as shift, p.name as plant, p.id as plant_id FROM employee as e JOIN shift as s ON e.shift_id = s.id JOIN team as t ON e.team_id = t.id JOIN plant as p ON t.plant_id = p.id WHERE NOT EXISTS (SELECT * FROM employee_has_locker as ehl WHERE ehl.employee_epf_no = e.epf_no) AND p.id ='.$plant;
        $query = $this->db->query($query);
        return $query->result();
    }
}

?>