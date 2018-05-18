<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
    }

    //desktop page
    public function index()


    {
        if(isset($_SESSION['user']))
        {
            $data['page_title'] = "Title";
            $this->load->view('template/header',$data);
            $this->load->view('template/debug',array('data' => $_SESSION['user']));
            $this->load->view('template/footer');
        }
        else
        {
            
            redirect('login');
        }
    }



    public function login()

    {


        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login/login');
        } else {

            // Get username
            $username = $this->input->post('email');
            // Get and encrypt the password
            $password = md5($this->input->post('pass'));
            // Login user
            $loggin_passed = $this->User_model->login($username, $password);
            
            if ($loggin_passed) {
                redirect('Main');
            } else {
                redirect('login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }

}

