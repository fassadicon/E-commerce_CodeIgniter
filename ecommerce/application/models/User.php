<?php
class User extends CI_Model
{
    function get_user_by_id($user_id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $values = array($user_id);
        return $this->db->query($query, $values)->row_array();
    }
    function get_user_by_contact_number($user_contact_number)
    {
        $query = "SELECT * FROM users WHERE contact_number = ?";
        $values = array($user_contact_number);
        return $this->db->query($query, $values)->row_array();
    }
    function get_user_by_email($user_email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $values = array($user_email);
        return $this->db->query($query, $values)->row_array();
    }
    function add_user($user)
    {
        $query = "INSERT INTO users(first_name, last_name, contact_number, email, password, salt, failed_login_at, created_at, updated_at) VALUES (?,?,?,?,?,?,?,?,?)";
        $values = array($user['first_name'], $user['last_name'], $user['contact_number'], $user['email'], $user['encrypted_password'], $user['salt'], NULL, date('Y-m-d H:i:s'), NULL);
        return $this->db->query($query, $values);
    }
    function update_failed_login_at($user_id)
    {
        $query = "UPDATE users SET failed_login_at = ? WHERE id = ?";
        $values = array(date('Y-m-d H:i:s'), $user_id);
        return $this->db->query($query, $values);
    }
}
