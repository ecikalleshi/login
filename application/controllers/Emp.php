<?php
class Emp extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in') !== TRUE)
		{
			redirect('login');
		}
		$this->load->model('Emp_model');
	}
	function index(){
		$this->load->view('Emp_view');
	}

	function emp_data(){
		$data=$this->Emp_model->emp_list();
		echo json_encode($data); // Convert array into json string
		//JavaScript Object Notation used for structuring data in a much more organized format 
		//the major purpose of using Codeigniter JSON is that it transmits data between web server and application
	}

	function save(){
		$data=$this->Emp_model->save_emp();
		echo json_encode($data);
	}

	function update(){
		$data=$this->Emp_model->update_emp();
		echo json_encode($data);
	}

	function delete(){
		$data=$this->Emp_model->delete_emp();
		echo json_encode($data);
	}

}