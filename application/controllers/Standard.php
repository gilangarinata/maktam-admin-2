<?php

class Standard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel', 'productModel');
        $this->load->model('OutletModel', 'outletModel');
        $this->load->model('MaterialModel', 'materialModel');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $data['products'] = $this->productModel->getAllProducts(); 
        $data['materials'] = $this->materialModel->getAllMaterials();       
        $this->load->view("admin/templates/header",$data);
        $this->load->view("standard");
    }
}
