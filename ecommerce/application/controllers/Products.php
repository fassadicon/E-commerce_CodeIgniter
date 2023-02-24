<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$header_data = array(
			'title' => 'Products | Shirts | Sixenart Clothing'
		);
		$view_data = array(
			'categories' => $this->Category->get_all()
		);
		$this->load->view('partials/header', $header_data);
		$this->load->view('products/index', $view_data);
	}

	public function filter_category($category_id, $page_number)
	{
		$category = $this->Category->get_by_id($category_id);
		$header_data = array(
			'title' => "Products | {$category['name']} | Sixenart Clothing"
		);
		$products = $this->Product->filter_category($category_id);
		$total_rows = count($products);
		$limit_page = 8;
		$page_result = ($page_number - 1) * $limit_page;
		$products = $this->Product->filter_page($category_id, $page_result);
		$view_data = array(
			'categories' => $this->Category->get_all(),
			'products' => $products,
			'pagination' => array(
				'category_id' => $category_id,
				'limit_page' => $limit_page,
				'total_rows' => $total_rows,
				'number_of_page' => ceil($total_rows / $limit_page)
			)
		);
		$this->load->view('partials/header', $header_data);
		$this->load->view('products/index', $view_data);
	}

	public function search_and_sort()
	{
		$post = $this->input->post();
		$products = $this->Product->search_and_sort($post);
		$total_rows = count($products);
		$limit_page = 8;
		$partial_data = array(
			'products' => $products,
		);
		$pagination_data = array(
			'pagination' => array(
				'category_id' => $post['category_id'],
				'limit_page' => $limit_page,
				'total_rows' => $total_rows,
				'number_of_page' => ceil($total_rows / $limit_page)
			)
		);
		$this->load->view('partials/product_cards', $partial_data);
		$this->load->view('partials/pagination', $pagination_data);
	}

	public function show($product_id) {
		$product = $this->Product->get_by_id($product_id);
		$view_data = array(
			'product' => $product
		);
		$this->load->view('partials/header');
		$this->load->view('products/show', $view_data);
	}

	public function buy() {
		$post = $this->input->post();
		$result = $this->Cart->store($post);
		$this->session->set_flashdata('message', "Added to cart");
	}


	public function cart() {
		$view_data = array(
			'items' => $this->Cart->get_by_user_id($this->session->userdata('user_id'))
		);
	
		$this->load->view('products/cart', $view_data);
	}
}
