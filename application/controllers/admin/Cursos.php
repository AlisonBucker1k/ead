<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Cursos extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('curso')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
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

    $this->load->view('admin/cursos/listar_cursos', $data);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('curso', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['modalidades'] = $this->model->selecionaBusca('modalidade', "");
    $data['professores'] = $this->model->selecionaBusca('professor', "");
    $this->load->view('admin/cursos/cadastrar_curso', $data);
  }

  public function editar($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
    if (isset($data['cur'][0]['id'])) {
      $data['modalidades'] = $this->model->selecionaBusca('modalidade', "");
      $data['professores'] = $this->model->selecionaBusca('professor', "");
      $this->load->view('admin/cursos/editar_curso', $data);
    } else {
      gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
    }
  }

  public function update($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `curso` WHERE `nome`='" . $this->input->post('nome') . "' AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Nome já cadastrado em outro curso.', 'admin/cursos');
    } else {
      if (atualizar_obj("curso", $this->input->post(NULL, TRUE), $id)) {
        $data =  $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Atualizou o curso #" . $id . " - " . $this->input->post('nome'));
        gera_aviso('sucesso', 'Curso atualizado com sucesso.', 'admin/cursos/editar/' . $id . '-' . $this->input->post('nome'));
      } else {
        gera_aviso('erro', 'Falha ao atualizar o curso.', 'admin/cursos');
      }
    }
  }

  public function ativar($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    if ($this->model->update("curso", ['status' => 'ativo'], $id)) {
      addRegistro("Ativou o curso #" . $id);
      gera_aviso('sucesso', 'Curso ativado com sucesso.', 'admin/cursos');
    } else {
      gera_aviso('erro', 'Falha ao ativar o curso.', 'admin/cursos');
    }
  }

  public function desativar($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    if ($this->model->update("curso", ['status' => 'inativo'], $id)) {
      addRegistro("Desativou o curso #" . $id);
      gera_aviso('sucesso', 'Curso desativado com sucesso.', 'admin/cursos');
    } else {
      gera_aviso('erro', 'Falha ao ativar o curso.', 'admin/cursos');
    }
  }

  public function inserir()
  {
    if (!buscaPermissao('curso', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `curso` WHERE `nome`='" . $this->input->post('curso') . "' ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Nome já cadastrado em outro curso.', 'admin/cursos');
    } else {
      $id = inserir_obj("curso", $this->input->post(NULL, TRUE));
      if ($id) {
        $data =  $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Cadastrou o curso #" . $id . ' - ' . $this->input->post('nome'));
        gera_aviso('sucesso', 'Curso cadastrado com sucesso.', 'admin/cursos');
      } else {
        gera_aviso('erro', 'Erro ao cadastrar o curso.', 'admin/cursos');
      }
    }
  }

  public function remover($id)
  {
    if (!buscaPermissao('curso', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("curso", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->remove("curso", $id)) {
        $this->model->removeKey('aula', 'id_curso', $id);
        $this->model->removeKey('tarefa_curso', 'id_curso', $id);
        $this->model->removeKey('prova_curso', 'id_curso', $id);
        $this->model->removeKey('curso_arquivos', 'id_curso', $id);
        $this->model->removeKey('aula_arquivos', 'id_curso', $id);

        deldir(get_url_h($id, $admin[0]['nome'], ''));

        addRegistro("Removeu o curso " . $admin[0]['nome'] . ' <br/>' . print_r($admin, true));
        gera_aviso('sucesso', 'Curso removido com sucesso.', 'admin/cursos');
      } else {
        gera_aviso('erro', 'Erro ao remover o curso.', 'admin/cursos');
      }
    } else {
      gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
    }
  }

}
