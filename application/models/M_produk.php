<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getProduk()
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $result = $this->db->get();
        $produk = $result->result_array();
    
        // Format harga_produk ke format uang Rupiah
        // foreach ($produk as &$item) {
        //     $item['harga_produk'] = 'Rp ' . number_format($item['harga_produk'], 0, ',', '.');
        // }
    
        return $produk;
    }
    

    public function getProdukForCustomer()
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->where('produk.stok_produk >', 0);
        $result = $this->db->get();
        $produk = $result->result_array();
        return $produk;
    }


    public function getDetailProduk($id)
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->where('produk.id_produk', $id);
        $result = $this->db->get()->result_array();
        return $result[0];
    }

    public function insertProduk()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_produk')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
        } else {
            $data = array('upload_data' => $this->upload->data());

            $gambar_path = $data['upload_data']['file_name']; 

            $insert_data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'id_category' => $this->input->post('id_category'),
                'id_admin' => $this->input->post('id_admin'),
                'stok_produk' => $this->input->post('stok_produk'),
                'harga_produk' => $this->input->post('harga_produk'),
                'deskripsi_produk' => $this->input->post('deskripsi_produk'),
                'foto_produk' => 'assets/foto/' . $gambar_path,
            );
            // var_dump($insert_data);die;
            $result = $this->db->insert('produk', $insert_data);
            return $result;
        }
    }
    
    public function editProduk()
    {
        
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!empty($_FILES['foto_produk']['name'])) {
            if ($this->upload->do_upload('foto_produk')) {
                $data = array('upload_data' => $this->upload->data());
                $gambar_path = 'assets/foto/'.$data['upload_data']['file_name'];
            } else {
                $error = array('error' => $this->upload->display_errors());
                echo $error['error'];
                return false;
            }
        } else {
            $gambar_path = $this->input->post('gambar_lama');
        }

        $update_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'foto_produk' => $gambar_path,
        );

        $this->db->where('id_produk', $this->input->post('id_produk'));
        $result = $this->db->update('produk', $update_data);

        return $result;
    }

    public function deleteProduk($id)
    {
        $this->db->where('id_produk', $id);
        $result = $this->db->delete('produk');
        return $result;
    }

    public function getCategory()
    {
        $result = $this->db->get('category');
        $category = $result->result_array();
        return $category;
    }

    public function getDetailCategory($id)
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->where('produk.id_category', $id);
        $this->db->where('produk.stok_produk != ', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function updateStok($id_pesanan) {
        $this->db->select('pesanan.id_pesanan, detail_pesanan.id_produk, detail_pesanan.qty_produk, produk.stok_produk');
        $this->db->from('pesanan');
        $this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan', 'left');
        $this->db->join('produk', 'detail_pesanan.id_produk = produk.id_produk', 'left');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);
    
        $result = $this->db->get();
        $stok = $result->result_array();
    
        foreach ($stok as $key) {
            $this->db->where('produk.id_produk', $key['id_produk']);
            $kurang = $key['stok_produk'] - $key['qty_produk'];
            $this->db->update('produk', array('stok_produk' => $kurang));
        }
    }

    public function search_data_produk($keyword){

        $this->db->select('produk. *, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->like('produk.nama_produk', $keyword);
        $this->db->or_like('produk.id_produk', $keyword);
        $this->db->or_like('category.nama_category', $keyword);
        $query = $this->db->get();
        return $query->result();
    } 

    public function searchProduk($keyword){
        $this->db->like('nama_produk', $keyword);
        $query = $this->db->get('produk');

        return $query->result_array();
    }


    
}



/* End of file M_produk.php */
