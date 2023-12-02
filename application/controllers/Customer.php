<?php
class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
        
    }

    public function login() {
        $data = [
            'header' => 'V_partials/loginRegister/header',
            'content' => 'V_partials/loginRegister/login2',
            'js' => 'V_partials/loginRegister/js',

        ];
        $this->load->view('customer/loginView', $data);
    }

    public function Main()
    {
        $this->load->view('Main/landingPages');
    } 

    public function process_login() {

        $username = $this->input->post('username');
        $password = $this->input->post('password_customer');

        $customer = $this->Customer_model->login($username, $password);

        if ($customer) {
            $customer_data = array(
                'customer_id' => $customer->id_customer,
                'customer_name' => $customer->nama_customer,
                'logged_in' => true
            );
            $this->session->set_userdata($customer_data);
            redirect('Customer/Main');
        } else {
            // Tampilkan pesan error jika login gagal
            $this->session->set_flashdata('error_message', 'Login Gagal');
            redirect('Customer/login');
        }

    }

    public function register() {
        $this->form_validation->set_rules('username','Username', 'required|trim', array(
            'required'=>'colom harus di isi'
        ));
        $this->form_validation->set_rules('password_customer','Password Customer', 'required|trim');
        $this->form_validation->set_rules('nama_customer','Nama Customer', 'required|trim');
        $this->form_validation->set_rules('email','Email', 'required|trim');
        $this->form_validation->set_rules('telepon','Telepon', 'required|trim');

        if($this->form_validation->run() == FALSE){

            $data = [
                'header' => 'V_partials/loginRegister/header',
                'content' => 'V_partials/loginRegister/register',
                'js' => 'V_partials/loginRegister/js'
            ];
            $this->load->view('customer/registerCustomer', $data);
            
        } else {
           
                $username = $this->input->post('username');
                $password_customer = $this->input->post('password_customer');
                $nama_customer = $this->input->post('nama_customer');
                $email = $this->input->post('email');
                $telepon = $this->input->post('telepon');
                
                $data = array (
                    'username' => $username,
                    'password_customer' => $password_customer,
                    'nama_customer' => $nama_customer,
                    'email' => $email,
                    'telepon' => $telepon
                );

               $this->db->insert('customer', $data);
               redirect('customer/login');
               
        }
       
    }


}
?>
