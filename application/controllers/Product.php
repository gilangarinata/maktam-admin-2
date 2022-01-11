<?php

class Product extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel', 'model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $data['products'] = $this->model->getAllProducts(); 
        $data['categories'] = $this->model->getAllCategories();       
        $this->load->view("admin/templates/header",$data);
        $this->load->view("product");
    }

    public function add()
    {   
        $data['subcategories'] = $this->model->getAllSubcategories();
        $this->load->view("admin/templates/header",$data);
        $this->load->view("product_add");

        if(isset($_POST['submit'])){
            $this->model->addProduct();
            redirect('product');
        }

    }

    public function add_category()
    {   
        $this->load->view("admin/templates/header");
        $this->load->view("category_add");

        if(isset($_POST['submit'])){
            $this->model->addCategory();
            redirect('product');
        }

    }

    public function delete_category($id)
    {   
        $this->model->deleteCategory($id);
        redirect('product');
    }

    public function delete($id)
    {   
        $this->model->deleteProduct($id);
        redirect('product');
    }


}
