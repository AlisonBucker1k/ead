<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Dados_pagamento extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_rede') == ''){
        redirect('rede/login');
    }
  }

  public function index()
  {
    $id = $this->session->userdata('id');
    $data['contas'] = $this->model->selecionaBusca('conta_usuario', "WHERE id_usuario='{$id}' ");

    $this->load->view('rede/dados_pagamento', $data);
  }
  
  public function update()
  {
    $tipos_conta = $this->input->post('tipo_conta');
    $contas = $this->input->post('conta');
    $bancos = $this->input->post('banco');
    $agencias = $this->input->post('agencia');
    $selecionadas = $this->input->post('selecionada');

    $this->model->removeKey('conta_usuario', "id_usuario", $this->session->userdata('id'));

    if (isset($contas[0])) {
        for ($i = 0; $i < count($contas); $i++) {
          $banco = $bancos[$i];
          $tipo_conta = $tipos_conta[$i];
          $agencia = $agencias[$i];
          $conta = $contas[$i];
          $selecionada = $selecionadas[$i];
          $insert = [
            'id_usuario' => $this->session->userdata('id'),
            'tipo_conta' => $tipo_conta,
            'conta' => $conta,
            'agencia' => $agencia,
            'banco' => $banco,
            'selecionada' => $selecionada
          ];

          $this->model->insere('conta_usuario', $insert);
        }
    }
    gera_aviso('sucesso', 'Dados de pagamento atualizados com sucesso.', 'rede/dados_pagamento');
  }
}
