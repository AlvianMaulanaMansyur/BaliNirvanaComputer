<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_personalInfo extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function insertPersonalInfo($data_info)
    {
        $id = $this->session->userdata('customer_id');
        $existing_personal_info = $this->getPersonalInfoByIdCustomer($id);

        if (empty($existing_personal_info)) {
            $this->db->insert('personal_info', $data_info);
        } else {
            $this->db->where('id_customer', $id);
            $this->db->update('personal_info', $data_info);
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

    public function getPersonalInfo()
    {
        $result = $this->db->get('personal_info');
        return $result->result_array();
    }

    public function getPersonalInfoByIdCustomer($id_customer)
    {
        $this->db->select('personal_info.*, kecamatan.*, kota_kab.*');
        $this->db->from('personal_info');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('id_customer', $id_customer);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function addKota()
    {
        $kota = $this->input->post('kota');
        $data = [
            'kota' => $kota,
        ];
        $this->db->insert('kota_kab', $data);
    }

    public function editKota()
    {
        $id_kota_kab = $this->input->post('id_kota_kab');
        $kota = $this->input->post('kota');
        $data = [
            'kota' => $kota,
        ];
        $this->db->where('id_kota_kab', $id_kota_kab);
        $this->db->update('kota_kab', $data);
    }

    public function deleteKota($id_kota)
    {
        // Get the id_kota_kab before deleting the kota
        $this->db->where('id_kota_kab', $id_kota);
        $id_kota_kab = $this->db->get('kota_kab')->row('id_kota_kab');

        // Delete all kecamatan associated with the obtained id_kota_kab
        $this->db->where('id_kota_kab', $id_kota_kab);
        $this->db->delete('kecamatan');

        // Delete the kota
        $this->db->where('id_kota_kab', $id_kota);
        $this->db->delete('kota_kab');
    }

    public function addKecamatan()
    {
        $id_kota_kab = $this->input->post('id_kota_kab');
        $kecamatan = $this->input->post('kecamatan');

        $data = [
            'id_kota_kab' => $id_kota_kab,
            'kecamatan' => $kecamatan,
        ];
        $this->db->insert('kecamatan', $data);
    }

    public function editKecamatan()
    {
        $id_kota_kab = $this->input->post('id_kota_kab');
        $kecamatan = $this->input->post('kecamatan');
        $id_kecamatan = $this->input->post('id_kecamatan');

        $data = [
            'id_kota_kab' => $id_kota_kab,
            'kecamatan' => $kecamatan,
        ];
        $this->db->where('id_kecamatan', $id_kecamatan);
        $this->db->update('kecamatan', $data);
    }

    public function deleteKecamatan($id_kecamatan)
    {
        $this->db->where('id_kecamatan', $id_kecamatan);
        $this->db->delete('kecamatan');
    }

    public function kotaKec()
    {
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
