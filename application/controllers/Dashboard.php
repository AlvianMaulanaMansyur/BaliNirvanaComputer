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

    public function insertProduk()
    {
        $result = $this->M_produk->insertProduk();
        redirect('dashboard/getproduk');
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
            'customer' => $customer,
            'active_tab' => 'admin'
        ];


        $this->load->view('master', $data);
    }

    public function getProduk()
    {
        $produk = $this->M_produk->getProduk();
        $category = $this->M_produk->getCategory();
        
        $data = [
            'title' => 'Produck Stock',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/produk',
            'js' => 'V_partials/dashboard/js',
            'produk' => $produk,
            'category' => $category,
            'active_tab' => 'getProduk'
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
            'customer' => $customer,
            'active_tab' => 'admin'
        ];
        $this->load->view('master', $data);
    }

    public function update_customer()
    {

        $id_customer = $this->input->post('id_customer');
        if ($this->input->post('confirm_update') === '1')
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password_customer' => $this->input->post('password_customer'),
                'nama_customer' => $this->input->post('nama_customer'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('telepon')
            );

            $this->admin_model->update_customer($id_customer, $data);


            redirect('dashboard/admin');
        } else {
            $data['confirm_update'] = TRUE;
            $this->load->view('V_partials/admin/edit', $data);
        }
    }
    public function search()
    {
        // Ambil data pencarian dari form
        $keyword = $this->input->post('keyword');
       
            $data = [
                'title' => 'Bali Nirvana',
                'header' => 'V_partials/dashboard/header',
                'navbar' => 'V_partials/dashboard/navbar',
                'sidebar' => 'V_partials/dashboard/sidebar',
                'footer' => 'V_partials/dashboard/footer',
                'js' => 'V_partials/dashboard/js',
                'active_tab' => 'admin'
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

    public function delete_customer($id_customer)
    {
        $this->admin_model->delete_customer($id_customer);
        redirect('dashboard/admin');
    }

    public function monthlyRep()
    {

        $monthly_orders = null;
        $data = [
            'title' => 'Edit Data',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/monthly_report',
            'js' => 'V_partials/dashboard/js',
            'monthly_orders' => $monthly_orders,
            'active_tab' => 'monthlyRep'
        ];
        $this->load->view('master', $data);
    }

    public function monthlyReport()
    {
        $month = $this->input->post('month'); // Ganti dengan metode yang sesuai
        $year = $this->input->post('year');
        // var_dump($month);die;  // Ganti dengan metode yang sesuai
        $monthly_orders = $this->M_pesanan->getMonthlyOrders($month, $year);

        $data = [
            'title' => 'Edit Data',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/monthly_report',
            'js' => 'V_partials/dashboard/js',
            'monthly_orders' => $monthly_orders,
            'active_tab' => 'monthlyReport'
        ];
        $this->load->view('master', $data);
    }

    public function Orders()
    {
        $orders = $this->M_pesanan->getAllOrderForAdmin();
        // var_dump($orders);die;
        $data = [
            'title' => 'Edit Data',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'content' => 'V_partials/dashboard/pesanan',
            'js' => 'V_partials/dashboard/js',
            'orders' => $orders,
            'active_tab' => 'OrderList'
        ];
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