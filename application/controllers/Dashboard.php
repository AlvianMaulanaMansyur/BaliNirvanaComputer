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

    public function delete_customer($id_customer)
    {
        
        $this->admin_model->delete_customer($id_customer);
        redirect('dashboard/admin');
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
            'orders' => $orders
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