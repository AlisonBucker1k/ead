<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Planos extends CI_Controller
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

  public function insere()
  {
    $servicos = implode(',', $this->input->post('servicos')) ?? '';
    $update = [
        'nome' => $this->input->post('nome', true), 
        'descricao' => $this->input->post('descricao', true),
        'valor' => $this->input->post('valor', true),
        'ead' => $this->input->post('ead') ? 1 : false,
        'servicos' => $servicos
    ];
    if ($this->modelo->insere('plano_rede', $update)){
        gera_aviso('sucesso', 'Plano cadastrado com sucesso.', 'admin/rede/planos');
    }
    gera_aviso('erro', 'Falha ao cadastrar o plano, tente novamente.', 'admin/rede/planos');
  }
  
  public function update($id)
  {
    $checker =  $this->modelo->selecionaBusca('plano_rede', "WHERE id='{$id}' ");
    
    if (isset($checker[0]['id'])){
        $servicos = implode(',', $this->input->post('servicos')) ?? '';
        $update = [
            'nome' => $this->input->post('nome', true), 
            'descricao' => $this->input->post('descricao', true),
            'valor' => $this->input->post('valor', true),
            'ead' => $this->input->post('ead') ? 1 : false,
            'servicos' => $servicos
        ];
        if ($this->modelo->update('plano_rede', $update, $checker[0]['id'])){
            gera_aviso('sucesso', 'Plano atualizado com sucesso.', 'admin/rede/planos');
        }
    }
    gera_aviso('erro', 'Falha ao atualizar o plano, tente novamente.', 'admin/rede/planos');
  }

  public function remove($id)
  {
    $checker =  $this->modelo->selecionaBusca('plano_rede', "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        if ($this->modelo->remove('plano_rede', $checker[0]['id'])){
            gera_aviso('sucesso', 'Plano removido com sucesso.', 'admin/rede/planos');
        }
    }
    gera_aviso('erro', 'Falha ao remover o plano, tente novamente.', 'admin/rede/planos');
  }
}
