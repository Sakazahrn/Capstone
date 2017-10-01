<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}
	
	public function Auth()
	{
		$this->load->database();
		
		$email = $this->input->post("email");
		$password = $this->input->post("password");	
		$emailLower = strtolower($email);
		
		$query = $this->db->query("SELECT * FROM cap_Student WHERE email = '$emailLower' && password = '$password'");
		$this->TPL['results'] = $query->result_array();

		// Get User's name
		$nameQuery = $this->db->query("SELECT name FROM cap_Student WHERE email = '$emailLower'");
		$this->TPL['name'] = $nameQuery->result_array();
		
		if ($query->num_rows() > 0)
		{
			$_SESSION['login_user'] = $this->TPL['name'][0]['name'];
			redirect(base_url() . 'index.php/Calendar');
		}
		else
		{
			$_SESSION['error'] = "Invalid Email/Password";
			
			redirect(base_url() . "index.php/Login");
		}	
	}
}
