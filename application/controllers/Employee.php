<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
    }

    //list all employees
    public function index()
    {
        $data['page_title'] = 'Employees';
        $data['data_tables'] = array('employee_table');
        $data['plants'] = $this->Employee_model->get_all_plants();
        $data['teams'] = $this->Employee_model->get_all_teams();
        $data['shifts'] = $this->Employee_model->get_all_shifts();
        if(isset($_GET['filter_results']))
        {
            $data['employees'] = $this->Employee_model->get_filtered_employees($_GET['epf_no'], $_GET['name'], $_GET['team'], $_GET['shift'], $_GET['plant']);
            $data['filters'] = $_GET;

        } else 
        {
            $data['employees'] = $this->Employee_model->get_all_employees();
        }
        
        $this->load->view('template/header',$data);
        $this->load->view('employee/all_employees',$data);
        $this->load->view('template/footer',$data);
    }


    //view employee details
    public function view($employee_id)
    {
        $data['page_title'] = 'View Employee Details';
        $data['data_tables'] = array('lockers_histroy_table');
        $data['employee'] = $this->Employee_model->get_employee_by_id($employee_id);
        $data['locker'] = $this->Employee_model->get_employee_current_locker($employee_id);
        $data['locker_history'] = $this->Employee_model->get_employee_locker_history($employee_id);
        $data['debug'] = $data['locker'];
        //$data['debug'] = $data['locker_history'];
        $this->load->view('template/header',$data);
        $this->load->view('employee/view_employee',$data);
        $this->load->view('template/footer');
    }
    //add new employee to the system
    public function new_employee()
    {
        $this->form_validation->set_rules('epf_no', 'Employee Number', 'required');
        $this->form_validation->set_rules('name', 'Employee Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['page_title'] = 'Add employee';
            $data['results_array']=$this->form_validation->run() === TRUE ;
            $this->load->view('template/header',$data);
            $this->load->view('employee/new_employee_one',$data);
            $this->load->view('template/footer');

        }else{
            $this->Employee_model->add_employee($_POST['epf_no'], $_POST['name'], $_POST['team'], $_POST['shift_group'], $_POST['section_id']);

                redirect("Employee/view/".$_POST['epf_no']);
            }
    }

    public function assign_locker($employee_id)
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('employee/assign_locker',$data);
        $this->load->view('template/footer');
    }

    //remive employee as a list
    public function remove_employee_csv()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('employee/remove_employee_csv',$data);
        $this->load->view('template/footer');
    }

}
