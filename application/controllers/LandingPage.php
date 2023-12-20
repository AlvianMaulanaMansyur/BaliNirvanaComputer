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

    public function shop()
    {
        $produk = $this->M_produk->getProdukForCustomer();
        $category = $this->M_produk->getCategory();
        $data = array(
            'content' => 'customer/shop',
            'title' => 'Home',
            'produk' => $produk,
            'category' => $category,
            'kosong' => false,
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
                'content' => 'customer/shop',
                'title' => $category[0]['nama_category'],
                'produk' => $produk,
                'category' => $category,
                'kosong' => false,
            ];
        } else {
            $data = [
                'content' => 'customer/shop',
                'title' => $category[0]['nama_category'],
                'category' => $category,
                'produk' => '',
                'kosong' => true,
            ];
        }
        $this->load->view('template', $data);
    }

    public function contactUs() {
        $data = [
            'content' => 'customer/contact',
            'title' => 'Contact Us',
        ];
        $this->load->view('template', $data);
        
    }

    public function aboutUs() {
        $data = [
            'content' => 'customer/about',
            'title' => 'Contact Us',
        ];
        $this->load->view('template', $data);
        
    }

    public function search(){
        $keyword = $this->input->get('search');

        $data = array(
            'content' => 'customer/shop',
            'title' => 'Home',
            'produk' => $this->M_produk->getProdukForCustomer(), 
            'category' => $this->M_produk->getCategory(),
            'kosong' => false,
        );
        // Jika kata kunci null atau kosong, tampilkan seluruh produk
        if (empty($keyword)) {
            $data['results'] = $this->M_produk->getProdukForCustomer();
        } else {
            // Jika search dilakukan
            $data['results'] = $this->M_produk->searchProduk($keyword);
        }
        $this->load->view('template', $data);
    }
    
}

/* End of file LandingPage.php */

?>