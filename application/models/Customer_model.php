<?php
class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_email($email, $password) {
        $query = $this->db->get_where('customer', array('email' => $email, 'password_customer' => $password));
        return $query->row();
    }

    public function get_username($username, $password){
        $query = $this->db->get_where('customer', array('username' => $username, 'password_customer' => $password));
        return $query->row();
    }

    

    // public function register($data) {
    //     $this->db->insert('customer', $data);
    //     return $this->db->insert_id();
    // }
}
?>
