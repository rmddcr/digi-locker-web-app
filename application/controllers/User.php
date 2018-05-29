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
        $data['page_title'] = 'View all users';
        $data['data_tables'] = array('user_table');
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('template/header',$data);
        $this->load->view('user/all_users',$data);
        $this->load->view('template/footer');
    }

    public function view($user_id)
    {
        $user_id = str_replace('%40','@',$user_id);
        $data['page_title'] = 'View user info';
        $data['result_array'] = $this->User_model->get_specified_user($user_id);

        $this->load->view('template/header',$data);
        $this->load->view('user/view_user',$data);
        $this->load->view('template/footer');
    }

    public function new_user()
    {
        $data['page_title'] = 'Add new user';
        $data['data_tables'] = array('user_table');
        $data['users'] = $this->User_model->get_all_new_users();
        $data['roles'] = $this->Role_model->get_all_roles();
        if(isset($_POST['user']))
        {

        }
        $this->load->view('template/header',$data);
        $this->load->view('user/new_user',$data);
        $this->load->view('template/footer');
    }

    public function authorize_new_user()
    {
        $data['page_title'] = 'Add new user';
        $data['result_array'] = $this->User_model->get_all_new_users();
        $this->load->view('template/header',$data);
        $this->load->view('user/new_user',$data);
        $this->load->view('template/footer');
    }


}
