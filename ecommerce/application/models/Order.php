<?php
class Order extends CI_Model
{
    function get_all()
    {
        $query = "SELECT * FROM orders";
        return $this->db->query($query)->result_array();
    }

    function get_by_id($order_id)
    {
        $query = "SELECT orders.*, users.first_name, users.last_name FROM orders 
        JOIN users ON orders.user_id = users.id
        WHERE orders.id = ?";
        $values = array(
            $order_id
        );
        return $this->db->query($query, $values)->row_array();
    }

    function get_by_name($order)
    {
        if (strlen($order['name'] == 0)) {
            $order['name'] = '%';
        } else {
            $order['name'] = '%' . $this->security->xss_clean($order['name']) . '%';
        }
        $query = "SELECT orders.*, users.first_name, users.last_name FROM orders 
        JOIN users ON orders.user_id = users.id
        WHERE users.first_name LIKE ?";
        $values = array(
            $order['name']
        );
        return $this->db->query($query, $values)->result_array();
    }

    function store($post)
    {
        $current_user_id = $this->session->userdata('user_id');
        $items = $this->Cart->get_by_user_id($current_user_id);

        foreach ($items as $item) {
            $post['items'][] = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity']
            );
            $this->Product->sold($item['id'], $item['quantity']);
            $this->Cart->remove($item['id'], $current_user_id);
        }
        $post['items'] = json_encode($post['items']);

        $post['shipping'] = array(
            'first_name' => $post['ship_first_name'],
            'last_name' => $post['ship_last_name'],
            'address' => $post['ship_address'] . ' ' .
                $post['ship_address2'] . ' ' .
                $post['ship_city'] . ' ' .
                $post['ship_state'] . ' ' .
                $post['ship_zipcode'],
            'address1' => $post['ship_address'],
            'address2' => $post['ship_address2'],
            'city' => $post['ship_city'],
            'state' => $post['ship_state'],
            'zipcode' => $post['ship_zipcode'],

        );
        $post['billing'] = array(
            'first_name' => $post['bill_first_name'],
            'last_name' => $post['bill_last_name'],
            'address' => $post['bill_address'] . ' ' .
                $post['bill_address2'] . ' ' .
                $post['bill_city'] . ' ' .
                $post['bill_state'] . ' ' .
                $post['bill_zipcode'],
            'address1' => $post['bill_address'],
            'address2' => $post['bill_address2'],
            'city' => $post['bill_city'],
            'state' => $post['bill_state'],
            'zipcode' => $post['bill_zipcode'],
        );
        $post['shipping'] = json_encode($post['shipping']);
        $post['billing'] = json_encode($post['billing']);

        $query = "INSERT INTO orders(user_id, items, total_amount, shipping, billing, created_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($current_user_id),
            $this->security->xss_clean($post['items']),
            $this->security->xss_clean($post['total_amount'] + 50),
            $this->security->xss_clean($post['shipping']),
            $this->security->xss_clean($post['billing']),
            $this->security->xss_clean(date('Y-m-d H:i:s'))
        );
        return $this->db->query($query, $values);
    }

    function update_status($post) {
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        $values = array($post['status'], $post['id']);
        return $this->db->query($query, $values);
    }
    // function get_total_amount_by_user_id($user_id)
    // {
    //     $query = "SELECT SUM(cart_items.quantity * products.price) as totalAmount FROM cart_items 
    //     JOIN products ON cart_items.product_id = products.id
    //     WHERE cart_items.user_id = ?";
    //     $values = array(
    //         $user_id
    //     );
    //     return $this->db->query($query, $values)->row_array();
    // }
    // public function fetch_limit($result, $per_page){
    //     return $this->db->query("SELECT * FROM products LIMIT ?,?", array($result, $per_page))->result_array();
    // }

    // function get_by_name($product)
    // {
    //     if (strlen($product['name'] == 0)) {
    //         $product['name'] = '%';
    //     } else {
    //         $product['name'] = '%' . $this->security->xss_clean($product['name']) . '%';
    //     }
    //     $query = "SELECT * FROM products WHERE name LIKE ?";
    //     $values = array(
    //         $product['name']
    //     );
    //     return $this->db->query($query, $values)->result_array();
    // }



}
