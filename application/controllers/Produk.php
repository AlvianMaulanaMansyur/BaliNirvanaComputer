<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_produk');
        $this->load->library('form_validation');

        if (empty($this->session->userdata('admin_name'))) {
            redirect('auth/login');
        }
    }

    public function tambahProduk()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        $this->form_validation->set_rules('stok_produk', 'Stok Produk', 'required|numeric');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|numeric');
        $this->form_validation->set_rules('deskripsi_produk', 'Deskripsi Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $category = $this->M_produk->getCategory();
            $id_admin = $this->session->userdata('admin_id');

            $data = [
                'title' => 'Dashboard Admin ',
                'header' => 'V_partials/dashboard/header',
                'navbar' => 'V_partials/dashboard/navbar',
                'sidebar' => 'V_partials/dashboard/sidebar',
                'footer' => 'V_partials/dashboard/footer',
                'content' => 'V_partials/dashboard/produk/tambah_produk',
                'js' => 'V_partials/dashboard/js',
                'category' => $category,
                'id_admin' => $id_admin,
                'active_tab' => 'getProduk'
            ];
            $this->load->view('master', $data);
        } else {

            $nama_produk = $this->input->post('nama_produk');
            $id_category = $this->input->post('category');
            $id_admin = $this->input->post('id_admin');
            $stok_produk = $this->input->post('stok_produk');
            $harga_produk = $this->input->post('harga_produk');
            $deskripsi_produk = $this->input->post('deskripsi_produk');

            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->load->library('upload', $config);

            $gambar_paths = array();

            if (!$this->upload->do_upload('foto_produk1')) {
                $error = array('error' => $this->upload->display_errors());
                echo $error['error'];
                echo json_encode('llalalalal');
                $this->form_validation->set_message('foto_produk1', 'Error uploading Foto Produk ' . ': ' . $this->upload->display_errors());
            }

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
            $slug = $this->M_produk->generateSlug($nama_produk);

            $insert_data = array(
                'nama_produk' => $nama_produk,
                'id_category' => $id_category,
                'id_admin' => $id_admin,
                'stok_produk' => $stok_produk,
                'harga_produk' => $harga_produk,
                'deskripsi_produk' => $deskripsi_produk,
                'create_time' => date('Y-m-d H:i:s'),
                'slug' => $slug,
            );

            $insert_id = $this->M_produk->insertProduk($insert_data);
            // var_dump($gambar_paths);
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($gambar_paths[$i - 1])) {
                    $this->M_produk->saveFotoProduk($insert_id, $gambar_paths[$i - 1], $i);
                }
            }

            $response = array('data' => 'Berhasil menambahkan produk');
            echo json_encode($response);
        }
    }
    public function editProduk($id_produk)
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        $this->form_validation->set_rules('stok_produk', 'Stok Produk', 'required|numeric');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|numeric');
        $this->form_validation->set_rules('deskripsi_produk', 'Deskripsi Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $produk = $this->M_produk->getProdukById($id_produk);
            $category = $this->M_produk->getCategory();
            $id_admin = $this->session->userdata('admin_id');

            $data = [
                'title' => 'Dashboard Admin ',
                'header' => 'V_partials/dashboard/header',
                'navbar' => 'V_partials/dashboard/navbar',
                'sidebar' => 'V_partials/dashboard/sidebar',
                'footer' => 'V_partials/dashboard/footer',
                'content' => 'V_partials/dashboard/produk/edit_produk',
                'js' => 'V_partials/dashboard/js',
                'category' => $category,
                'id_admin' => $id_admin,
                'produk' => $produk,
                'active_tab' => 'getProduk'
            ];
            $this->load->view('master', $data);
        } else {

            $produk = $this->M_produk->getProdukById($id_produk);

            $nama_produk = $this->input->post('nama_produk');
            $id_category = $this->input->post('category');
            $id_admin = $this->input->post('id_admin');
            $stok_produk = $this->input->post('stok_produk');
            $harga_produk = $this->input->post('harga_produk');
            $deskripsi_produk = $this->input->post('deskripsi_produk');

            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'jpg|png|jpeg';

            $this->load->library('upload', $config);

            $gambar_paths = array();

            for ($i = 1; $i <= 3; $i++) {
                if (!empty($_FILES['foto_produk' . $i]['name'])) {
                    if ($this->upload->do_upload('foto_produk' . $i)) {
                        $data['upload_data' . $i] = $this->upload->data();
                        $gambar_paths[$i] = 'assets/foto/' . $data['upload_data' . $i]['file_name'];
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $gambar_paths[$i] = ''; // Set a default value or handle accordingly
                    }
                } else {
                    $gambar_paths[$i] = ''; // Set a default value or handle accordingly
                }
            }
            $existingSlug = $this->M_produk->getExistingSlug($id_produk);

            $slug = empty($existingSlug) ? $this->M_produk->generateSlug($nama_produk) : $existingSlug;

            if ($produk['nama_produk'] != $nama_produk) {
                $slug = $this->M_produk->generateSlug($nama_produk);
            }

            $update_data = array(
                'nama_produk' => $nama_produk,
                'id_category' => $id_category,
                'id_admin' => $id_admin,
                'stok_produk' => $stok_produk,
                'harga_produk' => $harga_produk,
                'deskripsi_produk' => $deskripsi_produk,
                'create_time' => date('Y-m-d H:i:s'),
                'slug' => $slug,
            );

            $this->M_produk->editProduk($id_produk, $update_data);

            for ($i = 1; $i <= 3; $i++) {
                if (!empty($gambar_paths[$i])) {
                    $this->M_produk->deleteOldFoto($id_produk, $i);
                    $this->M_produk->saveFotoProduk($id_produk, $gambar_paths[$i], $i);
                }
            }

            $delete_foto2 = $this->input->post('delete_foto2');
            $delete_foto3 = $this->input->post('delete_foto3');
            if ($delete_foto2) {
                // Hapus foto 1 dari penyimpanan dan database
                $this->M_produk->deleteProductPhoto($id_produk, $delete_foto2);
            }

            if ($delete_foto3) {
                // Hapus foto 1 dari penyimpanan dan database
                $this->M_produk->deleteProductPhoto($id_produk, $delete_foto3);
            }

            $response = array('data' => 'Berhasil mengubah produk');
            echo json_encode($response);
        }
    }

}

/* End of file Produk.php */