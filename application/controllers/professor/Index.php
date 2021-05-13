<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_prof') != 1){
        redirect('professor/login');
    }
  }
  
  public function index() {
    $cursos = $this->model->selecionaBusca('curso', "WHERE `id_professor`='{$this->session->userdata('id')}' ");
    $data['entCursos'] = [];
    foreach($cursos as $key => $curso){
        $modalidade = $this->model->selecionaBusca('modalidade', "WHERE `id`='{$curso['id']}' ");
        $cursos[$key]['ttl_alunos'] = $this->db->query("SELECT id FROM aluno_curso WHERE id_curso='{$curso['id']}' AND concluido='0' ")->num_rows();
        $cursos[$key]['aulas'] = $this->model->selecionaBusca('aula', "WHERE `id_curso`='{$curso['id']}' ");
        $cursos[$key]['nome_modalidade'] = $modalidade[0]['nome'];
        if (isset($data['entCursos'][$modalidade[0]['id']][0]['id'])){

            $data['entCursos'][$modalidade[0]['id']][] = $cursos[$key];
        } else {
            $data['entCursos'][$modalidade[0]['id']] = [];
            $data['entCursos'][$modalidade[0]['id']][] = $cursos[$key];
        }
    }
    $this->load->view('professor/index', $data);
  }
  
}