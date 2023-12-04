<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->model('M_produk');
    }

    public function login()
    {
        if (empty($this->session->userdata('admin_name'))) {
            $data = [
                'header' => 'V_partials/loginRegister/header',
                'content' => 'V_partials/loginRegister/login',
                'js' => 'V_partials/loginRegister/js'
            ];
            $this->load->view('loginAdmin', $data);
        } else {
            redirect('dashboard/admin');
        }
    }


    public function sess()
    {

        if ($this->session->userdata('logged_in')) {
            redirect('dashboard/admin');
        } else {
            redirect('auth/login');
        }
    }


    public function process_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin = $this->admin_model->get_admin($username, $password);

        if ($admin) {
            $admin_data = array(
                'admin_id' => $admin->id_admin,
                'admin_name' => $admin->nama_admin,
                'logged_in' => true
            );
            $this->session->set_userdata($admin_data);
            redirect('dashboard/admin');
        } else {
            // Tampilkan pesan error jika login gagal
            $this->session->set_flashdata('error_message', 'Incorrect Username or Password!');
            redirect('auth/login');
        }
    }
}

/* End of file Auth.php */
