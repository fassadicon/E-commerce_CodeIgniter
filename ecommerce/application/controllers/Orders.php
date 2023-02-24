<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	// public function index() {
	//     $this->load->view('partials/header');
	// 	$this->load->view('products/cart');
	// }

	public function store()
	{
		$input = $this->input->post();
		$result = $this->Order->store($input);
		return $result;
	}

	public function show($order_id)
	{
		$header_data = array(
			'title' => 'Order #' . $order_id,
			'selected' => 'none'
		);
		$view_data = array(
			'order' => $this->Order->get_by_id($order_id)
		);
		$this->load->view('partials/header', $header_data);
		$this->load->view('dashboard/order_show', $view_data);
	}

	public function update_status()
	{
		$post = $this->input->post();
		$result = $this->Order->update_status($post);
		return $result;
	}
}
