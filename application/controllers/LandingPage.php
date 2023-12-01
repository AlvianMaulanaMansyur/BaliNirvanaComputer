<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_produk');
        $this->load->model('M_cart');
        $this->load->model('M_personalInfo');
        $this->load->model('M_pesanan');
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $produk = $this->M_produk->getProdukForCustomer();
        $category = $this->M_produk->getCategory();
        $data = array(
            'content' => 'V_user/home',
            'title' => 'Home',
            'produk' => $produk,
            'category' => $category,
        );
        $this->load->view('template', $data);
    }

    public function detailProduk($id)
    {
        $produk = $this->M_produk->getDetailProduk($id);
        $data = [
            'content' => 'V_produk/detailProduk',
            'title' => $produk['nama_produk'],
            'produk' => $produk,
        ];
        $this->load->view('template', $data);
    }

    public function detailCategory($id)
    {
        $produk = $this->M_produk->getDetailCategory($id);
        $category = $this->M_produk->getCategory();
        if (!empty($produk)) {
            $data = [
                'content' => 'V_user/category',
                'title' => $category[0]['nama_category'],
                'produk' => $produk,
                'category' => $category,
            ];
        } else {
            $data = [
                'content' => 'V_user/category_kosong',
                'title' => $category[0]['nama_category'],
                'category' => $category,
            ];
        }
        $this->load->view('template', $data);
    }
    
}

/* End of file LandingPage.php */

?>