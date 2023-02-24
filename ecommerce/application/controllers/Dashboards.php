<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboards extends CI_Controller
{
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('dashboard/orders');
	}

	public function orders()
	{
		$data = array(
			'title' => 'Dashboard Orders',
			'selected' => 'orders'
		);
		$view_data = array(
			'orders' => $this->Order->get_all()
		);
		$this->load->view('partials/header', $data);
		$this->load->view('dashboard/orders', $view_data);
	}

	public function order_search()
	{
		$name = $this->input->post();
		$view_data = array(
			'orders' => $this->Order->get_by_name($name)
		);
		$this->load->view('partials/dashboard_orders_table', $view_data);
	}

	public function products()
	{
		$header_data = array(
			'title' => 'Dashboard Products',
			'selected' => 'products'
		);
		$view_data = array(
			'categories' => $this->Category->get_all()
		);
		$this->load->view('partials/header', $header_data);
		$this->load->view('dashboard/products', $view_data);
	}

	public function search()
	{
		$name = $this->input->post();
		$view_data = array(
			'products' => $this->Product->get_by_name($name)
		);
		$this->load->view('partials/dashboard_products_table', $view_data);
	}

	public function add()
	{
		
		$product = $this->input->post();
		
		$countFiles = count($_FILES['images']['name']);
		$countUploadedFiles = 0;
		$countErrorUploadFiles = 0;
		for ($i=0; $i<$countFiles; $i++) {
			$_FILES['image']['name'] = $_FILES['images']['name'][$i];
			$_FILES['image']['type'] = $_FILES['images']['type'][$i];
			$_FILES['image']['size'] = $_FILES['images']['size'][$i];
			$_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
			$_FILES['image']['error'] = $_FILES['images']['error'][$i];

			$uploadStatus = $this->uploadFile('image', $product['category'], $product['name']);
			if ($uploadStatus != false) {
				$countUploadedFiles++;
				$product['images'][] = array(
					'path' => $uploadStatus,
					'uploaded_at' => date('Y-m-d H:i:s'),
					'is_main' => $i == 0 ? 1 : 0
				);
			} else {
				$countErrorUploadFiles++;
			}
		}
		$product['images'] = json_encode($product['images']);

		$category = $this->Category->get_by_name($product);
		$product['category_id']  = $category['id'];
		$post = $this->Product->store($product);
		$this->session->set_flashdata('message', 'Product added successfully');
		redirect('/dashboard/products');
	}

	public function uploadFile($name, $category, $productName)
	{
		$uploadPath = "./assets/images/$category/$productName";
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0777, TRUE);
		}

		$config = array(
			'upload_path' => $uploadPath,
			'allowed_types' => 'jpeg|JPEG|JPG|jpg|png|PNG',
			'encrypt_name' => TRUE
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($name)) {
			$fileData = $this->upload->data();
			return $uploadPath . '/' . $fileData['file_name'];
		} else {
			return false;
		}
	}

	function delete ($product_id) {
        $result = $this->Product->delete($product_id);
        if ($result) {
            $this->session->set_flashdata('message', 'Product successfully removed!');
        } else {
            $this->session->set_flashdata('message', 'Failed to remove product!');
        }
        redirect('/dashboard/products');
    }
}
