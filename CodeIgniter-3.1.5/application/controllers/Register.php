<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()
	{
		$this->load->view('register');
	}
	
	public function signUp()
	{
		var $TPL;
		
		$this->load->database();
		date_default_timezone_set('EST');
		$today = date("Y-m-d"); 
		
		$data['msg'] = "Registered Successfully! You may now login.";
		$data['taken'] = "This email address is already taken. Please try another."; 
		
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		
		$emailLower = strtolower($email);
		
		$password = $this->input->post("password");
		$phone = $this->input->post("phone");
		$question = $this->input->post("security_questions");
		$answer = $this->input->post("security_answer");
		$answerLower = strtolower($answer);
		
		$query = $this->db->query("SELECT * FROM cap_Student WHERE email = '$emailLower'");
		
		// For debugging purposes
		// $this->TPL['results'] = $query->result_array();
		
		if ($query->num_rows() > 0)
		{
			// Failure
			$this->load->view("register", $data);
		}
		else
		{
			// Success
			$query = $this->db->query("INSERT INTO cap_Student VALUES (NULL, '$name', '$emailLower', '$password', '$question', '$answerLower', '$phone', '$today')");
			$this->load->view("login", $data);
		}	
	}
}
