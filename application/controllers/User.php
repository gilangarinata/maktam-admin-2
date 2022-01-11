<?php

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'model');
        $this->load->model('OutletModel', 'outletModel');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $data['users'] = $this->model->getAllUsers();       
        $this->load->view("admin/templates/header",$data);
        $this->load->view("user");
    }

    public function add()
    {   
        $data['outlets'] = $this->outletModel->getAllOutlets();
        $this->load->view("admin/templates/header", $data);
        $this->load->view("user_add");

        if(isset($_POST['submit'])){
            $this->model->addUser();
            redirect('user');
        }

    }

    public function delete($id)
    {   
        $this->model->deleteUser($id);
        redirect('user');
    }


}
