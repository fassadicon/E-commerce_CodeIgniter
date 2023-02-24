<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carts extends CI_Controller
{
	public function index() {
		$view_data = array(
			'totalAmount' => $this->Cart->get_total_amount_by_user_id($this->session->userdata('user_id'))
		);
        $this->load->view('partials/header');
		$this->load->view('products/cart', $view_data);
	}

    public function cart_items() {
        $view_data = array(
			'items' => $this->Cart->get_by_user_id($this->session->userdata('user_id')),
			'totalAmount' => $this->Cart->get_total_amount_by_user_id($this->session->userdata('user_id'))
		);
		$this->load->view('partials/cart_table', $view_data);
    }

	public function remove_in_cart($cart_id) {
		$result = $this->Cart->remove_in_cart($cart_id);
		return $result;
	}
}
