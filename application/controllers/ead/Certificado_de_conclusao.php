<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Certificado_de_conclusao extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($token) {
        $conclusao = $this->model->setTable('aluno_conclusao')
        ->where('codigo', $token)
        ->fetch('array');

        if (!$conclusao || $conclusao[0]['resultado'] == "reprovado") redirect('ead/login');

        $aluno = $this->model->setTable('aluno')
        ->get($conclusao[0]['id_aluno']);

        $curso = $this->model->setTable('curso')
        ->get($conclusao[0]['id_curso']);

        if (!$aluno || !$curso) redirect('ead/login');

        $this->load->view('ead/certificado_conclusao', [
            'conclusao' => $conclusao[0],
            'aluno' => $aluno[0],
            'curso' => $curso[0]
        ]);
    }
}