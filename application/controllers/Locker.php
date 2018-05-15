<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //list all lockers
    public function index()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/all_lockers',$data);
        $this->load->view('template/footer');
    }

    public function view($locker_id)
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('locker/view_locker',$data);
        $this->load->view('template/footer');
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
