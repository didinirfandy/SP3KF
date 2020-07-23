<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('login');
	}

}
