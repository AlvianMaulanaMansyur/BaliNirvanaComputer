<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
        public function __construct() {
            parent::__construct();  
        }
    
        public function get_admin($username, $password) {
            $query = $this->db->get_where('admin', array('nama_admin' => $username, 'password_admin' => $password));
            return $query->row();
        }
        public function get_all_customers() {
            return $this->db->get('customer')->result_array();
            
        }
        
        public function delete_customer($id_customer) {
            
                
                $this->db->where('id_customer', $id_customer);
                $this->db->delete('cart');
                
                $this->db->where('id_customer', $id_customer);
                $this->db->delete('customer');
            
        }
    
        public function edit($id_customer, $data) {
            
            $this->db->where('id_customer', $id_customer);
            $this->db->update('customer', $data);
        }
        public function update_customer($customer_id, $data) {
            $this->db->where('id_customer', $customer_id);
            $this->db->update('customer', $data);
        }
        
        public function get_customer($customer_id) {
            $this->db->where('id_customer', $customer_id);
            return $this->db->get('customer')->row();
        }

        public function search_data($keyword) {
            $this->db->like('username', $keyword);
            $this->db->or_like('id_customer', $keyword);
            $this->db->or_like('nama_customer', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->or_like('telepon', $keyword);
            $query = $this->db->get('customer');
            return $query->result();
        }
    }
    
    
    



/* End of file ModelName.php */
