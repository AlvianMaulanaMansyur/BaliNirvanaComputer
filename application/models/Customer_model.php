<?php
class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login($email, $password) {
        $query = $this->db->get_where('customer', array('email' => $email, 'password_customer' => $password));
        return $query->row();
    }
    

    // public function register($data) {
    //     $this->db->insert('customer', $data);
    //     return $this->db->insert_id();
    // }
}
?>
