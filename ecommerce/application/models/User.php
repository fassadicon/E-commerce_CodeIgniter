<?php
class User extends CI_Model
{
    function get_all()
    {
        $query = "SELECT * FROM users";
        return $this->db->query($query)->result_array();
    }

    function get_user_by_id($user_id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $values = array($user_id);
        return $this->db->query($query, $values)->row_array();
    }

    function get_user_by_email($user_email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $values = array($user_email);
        return $this->db->query($query, $values)->row_array();
    }

    function is_admin($user_id)
    {
        $query = "SELECT * FROM users WHERE id = ? AND role = 1";
        $values = array($user_id);
        return $this->db->query($query, $values)->row_array();
    }

    function validateLogin($post)
    {
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ), array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            return validation_errors();
        } else {
            return 'valid';
        }
    }

    function store($user)
    {
        $user_level = empty($this->get_all()) ? 1 : 0;
        $query = "INSERT INTO users(first_name, last_name, email, password, salt, role, created_at) VALUES (?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['first_name']),
            $this->security->xss_clean($user['last_name']),
            $this->security->xss_clean($user['email']),
            $this->security->xss_clean($user['encrypted_password']),
            $this->security->xss_clean($user['salt']),
            $this->security->xss_clean($user_level),
            $this->security->xss_clean(date('Y-m-d H:i:s'))
        );
        return $this->db->query($query, $values);
    }

    function validateRegistration($post)
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
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[users.email]'
            ), array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|min_length[8]'
            ),
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            return validation_errors();
        } else {
            return 'valid';
        }
    }

    function update_info($user)
    {
        $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, updated_at = ? WHERE id = ?";
        $values = array(
            $this->security->xss_clean($user['first_name']),
            $this->security->xss_clean($user['last_name']),
            $this->security->xss_clean($user['email']),
            $this->security->xss_clean(date('Y-m-d H:i:s')),
            $this->security->xss_clean($user['id'])
        );
        return $this->db->query($query, $values);
    }

    function update_password($user)
    {
        $query = "UPDATE users SET password = ?, updated_at = ? WHERE id = ?";
        $values = array(
            $this->security->xss_clean($user['encrypted_password']),
            $this->security->xss_clean(date('Y-m-d H:i:s')),
            $this->security->xss_clean($user['id'])
        );
        return $this->db->query($query, $values);
    }
}
