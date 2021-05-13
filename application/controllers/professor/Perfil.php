<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Perfil extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_prof') != 1) {
      redirect('professor/login');
    }
  }

  public function index()
  {
    $idd = $this->session->userdata('id');
    $data['usuario'] = $this->model->selecionaBusca("professor", "WHERE `id`='" . $idd . "' ");
    if (isset($data['usuario'][0]['id'])) {
      $this->load->view('professor/perfil', $data);
    } else {
      gera_aviso('erro', 'Usuário não encontrado.', 'professor/login');
    }
  }

  public function update()
  {
    $id = $this->session->userdata('id');
    $busca = $this->model->queryString("SELECT id FROM `professor` WHERE (`login`='{$_POST['login']}' OR `email`='{$_POST['email']}') AND `id`!={$id} ");
    if (isset($busca[0]['id'])) {
      gera_aviso('erro', 'Email e/ou usuário já cadastrados em outro professor.', 'professor/perfil');
    } else {
      if (atualizar_obj("professor", $_POST, $id)) {
        $data = $_POST;
        unset($data['senha']);
        
        $nprof = $this->model->setTable('professor')->get($id);

        $this->session->set_userdata($nprof[0]);

        gera_aviso('sucesso', 'Perfil atualizado com sucesso.', 'professor/perfil');
      } else {
        gera_aviso('erro', 'Falha ao atualizar o perfil.', 'professor/perfil');
      }
    }
  }
}
