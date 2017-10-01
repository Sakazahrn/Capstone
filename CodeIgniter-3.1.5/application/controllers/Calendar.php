<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function index()
	{
		$this->load->view('calendar');
	}

	public function logout() 
	{
		unset($_SESSION['login_user']);
		redirect(base_url() . "index.php/Login");
	}
}
