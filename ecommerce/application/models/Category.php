<?php
class Category extends CI_Model
{
    function get_all()
    {
        $query = "SELECT * FROM categories";
        return $this->db->query($query)->result_array();
    }

    function get_by_name($category) {
        $query = "SELECT * FROM categories WHERE name = ?";
        $values = array(
            $this->security->xss_clean($category['category'])
        );
        return $this->db->query($query, $values)->row_array();
    }

    function get_by_id($category_id) {
        $query = "SELECT * FROM categories WHERE id = ?";
        $values = array(
            $this->security->xss_clean($category_id)
        );
        return $this->db->query($query, $values)->row_array();
    }

    function store($category)
    {
        $query = "INSERT INTO categories(name, created_at) VALUES (?,?)";
        $values = array(
            $this->security->xss_clean($category['name']),
            $this->security->xss_clean(date('Y-m-d H:i:s'))
        );
        return $this->db->query($query, $values);
    }

    // function validate() {

    // }
}
