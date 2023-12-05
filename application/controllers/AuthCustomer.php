<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthCustomer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('session');      
        $this->load->library('form_validation');  
    }

  
    public function login() {
        if (empty($this->session->userdata('email'))){
            $data = [
                'header' => 'V_partials/loginRegister/header',
                'content' => 'V_partials/loginRegister/login2',
                'js' => 'V_partials/loginRegister/js'
    
            ];
        $this->load->view('customer/loginView', $data);

        } else {
            redirect('home');
        }

        
    }


    public function process_login() {

        $email = $this->input->post('email');
        $password = $this->input->post('password_customer');

        $customer = $this->Customer_model->login($email, $password);

        if ($customer) {
            $customer_data = array(
                'customer_id' => $customer->id_customer,
                'email' => $customer->email,
                'logged_in' => true
            );
            $this->session->set_userdata($customer_data);
            redirect('home');
        } else {
            // Tampilkan pesan error jika login gagal
            $this->session->set_flashdata('error_message', 'Login Gagal');
            redirect('authCustomer/login');
        }

    }
    public function sess()
    {

        if ($this->session->userdata('logged_in')) {
            redirect('home');
        } else {
            redirect('authCustomer/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('customer_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
        redirect('AuthCustomer/login');
    }

    public function register() {
        $this->form_validation->set_rules('username','Username', 'required|trim|min_lenght[8]|is_unique[customer.username]|alpha_numeric', array(
            'required'=>'username cannot be empty!',
            'min_lenght' => 'username must be at least 8 characters!',
            'is_unique' => 'username already taken!',
            'alpha_numeric' => 'test'
        ));
        $this->form_validation->set_rules('password_customer','Password Customer', 'required|trim|min_lenght[8]|regex_match[/[0-9]/]', array(
            'required' => 'password cannot be empty!',
            'min_lenght' => 'password must be at least 8 characters!',
            'regex_match' => 'password must contain at least 1 number'
        ));
        $this->form_validation->set_rules('nama_customer','Nama Customer', 'required|trim', array(
            'required' => 'name cannot be empty!'
        ));

        $this->form_validation->set_rules('email','Email', 'required|trim|valid_email|is_unique[customer.email]',array(
            'required' => 'email cannot be empty!',
            'is_unique' => 'email already taken!'
        ));
        $this->form_validation->set_rules('telepon','Telepon', 'required|trim|numeric', array(
            'required' => 'phone number cannot be empty!'
        ));

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

/* End of file AuthCustomer.php */

?>