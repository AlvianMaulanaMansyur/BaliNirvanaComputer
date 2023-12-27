<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pesanan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getOrder($id_pesanan)
    {
        $this->db->select('pesanan.*, detail_pesanan.*, produk.nama_produk, produk.harga_produk, customer.nama_customer, customer.email,customer.telepon, personal_info.id_personal_info, personal_info.id_kecamatan, personal_info.kodepos, kota_kab.kota, kecamatan.kecamatan');
        $this->db->from('pesanan');
        $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
        $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
        $this->db->join('customer', 'pesanan.id_customer = customer.id_customer', 'left');
        $this->db->join('personal_info', 'pesanan.id_customer = personal_info.id_customer', 'left');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $cart = $result->result_array();

            return $cart;
        } else {
            return array();
        }
    }

    public function searchOrder($keyword)
    {
      
        $this->db->select('pesanan.*, detail_pesanan.*, produk.nama_produk, produk.harga_produk, foto_produk.url_foto, foto_produk.urutan_foto, customer.nama_customer, customer.email,customer.telepon, personal_info.id_personal_info, personal_info.id_kecamatan, personal_info.kodepos, kota_kab.kota, kecamatan.kecamatan');
        $this->db->from('pesanan');
        $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
        $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
        $this->db->join('foto_produk', 'detail_pesanan.id_produk = foto_produk.id_produk', 'left');
        $this->db->join('customer', 'pesanan.id_customer = customer.id_customer', 'left');
        $this->db->join('personal_info', 'pesanan.id_customer = personal_info.id_customer', 'left');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('foto_produk.urutan_foto', 1);

        // Menambahkan kondisi pencarian berdasarkan nama_customer atau alamat_pengiriman
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('customer.nama_customer', $keyword);
            $this->db->or_like('produk.nama_produk', $keyword);
            $this->db->or_like('personal_info.alamat', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('pesanan.status_pesanan', 'asc');
        $this->db->order_by('pesanan.create_time', 'asc');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $orders = array();

            foreach ($result->result_array() as $row) {
                $nomor_pesanan = $row['id_pesanan'];

                // Jika invoice belum ada dalam array, tambahkan
                if (!isset($orders[$nomor_pesanan])) {
                    $orders[$nomor_pesanan] = array(
                        'details' => array(),
                        'total' => 0
                    );
                }

                $orders[$nomor_pesanan]['details'][] = array(
                    'nama_customer' => $row['nama_customer'],
                    'telepon' => $row['telepon'],
                    'status_pesanan' => $row['status_pesanan'],
                    'alamat_pengiriman' => $row['alamat_pengiriman'],
                    'detail_alamat_pengiriman' => $row['detail_alamat_pengiriman'],
                    'nama_produk' => $row['nama_produk'],
                    'harga_produk' => $row['harga_produk'],
                    'qty_produk' => $row['qty_produk'],
                    'subtotal' => $row['harga_produk'] * $row['qty_produk'],
                    'url_foto' => $row['url_foto'],

                );
                $orders[$nomor_pesanan]['id_pesanan'] = $nomor_pesanan;
                $orders[$nomor_pesanan]['status'] = $row['status_pesanan'];
                $orders[$nomor_pesanan]['total'] += $row['harga_produk'] * $row['qty_produk'];
                $orders[$nomor_pesanan]['create_time'] = $row['create_time'];

            }
            return $orders;
        } else {
            return array();
        }
    }



    public function getAllOrder($id_customer)
    {
        $this->db->select('pesanan.*, detail_pesanan.*, produk.nama_produk, produk.harga_produk, foto_produk.url_foto, foto_produk.urutan_foto, customer.nama_customer, customer.email,customer.telepon, personal_info.id_personal_info, personal_info.id_kecamatan, personal_info.kodepos, kota_kab.kota, kecamatan.kecamatan');
        $this->db->from('pesanan');
        $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
        $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
        $this->db->join('foto_produk', 'detail_pesanan.id_produk = foto_produk.id_produk', 'left');
        $this->db->join('customer', 'pesanan.id_customer = customer.id_customer', 'left');
        $this->db->join('personal_info', 'pesanan.id_customer = personal_info.id_customer', 'left');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('pesanan.id_customer', $id_customer);
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->order_by('pesanan.status_pesanan', 'asc');
        $this->db->order_by('pesanan.create_time', 'asc');

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $orders = array();

            foreach ($result->result_array() as $row) {
                $id_pesanan = $row['id_pesanan'];

                // Jika invoice belum ada dalam array, tambahkan
                if (!isset($orders[$id_pesanan])) {
                    $orders[$id_pesanan] = array(
                        'details' => array(),
                        'total' => 0
                    );
                }

                $orders[$id_pesanan]['details'][] = array(
                    'nama_produk' => $row['nama_produk'],
                    'harga_produk' => $row['harga_produk'],
                    'qty_produk' => $row['qty_produk'],
                    'subtotal' => $row['harga_produk'] * $row['qty_produk'],
                    'url_foto' => $row['url_foto'],
                );

                $orders[$id_pesanan]['total'] += $row['harga_produk'] * $row['qty_produk'];
                $orders[$id_pesanan]['status_pesanan'] = $row['status_pesanan'];
                $orders[$id_pesanan]['create_time'] = $row['create_time'];
            }

            return $orders;
        } else {
            return array();
        }
    }
    // Di model M_pesanan, tambahkan fungsi berikut:

    // Di model M_pesanan, update fungsi getOrderCount menjadi seperti berikut:

    public function getOrderCount($id_customer)
    {
        $this->db->select('COUNT(DISTINCT id_pesanan) as order_count');
        $this->db->from('pesanan');
        $this->db->where('id_customer', $id_customer);

        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $row = $result->row_array();
            return $row['order_count'];
        } else {
            return 0;
        }
    }



    public function getAllOrderForAdmin()
    {
        $this->db->select('pesanan.*, detail_pesanan.*, produk.nama_produk, produk.harga_produk, foto_produk.url_foto, foto_produk.urutan_foto, customer.nama_customer, customer.email,customer.telepon, personal_info.id_personal_info, personal_info.id_kecamatan, personal_info.kodepos, kota_kab.kota, kecamatan.kecamatan');
        $this->db->from('pesanan');
        $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
        $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
        $this->db->join('foto_produk', 'detail_pesanan.id_produk = foto_produk.id_produk', 'left');
        $this->db->join('customer', 'pesanan.id_customer = customer.id_customer', 'left');
        $this->db->join('personal_info', 'pesanan.id_customer = personal_info.id_customer', 'left');
        $this->db->join('kecamatan', 'personal_info.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('kota_kab', 'kecamatan.id_kota_kab = kota_kab.id_kota_kab', 'left');
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->order_by('pesanan.status_pesanan', 'asc');
        $this->db->order_by('pesanan.create_time', 'asc');


        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            $orders = array();

            foreach ($result->result_array() as $row) {
                $nomor_pesanan = $row['id_pesanan'];

                // Jika invoice belum ada dalam array, tambahkan
                if (!isset($orders[$nomor_pesanan])) {
                    $orders[$nomor_pesanan] = array(
                        'details' => array(),
                        'total' => 0
                    );
                }

                $orders[$nomor_pesanan]['details'][] = array(
                    'nama_customer' => $row['nama_customer'],
                    'telepon' => $row['telepon'],
                    'status_pesanan' => $row['status_pesanan'],
                    'alamat_pengiriman' => $row['alamat_pengiriman'],
                    'detail_alamat_pengiriman' => $row['detail_alamat_pengiriman'],
                    'nama_produk' => $row['nama_produk'],
                    'harga_produk' => $row['harga_produk'],
                    'qty_produk' => $row['qty_produk'],
                    'subtotal' => $row['harga_produk'] * $row['qty_produk'],
                    'url_foto' => $row['url_foto'],

                );
                $orders[$nomor_pesanan]['id_pesanan'] = $nomor_pesanan;
                $orders[$nomor_pesanan]['status'] = $row['status_pesanan'];
                $orders[$nomor_pesanan]['total'] += $row['harga_produk'] * $row['qty_produk'];
                $orders[$nomor_pesanan]['create_time'] = $row['create_time'];

            }
            return $orders;
        } else {
            return array();
        }
    }

    public function createOrder()
    {
        $customer_id = $this->session->userdata('customer_id');

        $cart_data = $this->M_cart->getCheckout($customer_id);
        $this->M_personalInfo->insertPersonalInfo();
        $personal_info = $this->M_personalInfo->getPersonalInfoByIdCustomer($customer_id);
        $alamat = $this->input->post('alamat');
        $detail_alamat = $this->input->post('detail_alamat');
        // var_dump($personal_info);die;
        $order_data = array(
            'id_customer' => $customer_id,
            'alamat_pengiriman' => $alamat . ', ' . $personal_info[0]['kecamatan'] . ', ' . $personal_info[0]['kota'] . ', ' . $personal_info[0]['kodepos'],
            'detail_alamat_pengiriman' => $detail_alamat,
            'status_pesanan' => '0',
        );
        
        $this->insertOrder($order_data);
        $id_pesanan = $this->db->insert_id();

        foreach ($cart_data as $cart_item) {
            $order_item = array(
                'id_produk' => $cart_item['id_produk'],
                'id_pesanan' => $id_pesanan,
                'qty_produk' => $cart_item['qty_produk'],
            );

            $this->detailOrder($order_item);
            $this->M_cart->deleteProdukHasCart($cart_item['id_cart']);
            $this->M_cart->deleteCartItem($cart_item['id_cart']);
        }
        return $id_pesanan;
    }

    public function insertOrder($order_item)
    {
        $this->db->insert('pesanan', $order_item);
    }

    public function detailOrder($order_data)
    {
        $this->db->insert('detail_pesanan', $order_data);
    }

    public function getMonthlyOrders($monthYear)
    {
        $dateParts = explode('-', $monthYear);

        if (count($dateParts) >= 2) {
            $month = $dateParts[1];
            $year = $dateParts[0];

            $start_date = date("$year-$month-01 00:00:00");
            $end_date = date("Y-m-t 23:59:59", strtotime($start_date));

            $this->db->select('pesanan.*, customer.nama_customer, detail_pesanan.*, produk.harga_produk, produk.nama_produk');
            $this->db->from('pesanan');
            $this->db->join('customer', 'pesanan.id_customer = customer.id_customer', 'left');
            $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
            $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
            $this->db->where('status_pesanan', '1');
            $this->db->where('pesanan.create_time >=', $start_date);
            $this->db->where('pesanan.create_time <=', $end_date);

            $query = $this->db->get();

            return $query->result_array();
        } else {
            return [];
        }
    }
}

/* End of file M_pesanan.php */
