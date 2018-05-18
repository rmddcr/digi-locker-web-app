<?php
class Employee_model extends CI_Model{

    function get_filtered_employees($epf_no, $name, $team, $shift_group, $plant, $section)
    {
        $query = 'SELECT e.epf_no, e.name, e.team, e.shift_group, s.name as section, p.name as plant FROM employee as e JOIN section as s ON e.section_id=s.id JOIN plant as p ON s.plant_id=p.id WHERE 1 ';
        if($epf_no != "")
        {
            $query = $query."AND e.epf_no = ".$epf_no." ";
        }
        
        if($name != "")
        {
            $query = $query."AND e.name LIKE '".addslashes($name)."' ";
        }

        if($team != "")
        {
            $query = $query."AND e.team LIKE '".addslashes($team)."' ";
        }

        if($shift_group != "")
        {
            $query = $query."AND e.shift_group LIKE '".addslashes($shift_group)."' ";
        }

        if($plant != "")
        {
            $query = $query."AND p.name LIKE '".addslashes($plant)."' ";
        }

        if($section != "")
        {
            $query = $query."AND s.name LIKE '".addslashes($section)."' ";
        }
        $query = $this->db->query($query);
        return $query->result();
    }

    function get_all_employees()
    {
        $query = 'SELECT e.epf_no, e.name, e.team, e.shift_group, s.name as section, p.name as plant FROM employee as e JOIN section as s ON e.section_id=s.id JOIN plant as p ON s.plant_id=p.id';
        $query = $this->db->query($query);
        return $query->result();
    }

}
?>