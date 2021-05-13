<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Saques extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('nivel_rede') != 1){
        redirect('rede/login');
    }
  }

  public function pedir()
  {
    $aluno = $this->model->selecionaBusca('aluno', "WHERE id='".$this->session->userdata('id')."' ");
    $conta_aluno = $this->model->selecionaBusca('conta_usuario', "WHERE id_usuario='".$this->session->userdata('id')."' ");

    if (!$aluno) return gera_aviso('erro', 'Aluno não encontrado.', 'rede/index');
    if (!$conta_aluno) return gera_aviso('erro', 'Você precisa cadastrar ao menos uma conta bancária para pedir o saque.', 'rede/dados_pagamento');

    $data['saldo'] = $this->model->selecionaBusca('saldo_usuario', "WHERE id_aluno='".$this->session->userdata('id')."' ");
    if (!$data['saldo']) return gera_aviso('erro', 'Saldo não encontrado.', 'rede/index');

    if ($aluno[0]['bloqueado'] == 1 || $aluno[0]['ativo'] == 0) {
        gera_aviso('erro', 'Você não pode pedir saques pois está bloqueado, por favor, contate a administração.', 'rede/index');
    }

    $data['assinatura'] = $this->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='".$this->session->userdata('id')."' ");
    if (!$data['assinatura']) return gera_aviso('erro', 'Assinatura não encontrada.', 'rede/index');
        
    if ($data['assinatura'][0]['status'] != 'ativo') {
        gera_aviso('erro', 'Você precisa ter uma assinatura ativa para pedir saques!', 'rede/index');
    }

    $data['contas'] = $conta_aluno;

    $this->load->view('rede/saques/pedir', $data);
  }

  protected function retornaContaUsuarioFormatada($id){
    if ($id === null || $id == "") return "";

    $conta = $this->model->setTable('conta_usuario')
    ->where('id', $id)
    ->where('id_usuario', $this->session->userdata('id'))
    ->fetch('array');

    if (!$conta) return "";

    return "
      <b>Banco: </b>{$conta[0]['banco']}
      <b>Tipo de conta: </b> {$conta[0]['tipo_conta']}
      <b>Agência: </b>{$conta[0]['agencia']}
      <b>Conta: </b> {$conta[0]['conta']}
    ";
  }

  public function insere()
  {
    $jatempedido = $this->model->selecionaBusca('pedido_saque', "WHERE id_aluno='".$this->session->userdata('id')."' AND (status='aberto' OR status='em_processo') ");

    if ($jatempedido) {
        gera_aviso('erro', 'Você já tem um pedido de saque em aberto, aguarde a resposta deste pedido para pedir um novo.', 'saques/abertos');
    } else {
        $data = returnArray("pedido_saque");
        unset($data['id_aluno']);
        unset($data['status']);
        unset($data['taxa']);
        unset($data['criado_em']);
        unset($data['ultima_att']);
        unset($data['pago_em']);

        
        $dados_pagamento = $this->retornaContaUsuarioFormatada($this->input->post('selecionada'));

        if (!isset($data['valor']) || $dados_pagamento == "") return gera_aviso('erro', 'Dados incorretos.', 'rede/index');
        $data['valor'] = floatval($data['valor']);
        $data['dados_pagamento'] = $dados_pagamento;
        $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE id_aluno='".$this->session->userdata('id')."' ");
        if (!$saldo) return gera_aviso('erro', 'Saldo não encontrado.', 'rede/index');

        if ($saldo[0]['saldo'] < $data['valor']){
          return gera_aviso('erro', 'Você não possui saldo suficiente pra essa operação.', 'rede/index');
        } else {
            $config = $this->model->selecionaBusca('configuracoes', "");
            if (!$config) return gera_aviso('erro', 'Configurações não encontradas.', 'rede/index');


            $taxa = ($config[0]['taxa_saque'] / 100) * $data['valor'];
            $data['status'] = 'aberto';
            $data['taxa'] = $taxa;
            $data['id_aluno'] = $this->session->userdata('id');
            if ($this->model->insere('pedido_saque', $data)){
                $nvsaldo = [
                    'saldo' => $saldo[0]['saldo'] - $data['valor']
                ];
                $this->model->update('saldo_usuario', $nvsaldo, $saldo[0]['id']);
                addBalanco($this->session->userdata('id'), $data['valor'], null, 'saida', "saque", "Pedido de saque efetuado");
                return gera_aviso('success', 'Pedido de saque efetuado com sucesso.', 'rede/saques/abertos');
            }

            return gera_aviso('erro', 'Falha ao gerar pedido de saque, tente novamente.', 'rede/index');
        }
    }
  }

  public function abertos()
  {
    $data['pedidos'] = $this->model->selecionaBusca('pedido_saque', "WHERE id_aluno='".$this->session->userdata('id')."' AND ( status='aberto' OR status='em_processo' )  ");
    $data['tables'] = true;
    $this->load->view('rede/saques/abertos', $data);
  }

  public function concluidos()
  {
    $data['pedidos'] = $this->model->selecionaBusca('pedido_saque', "WHERE id_aluno='".$this->session->userdata('id')."' AND status='concluido' ");
    $data['tables'] = true;
    $this->load->view('rede/saques/concluidos', $data);
  }

  public function relatorio_por_datas()
  {
    $data['data_inicio'] = $this->input->get('data_inicial');
    $data['data_fim'] = $this->input->get('data_final');
    $data_inicial = formataSql($data['data_inicio'], false).' 00:00:00';
    $data_final = formataSql($data['data_fim'], false).' 23:59:59';


    $data['pedidos'] = $this->model->selecionaBusca('pedido_saque', "WHERE id_aluno='".$this->session->userdata('id')."' 
    AND pago_em >= '".$data_inicial."' 
    AND pago_em <= '".$data_final."' ");

    $this->load->view('rede/saques/relatorio', $data);
  }
}
