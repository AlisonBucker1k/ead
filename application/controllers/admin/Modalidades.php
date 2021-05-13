<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Modalidades extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('modalidade')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  public function index()
  {
    $data['usuarios'] = $this->model->selecionaBusca('modalidade', "");
    $data['tables'] = true;
    $data['colunas'] = '0,2';
    $this->load->view('admin/modalidades/listar_modalidades', $data);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('modalidade', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $this->load->view('admin/modalidades/cadastrar_modalidade');
  }

  public function editar($id)
  {
    if (!buscaPermissao('modalidade', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['mod'] = $this->model->selecionaBusca("modalidade", "WHERE `id`='" . $idd . "' ");
    if (isset($data['mod'][0]['id'])) {
      $this->load->view('admin/modalidades/editar_modalidade', $data);
    } else {
      gera_aviso('erro', 'Modalidade não encontrada.', 'admin/modalidades');
    }
  }

  public function update($id)
  {
    if (!buscaPermissao('modalidade', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `modalidade` WHERE `nome`='".$this->input->post('nome')."' AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Nome já cadastrado em outra modalidade.', 'admin/modalidades');
    } else {
      if (atualizar_obj("modalidade", $this->input->post(NULL, TRUE), $id)) {
        $data = $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Atualizou a modalidade #" . $id . " - " . $this->input->post('nome'));
        gera_aviso('sucesso', 'Modalidade atualizada com sucesso.', 'admin/modalidades');
      } else {
        gera_aviso('erro', 'Falha ao atualizar a modalidade.', 'admin/modalidades');
      }
    }
  }

  public function inserir()
  {
    $busca = $this->model->queryString("SELECT id FROM `modalidade` WHERE `nome`='{$_POST['nome']}' ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Nome já cadastrado em outra modalidade.', 'admin/modalidades');
    } else {
      $id = inserir_obj("modalidade", $_POST);
      if ($id) {
        $data = $_POST;
        unset($data['senha']);
        addRegistro("Cadastrou a modalidade #" . $id . ' - ' . $_POST['nome']);
        gera_aviso('sucesso', 'Modalidade cadastrada com sucesso.', 'admin/modalidades');
      } else {
        gera_aviso('erro', 'Erro ao cadastrar a modalidade.', 'admin/modalidades');
      }
    }
  }

  public function inserirAjax()
  {
    if (!buscaPermissao('modalidade', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `modalidade` WHERE `nome`='".$this->input->post('nome')."' ");
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Erro ao inserir modalidade, tente novamente";


    if (isset($busca[0]['id'])) {
      $ret['mensagem'] = "Nome já cadastrado em outra modalidade!";
    } else {
      $id = inserir_obj("modalidade", $this->input->post(NULL, TRUE));
      if ($id) {
        $data = $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Cadastrou a modalidade #" . $id . ' - ' . $this->input->post('nome'));
        $ret['tipo'] = 'success';
        $ret['mensagem'] = "Modalidade cadastrada com sucesso!";
        $ret['modalidades'] = $this->model->queryString("SELECT * FROM `modalidade` ");
      }
    }
    echo json_encode($ret);
  }

  public function remover($id)
  {
    if (!buscaPermissao('modalidade', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("modalidade", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->remove("modalidade", $id)) {
        addRegistro("Removeu a modalidade " . $admin[0]['nome']);
        gera_aviso('sucesso', 'Modalidade removida com sucesso.', 'admin/modalidades');
      } else {
        gera_aviso('erro', 'Erro ao remover a modalidade.', 'admin/modalidades');
      }
    } else {
      gera_aviso('erro', 'Modalidade não encontrada.', 'admin/modalidades');
    }
  }
}
