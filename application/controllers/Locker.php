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
        if(isset($_POST['status']))
        {
            $data['debug'] = "s";
            $result = $this->Locker_model->change_locker_state($_POST['state'],$locker_id);
            if($result == true)
            {
                $data['success'] = "Successfully changed the locker status";
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
        $data['page_title'] = 'Assign employee to locker : '.$locker_id.' - '.$data['locker']->section;
        $data['data_tables'] = array('employee_table');
        $data['employees'] = $this->Employee_model->get_filtered_employees("", "", "", "", $data['locker']->section);
        $this->load->view('template/header',$data);
        $this->load->view('locker/set_owner',$data);
        $this->load->view('template/footer',$data);
    }

    public function new_locker()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/new_locker_one',$data);
        $this->load->view('template/footer');
    }

    public function new_locker_bulck()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/new_locker_bulck',$data);
        $this->load->view('template/footer');
    }

    public function remove_locker_list()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/remove_locker_list',$data);
        $this->load->view('template/footer');
    }

    public function remove_locker_csv()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/remove_locker_csv',$data);
        $this->load->view('template/footer');
    }

}
