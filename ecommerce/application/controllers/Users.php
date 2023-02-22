<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function index()
	{
		$current_user_id = $this->session->userdata('user_id');
		if (!$current_user_id) {
			$this->load->view('partials/header');
			$this->load->view('users/login');
		} else if ($this->User->is_admin($current_user_id)) {
			redirect("/dashboard/orders");
		} else {
			redirect("/products");
		}
	}

	public function register()
	{
		$this->load->view('partials/header');
		$this->load->view('users/register');
	}

	public function admin()
	{
		$this->load->view('partials/header');
		$this->load->view('users/admin');
	}

	public function login()
	{
		$user = $this->input->post();
		$validateUser = $this->User->validateLogin($user);
		if ($validateUser == 'valid') {
			$userInDB = $this->User->get_user_by_email($user['email']);
			if ($userInDB == false) {
				$this->session->set_flashdata('errors', 'Email does not exist!');
			} else {
				$input_encrypted_password = md5($user['password'] . '' . $userInDB['salt']);
				if ($userInDB['password'] != $input_encrypted_password) {
					$this->session->set_flashdata('errors', 'Invalid password!');
				} else {
					if ($this->User->is_admin($userInDB['id'])) {
						$this->session->set_userdata('role', 1);
					}
					$this->session->set_userdata('user_id', $userInDB['id']);
				}
			}
		} else {
			$this->session->set_flashdata('errors', $validateUser);
		}
		redirect('/');
	}

	public function store()
	{
		$user = $this->input->post();
		$validateUser = $this->User->validateRegistration($user);
		if ($validateUser == 'valid') {
			$user['salt'] = bin2hex(openssl_random_pseudo_bytes(22));
			$user['encrypted_password'] = md5($user['password'] . '' . $user['salt']);
			$storeUser = $this->User->store($user);
			if ($storeUser == true) {
				$this->session->set_flashdata('message', 'User successfully created!');
			} else {
				$this->session->set_flashdata('message', 'User creation failed!');
			}
		} else {
			$this->session->set_flashdata('errors', $validateUser);
		}
		redirect('/register');
	}

	public function edit()
	{
		$current_user_id = $this->session->userdata('user_id');
		$this->load->view('users/edit', array('user_id' => $current_user_id));
	}

	public function update_info()
	{
		$user = $this->input->post();
		$result = $this->User->update_info($user);
		if ($result) {
			$this->session->set_flashdata('message', 'Information successfully updated!');
		} else {
			$this->session->set_flashdata('message', 'User update failed!');
		}
		redirect('/edit');
	}

	public function update_password()
	{
		$user = $this->input->post();
		$userInDB = $this->User->get_user_by_id($user['id']);
		$input_encrypted_old_password = md5($user['old_password'] . '' . $userInDB['salt']);
		if ($userInDB['password'] != $input_encrypted_old_password) {
			$this->session->set_flashdata('errors', 'Invalid password!');
		} else {
			if ($user['new_password'] != $user['confirm_password']) {
				$this->session->set_flashdata('errors', 'Passwords does not match!');
			} else {
				$user['encrypted_password'] = md5($user['confirm_password'] . '' . $userInDB['salt']);
				$storeUser = $this->User->update_password($user);
				if ($storeUser) {
					$this->session->set_flashdata('message', 'Password successfully updated!');
				} else {
					$this->session->set_flashdata('message', 'Password update failed!');
				}
			}
		}
		redirect('/edit');
	}

	public function profile()
	{
		$this->load->model("User");
		$session_user_id = $this->session->userdata('user_id');
		$user = $this->User->get_user_by_id($session_user_id);
		$data = array(
			'user' => $user
		);
		if (empty($session_user_id)) {
			redirect('/');
		}
		$this->load->view('profile', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('user_id');
		redirect('/');
	}
}
