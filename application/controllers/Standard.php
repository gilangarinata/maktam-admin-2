<?php

class Standard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StandardModel', 'model');

        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $data['standardMilks'] = $this->model->getMilkStandard();     
        $data['materials'] = $this->model->getAllMaterial();      
        $this->load->view("admin/templates/header",$data);
        $this->load->view("standard");
    }

    public function add()
    {
        $outletId = $this->input->get('outletId');
        $itemId = $this->input->get('itemId');
        $value = $this->input->get('value');

        $this->model->addStandardMilk($outletId,$itemId,$value);   

        redirect('standard');
    }

    public function add_material()
    {
        $outletId = $this->input->get('outletId');
        $itemId = $this->input->get('itemId');
        $value = $this->input->get('value');

        $this->model->addStandardMaterial($outletId,$itemId,$value);   

        redirect('standard/edit_material?materialId=' . $itemId);
    }

    public function edit_material()
    {
        $materialId = $this->input->get('materialId');

        $data['standardMaterials'] = $this->model->getMaterialStandard($materialId);   

        $this->load->view("admin/templates/header",$data);
        $this->load->view("edit_material_standard");
    }
}
