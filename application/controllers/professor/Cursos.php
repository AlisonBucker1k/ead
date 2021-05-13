<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Cursos extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_prof') != 1){
        redirect('professor/login');
    }
    $this->load->model('Curso_model', 'curso');
  }
  
  public function index()
  {
    $data['usuarios'] = $this->model->queryString("SELECT 
    curso.id AS id,
    curso.id_modalidade AS id_modalidade,
    modalidade.nome AS modalidade,
    professor.nome AS professor,
    curso.nome AS nome,
    curso.tipo AS tipo,
    curso.status AS status,
    curso.venda AS venda,
    DATE_FORMAT(curso.criado_em, '%d/%m/%Y') AS criado_em
    FROM curso
    INNER JOIN (SELECT id,nome FROM modalidade) AS modalidade ON modalidade.id = curso.id_modalidade
    INNER JOIN (SELECT id,nome FROM professor) AS professor ON professor.id = curso.id_professor");
    $data['tables'] = true;
    $data['colunas'] = '0,1,2,3,4,5';
    $this->load->view('professor/cursos/listar_cursos', $data);
  }


  public function getJson()
  {
    $cursos = $this->curso
    ->where('id_professor', $this->session->userdata('id'))
    ->where('status', 'ativo')
    ->fetch('array');

    foreach($cursos as &$c){
      $c['img_brd'] = get_url($c['id'], $c['nome'], $c['capa']);
    }

    echo json_encode($cursos, true);
  }

  public function selecionar($id){
    $redirect = getRedirect();
    $cursos = $this->curso
    ->where('id', $id)
    ->where('id_professor', $this->session->userdata('id'))
    ->where('status', 'ativo')
    ->fetch('array');

    if (!$cursos) {
      gera_aviso('erro', 'Curso não encontrado.', $redirect);
      return '';
    }

    $this->session->set_userdata([
      'curso_selecionado' => $cursos[0]['nome'],
      'curso_selecionado_id' => $cursos[0]['id']
    ]);

    
    gera_aviso('success', 'Curso <b>'.$cursos[0]['nome'].'</b> selecionado com sucesso.', $redirect);
  }

  public function editar($id)
  {
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
    if (isset($data['cur'][0]['id'])) {
      $data['modalidades'] = $this->model->selecionaBusca('modalidade', "");
      $data['professores'] = $this->model->selecionaBusca('professor', "");
      $this->load->view('professor/cursos/editar_curso', $data);
    } else {
      gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
    }
  }

  public function update($id)
  {
    $busca = $this->model->queryString("SELECT id FROM `curso` WHERE `nome`='" . $this->input->post('nome') . "' AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Nome já cadastrado em outro curso.', 'professor/cursos');
    } else {
      if (atualizar_obj("curso", $this->input->post(NULL, TRUE), $id)) {
        $data =  $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Atualizou o curso #" . $id . " - " . $this->input->post('nome'));
        gera_aviso('sucesso', 'Curso atualizado com sucesso.', 'professor/cursos/editar/' . $id . '-' . $this->input->post('nome'));
      } else {
        gera_aviso('erro', 'Falha ao atualizar o curso.', 'professor/cursos');
      }
    }
  }
}