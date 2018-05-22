<?php
class Role_model extends CI_Model{


    function get_all_roles()
    {
        $query = 'SELECT * From role';
        $query = $this->db->query($query);
        return $query->result_array();
    }


    // simple insert function ti add data to db
    public function add_employee($epf_no, $name, $team, $shift_group, $section){


        $data = array(
            'epf_no' => $epf_no,
            'name' => $name,
            'team' => $team,
            'shift_group' => $shift_group,
            'section_id' => $section


        );
        // Insert user
        return $this->db->insert('employee', $data);


    }

    public function get_specified_employee($user_id){


        // $query = $this->db->get('user');
        $this->db->select('employee.epf_no , employee.name , employee.team , employee.shift_group ,employee.section_id ,employee_has_locker.locker_locker_no' );
        $this->db->from('employee');
        $this->db->join('employee_has_locker' , 'employee.epf_no = employee_has_locker.employee_epf_no', 'left');
        $this->db->where('employee.epf_no', $user_id);
        $query = $this->db->get();
        return $query->result_array();

    }
    /**
    GET
    EMPLOYEE DETAILS
    EMPLOYEE CURRENT LOCKER DETAILS
    EMPLOYEE LOCKER HOSTORY DETAILS
    USING SEPERATE FUNCTIONS
     **/

    public function get_employee_by_id($employee_id)
    {
        $query = 'SELECT * From employee WHERE employee.epf_no = "'.addslashes($employee_id).'"';
        $query = $this->db->query($query);
        return $query->result();
    }

    public function get_employee_current_locker()
    {

    }

    public function get_employee_locker_history()
    {




    }
}

?>