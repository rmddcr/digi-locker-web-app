<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('System_model');

    }

    //list all lockers
    public function add_plant()
    {
        $data['page_title'] = 'New plant';
        if(isset($_POST['new_plant']))
        {
            $result = $this->System_model->add_plant($_POST['plant']);
            if($result == true)
            {
                $data['success'] = "Successfully added Plant : <strong>".$_POST['plant']."</strong>";

            } else {
                $data['error'] = "Failed to add Plant : <strong>".$_POST['plant']."</strong>";;
            }
        }
        $this->load->view('template/header',$data);
        $this->load->view('system/add_plant',$data);
        $this->load->view('template/footer',$data);
    }

    public function add_team()
    {
        $data['page_title'] = 'New team';
        $data['plants'] = $this->System_model->get_all_plants();
        if(isset($_POST['new_team']))
        {
            $result = $this->System_model->add_team($_POST['team'], $_POST['plant']);
            if($result == true)
            {
                $data['success'] = "Successfully added Team : <strong>".$_POST['team']."</strong>";

            } else {
                $data['error'] = "Failed to add Team : <strong>".$_POST['team']."</strong>";;
            }
        }
        $this->load->view('template/header',$data);
        $this->load->view('system/add_team',$data);
        $this->load->view('template/footer',$data);
    }

    public function add_shift()
    {
        if(isset($_POST['new_shift']))
        {
            $result = $this->System_model->add_shift($_POST['shift']);
            if($result == true)
            {
                $data['success'] = "Successfully added Shift : <strong>".$_POST['shift']."</strong>";

            } else {
                $data['error'] = "Failed to add Shift : <strong>".$_POST['shift']."</strong>";;
            }
        }
        $data['page_title'] = 'New shift';
        $this->load->view('template/header',$data);
        $this->load->view('system/add_shift',$data);
        $this->load->view('template/footer',$data);
    }

    public function restore()
    {
        $data['page_title'] = 'Restore system';
        $data['plants'] = $this->System_model->get_all_plants();
        if(isset($_POST['restore']))
        {
            
            $result = $this->System_model->restore("cvs_file", $_POST['plant']);
            if($result['status'] == 'failed' || !isset($result['end']))
                $data['error'] = $result['error'];
            else
                $data['success'] = "Successfully restored the system";
            
            if($result['errors'] > 0){
                $data['warning'] = "There were <strong>".$result['errors']."</strong> formatting errors in the CVS file";
                $data['data_tables'] = array('warnings');
            }
            $data['warrnings'] = $result['error_rows'];
            $data['warrning_count'] = $result['errors'];
            $data['inserted_rows'] = $result['entered_rows'];
            $data['read_rows'] = $result['row'];
        }
        
            $this->load->view('template/header',$data);
        $this->load->view('system/restore_system_csv',$data);
        $this->load->view('template/footer',$data);
    }
}
