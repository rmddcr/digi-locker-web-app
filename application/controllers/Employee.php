<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->model('Locker_model');
    }

    //list all employees
    public function index()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_employee']) || $_SESSION['user']['privilage_level'] == '1')
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
            else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }


    //view employee details
    public function view($employee_id)
    {

        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['data_tables'] = array('lockers_histroy_table');
                $data['employee'] = $this->Employee_model->get_employee_by_id($employee_id);
                $data['locker'] = $this->Employee_model->get_employee_current_locker($employee_id);
                $data['locker_history'] = $this->Employee_model->get_employee_locker_history($employee_id);
                $data['page_title'] = 'Employee : <strong>'.$data['employee']->name.'</strong>';
                $this->load->view('template/header',$data);
                $this->load->view('employee/view_employee',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }
    //add new employee to the system
    public function new_employee()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['new_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['shifts'] = $this->Employee_model->get_all_shifts();
                $data['teams'] = $this->Employee_model->get_all_teams();
                $data['plants'] = $this->Employee_model->get_all_plants();
                $data['page_title'] = 'Add Employee';
                if(isset($_POST['new_employee']))
                {
                    $result = $this->Employee_model->add_employee($_POST['epf_no'], $_POST['name'], $_POST['plant'], $_POST['team'], $_POST['shift']);
                    if($result['status'] == 'success')
                    {
                        $data['success'] = "Successfully added employee";
                        redirect('Employee/assign_locker/'.$result['employee_id']);

                    } else {
                        $data['error'] = $result['error'];
                    }
                }
                $this->load->view('template/header',$data);
                $this->load->view('employee/new_employee_one',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    public function assign_locker($employee_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['employee'] = $this->Employee_model->get_employee_by_id($employee_id);
                //$data['page_title'] = 'Assigne Locker to <strong>'.$data['employee']->name.'</strong> EPF no : <strong>'.$data['employee']->epf_no.'</strong> Plant : <strong>'.$data['employee']->plant.'</strong> Shift : <strong>'.$data['employee']->shift.'</strong> Team : <strong>'.$data['employee']->team.'</strong>';
                $data['page_title'] = 'Assigne Locker to <strong>'.$data['employee']->name.'</strong>';
                if($data['employee']->has_locker == 1)
                {
                    redirect('Employee/view/'.$employee_id );
                }

                if(isset($_POST['locker_id']))
                {
                    $result = $this->Locker_model->change_locker_state("assign", $_POST['locker_id'], $_SESSION['user']['username'], $employee_id);
                    if($result == true)
                    {
                        redirect('Employee/view/'.$employee_id );
                    } else {
                        $data['error'] = "Unable to assigne locker : <strong>".$_POST['locker_id']."</strong> to Employee with EPF no : <strong>".$employee_id."</strong>";
                    }
                }

                $data['lockers'] = $this->Locker_model->get_filtered_lockers("free", "", $data['employee']->plant_id);
                $data['data_tables'] = array('locker_table');
                //$data['debug'] = $data['employee'];
                $this->load->view('template/header',$data);
                $this->load->view('employee/assign_locker',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    public function edit($employee_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['edit_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {

            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    public function delete($employee_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['remove_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {

            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    //remive employee as a list
    public function remove_employee_csv()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['remove_employee']) || $_SESSION['user']['privilage_level'] == '1')
            {
                if(isset($_POST['remove_employees']))
                {
                    $data['data_tables'] = array('deleted');
                    $result = $this->Employee_model->remove_employees_csv("cvs_file_remove_emp");
                    if($result['status'] == 'failed' || !isset($result['end']))
                        $data['error'] = $result['error'];
                    else
                        $data['success'] = "Successfully removed employees";
                    
                    if($result['errors'] > 0){
                        $data['warning'] = "There were <strong>".$result['errors']."</strong> formatting errors in the CVS file";
                        array_push($data['data_tables'], 'warnings');
                    }
                    $data['warrnings'] = $result['error_rows'];
                    $data['warrning_count'] = $result['errors'];
                    $data['inserted_rows'] = $result['entered_rows'];
                    $data['read_rows'] = $result['row'];
                    $data['deleted'] = $result['deleted'];
                }
                $data['page_title'] = 'Title';
                $this->load->view('template/header',$data);
                $this->load->view('employee/remove_employee_csv',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

}
