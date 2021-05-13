<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Professor extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('professor')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  public function index()
  {
    $data['usuarios'] = $this->model->selecionaBusca('professor', "");
    $data['tables'] = true;
    $data['colunas'] = '0,2,3,4';
    $this->load->view('admin/professores/listar_professores', $data);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('professor', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $this->load->view('admin/professores/cadastrar_professor');
  }

  public function editar($id)
  {
    if (!buscaPermissao('professor', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['usuario'] = $this->model->selecionaBusca("professor", "WHERE `id`='" . $idd . "' ");
    if (isset($data['usuario'][0]['id'])) {
      $this->load->view('admin/professores/editar_professor', $data);
    } else {
      gera_aviso('erro', 'Usuário não encontrado.', 'admin/professor');
    }
  }

  public function bloquear($id){
    if (!buscaPermissao('professor', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("professor", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->update("professor", array('bloqueado' => 1),$id)) {
        addRegistro("Bloqueou o professor " . $admin[0]['login']);
        gera_aviso('sucesso', 'Professor bloqueado com sucesso.', 'admin/professor');
      } else {
        gera_aviso('erro', 'Erro ao bloquear professor.', 'admin/professor');
      }
    } else {
      gera_aviso('erro', 'Professor não encontrado.', 'admin/professor');
    }
  }

  public function desbloquear($id){
    if (!buscaPermissao('professor', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("professor", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->update("professor", array('bloqueado' => 0),$id)) {
        addRegistro("Desbloqueou o professor " . $admin[0]['login']);
        gera_aviso('sucesso', 'Professor desbloqueado com sucesso.', 'admin/professor');
      } else {
        gera_aviso('erro', 'Erro ao desbloquear professor.', 'admin/professor');
      }
    } else {
      gera_aviso('erro', 'Professor não encontrado.', 'admin/professor');
    }
  }

  public function update($id)
  {
    if (!buscaPermissao('professor', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `professor` WHERE (`login`='{$_POST['login']}' OR `email`='{$_POST['email']}') AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Email e/ou usuário já cadastrados em outro professor.', 'admin/professor');
    } else {
      if (atualizar_obj("professor", $_POST, $id)) {
        $data = $_POST;
        unset($data['senha']);
        addRegistro("Atualizou o professor #" . $id . " - " . $_POST['login'] . "<br/>Dados: " . print_r($data, true));
        gera_aviso('sucesso', 'Professor atualizado com sucesso.', 'admin/professor');
      } else {
        gera_aviso('erro', 'Falha ao atualizar o professor.', 'admin/professor');
      }
    }
  }

  public function insere()
  {
    if (!buscaPermissao('professor', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `professor` WHERE `login`='{$_POST['login']}' OR `email`='{$_POST['email']}' ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Email e/ou usuário já cadastrados em outro professor.', 'admin/professor');
    } else {
      $id = inserir_obj("professor", $_POST);
      if ($id) {
        $data = $_POST;
        unset($data['senha']);
        addRegistro("Cadastrou o professor #" . $id . ' - ' . $_POST['login'] . "<br/>Dados: " . print_r($data, true));
        gera_aviso('sucesso', 'Professor cadastrado com sucesso.', 'admin/professor');
      } else {
        gera_aviso('erro', 'Erro ao cadastrar o professor.', 'admin/professor');
      }
    }
  }


  public function inserirAjax()
  {
    if (!buscaPermissao('professor', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `professor` WHERE `login`='".$this->input->post('login')."' OR `email`='".$this->input->post('email')."' ");
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Erro ao inserir professor, tente novamente";

    if (isset($busca[0]['id'])) {
      $ret['mensagem'] = "Email e/ou usuário já cadastrados em outro professor.";
    } else {
      $id = inserir_obj("professor", $this->input->post(NULL, TRUE));
      if ($id) {
        $data = $this->input->post(NULL, TRUE);
        unset($data['senha']);
        addRegistro("Cadastrou o professor #" . $id . ' - ' . $this->input->post('login') . "<br/>Dados: " . print_r($data, true));
        $ret['tipo'] = 'success';
        $ret['mensagem'] = "Professor cadastrado com sucesso.";
        $ret['professores'] = $this->model->queryString("SELECT * FROM `professor` ");
      } else {
        $ret['mensagem'] = "Erro ao cadastrar o professor.";
      }
    }
    echo json_encode($ret);
  }

  public function remover($id)
  {
    if (!buscaPermissao('professor', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("professor", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->remove("professor", $id)) {
        $diretorio = ROOT_PATH . '/uploads/professor/' . $id . '-' . rawurlencode($admin[0]['login']);
        if (is_dir($diretorio)){
          removerDir($diretorio);
        }
        addRegistro("Removeu o professor " . $admin[0]['login']);
        gera_aviso('sucesso', 'Professor removido com sucesso.', 'admin/professor');
      } else {
        gera_aviso('erro', 'Erro ao remover professor.', 'admin/professor');
      }
    } else {
      gera_aviso('erro', 'Professor não encontrado.', 'admin/professor');
    }
  }
}
