<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Management extends CI_Controller {
	public function index()
	{
		$this->load->view('student_management');
	}
}
