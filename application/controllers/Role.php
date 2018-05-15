<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //list all roles
    public function index()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('role/all_roles',$data);
        $this->load->view('template/footer');
    }

    public function view($role_id)
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('role/view_role',$data);
        $this->load->view('template/footer');
    }

    public function new_role()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('role/new_role',$data);
        $this->load->view('template/footer');
    }

}
