<?php

class Inventory extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('InventoryModel', 'model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $date = date("Y-m-d");

        $data['inventories'] = $this->model->getInventories($date); 
        
        if(isset($_POST['submit'])){
            $time = strtotime($this->input->post("tanggal"));
            $date = date('Y-m-d',$time);
            $data['inventories'] = $this->model->getInventories($date);
        }

        $this->load->view("admin/templates/header",$data);
        $this->load->view("inventory");
    }

    public function add($date,$materialId,$stock)
    {   
        $this->model->addInventory($date,$materialId,$stock);
        redirect('inventory');
    }


}
