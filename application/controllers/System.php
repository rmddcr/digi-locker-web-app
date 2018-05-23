<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Locker_model');
        $this->load->model('Employee_model');

    }

    //list all lockers
    public function add_plant()
    {
        $data['page_title'] = 'Lockers';
        $this->load->view('template/header',$data);
        $this->load->view('system/add_plant',$data);
        $this->load->view('template/footer',$data);
    }

    public function add_team()
    {
        $data['page_title'] = 'Lockers';
        $this->load->view('template/header',$data);
        $this->load->view('system/add_team',$data);
        $this->load->view('template/footer',$data);
    }

    public function restore()
    {
        $data['page_title'] = 'Lockers';
        $this->load->view('template/header',$data);
        $this->load->view('system/restore_system_csv',$data);
        $this->load->view('template/footer',$data);
    }
}
