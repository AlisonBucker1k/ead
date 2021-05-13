<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Perguntas_frequentes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nivel_user') != 1) {
            redirect('ead/login');
          }
    }

    public function index() {
        $faq = $this->model->setTable('faq')
        ->where('tipo', "ead")
        ->fetch('array');

        $this->load->view('comuns/faq', [
            'tipo' => "ead",
            'faq' => $faq
        ]);
    }
}