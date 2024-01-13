<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                    $gambar_paths[] = ''; // Set a default value or handle accordingly
                }
            } else {
                $gambar_paths[] = ''; // Set a default value or handle accordingly
            }
        }
        $harga_produk = intval($this->input->post('harga_produk'));
        $slug = $this->generateSlug($this->input->post('nama_produk'));

        $insert_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $harga_produk,
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'create_time' => date('Y-m-d H:i:s'),
            'slug' => $slug,
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

    public function getProduk()
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->where('produk.deleted', 0);

        $result = $this->db->get();
        $produk = $result->result_array();

        return $produk;
    }

    public function getProdukById($id_produk)
    {
        $this->db->select('produk.*, category.nama_category');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->where('produk.id_produk', $id_produk);
        $this->db->where('produk.deleted', 0);

        $result = $this->db->get();
        $produk = $result->result_array();

        return $produk[0];
    }

    public function getProdukForCustomer()
    {
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->where('produk.stok_produk >', 0);
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->where('produk.deleted', 0);

        $result = $this->db->get();
        $produk = $result->result_array();
        return $produk;
    }

    public function editProduk()
    {
        $produk = $this->getProdukById($this->input->post('id_produk'));

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

        $harga_produk = intval($this->input->post('harga_produk'));

        // Periksa apakah produk sudah memiliki slug
        $existingSlug = $this->getExistingSlug($id_produk);

        // Jika produk belum memiliki slug, hasilkan slug baru
        $slug = empty($existingSlug) ? $this->generateSlug($this->input->post('nama_produk')) : $existingSlug;

        if ($produk['nama_produk'] != $this->input->post('nama_produk')) {
            $slug = $this->generateSlug($this->input->post('nama_produk'));
        }

        $update_data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_category' => $this->input->post('id_category'),
            'id_admin' => $this->input->post('id_admin'),
            'stok_produk' => $this->input->post('stok_produk'),
            'harga_produk' => $harga_produk,
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'slug' => $slug,
        );

        $this->db->where('id_produk', $id_produk);
        $this->db->update('produk', $update_data);

        for ($i = 1; $i <= 3; $i++) {
            if (!empty($gambar_paths[$i])) {
                $this->deleteOldFoto($id_produk, $i);
                $this->saveFotoProduk($id_produk, $gambar_paths[$i], $i);
            }
        }

        $delete_foto2 = $this->input->post('delete_foto2');
        $delete_foto3 = $this->input->post('delete_foto3');
        if ($delete_foto2) {
            // Hapus foto 1 dari penyimpanan dan database
            $this->deleteProductPhoto($id_produk, $delete_foto2);
        }

        if ($delete_foto3) {
            // Hapus foto 1 dari penyimpanan dan database
            $this->deleteProductPhoto($id_produk, $delete_foto3);
        }

        return $id_produk;
    }

    public function deleteProduk($id_produk)
    {
        // Get photo information
        $foto_info = $this->db->select('urutan_foto, url_foto')->where('id_produk', $id_produk)->get('foto_produk')->result();

        // Delete all photos with urutan_foto other than 1
        $this->db->where('id_produk', $id_produk);
        $this->db->where('urutan_foto <>', 1);
        $this->db->delete('foto_produk');

        // Delete the product
        $this->db->where('id_produk', $id_produk);
        $this->db->update('produk', ['deleted' => 1, 'slug' => null]);

        // Remove the files associated with deleted photos
        foreach ($foto_info as $foto) {
            if ($foto && !empty($foto->url_foto)) {
                $foto_path = './' . $foto->url_foto;
                if (file_exists($foto_path)) {
                    unlink($foto_path);
                }
            }
        }

        return true;
    }

    public function getDetailProduk($slug)
    {
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        // $this->db->where('produk.stok_produk >', 0);
        $this->db->where('produk.slug', $slug);
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

    public function getDetailProdukByID($id)
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

    public function getTotalProductsForCustomer()
    {
        // Query untuk menghitung total produk
        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('produk');
        $result = $query->row_array();

        return $result['total'];
    }

    public function getProductPhotos($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->get('foto_produk')->result_array();
    }

    public function deleteProductPhoto($id_produk, $urutan_foto)
    {
        $photo = $this->db->get_where('foto_produk', ['id_produk' => $id_produk, 'urutan_foto' => $urutan_foto])->row();

        if ($photo) {
            unlink($photo->url_foto);
        }

        $this->db->delete('foto_produk', ['id_produk' => $id_produk, 'urutan_foto' => $urutan_foto]);
    }

    private function getExistingSlug($id_produk)
    {
        $this->db->select('slug');
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('produk');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->slug;
        }
        return '';
    }

    private function saveFotoProduk($id_produk, $gambar_path, $urutan_foto)
    {
        if (!empty($gambar_path)) {
            $existing_data = $this->db->get_where('foto_produk', array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto))->row();

            if ($existing_data) {
                $this->db->update('foto_produk', array('url_foto' => $gambar_path), array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto));
            } else {
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
        $oldFoto = $this->db->select('url_foto')->where(array('id_produk' => $id_produk, 'urutan_foto' => $urutan_foto))->get('foto_produk')->row();

        if ($oldFoto && !empty($oldFoto->url_foto)) {
            $oldFilePath = './' . $oldFoto->url_foto;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    }

    public function addCategory()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if (empty($_FILES['foto_category']['name'])) {
            echo "Please select a file for foto_category.";
        }

        if (!$this->upload->do_upload('foto_category')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
            die;
        }

        $data['upload_data'] = $this->upload->data();
        $gambar_path = 'assets/foto/' . $data['upload_data']['file_name'];

        $insert_data = array(
            'nama_category' => $this->input->post('nama_category'),
            'foto_category' => $gambar_path,
        );

        $result = $this->db->insert('category', $insert_data);
        return $result;
    }

    public function editCategory()
    {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        $id_category = $this->input->post('id_category');

        // Check if a new photo is selected
        if (!empty($_FILES['foto_category']['name'])) {
            if (!$this->upload->do_upload('foto_category')) {
                $error = array('error' => $this->upload->display_errors());
                echo $error['error'];
                die;
            }

            $data['upload_data'] = $this->upload->data();
            $gambar_path = 'assets/foto/' . $data['upload_data']['file_name'];

            // Remove old photo if it exists
            $old_photo_path = $this->db->get_where('category', array('id_category' => $id_category))->row('foto_category');
            if (!empty($old_photo_path) && file_exists($old_photo_path)) {
                unlink($old_photo_path);
            }
        } else {
            // No new photo selected, keep the existing photo
            $gambar_path = $this->db->get_where('category', array('id_category' => $id_category))->row('foto_category');
        }

        $edit_data = array(
            'nama_category' => $this->input->post('nama_category'),
            'foto_category' => $gambar_path,
        );

        $this->db->where('id_category', $id_category);
        $result = $this->db->update('category', $edit_data);

        return $result;
    }

    public function deleteCategory($category_id)
    {
        // Get the photo path before deleting the category
        $photo_path = $this->db->get_where('category', array('id_category' => $category_id))->row('foto_category');

        // Delete the category
        $this->db->where('id_category', $category_id);
        $result = $this->db->delete('category');

        // Remove the photo file if it exists
        if (!empty($photo_path) && file_exists($photo_path)) {
            unlink($photo_path);
        }

        return $result;
    }

    public function getCategory()
    {
        $result = $this->db->get('category');
        $category = $result->result_array();
        return $category;
    }

    public function getDetailCategory($nama)
    {
        $this->db->select('produk.*, category.nama_category, foto_produk.url_foto, foto_produk.urutan_foto');
        $this->db->from('produk');
        $this->db->join('category', 'produk.id_category = category.id_category');
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->where('category.nama_category', $nama);
        $this->db->where('produk.stok_produk != ', 0);
        $this->db->where('produk.deleted = ', 0);
        
        $result = $this->db->get()->result_array();
        return $result;
    }

    // M_produk.php model, around line 528
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
            // Check if relevant data is set and quantities are valid
            if (isset($key['id_produk'], $key['qty_produk'], $key['stok_produk']) && $key['stok_produk'] >= $key['qty_produk']) {
                $kurang = $key['stok_produk'] - $key['qty_produk'];
                $this->db->where('produk.id_produk', $key['id_produk']);
                $this->db->update('produk', array('stok_produk' => $kurang));
                return true;
            }
        }
    
        return false;
    }
    
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
        $this->db->join('foto_produk', 'produk.id_produk = foto_produk.id_produk', 'left');
        $this->db->like('nama_produk', $keyword);
        $this->db->where('foto_produk.urutan_foto', 1);
        $this->db->where('produk.deleted = ', 0);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    function generateSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);

        $text = preg_replace('/\s+/', '-', $text);

        $newSlug = $text;

        $isUnique = $this->isSlugUnique($text);
        $counter = 1;
        while (!$isUnique) {
            $newSlug = $text . '-' . $counter;
            $isUnique = $this->isSlugUnique($newSlug);
            $counter++;
        }
        return $isUnique ? $newSlug : $text;
    }

    private function isSlugUnique($slug)
    {
        $existingSlug = $this->db->get_where('produk', ['slug' => $slug])->row();

        return empty($existingSlug);
    }
}



/* End of file M_produk.php */
