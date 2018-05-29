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
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['users']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['page_title'] = 'View all users';
                $data['data_tables'] = array('user_table');
                $data['users'] = $this->User_model->get_all_users();
                $this->load->view('template/header',$data);
                $this->load->view('user/all_users',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    public function view($user_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['users']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $user_id = str_replace('%40','@',$user_id);
                if(isset($_POST['update_role']))
                {
                    $result = $this->User_model->update_user_role($user_id, $_POST['role']);
                    if($result == true)
                    {
                        $data['success'] = "Succefully updated role of <strong>".$user_id."</strong>";
                    } else {
                        $data['error'] = "Failed to updated role of <strong>".$user_id."</strong>";
                    }
                }
                if(isset($_POST['reset_password']))
                {
                    $result = $this->User_model->set_password_reset_on($user_id);
                    if($result == true)
                    {
                        $data['success'] = "Succefully turned passsword reset on for <strong>".$user_id."</strong>";
                    } else {
                        $data['error'] = "Failed to turn on passsword reset for <strong>".$user_id."</strong>";
                    }
                }
                if(isset($_POST['delete']))
                {
                    $result = $this->User_model->delete_user($user_id);
                    if($result == true)
                    {
                        $data['success'] = "Succefully deleted user <strong>".$user_id."</strong>";
                        redirect('User');
                    } else {
                        $data['error'] = "Failed delete <strong>".$user_id."</strong>";
                    }
                }
                
                $data['page_title'] = 'View user info';
                $data['user'] = $this->User_model->get_specified_user($user_id)[0];
                $data['roles'] = $this->Role_model->get_all_roles();
                $this->load->view('template/header',$data);
                $this->load->view('user/view_user',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

    public function new_user()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['users']) || $_SESSION['user']['privilage_level'] == '1')
            {
                if(isset($_POST['user']))
                {
                    $result = $this->User_model->update_user_role($_POST['user'], $_POST['role_id']);
                    if($result == true)
                    {
                        $data['success'] = "Succefully assigned role to <strong>".$_POST['user']."</strong>";
                    } else {
                        $data['error'] = "Failed to assign role to <strong>".$_POST['user']."</strong>";
                    }
                }
                if(isset($_POST['delete']))
                {  
                    $result = $this->User_model->delete_user($_POST['delete']);
                    if($result == true)
                    {
                        $data['success'] = "Deleted user <strong>".$_POST['delete']."</strong>";
                    } else {
                        $data['error'] = "Failed to delete <strong>".$_POST['delete']."</strong>";
                    }
                }
                $data['page_title'] = 'Add new user';
                $data['data_tables'] = array('user_table');
                $data['users'] = $this->User_model->get_all_new_users();
                $data['roles'] = $this->Role_model->get_all_roles();
                $this->load->view('template/header',$data);
                $this->load->view('user/new_user',$data);
                $this->load->view('template/footer');
            } else {
                $data['page_title'] = 'ACCESS DENIED';
                $this->load->view('template/header',$data);
                $this->load->view('login/no_access',$data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('login');
        }
    }

}
