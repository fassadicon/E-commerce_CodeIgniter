<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function index()
	{
		$data = array(
			'errors' => $this->session->flashdata('errors'),
			'message' => $this->session->flashdata('message')
		);
		$this->load->view('form', $data);
	}

	public function add()
	{
		$rules = array(
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|min_length[2]|alpha'
			), array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required|min_length[2]|alpha'
			), array(
				'field' => 'contact_number',
				'label' => 'Contact Number',
				'rules' => 'trim|required|numeric|min_length[11]|is_unique[users.contact_number]'
			), array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|is_unique[users.email]'
			), array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]'
			),
			// array(
			// 	'folder' => 'repeat_password',
			// 	'label' => 'Repeat Password',
			// 	'rules' => 'required|matches[password]'
			// )
		);
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
		} else {
			$user = $this->input->post();
			$this->load->model("User");
			$user['salt'] = bin2hex(openssl_random_pseudo_bytes(22));
			$user['encrypted_password'] = md5($user['password'] . '' . $user['salt']);
			$result = $this->User->add_user($user);
			if ($result == true) {
				$this->session->set_flashdata('message', 'User successfully created!');
			} else {
				$this->session->set_flashdata('message', 'User creation failed!');
			}
		}
		redirect('/');
	}

	public function login()
	{
		$rules = array(
			array(
				'field' => 'user_identifaction',
				'label' => 'Contact Number or Email',
				'rules' => 'trim|required'
			), array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[8]'
			)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		} else {
			$userInputCredentials = $this->input->post();
			$this->load->model("User");
			if (filter_var($userInputCredentials['user_identifaction'], FILTER_VALIDATE_EMAIL)) {
				$userDBCredentials = $this->User->get_user_by_email($userInputCredentials['user_identifaction']);
			} else if (is_numeric($userInputCredentials['user_identifaction'])) {
				$userDBCredentials = $this->User->get_user_by_contact_number($userInputCredentials['user_identifaction']);
			} 
			if ($userDBCredentials == false) {
				$this->session->set_flashdata('errors', 'Contact number or Email does not exist!');
				$this->User->update_failed_login_at($userDBCredentials['id']);
				redirect('/');
			} else {
				$input_encrypted_password = md5($userInputCredentials['password'] . '' . $userDBCredentials['salt']);
				if ($userDBCredentials['password'] != $input_encrypted_password) {
					$this->session->set_flashdata('errors', 'Invalid password!');
					$this->User->update_failed_login_at($userDBCredentials['id']);
					redirect('/');
				}
			}
		}
		$this->session->set_userdata('user_id', $userDBCredentials['id']);
		redirect('/users/profile');
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
		$this->session->unset_userdata('user_id');
		redirect('/');
	}
}
