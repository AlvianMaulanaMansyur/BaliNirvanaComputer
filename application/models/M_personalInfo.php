<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_personalInfo extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function insertPersonalInfo()
    {
        $id = $this->session->userdata('customer_id');
        $existing_personal_info = $this->getPersonalInfoByIdCustomer($id);

        $insert_data = array(
            'alamat' => $this->input->post('alamat'),
            'kodepos' => $this->input->post('kodepos'),
            'id_customer' => $id,
            'id_kecamatan' => $this->input->post('id_kecamatan'),
        );
        
        if (empty($existing_personal_info)) {
            $this->db->insert('personal_info', $insert_data);
        } else {
            $this->db->where('id_customer', $id);
            $this->db->update('personal_info', $insert_data);
        }
    }

    public function getCustomerById($customer_id)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id_customer', $customer_id);
        $result = $this->db->get()->row_array();
        return $result;
    }
    
    public function getPersonalInfo() {
        $result = $this->db->get('personal_info');
        return $result->result_array();
    }

    public function getPersonalInfoByIdCustomer($id_customer)
    {
        $this->db->select('personal_info.*, kecamatan.kecamatan, kota_kab.kota');
        $this->db->from('personal_info');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('id_customer', $id_customer);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function kotaKec() {
        $this->db->select('kecamatan.*, kota_kab.kota');
        $this->db->from('kecamatan');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getKota()
    {
        $result = $this->db->get('kota_kab');
        return $result->result_array();
    }

    public function getKecamatan()
    {
        $result = $this->db->get('kecamatan');
        return $result->result_array();
    }

}

/* End of file M_personalInfo.php */


?>