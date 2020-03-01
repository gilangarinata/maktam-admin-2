<?php

class SusuModel extends CI_Model
{
    function getProdukList()
    {
        return $this->db->get('kasir_maktam_susu')->result_array();
    }

    function getProdukById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('kasir_maktam_susu')->result_array();
    }

    function tambahProduk()
    {
        $data = array(
            'nama_produk' => $this->input->post('nama_produk', true),
            'deskripsi' => $this->input->post('deskripsi', true),
            'harga' => $this->input->post('harga', true),
            'kategori' => "Susu",
            'es' => $this->input->post('es', true),
            'gambar' => $this->_uploadImage(),
            
        );
        $this->db->insert('kasir_maktam_susu', $data);
    }

    function editProduk($id)
    {
        if (!empty($_FILES["image"]["name"])) {
            $gambar = $this->_uploadImage();   
        }else{
            $gambar = "old image";
        }

        $data = array(
            'nama_produk' => $this->input->post('nama_produk', true),
            'deskripsi' => $this->input->post('deskripsi', true),
            'harga' => $this->input->post('harga', true),
            'kategori' => "Susu",
            'es' => $this->input->post('es', true),
            'gambar' => $gambar
        );
        $this->db->where('id', $id);
        $this->db->update('kasir_maktam_susu', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kasir_maktam_susu');
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './assets/upload/product/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['file_name']            = $this->product_id;
        $config['overwrite']            = true;
        $config['max_size']             = 10000; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }else{
            return $this->upload->display_errors();
        }
    }
}