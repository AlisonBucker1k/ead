<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Perguntas_frequentes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nivel_prof') != 1) {
            redirect('professor/login');
          }
    }

    public function index() {
        $faq = $this->model->setTable('faq')
        ->where('tipo', "prof")
        ->fetch('array');

        $this->load->view('comuns/faq', [
            'tipo' => "professor",
            'faq' => $faq
        ]);
    }
}