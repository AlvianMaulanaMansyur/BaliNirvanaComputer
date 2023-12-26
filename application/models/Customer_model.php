<?php
class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }

    public function get_customer_data($id_customer)
    {
        $this->db->where('id_customer', $id_customer);
        $query = $this->db->get('customer');

        // Mengembalikan hasil query dalam bentuk array
        $query = $query->result_array();
        return $query[0];
    }

    public function editProfile($id_customer, $nama_customer, $telepon) {
        // Lakukan validasi data jika diperlukan

        // Update data di database
        $data = array(
            'nama_customer' => $nama_customer,
            'telepon' => $telepon
        );

        $this->db->where('id_customer', $id_customer);
        $this->db->update('customer', $data);
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
