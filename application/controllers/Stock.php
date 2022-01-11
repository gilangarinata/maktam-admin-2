<?php

class Stock extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StockModel', 'model');
        $this->load->model('ProductModel', 'productModel');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $date = date("Y-m-d");


        $data['stockData'] = $this->model->getStockData($date);
        if(isset($_POST['submit'])){
            $time = strtotime($this->input->post("tanggal"));
            $date = date('Y-m-d',$time);
            $data['stockData'] = $this->model->getStockData($date);
        }

        $this->load->view("admin/templates/header",$data);
        $this->load->view("stock");
    }

    public function add()
    {   

        $this->load->view("admin/templates/header");
        $this->load->view("stock_add");

        if(isset($_POST['submit'])){
            $this->model->addStock();
            redirect('stock');
        }

    }

    public function add_cup()
    {   

        $this->load->view("admin/templates/header");
        $this->load->view("cup_add");

        if(isset($_POST['submit'])){
            $this->model->addCup();
            redirect('stock');
        }

    }

    public function add_spices()
    {   

        $this->load->view("admin/templates/header");
        $this->load->view("spices_add");

        if(isset($_POST['submit'])){
            $this->model->addSpices();
            redirect('stock');
        }

    }


    public function delete_cup($name)
    {   
        $this->model->deleteItem($name);
        redirect('stock');
    }

    public function delete_spices($name)
    {   
        $this->model->deleteItem($name);
        redirect('stock');
    }


}
