<?php

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DashboardModel', 'model');
        $this->load->model('InventoryModel', 'inventoryModel');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $date = date("Y-m-d");

        $data['overview'] = $this->model->getOverview($date);
        $data['products'] = $this->model->getSellingData($date);
        $data['inventory_expense'] = $this->inventoryModel->getInventoryExpense($date);

        if(isset($_POST['submit'])){
            $time = strtotime($this->input->post("tanggal"));
            $date = date('Y-m-d',$time);
            $data['overview'] = $this->model->getOverview($date);
            $data['products'] = $this->model->getSellingData($date);
            $data['inventory_expense'] = $this->inventoryModel->getInventoryExpense($date);
        }
        
        $this->load->view("admin/templates/header",$data);
        $this->load->view("dashboard");
    }

    public function add_inventory()
    {
        $date = $this->input->get('date');
        $name = $this->input->get('name');
        $total = $this->input->get('total');
        $this->inventoryModel->insertInventoryExpense($date,$name,$total);

        redirect('dashboard');
    }

    public function delete_inventory()
    {
        $id = $this->input->get('id');
        $this->inventoryModel->deleteInventoryExpense($id);
        redirect('dashboard');
    }

}
