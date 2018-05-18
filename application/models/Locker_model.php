<?php
class Locker_model extends CI_Model{

    function get_filtered_lockers($status, $locker_no, $plant, $section)
    {
        $query = 'SELECT l.id, l.locker_no, l.status, s.name as section , p.name as plant FROM locker AS l JOIN section AS s ON l.section_id = s.id JOIN plant as p ON s.plant_id = p.id WHERE 1 ';
        if($status != "" AND $status != "all")
        {
            $query = $query."AND l.status = '".addslashes($status)."' ";
        }
        
        if($locker_no != "")
        {
            $query = $query."AND l.locker_no = ".$locker_no." ";
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

    function get_all_lockers()
    {
        $query = 'SELECT l.id, l.locker_no, l.status, s.name as section , p.name as plant FROM locker AS l JOIN section AS s ON l.section_id = s.id JOIN plant as p ON s.plant_id = p.id ';
        $query = $this->db->query($query);
        return $query->result();
    }


    // function delete_data($id){


    //     $this->db->where('id', $id);
    //     $this->db->delete('student_data');

    // }

    // function fetch_single_data($id){

    //     $query=$this->db->query("SELECT * FROM student_data WHERE id=$id");

    //     return $query;

    // }
    // function update_data($id,$data){

    //     $this->db->where('id', $id);
    //     $this->db->update('student_data', $data);

    // }
    // function search_data_model($search_data){
    //     $this->db->select('*');
    //     $this->db->from('student_data');
    //     $this->db->like('index_num', $search_data);
    //     $this->db->or_like('firstname', $search_data);
    //     $this->db->or_like('lastname', $search_data);
    //     $this->db->or_like('phone', $search_data);
    //     $query=$this->db->get();
    //     return $query;
    // }



}
?>