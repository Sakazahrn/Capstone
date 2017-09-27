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
		
		$CI =& get_instance();
		$sql = "select * from cap_Student";
		$query = $CI->db->query($sql);
		$this->TPL['results'] = $query->result_array();
		
		if ($email == $this->TPL['results'][0]['email'] && $password == $this->TPL['results'][0]['password'])
		{
			redirect(base_url() . 'index.php/Calendar');
		}
		else
		{
			$_SESSION['error'] = "Invalid Email/Password";
			
			redirect(base_url() . "index.php/Login");
		}	
	}
}
