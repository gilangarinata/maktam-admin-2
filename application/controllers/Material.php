<?php

class Material extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MaterialModel', 'model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $date = date("Y-m-d");

        $data['materials'] = $this->model->getAllMaterials(); 
        $data['materialData'] = $this->model->getMaterialData($date);
        
        if(isset($_POST['submit'])){
            $time = strtotime($this->input->post("tanggal"));
            $date = date('Y-m-d',$time);
            $data['materialData'] = $this->model->getMaterialData($date);
        }

        $this->load->view("admin/templates/header",$data);
        $this->load->view("material");
    }

    public function add()
    {   

        $this->load->view("admin/templates/header");
        $this->load->view("material_add");

        if(isset($_POST['submit'])){
            $this->model->addMaterial();
            redirect('material');
        }

    }

    public function delete($id)
    {   
        $this->model->deleteMaterial($id);
        redirect('material');
    }

    public function edit()
    {   
        $data['materialId'] = $this->input->get('materialId');
        $data['materialName'] = $this->input->get('materialName'); 
        $this->load->view("admin/templates/header");
        $this->load->view("material_add",$data);

        if(isset($_POST['submit'])){
            $this->model->editMaterial($this->input->get('materialId'));
            redirect('material');
        }
    }
}
