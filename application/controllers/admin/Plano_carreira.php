<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Plano_carreira extends CI_Controller
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

  public function cadastro()
  {
    $update = [
        'ganho' => $this->input->post('ganho', true), 
        'ativos' => $this->input->post('ativos', true),
        'nivel' => $this->input->post('nivel', true),
    ];
    if ($this->modelo->insere('plano_carreira', $update)){
        gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }
  
  public function update($id)
  {
    $checker =  $this->modelo->selecionaBusca('plano_carreira', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        $update = [
            'ganho' => $this->input->post('ganho', true), 
            'ativos' => $this->input->post('ativos', true),
            'nivel' => $this->input->post('nivel', true),
        ];
        if ($this->modelo->update('plano_carreira', $update, $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }

  public function remove($id)
  {
    $checker =  $this->modelo->selecionaBusca('plano_carreira', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->remove('plano_carreira', $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }

  public function cadastro_regra()
  {
    $data = ['n_ativos' => $this->input->post('n_ativos'), 'ganho_pct' => $this->input->post('ganho_pct')];

    if ($this->modelo->insere('regras_carreira', $data)){
        gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }

  public function update_regra($id)
  {
    $updater = ['n_ativos' => $this->input->post('n_ativos'), 'ganho_pct' => $this->input->post('ganho_pct')];
    $checker =  $this->modelo->selecionaBusca('regras_carreira', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->update('regras_carreira', $updater, $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }

  public function delete_regra($id)
  {
    $checker =  $this->modelo->selecionaBusca('regras_carreira', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->remove('regras_carreira', $checker[0]['id'])){
            gera_aviso('sucesso', 'Configurações da rede atualizadas com sucesso.', 'admin/rede/configuracoes?&indice=carreira');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar as configurações da rede.', 'admin/rede/configuracoes?&indice=carreira');
  }
}
