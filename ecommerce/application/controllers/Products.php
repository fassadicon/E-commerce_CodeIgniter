<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('products/index');
	}
}
