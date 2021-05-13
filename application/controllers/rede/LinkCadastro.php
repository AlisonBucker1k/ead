<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class LinkCadastro extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function nova_conta()
  {
    $link = $this->input->get('link', TRUE);
    $busca = $this->model->selecionaBusca('link_rede', "WHERE link='{$link}' ");
    if (!$busca) {
      gera_aviso('erro', 'Link de cadastro inválido.', 'rede/login');
    }

    $indicador = $this->model->selecionaBusca('aluno', "WHERE id='{$busca[0]['id_usuario']}' ");

    if (!$indicador) {
      gera_aviso('erro', 'Usuário indicador não encontrado.', 'rede/login');
    }

    $planos = $this->model->selecionaBusca('plano_rede', "");
    $estados = $this->model->selecionaBusca('estados', "");
    $config = $this->model->selecionaBusca('configuracoes', "");
    $this->load->view('rede/nova_conta', ['indicador' => $indicador[0], 'planos' => $planos, 'estados' => $estados, 'config' => $config, 'link' => $link]);
  }

  public function testeJuno()
  {
    echo '<script>
    // Creating a XHR object 
    let xhr = new XMLHttpRequest(); 
    let url = "' . site_url('pagamentos/ipn') . '"; 

    // open a connection 
    xhr.open("POST", url, true); 

    // Set the request header i.e. which type of content you are sending 
    xhr.setRequestHeader("Content-Type", "application/json"); 

    // Create a state change callback 
    xhr.onreadystatechange = function () { 
        if (xhr.readyState === 4 && xhr.status === 200) { 

            // Print received data from server 
            console.log(this.responseText); 

        } 
    }; 

    // Converting JSON data to string 

    // Sending data with the request 
    xhr.send(' . "'" . '{"eventId":"b4a145ab-3d72-40d0-81ba-80d393354402","eventType":"CHARGE_STATUS_CHANGED","timestamp":"2020-12-08T17:52:56.754-03:00","data":[{"entityId":"chr_E0E9B4CF1BBC882B08570752B709F57E","entityType":"CHARGE","attributes":{"amount":"50.00","code":136228208,"digitalAccountId":"dac_4C41E0B2C4FBB22C","dueDate":"2020-12-26","reference":"faturas-1","status":"PAID"}}]}' . "'" . '); 
    </script>
    ';
  }


  //CADASTRO DO ALUNO
  public function cadastrar()
  {
    $id_indicador = $this->input->post('id_indicador', TRUE);
    $buscaIndicador = $this->model->selecionaBusca('aluno', "WHERE id='{$id_indicador}' ");
    if (!isset($buscaIndicador[0]['id'])) {
      gera_aviso('erro', 'Usuário indicador não encontrado.', 'rede/login');
    }
    $linkIndicador = $this->input->post('link_indicador');
    $data = [];
    $data = returnArray('aluno_espera');
    if (!loginValidator($data['login'])){
      gera_aviso('erro', 'O login não pode ter espaços em branco nem caracteres especiais.', 'rede/nova_conta?&link='.$linkIndicador);
      return '';
    }

    $args = [
      [
        'row' => 'login',
        'op' => '=',
        'value' => $data['login']
      ],
      [
        'row' => 'cpf',
        'op' => '=',
        'value' => $data['cpf']
      ]
    ];

    if (!checa_ja_cadastrado($args)) {
      gera_aviso('erro', 'Já existe um usuário com esse login ou CPF / CNPJ, tente novamente.', 'rede/nova_conta?&link='.$linkIndicador);
      return '';
    }

    $plano = $this->model->selecionaBusca('plano_rede', "WHERE id='" . $this->input->post('plano', TRUE) . "' ");
    if (!$plano) {
      gera_aviso('erro', 'Falha ao cadastrar sua conta, tente novamente.', 'rede/login');
      return '';
    }
    $data['id_plano'] = $plano[0]['id'];
    $idnew = $this->model->insere_id('aluno_espera', $data);
    if ($idnew) {
      $aluno = $this->model->selecionaBusca('aluno_espera', "WHERE id='{$idnew}' ");

      if (!$aluno) {
        gera_aviso('erro', 'Falha ao cadastrar sua conta, tente novamente.', 'rede/login');
        return '';
      }

      $valPagamento = $plano[0]['valor'];

      $dateNow = new DateTime();
      $dateNow->setTimezone(new DateTimeZone('America/Sao_Paulo'));
      $dateNow->add(new DateInterval('P5D'));


      $linkpay = gerarPagamentoJuno($idnew, $valPagamento, $plano[0]['nome'], $dateNow->format('Y-m-d'), $aluno[0], 'cadastro');
      if ($linkpay) {
        $gerado = ['gerou_pagamento' => 1];
        $this->model->update('aluno_espera', $gerado, $idnew);
        redirect($linkpay, 'refresh');
      } else {
        $this->model->remove('aluno_espera', $idnew);
        redirect('rede/nova_conta?&link=' . $linkIndicador);
      }
    } else {
      gera_aviso('erro', 'Login já cadastrado em outro usuário!', 'rede/login');
    }
  }
}
