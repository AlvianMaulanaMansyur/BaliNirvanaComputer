<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->model('M_produk');
        $this->load->model('M_pesanan');
        $this->load->library('form_validation');
        $this->load->library('PDF');

        if (empty($this->session->userdata('admin_name'))) {
            redirect('auth/login');
        }
    }

    public function insertProduk()
    {
        $this->M_produk->insertProduk();
        $this->session->set_flashdata('success_add', 'Produk berhasil ditambahkan.');
        redirect('dashboard/getproduk');
    }

    public function editProduk()
    {
        $id_produk = $this->M_produk->editProduk();
        $this->session->set_flashdata('success_edit', 'Produk berhasil diubah.');
        $this->session->set_flashdata('edited_product_id', $id_produk); // id_produk dari hasil pengeditan
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

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {

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
        } else {
            $data_to_save = [
                'username' => $this->input->post('username'),
                'password_customer' => $this->input->post('password_customer'),
                'nama_customer' => $this->input->post('nama_customer'),
                'email' => $this->input->post('email'),
                'telepon' => $this->input->post('telepon'),

            ];
            $this->admin_model->update_customer($id_customer, $data_to_save);
        }
    }

    public function update_customer()
    {

        $id_customer = $this->input->post('id_customer');
        if ($this->input->post('confirm_update') === '1') {
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
    public function search_Customer()
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

    public function search_produk()
    {
        // Ambil data pencarian dari form
        $keyword = $this->input->post('keyword');


        $data = [
            'title' => 'Produck Stock',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'js' => 'V_partials/dashboard/js',
            'active_tab' => 'getProduk'
        ];

        // Jika pencarian tidak kosong, lakukan pencarian
        if (!empty($keyword)) {
            $results = $this->M_produk->search_data_produk($keyword);

            // Kirim hasil pencarian ke tampilan
            $data['content'] = 'V_partials/dashboard/produk';
            $data['results'] = $results;
        } else {
            // Jika pencarian kosong, ambil semua data pelanggan
            $data['content'] = 'V_partials/dashboard/produk';
            $data['produk'] = $this->M_produk->getProduk();
            $data['category'] = $this->M_produk->getCategory();
        }

        // Load tampilan dengan data yang sesuai
        $this->load->view('master', $data);
    }

    public function delete_customer($id_customer)
    {
        $this->admin_model->delete_customer($id_customer);
        redirect('dashboard/admin');
    }

    public function monthlyReport()
    {
        $selectedMonth = $this->input->get('month');
        // var_dump($selectedMonth);die;
        // Cek apakah ada data GET
        if ($selectedMonth) {
            $selectedYear = $this->input->get('year');

            $monthYear = "$selectedYear-$selectedMonth";

            // Simpan nilai bulan ke dalam session
            $this->session->set_userdata('selected_month', $monthYear);
            $formattedMonthYear = date("F Y", strtotime($this->session->userdata('selected_month')));
        } else {
            $monthYear = "";
            $this->session->set_userdata('selected_month', $monthYear);
            $monthYear = $this->session->userdata('selected_month');
            $formattedMonthYear = "";
        }

        $monthly_orders = $this->M_pesanan->getMonthlyOrders($this->session->userdata('selected_month'));

        $data = [
            'title' => 'Monthly Report',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'js' => 'V_partials/dashboard/js',
            'monthly_orders' => $monthly_orders,
            'active_tab' => 'monthlyReport',
            'selected_month' => $formattedMonthYear,
        ];

        if($selectedMonth == '') {
            $data['content'] = 'V_partials/dashboard/monthly_report';
        } else {
            $data['content'] = 'V_partials/dashboard/monthly_report_table';
            
        }
        $this->load->view('master', $data);
    }

    public function saveAsPDF()
    {
        $data['title'] = 'Laporan Bulanan';
        $monthYear = $this->session->userdata('selected_month');

        if ($monthYear == null) {
            $formattedMonthYear = "";
        } else {
            $formattedMonthYear = date("F Y", strtotime($monthYear));
        }

        $data['title'] = 'Laporan Bulanan ' . $formattedMonthYear;
        $monthly_orders = $this->M_pesanan->getMonthlyOrders($monthYear);

        $data = [
            'monthly_orders' => $monthly_orders,
            'selected_month' => $formattedMonthYear, // Menggunakan format yang baru
        ];

        $data['formatCurrency'] = array($this->pdf, 'formatCurrency');

        $filename = 'LaporanBulanan';
        $paper = 'A4';
        $orientation = 'portrait';
        $view = $this->load->view('V_partials/dashboard/monthly_report_pdf', $data, true);

        $this->pdf->generate($view, $filename, $paper, $orientation);
    }

    public function Orders()
    {
        $orders = $this->M_pesanan->getAllOrderForAdmin();
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

    public function search_pesanan()
    {
        $keyword = $this->input->post('keyword');

        $data = [
            'title' => 'Edit Data',
            'header' => 'V_partials/dashboard/header',
            'navbar' => 'V_partials/dashboard/navbar',
            'sidebar' => 'V_partials/dashboard/sidebar',
            'footer' => 'V_partials/dashboard/footer',
            'js' => 'V_partials/dashboard/js',
            'active_tab' => 'OrderList'
        ];

        if ($keyword) {
            $data['orders'] = $this->M_pesanan->searchOrder($keyword);
            $data['search_result'] = true; // Tandai bahwa hasil pencarian akan ditampilkan
            $data['content'] =  'V_partials/dashboard/pesanan';
        } else {
            $data['orders'] = $this->M_pesanan->getAllOrderForAdmin();
            $data['search_result'] = false; // Tandai bahwa seluruh pesanan akan ditampilkan
            $data['content'] =  'V_partials/dashboard/pesanan';
        }

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
