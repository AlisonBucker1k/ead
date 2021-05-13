<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Views extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function loginProfessor(){
        $this->load->view('professor/login');
    }

    public function indexProfessor(){
        $this->load->view('professor/templates/header');
        $this->load->view('professor/index');
        $this->load->view('professor/templates/footer');
    }

    public function loginAluno(){
        $this->load->view('professor/login');
    }

    public function indexAluno(){
        $this->load->view('ead/templates/header');
        $this->load->view('ead/index');
        $this->load->view('ead/templates/footer');
    }
    
    public function cadAdmin(){
        $this->load->view('admin/templates/header');
        $this->load->view('admin/register');
        $this->load->view('admin/templates/footer');
    }
    
    public function cadProfessor(){
        $this->load->view('professor/templates/header');
        $this->load->view('professor/register');
        $this->load->view('professor/templates/footer');
    }

    public function cadAula(){
        $this->load->view('professor/templates/header');
        $this->load->view('professor/addAula');
        $this->load->view('professor/templates/footer');
    }
    

}