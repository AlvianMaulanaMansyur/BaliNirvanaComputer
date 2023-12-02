<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_cart extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    // In your M_cart.php model

    public function updateQuantity($id_cart, $qty_produk)
    {
        $data = array(
            'qty_produk' => $qty_produk
        );

        $this->db->where('id_cart', $id_cart);
        $this->db->update('produk_has_cart', $data);
    }

    public function saveQuantity($id_cart, $action)
    {
        // Ambil jumlah produk saat ini dari database
        $current_quantity = $this->db->get_where('produk_has_cart', ['id_cart' => $id_cart])->row()->qty_produk;

        // Hitung jumlah produk baru berdasarkan aksi yang dipilih
        $new_quantity = ($action == 'increase') ? $current_quantity + 1 : max(1, $current_quantity - 1);

        // Simpan perubahan jumlah produk ke database
        $this->db->set('qty_produk', $new_quantity);
        $this->db->where('id_cart', $id_cart);
        $this->db->update('produk_has_cart');
    }

    // Tambahkan fungsi berikut di dalam model M_cart.php
    public function calculateTotalCheckedPrice($id_customer)
    {
        $this->db->select('SUM(produk.harga_produk * produk_has_cart.qty_produk) as total_checked_price');
        $this->db->from('cart');
        $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->where('cart.id_customer', $id_customer);
        $this->db->where('produk_has_cart.is_check', 1);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $total_checked_price = $result->row()->total_checked_price;
            return $total_checked_price ? $total_checked_price : 0;
        } else {
            return 0;
        }
    }


    public function insertCart($id)
    {
        $produk = $this->M_produk->getDetailProduk($id);

        if ($produk) {
            $customerId = $this->session->userdata('customer_id');;

            $qty = $this->input->post('qty_produk');

            $this->db->select('produk_has_cart.*, cart.id_customer');
            $this->db->from('produk_has_cart');
            $this->db->join('cart', 'produk_has_cart.id_cart = cart.id_cart', 'left');
            $this->db->where('id_produk', $produk['id_produk']);
            $this->db->where('id_customer', $customerId);

            $result = $this->db->get();
            $existingCart = $result->result_array();

            if (!empty($existingCart)) {
                // Update kuantitas jika produk sudah ada di keranjang
                $newQty = (int)$existingCart[0]['qty_produk'] + (int)$qty;
                if ($newQty <= $produk['stok_produk']) {
                    $this->db->where('id_produk', $produk['id_produk']);
                    $this->db->where('id_cart', $existingCart[0]['id_cart']);
                    $this->db->update('produk_has_cart', ['qty_produk' => $newQty, 'is_check' => 1]);
                    return true;
                } else {
                    return false;
                }
            } else {

                if ($qty <= $produk['stok_produk']) {
                    $cart_data = array(
                        'id_customer' => $this->session->userdata('customer_id'),
                    );

                    $result_cart = $this->db->insert('cart', $cart_data);

                    $id_cart = $this->db->insert_id();

                    $produk_has_cart_data = array(
                        'id_produk' => $produk['id_produk'],
                        'id_cart' => $id_cart,
                        'qty_produk' => $this->input->post('qty_produk'),
                        'is_check' => 1,
                    );

                    $result_produk_has_cart = $this->db->insert('produk_has_cart', $produk_has_cart_data);

                    return true;
                }
            }
        }
    }

    public function getCartByCustomerId($id_customer)
    {
        $this->db->select('cart.*, produk_has_cart.id_produk');
        $this->db->from('cart');
        $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->where('cart.id_customer', $id_customer);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateIsCheck($id_cart, $is_checked)
    {
        $this->db->set('is_check', $is_checked);
        $this->db->where('id_cart', $id_cart);
        $this->db->update('produk_has_cart');
    }

    public function deleteCartItem($id_cart)
    {
        $this->db->where('id_cart', $id_cart);
        $this->db->delete('cart');
    }

    public function deleteProdukHasCart($id_cart)
    {
        $this->db->where('id_cart', $id_cart);
        $this->db->delete('produk_has_cart');
    }

    public function deleteCartByCustomerId($id_customer)
    {
        $this->db->where('id_customer', $id_customer);
        $this->db->delete('cart');
    }

    public function increaseQty($id_cart, $operator)
    {
        $this->db->select('produk_has_cart.*, produk.stok_produk');
        $this->db->from('produk_has_cart');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->where('produk_has_cart.id_cart', $id_cart);
        $result = $this->db->get();
        $produk = $result->result_array();

        if ($operator == '+1') {
            if ($produk[0]['stok_produk'] > $produk[0]['qty_produk']) {
                $this->db->set('qty_produk', 'qty_produk ' . $operator, FALSE);
                $this->db->where('id_cart', $id_cart);
                $result = $this->db->update('produk_has_cart');
                return $result;
            } else {
            }
        } else if ($operator == '-1') {
            if ($produk[0]['qty_produk'] > 1) {
                $this->db->set('qty_produk', 'qty_produk ' . $operator, FALSE);
                $this->db->where('id_cart', $id_cart);
                $result = $this->db->update('produk_has_cart');
                return $result;
            } else if ($produk[0]['qty_produk'] == 1) {
            }
        }
    }

    public function updateQty($id_cart)
    {
        $this->db->select('*');
        $this->db->from('cart');
        $this->db->where('id_cart', $id_cart);
    }

    public function getCart($id_customer)
    {
        $this->db->select('cart.*, produk_has_cart.id_produk, produk_has_cart.qty_produk, produk_has_cart.is_check, produk.nama_produk, produk.harga_produk, produk.foto_produk, produk.stok_produk');
        $this->db->from('cart');
        $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->where('cart.id_customer', $id_customer);
        $this->db->order_by('cart.create_time', 'asc');
        

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $cart = $result->result_array();

            return $cart;
        } else {
            return array();
        }
    }

    // public function getCheckout($id_customer)
    // {
    //     $this->db->select('cart.*, produk_has_cart.id_produk, produk_has_cart.qty_produk, produk_has_cart.is_check, produk.nama_produk, produk.harga_produk, produk.foto_produk, produk.stok_produk');
    //     $this->db->from('cart');
    //     $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
    //     $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
    //     $this->db->where('cart.id_customer', $id_customer);
    //     $this->db->where('produk_has_cart.is_check', 1);


    //     $result = $this->db->get();

    //     if ($result->num_rows() > 0) {
    //         $cart = $result->result_array();

    //         return $cart;
    //     } else {
    //         return array();
    //     }
    // }

    public function getCheckout($id_customer)
    {
        $this->db->select('cart.*, produk_has_cart.id_produk, produk_has_cart.qty_produk ,produk_has_cart.is_check, produk.nama_produk, produk.harga_produk, customer.nama_customer, customer.email,customer.telepon, personal_info.id_personal_info, personal_info.id_kecamatan, personal_info.kodepos, personal_info.alamat,personal_info.detail_alamat, kota_kab.kota, kota_kab.id_kota_kab, kecamatan.kecamatan');
        $this->db->from('cart');
        $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->join('customer', 'cart.id_customer = customer.id_customer', 'left');
        $this->db->join('personal_info', 'customer.id_customer = personal_info.id_customer', 'left');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kota_kab.id_kota_kab = kecamatan.id_kota_kab', 'left');
        $this->db->where('cart.id_customer', $id_customer);
        $this->db->where('produk_has_cart.is_check', 1);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $cart = $result->result_array();

            return $cart;
        } else {
            return array();
        }
    }


    public function getCartByID($id_cart)
    {
        $this->db->select('cart.*, produk_has_cart.id_produk, produk_has_cart.qty_produk, produk_has_cart.is_check, produk.nama_produk, produk.harga_produk, produk.foto_produk, produk.stok_produk');
        $this->db->from('cart');
        $this->db->join('produk_has_cart', 'cart.id_cart = produk_has_cart.id_cart', 'left');
        $this->db->join('produk', 'produk_has_cart.id_produk = produk.id_produk', 'left');
        $this->db->where('cart.id_cart', $id_cart);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    // Di model M_cart.php
    public function updateCartStatus($id_cart, $is_checked)
    {
        $data = array(
            'is_check' => $is_checked,
        );

        $this->db->where('id_cart', $id_cart);
        $this->db->update('cart', $data);
    }
}

/* End of file M_cart.php */
