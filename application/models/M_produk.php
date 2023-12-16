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

        $gambar_paths = array();

        for ($i = 1; $i <= 3; $i++) {
            if (!empty($_FILES['foto_produk' . $i]['name'])) {
                if ($this->upload->do_upload('foto_produk' . $i)) {
                    $data['upload_data' . $i] = $this->upload->data();
                    $gambar_paths[] = 'assets/foto/' . $data['upload_data' . $i]['file_name'];
                } else {
                    // Handle the case when the upload is not successful
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    // Continue execution, as foto_produk2 and foto_produk3 are optional
                    $gambar_paths[] = ''; // Set a default value or handle accordingly
                }
            } else {
                $gambar_paths[] = ''; // Set a default value or handle accordingly
            }
        }

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

        for ($i = 1; $i <= 3; $i++) {
            if (!empty($gambar_paths[$i - 1])) {
                $this->saveFotoProduk($insert_id, $gambar_paths[$i - 1], $i);
            }
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
        $gambar_paths = array();

        for ($i = 1; $i <= 3; $i++) {
            $data = array();
            if (!empty($_FILES['foto_produk' . $i]['name'])) {
                if ($this->upload->do_upload('foto_produk' . $i)) {
                    $data['upload_data' . $i] = $this->upload->data();
                    $gambar_paths[$i] = 'assets/foto/' . $data['upload_data' . $i]['file_name'];
                } else {
                    // Handle the case when the upload is not successful
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    // Continue execution, as foto_produk is optional
                    $gambar_paths[$i] = ''; // Set a default value or handle accordingly
                }
            } else {
                $gambar_paths[$i] = ''; // Set a default value or handle accordingly
            }
        }

        $id_produk = $this->input->post('id_produk');

        $update_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
        );

        $this->db->where('id_produk', $id_produk);
        $this->db->update('produk', $update_data);

        for ($i = 1; $i <= 3; $i++) {
            if (!empty($gambar_paths[$i])) {
                $this->deleteOldFoto($id_produk, $i);
                $this->saveFotoProduk($id_produk, $gambar_paths[$i], $i);
            }
        }

        return $id_produk;
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

    private function deleteOldFoto($id_produk, $urutan_foto)
    {
        // Get the old photo path from the database
        $oldFoto = $this->db->select('url_foto')->where(array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto))->get('foto_produk')->row();

        if ($oldFoto && !empty($oldFoto->url_foto)) {
            // Delete the old photo file
            $oldFilePath = './' . $oldFoto->url_foto;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    }

    public function deleteProduk($id_produk)
    {
        $foto_info = $this->db->select('url_foto')->where('id_produk', $id_produk)->get('foto_produk')->result();

        $this->db->where('id_produk', $id_produk);
        $this->db->delete('foto_produk');

        // Delete the product
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('produk');

        // Delete associated photos
        foreach ($foto_info as $foto) {
            if ($foto && !empty($foto->url_foto)) {
                $foto_path = './' . $foto->url_foto;
                if (file_exists($foto_path)) {
                    unlink($foto_path);
                }
            }
        }
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
