<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //list all users
    public function index()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('user/all_users',$data);
        $this->load->view('template/footer');
    }

    public function view($user_id)
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('user/view_user',$data);
        $this->load->view('template/footer');
    }

    public function new_user()
    {
        $data['page_title'] = 'Title';
        $this->load->view('template/header',$data);
        $this->load->view('user/new_user',$data);
        $this->load->view('template/footer');
    }

}
