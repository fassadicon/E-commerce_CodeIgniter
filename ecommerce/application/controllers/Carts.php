<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index() {
		$view_data = array(
			'items' => $this->Cart->get_by_user_id($this->session->userdata('user_id'))
		);
        $this->load->view('partials/header');
		$this->load->view('products/cart', $view_data);
	}
}
