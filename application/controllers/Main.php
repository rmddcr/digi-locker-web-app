<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
    }

    public function debug()
    {   
        $data['page_title'] = "Title";
        $this->load->view('template/header',$data);
        $this->load->view('template/footer');
    }

    //desktop page
    public function index()


    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user_rest']))
            {
                redirect('password_rest');
            }
            redirect($_SESSION['user']['main_page']);
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
            $password = $this->input->post('pass');
            // Login user
            $loggin_passed = $this->User_model->login($username, $password);
            
            if ($loggin_passed) {
                redirect('Main');
            } else {
                if(isset($_SESSION['user_rest']))
                    redirect('password_rest');
                var_dump('asd');
                $this->session->set_flashdata('error', 'ERROR');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }

    public  function signup()// better if we add some confirm massage
    {
        $this->form_validation->set_rules('email', 'Username', 'required');//$this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

      //  $this->load->view('template/debug',array('data' => $this->form_validation->run(),'name'=> md5($this->input->post('pass'))));
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login/signup');
        } else {
            // Get username
            $username = $this->input->post('email');
            // Get and the password
            $password = $this->input->post('password');
            //generate random salt
            $password_salt = bin2hex(random_bytes(32));
            //geerate password hash
            $password_hash = hash('sha256', $password.$password_salt);
            // Login user
            $loggin_passed = $this->User_model->register($username, $password_hash, $password_salt);

            if ($loggin_passed) {
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'ERROR');
                redirect('signup');//show error massage page telleing siugn up was un success full
            }
        }



    }

    public function password_rest()
    {
        if(isset($_SESSION['user_rest']))
        {
            //$this->form_validation->set_rules('email', 'Username', 'required');//$this->form_validation->set_rules('email','Email','trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run() === FALSE) 
            {
                $this->load->view('login/reset');
            } else 
            {
                // Get username
                $username = $_SESSION['user_rest']['username'];
                // Get and the password
                $password = $this->input->post('password');
                //generate random salt
                $password_salt = bin2hex(random_bytes(32));
                //geerate password hash
                $password_hash = hash('sha256', $password.$password_salt);
                // Login user
                $loggin_passed = $this->User_model->reset_password($username, $password_hash, $password_salt);
                if ($loggin_passed) {
                    session_destroy();
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'ERROR');
                    redirect('password_rest');//show error massage page telleing siugn up was un success full
                }
            }
        } else {

            if(isset($_POST['email']))
            {
                $username = $this->input->post('email');
                   
                $loggin_passed = $this->User_model->request_password_change($username);

                if ($loggin_passed) {
                    echo "<string>Please contact system admin to turn your password reset ON. Then Loginin to the system to set your new password.Thankyou</string>";
                } else {
                    $data['error'] = true;
                    $this->load->view('login/reset_request',$data);
                }
            }else{
                $this->load->view('login/reset_request');
            }
        }
    }
        

}

