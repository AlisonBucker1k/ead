<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Assinaturas extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_prof') != 1){
        redirect('professor/login');
    }
    $this->load->model('Curso_model', 'curso');
    $this->load->model('AlunoCurso_model', 'aluno_curso');
    $this->load->model('Aluno_model', 'aluno');
  }
  
  public function index()
  {
    setRedirect('professor/assinaturas');
    $id_curso = $this->session->userdata('curso_selecionado_id') ?? 0;
    $id_prof = $this->session->userdata('id') ?? 0;
    $curso = $this->curso
    ->where('id', $id_curso)
    ->where('id_professor', $id_prof)
    ->fetch('array');

    if (!$curso){
        gera_aviso('erro', 'Curso não encontrado.', 'professor/index');
        return '';
    }

    $assinaturas = $this->aluno_curso
    ->where('id_curso', $id_curso)
    ->where('concluido', 0)
    ->fetch('array');

    foreach($assinaturas as &$ass){
        $aluno = $this->aluno->get($ass['id_aluno']);
        $ass['aluno'] = $aluno[0] ?? [];
    }

    $this->load->view('professor/assinaturas', [
        'curso' => $curso,
        'assinaturas' => $assinaturas,
        'tables' => true
    ]);
  }
}