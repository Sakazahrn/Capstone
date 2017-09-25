<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {
	public function index()
	{
		$this->load->view('forgot');
	}
	
	function getPassword()
	{
		$email = $this->input->post("email");
		$emailLower = strtolower($email);
		
		$question = $this->input->post("security_questions");
		$answer = $this->input->post("security_answer");
		
		$query = $this->db->query("SELECT * FROM cap_Student WHERE email = '$emailLower' AND security_question = '$question' AND security_answer = '$answer'");
		$emailCheck = $this->db->query("SELECT email FROM cap_Student WHERE email = '$emailLower'");
		$questionCheck = $this->db->query("SELECT security_question FROM cap_Student WHERE email = '$emailLower'");
		$answerCheck = $this->db->query("SELECT security_answer FROM cap_Student WHERE email = '$emailLower'");

		// For debugging purposes
		
		/* $TPL['emailResults'] = $emailCheck->result_array();
		$TPL['questionResults'] = $questionCheck->result_array();
		$TPL['answerResults'] = $answerCheck->result_array();
		
		echo "<pre>";
		echo print_r($TPL['emailResults']);
		echo print_r($TPL['questionResults']);
		echo print_r($TPL['answerResults']);
		echo "</pre>"; 
		
		
		
		$TPL['results'] = $query->result_array();
		
		echo "<pre>";
		echo print_r($TPL['results']);
		echo "</pre>"; */
		
		if ($query->num_rows() > 0)
		{
			// Success
			$passwordQuery = $this->db->query("SELECT password FROM cap_Student WHERE email = '$emailLower'");
			$TPL['password'] = $passwordQuery->result_array();
			
			$data['password'] = $TPL['password'][0]['password'];
			echo $data['password'];
			
			$this->load->view("forgot", $data);
		}
		else if ($emailCheck <= 0)
		{
			// Failure
			$data['incorrect'] += "Incorrect Email.";
			$this->load->view("forgot", $data);
		}
		else if ($questionCheck <= 0)
		{
			$data['incorrect'] += "Incorrect Question.";
		}
		else if ($answerCheck <= 0)
		{
			$data['incorrect'] += "Incorrect Answer.";
		}
	}
}
