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

    public  function signup()
    {
        $this->form_validation->set_rules('email', 'Username', 'required');//$this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
       // print_r($this->form_validation->run());
        $this->load->view('template/debug',array('data' => $this->form_validation->run(),'name'=> md5($this->input->post('pass'))));
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login/signup');
        } else {
            $this->load->view('login/login');
            // Get username
            $username = $this->input->post('email');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));
            // Login user
            $loggin_passed = $this->User_model->register($username, $password);
          //  print_r($loggin_passed);

            if ($loggin_passed) {
                redirect('login');
            } else {
                redirect('signup');//show error massage page telleing siugn up was un success full
            }
        }



    }

}

