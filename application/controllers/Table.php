<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {
	
	
	public function index()
	{
        $this->load->model("User_model");

        $data["fetch_data"]=$this->User_model->fetch_data();
        $this->load->view('Table',$data);
    }
	


	





	
	public function form_validation_Table($data){
		$pagename=$this->uri->segment(3);
		if($pagename=='Table'){
			
			$this->form_validation->set_rules("index_num","Index Number",'required|min_length[8]');
			$this->form_validation->set_rules("firstname","First Name",'required');
			$this->form_validation->set_rules("lastname","Lastname Name",'required');
			$this->form_validation->set_rules("phone","Phone Number",'required|min_length[10]');
			

			if($this->form_validation->run()){
				
				$this->load->model('User_model');
				$data=array(
					"index_num"    =>$this->input->post("index_num"),
					"firstname" =>$this->input->post("firstname"),
					"lastname" =>$this->input->post("lastname"),	
					"phone" =>$this->input->post("phone")
					);

				 $this->User_model->insert_data($data);
				$this->Table();
				

			}else{
			
				$this->Table();
				
			}
		}
	}
	
	
	public function delete_data($page){
		$id=$this->uri->segment(3);
		
		$this->load->model('User_model');
		$this->User_model->delete_data($id);
		
		redirect(base_url().'main/Table');
		
	}
	

	public function update_data(){

		$id=$this->uri->segment(3);
		
		$this->load->model('User_model');
		$data['user_data']=$this->User_model->fetch_single_data($id);
		$data['fetch_data']=$this->User_model->fetch_data();
		$this->load->view('Table', $data);

	}

	
	public function form_Update_common(){
		$id=$this->uri->segment(3);
		

		$this->load->model('User_model');
				$data=array(
				"index_num" =>$this->input->post("index_num"),
				"firstname" =>$this->input->post("firstname"),
				"lastname"    =>$this->input->post("lastname"),
				"phone" =>$this->input->post("phone")
				);

		$this->User_model->update_data($id,$data);
		redirect(base_url().'main/Table/updated');
	}


	public function search(){
		$this->load->model('User_model');
		
		$search_data =$this->input->post("search_data");
		
		$data['fetch_data']=$this->User_model->search_data_model($search_data);
		$this->load->view('Table',$data);
	}	
}