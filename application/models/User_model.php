<?php
class User_model extends CI_Model{

    function insert_data($data){
        $this->db->insert('student_data',$data);
    }

    function fetch_data(){


        $this->db->order_by("id", "desc");

        $query = $this->db->get('student_data');
        return $query;
    }


    function delete_data($id){


        $this->db->where('id', $id);
        $this->db->delete('student_data');

    }

    function fetch_single_data($id){

        $query=$this->db->query("SELECT * FROM student_data WHERE id=$id");

        return $query;

    }
    function update_data($id,$data){

        $this->db->where('id', $id);
        $this->db->update('student_data', $data);

    }
    function search_data_model($search_data){
        $this->db->select('*');
        $this->db->from('student_data');
        $this->db->like('index_num', $search_data);
        $this->db->or_like('firstname', $search_data);
        $this->db->or_like('lastname', $search_data);
        $this->db->or_like('phone', $search_data);
        $query=$this->db->get();
        return $query;
    }



}
?>