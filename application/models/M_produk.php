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
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->where('produk.stok_produk >', 0);
        $this->db->where('foto_produk.urutan_foto', 1);
        $result = $this->db->get();
        $produk = $result->result_array();
        return $produk;
    }


    public function getDetailProduk($id)
    {
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->where('produk.stok_produk >', 0);
        $this->db->where('produk.id_produk', $id);
        $result = $this->db->get()->result_array();
    
        // Membuat array baru untuk menyimpan semua foto terkait produk
        $fotos = [];
        foreach ($result as $row) {
            $fotos[] = [
                'url_foto' => $row['url_foto'],
                'urutan_foto' => $row['urutan_foto'],
            ];
        }
    
        // Menambahkan array fotos ke hasil query
        $result[0]['fotos'] = $fotos;
    
        return $result[0];
    }
    

    public function insertProduk()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        // Check if the first photo is selected
        if (empty($_FILES['foto_produk1']['name'])) {
            echo "Please select a file for foto_produk1.";
            die;
        }

        if (!$this->upload->do_upload('foto_produk1')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
            die;
        }

        // Photo 1 is uploaded successfully
        $data1 = array('upload_data1' => $this->upload->data());
        $gambar_path1 = 'assets/foto/' . $data1['upload_data1']['file_name'];

        // Handle optional uploads for foto_produk2 and foto_produk3
        $data2 = array();
        if (!empty($_FILES['foto_produk2']['name'])) {
            if ($this->upload->do_upload('foto_produk2')) {
                $data2['upload_data2'] = $this->upload->data();
            } else {
                // Handle the case when the upload is not successful
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // Continue execution, as foto_produk2 is optional
            }
        }

        $data3 = array();
        if (!empty($_FILES['foto_produk3']['name'])) {
            if ($this->upload->do_upload('foto_produk3')) {
                $data3['upload_data3'] = $this->upload->data();
            } else {
                // Handle the case when the upload is not successful
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // Continue execution, as foto_produk3 is optional
            }
        }

        // Set default paths for images
        $gambar_path2 = isset($data2['upload_data2']) ? 'assets/foto/' . $data2['upload_data2']['file_name'] : '';
        $gambar_path3 = isset($data3['upload_data3']) ? 'assets/foto/' . $data3['upload_data3']['file_name'] : '';

        // Check if the file uploads were successful before accessing the data
        if (isset($data1['upload_data1'])) {
            $gambar_path1 = 'assets/foto/' . $data1['upload_data1']['file_name'];
        } else {
            // Handle the case when $data1['upload_data1'] is not set
            $gambar_path1 = ''; // Set a default value or handle accordingly
        }

        if (isset($data2['upload_data2'])) {
            $gambar_path2 = 'assets/foto/' . $data2['upload_data2']['file_name'];
        } else {
            // Handle the case when $data2['upload_data2'] is not set
            $gambar_path2 = ''; // Set a default value or handle accordingly
        }

        if (isset($data3['upload_data3'])) {
            $gambar_path3 = 'assets/foto/' . $data3['upload_data3']['file_name'];
        } else {
            // Handle the case when $data3['upload_data3'] is not set
            $gambar_path3 = ''; // Set a default value or handle accordingly
        }

        // var_dump($gambar_path1);
        // die;

        $insert_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'create_time' => date('Y-m-d H:i:s'),
        );

        $result = $this->db->insert('produk', $insert_data);
        $insert_id = $this->db->insert_id();

        if (!empty($gambar_path1)) {
            $this->saveFotoProduk($insert_id, $gambar_path1, 1);
        }

        if (!empty($gambar_path2)) {
            $this->saveFotoProduk($insert_id, $gambar_path2, 2);
        }

        if (!empty($gambar_path3)) {
            $this->saveFotoProduk($insert_id, $gambar_path3, 3);
        }
        return $result;
    }
    // In your M_produk model
    public function getProductPhotos($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->get('foto_produk')->result_array();
    }



    public function editProduk()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        // Check if the first photo is selected
        $data1 = array();
        if (!empty($_FILES['foto_produk1']['name'])) {
            if ($this->upload->do_upload('foto_produk1')) {
                $data1['upload_data1'] = $this->upload->data();
            } else {
                // Handle the case when the upload is not successful
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // Continue execution, as foto_produk1 is optional
            }
        }

        // Handle optional uploads for foto_produk2 and foto_produk3
        $data2 = array();
        if (!empty($_FILES['foto_produk2']['name'])) {
            if ($this->upload->do_upload('foto_produk2')) {
                $data2['upload_data2'] = $this->upload->data();
            } else {
                // Handle the case when the upload is not successful
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // Continue execution, as foto_produk2 is optional
            }
        }

        $data3 = array();
        if (!empty($_FILES['foto_produk3']['name'])) {
            if ($this->upload->do_upload('foto_produk3')) {
                $data3['upload_data3'] = $this->upload->data();
            } else {
                // Handle the case when the upload is not successful
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // Continue execution, as foto_produk3 is optional
            }
        }

        // Set default paths for images
        $gambar_path1 = isset($data1['upload_data1']) ? 'assets/foto/' . $data1['upload_data1']['file_name'] : '';
        $gambar_path2 = isset($data2['upload_data2']) ? 'assets/foto/' . $data2['upload_data2']['file_name'] : '';
        $gambar_path3 = isset($data3['upload_data3']) ? 'assets/foto/' . $data3['upload_data3']['file_name'] : '';
        $id_produk = $this->input->post('id_produk');

        // Check if the file uploads were successful before accessing the data
        if (isset($data1['upload_data1'])) {
            $gambar_path1 = 'assets/foto/' . $data1['upload_data1']['file_name'];
        } else {
            // Handle the case when $data1['upload_data1'] is not set
            $gambar_path1 = ''; // Set a default value or handle accordingly
        }

        if (isset($data2['upload_data2'])) {
            $gambar_path2 = 'assets/foto/' . $data2['upload_data2']['file_name'];
        } else {
            // Handle the case when $data2['upload_data2'] is not set
            $gambar_path2 = ''; // Set a default value or handle accordingly
        }

        if (isset($data3['upload_data3'])) {
            $gambar_path3 = 'assets/foto/' . $data3['upload_data3']['file_name'];
        } else {
            // Handle the case when $data3['upload_data3'] is not set
            $gambar_path3 = ''; // Set a default value or handle accordingly
        }

        $update_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
        );

        $this->db->where('id_produk', $id_produk);
        $result = $this->db->update('produk', $update_data);

        if (!empty($gambar_path1)) {
            $this->saveFotoProduk($id_produk, $gambar_path1, 1);
        }

        if (!empty($gambar_path2)) {
            $this->saveFotoProduk($id_produk, $gambar_path2, 2);
        }

        if (!empty($gambar_path3)) {
            $this->saveFotoProduk($id_produk, $gambar_path3, 3);
        }

        $this->updateFotoProduk($id_produk, $gambar_path1, $gambar_path2, $gambar_path3);

        return $result;
    }


    private function saveFotoProduk($id_produk, $gambar_path, $urutan_foto)
    {
        // Check if $gambar_path is not empty before saving
        if (!empty($gambar_path)) {
            // Check if the entry already exists for the given $id_produk and $urutan_foto
            $existing_data = $this->db->get_where('foto_produk', array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto))->row();

            if ($existing_data) {
                // Update existing entry
                $this->db->update('foto_produk', array('url_foto' => $gambar_path), array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto));
            } else {
                // Insert new entry
                $insert_data = array(
                    'id_produk' => $id_produk,
                    'url_foto' => $gambar_path,
                    'urutan_foto' => $urutan_foto
                );

                $this->db->insert('foto_produk', $insert_data);
            }
        }
    }

    private function updateFotoProduk($id_produk, $gambar_path1, $gambar_path2, $gambar_path3)
    {
        // Update foto_produk untuk urutan_foto = 1 (foto_produk1) jika gambar_path1 tidak kosong
        if (!empty($gambar_path1)) {
            $this->db->update('foto_produk', array('url_foto' => $gambar_path1), array('id_produk' => $id_produk, 'urutan_foto' => 1));
        }

        // Update foto_produk untuk urutan_foto = 2 (foto_produk2) jika gambar_path2 tidak kosong
        if (!empty($gambar_path2)) {
            $this->db->update('foto_produk', array('url_foto' => $gambar_path2), array('id_produk' => $id_produk, 'urutan_foto' => 2));
        }

        // Update foto_produk untuk urutan_foto = 3 (foto_produk3) jika gambar_path3 tidak kosong
        if (!empty($gambar_path3)) {
            $this->db->update('foto_produk', array('url_foto' => $gambar_path3), array('id_produk' => $id_produk, 'urutan_foto' => 3));
        }
    }



    public function deleteProduk($id_produk)
    {
        // Hapus terlebih dahulu foto_produk yang terkait
        $this->db->delete('foto_produk', array('id_produk' => $id_produk));

        // Baru hapus produknya
        $this->db->delete('produk', array('id_produk' => $id_produk));
    }


    public function getCategory()
    {
        $result = $this->db->get('category');
        $category = $result->result_array();
        return $category;
    }

    public function getDetailCategory($id)
    {
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->where('produk.id_category', $id);
        $this->db->where('produk.stok_produk != ', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function updateStok($id_pesanan)
    {
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

    //search untuk mencari data barang di admin dashboard
    public function search_data_produk($keyword)
    {

        $this->db->select('produk. *, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->like('produk.nama_produk', $keyword);
        $this->db->or_like('produk.id_produk', $keyword);
        $this->db->or_like('category.nama_category', $keyword);
        $query = $this->db->get();
        return $query->result();
    }


    //search untuk main menu
    public function searchProduk($keyword)
    {
        $this->db->select('produk.*, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('foto_produk', 'produk.id_produk = produk.id_produk', 'left');
        $this->db->like('nama_produk', $keyword);
        $this->db->where('foto_produk.urutan_foto', 1);
        
        $query = $this->db->get();

        return $query->result_array();
    }
}



/* End of file M_produk.php */
