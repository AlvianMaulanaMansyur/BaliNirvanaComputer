<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->model('M_produk');
        $this->load->model('M_pesanan');

        if (empty( $this->session->userdata('admin_name'))){
            redirect('auth/login');
        }
        
    }

    public function admin()
    {
        $customer = $this->admin_model->get_all_customers();
        $data = [
            'title' => 'Dashboard Admin ',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/content',
            'js' => 'V_partials/dashboard/js',
            'customer' => $customer
        ];


        $this->load->view('master', $data);
    }

    public function getProduk()
    {
        $produk = $this->M_produk->getProduk();
        $category = $this->M_produk->getCategory();
        
        $data = [
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/produk',
            'js' => 'V_partials/dashboard/js',
            'produk' => $produk,
            'category' => $category,
        ];
        $this->load->view('master', $data);
    }


    public function edit($id_customer)
    {
        $customer = $this->admin_model->get_customer($id_customer);
        $data = [
            'title' => 'Edit Data',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/admin/edit',
            'js' => 'V_partials/dashboard/js',
            'customer' => $customer
        ];
        $this->load->view('master', $data);
    }

    public function search()
{
    // Ambil data pencarian dari form
    $keyword = $this->input->post('keyword');

    // Inisialisasi data untuk tampilan
    $data = [
        'title' => 'Bali Nirvana',
        'header' => 'V_partials/dashboard/header',
        'navbar' => 'V_partials/dashboard/navbar',
        'sidebar' => 'V_partials/dashboard/sidebar',
        'footer' => 'V_partials/dashboard/footer',
        'js' => 'V_partials/dashboard/js',
    ];

    // Jika pencarian tidak kosong, lakukan pencarian
    if (!empty($keyword)) {
        $results = $this->admin_model->search_data($keyword);

        // Kirim hasil pencarian ke tampilan
        $data['content'] = 'V_partials/dashboard/content';
        $data['results'] = $results;
    } else {
        // Jika pencarian kosong, ambil semua data pelanggan
        $data['content'] = 'V_partials/dashboard/content';
        $data['customer'] = $this->admin_model->get_all_customers();
    }

    // Load tampilan dengan data yang sesuai
    $this->load->view('master', $data);
}


    public function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('logged_in');
        redirect('auth/login');
    }

}

/* End of file Dashboard.php */

?>