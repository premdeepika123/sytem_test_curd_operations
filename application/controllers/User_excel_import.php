<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_excel_import extends CI_Controller {


	public function __construct()
	{

		parent::__construct();

	}

	public function index(){

		$this->load->model("import_excel_model");
		$users=$this->import_excel_model->all();
		$data=array();
		$data['users']=$users;
		$this->load->view("list",$data);

	}

	
	public function create()
	{
		$this->load->model('import_excel_model');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email_id]');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('qualification', 'Qualification', 'required');
		$this->form_validation->set_rules('terms', 'Terms and Conditions', 'required');


		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('import_excel_view');
                }
                else
                {
                   $formArray= array();
                   $formArray['username']=$this->input->post('username');
                   $formArray['email_id ']=$this->input->post('email');
                   $formArray['address']=$this->input->post('address');
                   $formArray['gender']=$this->input->post('gender');
                   $formArray['qualification']=$this->input->post('qualification');
                   $formArray['toc']=$this->input->post('terms');
                   $formArray['created_date  ']=date('Y-m-d');
                   $this->import_excel_model->create($formArray);
                   $this->session->set_flashdata("success","Record added successfully");
                   redirect(base_url()."index.php/user_excel_import/index");



                }


	}


	public function edit($userId)
	{

		$this->load->model('import_excel_model');
		$user=$this->import_excel_model->getUser($userId);
		$data=array();
		$data['user']=$user;
		$this->load->model('import_excel_model');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('qualification', 'Qualification', 'required');

		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('edit',$data);
                }
		else
		{


			//update user
				$formArray=array();
			 	$formArray['username']=$this->input->post('username');
	           $formArray['email_id ']=$this->input->post('email');
	           $formArray['address']=$this->input->post('address');
	           $formArray['gender']=$this->input->post('gender');
	           $formArray['qualification']=$this->input->post('qualification');
	           $formArray['toc']=$this->input->post('terms');
	           $formArray['updated_date  ']=date('Y-m-d');
	       		$this->import_excel_model->updateUser($userId,$formArray);
			$this->session->set_flashdata("success","Record updated successfully");
			 redirect(base_url()."index.php/user_excel_import/index");

		}

	}

	public function delete($userId)
	{

		$this->load->model('import_excel_model');
		$user=$this->import_excel_model->getUser($userId);
		if(empty($user)){	

			$this->session->set_flashdata("failure","Record not found in database");
			 redirect(base_url()."index.php/user_excel_import/index");


		}
		$this->import_excel_model->deleteUser($userId);
		$this->session->set_flashdata("success","Record deleted successfully");
			 redirect(base_url()."index.php/user_excel_import/index");

	}
	
}
?>