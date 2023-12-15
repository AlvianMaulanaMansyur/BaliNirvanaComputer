<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_produk');
        $this->load->model('M_cart');
        $this->load->model('M_personalInfo');
        $this->load->model('M_pesanan');
        $this->load->model('Customer_model');
        $this->load->library('form_validation');

        if (empty($this->session->userdata('customer_id'))) {
            if ($this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo json_encode(['redirect' => base_url('AuthCustomer/login')]);
                exit();
            } else {
                redirect('AuthCustomer/login');
            }
        }
    }

    public function insertCart($id_produk)
    {
        $result = $this->M_cart->insertCart($id_produk);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error_message' => 'Gagal menambahkan produk ke keranjang.']);
        }
    }

    public function getCart()
    {
        $id = $this->session->userdata('customer_id');
        $cart['cart'] = $this->M_cart->getCart($id);
        if (!empty($cart['cart'])) {
            $data = array(
                'content' => 'V_user/cart',
                'title' => 'Cart',
                'cart' => $cart['cart'],
            );
        } else {
            $data = array(
                'content' => 'V_user/cart_kosong',
                'title' => 'Cart Kosong',
            );
        }
        $this->load->view('template', $data);
    }

    public function updateIsCheck($id_cart)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $is_checked = $this->input->post('is_check') ? 1 : 0;
            // Ambil nilai is_checked dari database
            $cart = $this->M_cart->getCartById($id_cart);
            $is_checked = $cart[0]['is_check'];

            // Toggle nilai is_checked (1 menjadi 0, 0 menjadi 1)
            $is_checked = 1 - $is_checked;

            // Update nilai is_checked di database
            $this->M_cart->updateIsCheck($id_cart, $is_checked);
            $this->updateTotalCheckedPrice();
            redirect('user/getcart'); // Gantilah dengan halaman yang sesuai
        } else {
            // Tindakan untuk metode HTTP selain POST (misalnya, jika diakses langsung melalui URL)
            show_404();
        }
    }

    public function updateTotalCheckedPrice()
    {
        $id_customer = $this->session->userdata('customer_id');
        $total_checked_price = $this->M_cart->calculateTotalCheckedPrice($id_customer);

        header('Content-Type: application/json');
        echo json_encode(['total_checked_price' => $total_checked_price]);
    }

    // Controller
    public function updateQuantity($id_cart)
    {
        $action = $this->input->post('action');

        $cart = $this->M_cart->getCartByID($id_cart);

        if (!empty($cart)) {
            $qty_produk = $cart[0]['qty_produk'];
            $result = $this->M_produk->getDetailProduk($cart[0]['id_produk']);
            $stok_produk = $result['stok_produk'];
            if ($action == 'increase' && $qty_produk < $stok_produk) {
                $qty_produk++;
            } else if ($action == 'decrease' && $qty_produk > 1) {
                $qty_produk--;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => ($action == 'increase' ? 'Qty melebihi stok' : 'Min qty adalah 1')]);
                return;
            }

            $this->M_cart->updateQuantity($id_cart, $qty_produk);

            $updatedCart = $this->M_cart->getCartByID($id_cart);

            header('Content-Type: application/json');
            echo json_encode($updatedCart[0]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Cart not found']);
        }
    }


    public function deleteCart($id_cart)
    {
        $this->M_cart->deleteProdukHasCart($id_cart);
        $this->M_cart->deleteCartItem($id_cart);
        redirect('user/getCart');
    }

    public function personalInfo()
    {
        $personal_info = $this->M_personalInfo->getPersonalInfo();

        $data = [
            'content' => 'V_user/personalInfo',
            'title' => 'Checkout',
            'personal' => $personal_info,
        ];

        $this->load->view('template', $data);
    }

    public function uploadPersonalInfo()
    {
        $this->M_personalInfo->insertPersonalInfo();
        redirect('user/checkout');
    }

    public function checkout()
    {
        $id = $this->session->userdata('customer_id');
        $checkout = $this->M_cart->getCheckout($id);
        $kota = $this->M_personalInfo->kotaKec();
        $personal_info = $this->M_personalInfo->getPersonalInfoByIdCustomer($id);

        if (!empty($checkout)) {
            // Lakukan validasi untuk setiap item dalam keranjang
            foreach ($checkout as $item) {
                $stockAvailable = $item['stok_produk'];

                if ($item['qty_produk'] > $stockAvailable) {
                    // Jika qty melebihi stok, tampilkan pesan kesalahan dan arahkan kembali ke halaman keranjang
                    $this->session->set_flashdata('error', 'Jumlah produk dalam keranjang melebihi stok yang tersedia.');
                    redirect('user/getcart');
                }
            }

            // Lanjutkan ke proses checkout jika validasi berhasil
            if (!empty($personal_info)) {
                $content = 'V_user/checkout1';
            } else {
                $content = 'V_user/checkout';
            }

            $data = [
                'content' => $content,
                'title' => 'Checkout',
                'cart' => $checkout,
                'kota' => $kota,
            ];
            $this->load->view('template', $data);
        } else {
            redirect('cart');
        }
    }


    public function transaksi()
    {
        $id_pesanan = $this->M_pesanan->createOrder();
        redirect('transaksi/' . $id_pesanan);
    }

    public function hlmTransaksi($id_pesanan)
    {
        $order = $this->M_pesanan->getOrder($id_pesanan);
        if (!empty($order)) {
            $data = [
                'title' => 'Transaksi',
                'content' => 'V_user/transaksi',
                'order' => $order,
            ];

            $this->load->view('template', $data);
        } else {
            redirect('user');
        }
    }

    public function Orders()
    {
        $id = $this->session->userdata('customer_id');
        $order = $this->M_pesanan->getAllOrder($id);
        $data = [
            'title' => 'Transaksi',
            'content' => 'V_user/pesanan',
            'orders' => $order,
        ];

        $this->load->view('template', $data);
    }
}

/* End of file User.php */
