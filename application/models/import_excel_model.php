<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class import_excel_model extends CI_Model {


	public function create($formArray){

		$this->db->insert('users',$formArray); //insert into users 


	}

	public function all(){


		return $users=$this->db->get("users")->result_array();// Select # from Users
	}

	public function getUser($userId)
	{

		$this->db->where('id',$userId);

		return $user=$this->db->get('users')->row_array();//select * from users where id=?
	}

	public function updateUser($userId,$formArray){

		$this->db->where('id',$userId);

		$this->db->update('users',$formArray);//Update users SET name=? email=? where id=? 

	}
	public function deleteUser($userId){

		$this->db->where('id',$userId);

		$this->db->delete('users');//delete from  users  where id=? 

	}

	public function batchInsertdata($data){

         $this->db->truncate('users'); // empty the table
         $this->db->insert_batch('users', $data);
         return true;


    }
}
