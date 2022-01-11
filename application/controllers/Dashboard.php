<?php

class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DashboardModel', 'model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    public function index()
    {
        $date = date("Y-m-d");

        $data['overview'] = $this->model->getOverview($date);
        $data['products'] = $this->model->getSellingData($date);

        if(isset($_POST['submit'])){
            $time = strtotime($this->input->post("tanggal"));
            $date = date('Y-m-d',$time);
            $data['overview'] = $this->model->getOverview($date);
            $data['products'] = $this->model->getSellingData($date);
        }
        
        $this->load->view("admin/templates/header",$data);
        $this->load->view("dashboard");
    }


}
