<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_produk');
        $this->load->model('M_pesanan');
        $this->load->helper('form');
        $this->load->model('Admin_model');
    }

    //Produk

    public function getProduk()
    {
        $produk = $this->M_produk->getProduk();
        $data = array(
            'content' => 'admin',
            'title' => 'Admin',
            'produk' => $produk,
        );
        $this->load->view('template', $data);
    }

    public function hlmInsert()
    {
        $category = $this->M_produk->getCategory();
        $data = [
            'content' => 'V_produk/hlmInsert',
            'title' => 'Insert Produk',
            'category' => $category
        ];
        $this->load->view('template', $data);
    }

    public function insertProduk()
    {
        $this->M_produk->insertProduk();
        redirect('dashboard/getproduk');
    }


    public function hlmEdit($id)
    {
        $category = $this->M_produk->getCategory();
        $produk = $this->M_produk->getDetailProduk($id);
        $data = [
            'content' => 'V_produk/hlmEdit',
            'title' => 'Edit Produk',
            'produk' => $produk,
            'category' => $category
        ];
        $this->load->view('template', $data);
    }

    public function editProduk()
    {
        $this->M_produk->editProduk();
        redirect('dashboard/getproduk');

    }

    public function delete($id)
    {
        $this->M_produk->deleteProduk($id);
        redirect('dashboard/getproduk');
    }

    public function Orders()
    {
        $order = $this->M_pesanan->getAllOrderForAdmin();
        $data = [
            'title' => 'Pesanan',
            'content' => 'V_produk/pesanan',
            'orders' => $order,
        ];

        $this->load->view('template', $data);
    }

    public function updateOrder($id_pesanan)
    {
        $this->db->select('*');
        $this->db->from('pesanan');
        $this->db->where('id_pesanan', $id_pesanan);
        $result = $this->db->get();
        $status = $result->result_array();

        if ($status[0]['status_pesanan'] == 0) {
            $data = [
                'status_pesanan' => '1',
            ];
            $this->db->where('id_pesanan', $id_pesanan);
            $this->db->update('pesanan', $data);
            $this->M_produk->updateStok($id_pesanan);

            redirect('dashboard/orders');
        } else if ($status[0]['status_pesanan'] == 1) {
            redirect('dashboard/rders');
        }
    }

    // C_laporan.php

    public function hlmReport() {
        $this->load->view('V_produk/monthly_report');
    }

    public function monthlyReport()
    {
        $month = $this->input->post('month'); // Ganti dengan metode yang sesuai
        $year = $this->input->post('year');   // Ganti dengan metode yang sesuai

        $data =[
        'monthly_orders' => $this->M_pesanan->getMonthlyOrders($month, $year),
        'content' => 'V_produk/monthly_report',
        'title' => 'Laporan Bulanan',
        ];
        $this->load->view('template', $data);
    }

    
}

/* End of file Admin.php */
