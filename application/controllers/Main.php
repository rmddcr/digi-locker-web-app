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
            // $data['page'] = array('header'=>'Apps', 'description'=>'apps accessible for you','app_name'=>'');
            // $data['user'] = $_SESSION['user'];
            // $data['apps'] = $_SESSION['apps'];
            // $data['access'] = $_SESSION['access'];
            // $this->load->view('template/header',$data);
            // $this->load->view('Main/Desktop', $data);
            // $this->load->view('template/footer');
        }
        else
        {
            $data['page_title'] = "Title";
            $username = $this->input->post('email');
            $password = md5($this->input->post('pass'));

            $user_data = array(

                'username' => $username,
                'password' => $password
            );
            $this->session->set_userdata($user_data);


            $this->load->view('template/header',$data);
            $this->load->view('template/footer');
         //   redirect('/Main/login', 'refresh');
        }
    }



    public function login2()

    {


        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $privilages = get_privilage_array($this->session->userdata('privilage_level'));

            $this->load->view('login/login');

        } else {

            // Get username
            $username = $this->input->post('email');
            // Get and encrypt the password
            $password = md5($this->input->post('pass'));
            // Login user
            $user_id = $this->User_model->login($username, $password);
            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                // Set message

                redirect('Main');
            } else {
                // Set message

                redirect('Main/login2');
            }
        }
    }


    public  function login(){


        $this->load->view('login/login');

    }


}

