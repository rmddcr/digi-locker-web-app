<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Locker_model');
        $this->load->model('Employee_model');

    }

    //list all lockers
    public function index()
    {
        $data['page_title'] = 'Lockers';
        $data['data_tables'] = array('locker_table');
        $data['sections'] = $this->Locker_model->get_all_sections();
        if(isset($_GET['filter_results']))
        {
            $data['lockers'] = $this->Locker_model->get_filtered_lockers($_GET['status'], $_GET['locker_no'], $_GET['section']);
            $data['filters'] = $_GET;

        } else 
        {
            $data['lockers'] = $this->Locker_model->get_all_lockers();
        }
        
        $this->load->view('template/header',$data);
        $this->load->view('locker/all_lockers',$data);
        $this->load->view('template/footer',$data);
    }

    public function view($locker_id)
    {
        
        $data['locker'] = $this->Locker_model->get_locker_by_id($locker_id);
        $data['owner'] = $this->Locker_model->get_locker_owner($locker_id);
        $data['owner_history'] = $this->Locker_model->get_locker_owner_history($locker_id);
        $data['page_title'] = 'Locker : '.$locker_id.' - '.$data['locker']->section;
        $data['data_tables'] = array('owner_history_table');
        if(isset($_POST['state']))
        {
            $result = $this->Locker_model->change_locker_state($_POST['state'], $locker_id, $_SESSION['user']['username']);
            if($result == true)
            {
                $data['success'] = "Successfully changed the locker status";
                redirect('Locker/view/'.$locker_id );

            } else {
                $data['error'] = "Failed to change the locker status";
            }
        }

        $this->load->view('template/header',$data);
        $this->load->view('locker/view_locker',$data);
        $this->load->view('template/footer',$data);
    }

    public function assign($locker_id)
    {
        $data['locker'] = $this->Locker_model->get_locker_by_id($locker_id);
        if($data['locker']->status == "in_use")
        {
            redirect('Locker/view/'.$locker_id );
        }
        $data['page_title'] = 'Assign employee to locker : '.$locker_id.' - '.$data['locker']->section;
        $data['data_tables'] = array('employee_table');
        $data['employees'] = $this->Employee_model->get_filtered_employees("", "", "", "", $data['locker']->section);
        $data['sections'] = $this->Locker_model->get_all_sections();
        if(isset($_POST['employee_id']))
        {
            $result = $this->Locker_model->change_locker_state("assign", $locker_id, $_SESSION['user']['username'], $_POST['employee_id']);
            if($result == true)
            {
                redirect('Locker/view/'.$locker_id );
            } else {
                $data['error'] = "Unable to assigne locker : <strong>".$locker_id."</strong> to Employee with EPF no : <strong>".$_POST['employee_id']."</strong>";
            }
        }
        else if(isset($_POST['new_employee'])){
            $result = $this->Locker_model->add_new_employee_and_assign_locker($locker_id, $_SESSION['user']['username'], $_POST['epf_no'], $_POST['name'], $_POST['team'], $_POST['shift'], $_POST['section']);
            if($result == true)
            {
                redirect('Locker/view/'.$locker_id );
            } else {
                $data['error'] = "Unable to assigne locker : <strong>".$locker_id."</strong> to New Employee";
            }
        }
        $this->load->view('template/header',$data);
        $this->load->view('locker/set_owner',$data);
        $this->load->view('template/footer',$data);
    }

    public function new_locker()
    {
        $data['page_title'] = 'Add New Locker';
        $data['sections'] = $this->Locker_model->get_all_sections();
        if(isset($_POST['new_locker']))
        {
            $result = $this->Locker_model->add_new_locker($_POST['locker_no'], $_POST['section']);
            if($result == true)
            {
                $data['success'] = 'Successfully added new locker <strong>'.$_POST['locker_no'].'<strong>';
            } else {
                $data['error'] = 'Falied to add new locker : <strong>'.$_POST['locker_no'].'</strong>';

            }
        }
        $data['debug'] = $_SESSION;
        $this->load->view('template/header', $data);
        $this->load->view('locker/new_locker_one', $data);
        $this->load->view('template/footer');
    }

    public function remove_locker_list()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/remove_locker_list',$data);
        $this->load->view('template/footer');
    }
}
