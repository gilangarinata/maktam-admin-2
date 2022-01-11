<?php

class Outlet extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OutletModel', 'model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $data['outlets'] = $this->model->getAllOutlets();       
        $this->load->view("admin/templates/header",$data);
        $this->load->view("outlet");
    }

    public function add()
    {   
        $this->load->view("admin/templates/header");
        $this->load->view("outlet_add");

        if(isset($_POST['submit'])){
            $this->model->addOutlet();
            redirect('outlet');
        }

    }

    public function delete($id)
    {   
        $this->model->deleteOutlet($id);
        redirect('outlet');
    }


}
