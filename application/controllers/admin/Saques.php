<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Saques extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('saque')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  public function em_aberto()
  {
    $this->load->model('Saques_model', "saques");
    $data['pedidos'] = $this->saques->abertos();
    $data['tables'] = true;
    $this->load->view('admin/saques/abertos', $data);
  }

  public function concluidos()
  {
    $this->load->model('Saques_model', "saques");
    $data['pedidos'] = $this->saques->concluidos();
    $data['tables'] = true;
    $this->load->view('admin/saques/concluidos', $data);
  }

  /* ====================================================================================================================================================
  ACEITAR O SAQUE
  ======================================================================================================================================================= */
  public function aceitar_saque($id)
  {
    if (!buscaPermissao('saque', 'administrar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $saque = $this->model->selecionaBusca('pedido_saque', "WHERE id='{$id}' ");
    if (!$saque) gera_aviso('erro', 'saque não encontrado.', 'admin/saques/em_aberto');

    if ($saque[0]['status'] == 'concluido') gera_aviso('erro', 'esse saque já esta concluido.', 'admin/saques/concluidos');

    $data = returnArray("pedido_saque", [
      'upload_path' => './uploads/',
      'allowed_types' => 'gif|jpg|png|jpeg',
      'file_name' => time() . '_comprovante.' . getExtension('comprovante')
    ]);
    $data['status'] = 'concluido';
    $data['pago_em'] = date('Y-m-d H:i:s');
    if ($this->model->update('pedido_saque', $data, $id)) {
      $aluno = $this->model->selecionaBusca('aluno', "WHERE id='{$saque[0]['id_aluno']}' ");
      if ($aluno) {
        gerarAvisoAluno($aluno[0]['id'], "Pedido de saque concluído", "Seu pedido de saque foi concluído pela administração!
          <br/>Confira os detalhes no <b>painel de controle</b>, menu <b>saques concluídos</b>!", 1, true);
      }
      gera_aviso('sucesso', 'Saque definido como concluído com sucesso.', 'admin/saques/concluidos');
    } else {
      gera_aviso('erro', 'Falha ao concluir pedido de saque, tente novamente.', 'admin/saques/em_aberto');
    }
  }



  /* ====================================================================================================================================================
  ESTORNAR O SAQUE
  ======================================================================================================================================================= */
  # estorna o saque e volta o saldo para o usuário
  protected function estornar($saque)
  {
    $saldo_usuario = $this->model->selecionaBusca('saldo_usuario', "WHERE id_aluno='{$saque['id_aluno']}' ");

    if (!$saldo_usuario) return false;

    if ($this->model->remove('pedido_saque', $saque['id'])) {
      $nvarr = [
        'saldo' => $saldo_usuario[0]['saldo'] + $saque['valor']
      ];
      return $this->model->update('saldo_usuario', $nvarr, $saldo_usuario[0]['id']);
    }
    return false;
  }

  #função de chamada do estorno e retorno do aviso / conclusão do estorno
  public function estornar_saque($id)
  {
    if (!buscaPermissao('saque', 'administrar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $saque = $this->model->selecionaBusca('pedido_saque', "WHERE id='{$id}' ");
    $motivo = $this->input->post('motivo');

    if (!$saque) gera_aviso('erro', 'saque não encontrado.', 'admin/saques/em_aberto');

    if ($saque[0]['status'] == 'concluido') gera_aviso('erro', 'esse saque já esta concluido.', 'admin/saques/concluidos');

    if ($this->estornar($saque[0])) {
      $aluno = $this->model->selecionaBusca('aluno', "WHERE id='{$saque[0]['id_aluno']}' ");
      if ($aluno) {
        gerarAvisoAluno($aluno[0]['id'], "Pedido de saque estornado", "Seu pedido de saque foi estornado pela administração.<br/><b>Motivos do estorno:</b> " . $motivo, 1, true);
      }
      addBalanco($this->session->userdata('id'), $saque[0]['valor'], null, 'entrada', "estorno", "Pedido de saque estornado. ".$motivo);
      gera_aviso('sucesso', 'saque estornado e excluído com sucesso.', 'admin/saques/em_aberto');
    }
  }
}
