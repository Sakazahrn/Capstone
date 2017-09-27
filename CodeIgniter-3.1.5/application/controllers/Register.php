<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()
	{
		$this->load->view('register');
	}
	
	public function signUp()
	{

		$this->load->database();
		date_default_timezone_set('EST');
		$today = date("Y-m-d"); 
		
		//$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$phone = $this->input->post("phone");
		$question = $this->input->post("security_questions");
		$answer = $this->input->post("security_answer");
		
		$answerLower = strtolower($answer);
		
		$domain = substr($email, strpos($email, '@') + 1);
		if  (checkdnsrr($domain) !== FALSE) {
			$emailVerified = $email;
			$emailLower = strtolower($emailVerified);
			
			$query = $this->db->query("SELECT * FROM cap_Student WHERE email = '$emailLower'");
		
			// For debugging purposes
			// $this->TPL['results'] = $query->result_array();
			
			if ($query->num_rows() > 0)
			{
				// Failure
				$_SESSION['error'] = "This email address is already taken. Please try another.";
				redirect(base_url() . "index.php/Register");
			}
			else
			{
				// Success
				$query = $this->db->query("INSERT INTO cap_Student VALUES (NULL, '$name', '$emailLower', '$password', '$question', '$answerLower', '$phone', '$today')");
				$_SESSION['msg'] = "Registered Successfully! You may now login.";
				redirect(base_url() . "index.php/Login");
			}	
		}
		else {
			$_SESSION['error'] = "This is not a valid email.";
			
			redirect(base_url() . "index.php/Register");
		}
	}
}
