<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Locker_model');
        $this->load->model('Employee_model');

    }

    //list all lockers
    public function index()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_lockers']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['page_title'] = 'Lockers';
                $data['data_tables'] = array('locker_table');
                $data['plants'] = $this->Locker_model->get_all_plants();
                if(isset($_GET['filter_results']))
                {
                    $data['lockers'] = $this->Locker_model->get_filtered_lockers($_GET['status'], $_GET['locker_no'], $_GET['plant']);
                    $data['filters'] = $_GET;

                } else 
                {
                    $data['lockers'] = $this->Locker_model->get_all_lockers();
                }
                
                $this->load->view('template/header',$data);
                $this->load->view('locker/all_lockers',$data);
                $this->load->view('template/footer',$data);
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

    public function view($locker_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_lockers']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['locker'] = $this->Locker_model->get_locker_by_id($locker_id);
                $data['owner'] = $this->Locker_model->get_locker_owner($locker_id);
                $data['owner_history'] = $this->Locker_model->get_locker_owner_history($locker_id);
                $data['page_title'] = 'Locker : '.$data['locker']->locker_no.' - '.$data['locker']->plant;
                $data['data_tables'] = array('owner_history_table');
                if(isset($_POST['state']))
                {
                    $result = $this->Locker_model->change_locker_state($_POST['state'], $locker_id, $_SESSION['user']['username']);
                    if($result == true)
                    {
                        $data['success'] = "Successfully changed the locker status";
                        redirect('Locker/view/'.$locker_id );

                    } else {
                        $data['error'] = "Failed to change the locker status";
                    }
                }

                $this->load->view('template/header',$data);
                $this->load->view('locker/view_locker',$data);
                $this->load->view('template/footer',$data);
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

    public function assign($locker_id)
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['all_lockers']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['locker'] = $this->Locker_model->get_locker_by_id($locker_id);
                if($data['locker']->status == "in_use")
                {
                    redirect('Locker/view/'.$locker_id );
                }
                $data['page_title'] = 'Assign employee to locker : '.$locker_id.' - '.$data['locker']->plant;
                $data['data_tables'] = array('employee_table');
                $data['employees'] = $this->Employee_model->get_employees_without_lockers($data['locker']->plant_id);
                $data['plants'] = $this->Locker_model->get_all_plants();
                if(isset($_POST['employee_id']))
                {
                    $result = $this->Locker_model->change_locker_state("assign", $locker_id, $_SESSION['user']['username'], $_POST['employee_id']);
                    if($result == true)
                    {
                        redirect('Locker/view/'.$locker_id );
                    } else {
                        $data['error'] = "Unable to assigne locker : <strong>".$locker_id."</strong> to Employee with EPF no : <strong>".$_POST['employee_id']."</strong>";
                    }
                }
                $this->load->view('template/header',$data);
                $this->load->view('locker/set_owner',$data);
                $this->load->view('template/footer',$data);
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

    public function new_locker()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['new_locker']) || $_SESSION['user']['privilage_level'] == '1')
            {
                $data['page_title'] = 'Add New Locker';
                $data['plants'] = $this->Locker_model->get_all_plants();
                if(isset($_POST['new_locker']))
                {
                    $result = $this->Locker_model->add_new_locker($_POST['locker_no'], $_POST['plant'], $_SESSION['user']['username']);
                    if($result == true)
                    {
                        $data['success'] = 'Successfully added new locker <strong>'.$_POST['locker_no'].'<strong>';
                    } else {
                        $data['error'] = 'Falied to add new locker : <strong>'.$_POST['locker_no'].'</strong>';

                    }
                }
                $this->load->view('template/header', $data);
                $this->load->view('locker/new_locker_one', $data);
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

    public function remove_locker()
    {
        if(isset($_SESSION['user']))
        {
            if(isset($_SESSION['user']['access']['remove_locker']) || $_SESSION['user']['privilage_level'] == '1')
            {
                if(isset($_POST['locker_id']))
                {
                    $locker = $this->Locker_model->get_locker_by_id($_POST['locker_id']);
                    $result = $this->Locker_model->remove_locker($_POST['locker_id']);
                    if($result == true)
                    {
                        $data['success'] = "Removed Locker <strong>".$locker->locker_no."</strong> in plant <strong>".$locker->plant."</strong> successfully";
                    } else {
                        $data['error'] = "Failed to removed Locker <strong>".$locker->locker_no."</strong> in plant <strong>".$locker->plant."</strong>";
                    }
                }
                $data['data_tables'] = array('locker_table');
                $data['plants'] = $this->Locker_model->get_all_plants();
                if(isset($_GET['filter_results']))
                {
                    $data['lockers'] = $this->Locker_model->get_filtered_lockers($_GET['status'], $_GET['locker_no'], $_GET['plant']);
                    $data['filters'] = $_GET;

                } else 
                {
                    $data['lockers'] = $this->Locker_model->get_all_lockers();
                }
                $data['page_title'] = 'Remove Lockers';
                $this->load->view('template/header',$data);
                $this->load->view('locker/remove_locker',$data);
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
