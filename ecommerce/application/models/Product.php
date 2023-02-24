<?php
class Product extends CI_Model
{
    function get_all()
    {
        $query = "SELECT * FROM products";
        return $this->db->query($query)->result_array();
    }

    function get_by_id($product_id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $values = array(
            $product_id
        );
        return $this->db->query($query, $values)->row_array();
    }

    public function fetch_limit($result, $per_page){
        return $this->db->query("SELECT * FROM products LIMIT ?,?", array($result, $per_page))->result_array();
    }

    function get_by_name($product)
    {
        if (strlen($product['name'] == 0)) {
            $product['name'] = '%';
        } else {
            $product['name'] = '%' . $this->security->xss_clean($product['name']) . '%';
        }
        $query = "SELECT * FROM products WHERE name LIKE ?";
        $values = array(
            $product['name']
        );
        return $this->db->query($query, $values)->result_array();
    }

    function store($user)
    {
        $query = "INSERT INTO products(user_id, category_id, name, description, price, stock, images, created_at) VALUES (?,?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($this->session->userdata('user_id')),
            $this->security->xss_clean($user['category_id']),
            $this->security->xss_clean($user['name']),
            $this->security->xss_clean($user['description']),
            $this->security->xss_clean($user['price']),
            $this->security->xss_clean($user['stock']),
            $this->security->xss_clean($user['images']),
            $this->security->xss_clean(date('Y-m-d H:i:s'))
        );
        return $this->db->query($query, $values);
    }

    public function sold($product_id, $quantity) {
        $product = $this->get_by_id($product_id);
		$query = "UPDATE products SET stock = ?, sold = ? WHERE id = ?";
		$values = array($product['stock'] - $quantity, $product['sold'] + $quantity, $product_id);
		return $this->db->query($query, $values);
	}

    function validate()
    {
    }

    function delete($product_id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $values = array($product_id);
        return $this->db->query($query, $values);
    }

    function filter_category($category_id)
    {
        $query = "SELECT * FROM products WHERE category_id = ?";
        $values = array($category_id);
        return $this->db->query($query, $values)->result_array();
    }

    function filter_page($category_id, $page_number)
    {
        $query = "SELECT * FROM products WHERE category_id = ? LIMIT ?, 8";
        $values = array($category_id, $page_number );
        return $this->db->query($query, $values)->result_array();
    }

    function search_and_sort($post) {
        if (strlen($post['name'] == 0)) {
			$name = '%';
		} else {
			$name = '%' . $this->security->xss_clean($post['name']) . '%';
		}

		$order = 'ASC';
        $orderCol = 'PRICE';

		$query = "SELECT * FROM products WHERE name LIKE ? AND category_id = ? ORDER BY {$orderCol} {$order}";
        $values = array($name, $post['category_id']);
        return $this->db->query($query, $values)->result_array();
    }
}
