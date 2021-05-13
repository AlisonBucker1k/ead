<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Administradores extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('admin')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
    $this->load->model('Admin_model', 'adm');
  }


  #################################################################
  # CARGOS #
  #################################################################
  #
  # listar cargos
  #
  public function cargos()
  {
    $data['cargos'] = $this->model
      ->setTable('cargo')
      ->all();

    $data['tables'] = true;
    $data['colunas'] = '0,1,2,3';
    $this->load->view('admin/listar_cargos', $data);
  }

  #
  # cadastrar cargos
  #
  public function cadastrar_cargo()
  {
    if (!buscaPermissao('admin', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $this->load->helper('permissoes_helper');

    $fields = $this->model
    ->setTable('fields')
    ->all();

    foreach($fields as &$f){
      $f['acoes'] = getActions($f['nome']);
    }

    $this->load->view('admin/cadastrar_cargo', [
      'fields' => $fields
    ]);
  }


  #
  # editar cargos
  #
  public function editar_cargo($id)
  {
    if (!buscaPermissao('admin', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $this->load->helper('permissoes_helper');
    $cargo = $this->model
      ->setTable('cargo')
      ->get($id);

    $permissoes = $this->model
      ->setTable('permissoes')
      ->where('id_cargo', $id)
      ->fetch('array');

    $fields = $this->model
      ->setTable('fields')
      ->all();

    foreach($fields as &$f){
      $f['acoes'] = getActions($f['nome']);
    }

    $this->load->view('admin/editar_cargo', [
      'cargo' => $cargo,
      'fields' => $fields,
      'permissoes' => $permissoes
    ]);
  }

  #
  # insere permissão
  #
  # dados [ id_cargo, action, id_field ];
  #
  protected function insere_permissao(array $dados)
  {
    $checkField = $this->model->setTable('fields')->get($dados['id_field']);
    if ($checkField) {
      $newArr = [
        'id_cargo'   => $dados['id_cargo'],
        'action'     => $dados['action'],
        'id_field'   => $dados['id_field'],
        'nome_field' => $checkField[0]['nome']
      ];

      return $this->model->insere('permissoes', $newArr);
    }
    return false;
  }

  #
  # insere cargos
  #
  public function insere_cargo()
  {
    if (!buscaPermissao('admin', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data_cargo = [
      'nome' => $this->input->post('nome')
    ];
    $permissoes_action = $this->input->post('action');

    $id_inserido = $this->model->insere_id('cargo', $data_cargo);

    $checker = true;
    if ($id_inserido) {
      if (is_array($permissoes_action)) {
        for ($i = 0; $i < count($permissoes_action); $i++) {
          $xpd = explode('|', $permissoes_action[$i]);
          $checker = $this->insere_permissao([
            'id_cargo' => $id_inserido,
            'action'   => $xpd[0],
            'id_field' => $xpd[1]
          ]);
          if (!$checker) break;
        }
      }

      if (!$checker) {
        $this->model->remove('cargo', $id_inserido);
        gera_aviso('erro', 'Erro ao inserir as permissões do cargo, tente novamente.', 'admin/administradores/cargos');
      } else {
        addRegistro("Cadastrou o cargo #" . $id_inserido . " - " . $data_cargo['nome']);
        gera_aviso('sucesso', 'Cargo cadastrado com sucesso.', 'admin/administradores/cargos');
      }
    } else {
      gera_aviso('erro', 'Erro ao cadastrar cargo, tente novamente.', 'admin/administradores/cargos');
    }
  }

  #
  # insere cargos
  #
  public function update_cargo($id)
  {
    if (!buscaPermissao('admin', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $cargo = $this->model->selecionaBusca("cargo", "WHERE `id`='{$id}' ");
    if (isset($cargo[0]['id'])) {
      $data_cargo = [
        'nome' => $this->input->post('nome')
      ];
      $permissoes_action = $this->input->post('action');

      $update = $this->model->update('cargo', $data_cargo, $id);
      $this->model->removeKey('permissoes', 'id_cargo', $id);

      $checker = true;
      if ($update) {
        if (is_array($permissoes_action)) {
          for ($i = 0; $i < count($permissoes_action); $i++) {
            $xpd = explode('|', $permissoes_action[$i]);
            $checker = $this->insere_permissao([
              'id_cargo' => $id,
              'action'   => $xpd[0],
              'id_field' => $xpd[1]
            ]);
            if (!$checker) break;
          }
        }

        if (!$checker) {
          gera_aviso('erro', 'Ocorreu um erro ao atualizar as permissões do cargo, tente novamente.', 'admin/administradores/argos');
        } else {
          addRegistro("Atualizou o cargo #" . $id . " - " . $data_cargo['nome']);
          gera_aviso('sucesso', 'Cargo atualizado com sucesso.', 'admin/cargos');
        }
      } else {
        gera_aviso('erro', 'Erro ao atualizar o cargo, tente novamente.', 'admin/administradores/cargos');
      }
    } else {
      gera_aviso('erro', 'Cargo não encontrado.', 'admin/administradores/cargos');
    }
  }

  #
  # remove cargos
  #
  public function remove_cargo($id)
  {
    if (!buscaPermissao('admin', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $cargo = $this->model->selecionaBusca("cargo", "WHERE `id`='{$id}' ");
    if (isset($cargo[0]['id'])) {
      if ($this->model->remove("cargo", $id)) {
        $this->model->removeKey('permissoes', 'id_cargo', $id);
        addRegistro("Removeu o cargo " . $cargo[0]['id']);
        gera_aviso('sucesso', 'Cargo removido com sucesso.', 'admin/cargos');
      } else {
        gera_aviso('erro', 'Erro ao remover cargo, verifique se algum admin não o possui antes da remoção!', 'admin/administradores/cargos');
      }
    } else {
      gera_aviso('erro', 'Cargo não encontrado.', 'admin/administradores/cargos');
    }
  }





  #################################################################
  # ADMINISTRADORES #
  #################################################################
  public function index()
  {
    $data['usuarios'] = $this->model->selecionaBusca('admin', "");
    $data['tables'] = true;
    $data['colunas'] = '0,2,3,4';
    $this->load->view('admin/listar_admin', $data);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('admin', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $cargos = $this->model
    ->setTable('cargo')
    ->all();

    $this->load->view('admin/register', [
      'cargos' => $cargos
    ]);
  }

  public function editar($id)
  {
    if (!buscaPermissao('admin', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['usuario'] = $this->model->selecionaBusca("admin", "WHERE `id`='" . $idd . "' ");
    $data['cargos'] = $this->model
    ->setTable('cargo')
    ->all();

    if (isset($data['usuario'][0]['id'])) {
      $this->load->view('admin/editar_admin', $data);
    } else {
      gera_aviso('erro', 'Usuário não encontrado.', 'admin/administradores');
    }
  }

  public function perfil()
  {
    $idd = $this->session->userdata('id');
    $data['usuario'] = $this->model->selecionaBusca("admin", "WHERE `id`='" . $idd . "' ");
    if (isset($data['usuario'][0]['id'])) {
      $this->load->view('admin/editar_admin', $data);
    } else {
      gera_aviso('erro', 'Usuário não encontrado.', 'admin/administradores');
    }
  }

  public function update($id)
  {
    if (!buscaPermissao('admin', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `admin` WHERE (`login`='{$_POST['login']}' OR `email`='{$_POST['email']}') AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Email e/ou usuário já cadastrados em outro administrador.', 'admin/administradores');
    } else {
      $data_insert = $_POST;
      $cargo = $this->model->setTable('cargo')->get($data_insert['id_cargo']);
      $data_insert['nome_cargo'] = $cargo[0]['nome'] ?? 'Não encontrado';

      if (atualizar_obj("admin", $data_insert, $id)) {
        $data = $data_insert;
        unset($data['senha']);

        if ($id == $this->session->userdata('id')) {
          addRegistro("Atualizou o perfil<br/>Dados: " . print_r($data, true));
          gera_aviso('sucesso', 'Perfil atualizado com sucesso.', 'admin/perfil');
        } else {
          addRegistro("Atualizou o administrador #" . $id . " - " . $_POST['login'] . "<br/>Dados: " . print_r($data, true));
          gera_aviso('sucesso', 'Administrador atualizado com sucesso.', 'admin/administradores');
        }
      } else {
        gera_aviso('erro', 'Falha ao atualizar o administrador.', 'admin/administradores');
      }
    }
  }

  public function registro_de_acoes($id)
  {
    if (!buscaPermissao('admin', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['registros'] = $this->model->selecionaBusca("registro_admin", "WHERE `id_admin`='{$id}' ORDER BY `id` DESC");
    $data['admin'] = $this->model->selecionaBusca("admin", "WHERE `id`='{$id}' ");
    $this->load->view('admin/header');
    $this->load->view('admin/registro_acoes', $data);
    $this->load->view('admin/footer');
  }

  public function insere()
  {
    if (!buscaPermissao('admin', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $busca = $this->model->queryString("SELECT id FROM `admin` WHERE `login`='{$_POST['login']}' OR `email`='{$_POST['email']}' ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Email e/ou usuário já cadastrados em outro administrador.', 'admin/administradores');
    } else {
      $data_insert = $_POST;
      $cargo = $this->model->setTable('cargo')->get($data_insert['id_cargo']);
      $data_insert['nome_cargo'] = $cargo[0]['nome'] ?? 'Não encontrado';

      $id = inserir_obj("admin", $data_insert);
      if ($id) {
        $data = $data_insert;
        unset($data['senha']);
        addRegistro("Cadastrou o administrador #" . $id . ' - ' . $_POST['login'] . "<br/>Dados: " . print_r($data, true));
        gera_aviso('sucesso', 'Administrador cadastrado com sucesso.', 'admin/administradores');
      } else {
        gera_aviso('erro', 'Erro ao cadastrar administrador.', 'admin/administradores');
      }
    }
  }

  public function remover($id)
  {
    if (!buscaPermissao('admin', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    if ($this->session->userdata('id') != $id) {
      $admin = $this->model->selecionaBusca("admin", "WHERE `id`='{$id}' ");
      if (isset($admin[0]['id'])) {
        if ($this->model->remove("admin", $id)) {
          $diretorio = ROOT_PATH . '/uploads/admin/' . $id . '-' . rawurlencode($admin[0]['login']);
          if (is_dir($diretorio)) {
            removerDir($diretorio);
          }
          addRegistro("Removeu o administrador " . $admin[0]['login']);
          gera_aviso('sucesso', 'Administrador removido com sucesso.', 'admin/administradores');
        } else {
          gera_aviso('erro', 'Erro ao remover administrador.', 'admin/administradores');
        }
      } else {
        gera_aviso('erro', 'Admin não encontrado.', 'admin/administradores');
      }
    } else {
      gera_aviso('erro', 'Você não pode remover a si mesmo.', 'admin/administradores');
    }
  }
}
