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
        if(isset($_GET['filter_results']))
        {
            $data['employees'] = $this->Employee_model->get_filtered_employees($_GET['epf_no'], $_GET['name'], $_GET['team'], $_GET['shift_group'], $_GET['plant'], $_GET['section']);
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
        $data['page_title'] = 'Title';
        $data['result_array']=$this->Employee_model->get_specified_employee($employee_id);
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
            $data['page_title'] = $this->form_validation->run()===FALSE;
            $this->load->view('template/header',$data);
            $this->load->view('employee/new_employee_one');
            $this->load->view('template/footer');

        }else{
            $this->Employee_model->add_employee($_GET['epf_no'], $_GET['name'], $_GET['team'], $_GET['shift_group'], $_GET['plant'], $_GET['section']);

            $is_success=


                redirect('login');
            }
        }






    public function new_employee_bulck()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('employee/new_employee_bulck',$data);
        $this->load->view('template/footer');
    }

    public function remove_employee_list()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('employee/remove_employee_list',$data);
        $this->load->view('template/footer');
    }

    public function remove_employee_csv()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('employee/remove_employee_csv',$data);
        $this->load->view('template/footer');
    }

}
