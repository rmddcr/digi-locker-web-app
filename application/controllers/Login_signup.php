<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_signup extends CI_Controller
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
            $this->load->view('login_signup/login_signup');    
         //   redirect('/Main/login', 'refresh');
        }
    }

    // public function login()
    // {
    //     if(isset($_POST['email']) && isset($_POST['password']))
    //     {
    //         $this->load->model('User_model');
    //         $this->load->model('Role_model');

    //         $user  = $this->User_model->get_user_data($_POST['email']);

    //         if($user !== NULL)
    //         {
    //             if(hash('sha256', $_POST['password'])==$user['password_hash'])
    //             {
    //             	$role_data = $this->Role_model->get_role_acess_data($user['role_id']);
    //             	$_SESSION['user'] = $user;
    //             	$_SESSION['access'] = $role_data['access'];
    //             	$_SESSION['apps'] = $role_data['apps'];
    //             	redirect('/Main', 'refresh');
    //             }
    //         }
    //         $data['error'] = true;
    //     }
    //     if(isset($_POST['clicked'])) $data['error'] = true;
    //     else $data['error'] = false;
    //     $this->load->view('Main/login',$data);
    // }

    public function logout()
    {
        session_destroy();
        redirect('/Main/login', 'refresh');
    }
}
