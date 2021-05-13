<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Residual extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('rede', 'configurar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
    $this->load->model('Redes_model', 'modelo');
  }

  public function update()
  {
    $updater = [];
    for ($i=1; $i<=10; $i++) $updater['n'.$i] = $this->input->post('n'.$i, true);

    $checker =  $this->modelo->selecionaBusca('ganho_residual', " ORDER BY ID LIMIT 1");
    if (isset($checker[0]['id'])){
        if ($this->modelo->update('ganho_residual', $updater, $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=fidelidade');
        }
    } else {
        if ($this->modelo->insere('ganho_residual', $updater)){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=fidelidade');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=fidelidade');
  }

  public function cadastro_regra()
  {
    $data = ['n_ativos' => $this->input->post('n_ativos'), 'ganho_pct' => $this->input->post('ganho_pct')];

    if ($this->modelo->insere('regras_fidelidade', $data)){
        gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=fidelidade');
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes');
  }

  public function update_regra($id)
  {
    $updater = ['n_ativos' => $this->input->post('n_ativos'), 'ganho_pct' => $this->input->post('ganho_pct')];
    $checker =  $this->modelo->selecionaBusca('regras_fidelidade', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->update('regras_fidelidade', $updater, $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=fidelidade');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=fidelidade');
  }

  public function delete_regra($id)
  {
    $checker =  $this->modelo->selecionaBusca('regras_fidelidade', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->remove('regras_fidelidade', $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=fidelidade');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=fidelidade');
  }
}
