<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Fornecedores extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('servico')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  protected $table = "fornecedor";
  protected $label = "fornecedor";
  protected $sChar = 'o'; //define o sexo do item da tabela ex: "o" professor para tabela professor, ou "a" professora para tabela professora
  protected $errRedirect = 'admin/fornecedores'; //redirecionamento em caso de erro
  protected $successRedirect = 'admin/fornecedores'; //redirectionamento em caso de sucesso

  public function index()
  {
    $entradas = $this->model->setTable($this->table)->all();
    foreach ($entradas as &$e) {
      $e['contas'] = $this->model->setTable('conta_fornecedor')->where('id_fornecedor', $e['id'])->fetch('array');
    }
    $estados = $this->model->selecionaBusca('estados', "");
    $cidades = $this->model->selecionaBusca('cidades', "");

    $this->load->view('admin/fornecedores', [
      'entradas' => $entradas,
      'tables' => true,
      'colunas' => '0,1,2',
      'estados' => $estados,
      'cidades' => $cidades
    ]);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('servico', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $estados = $this->model->selecionaBusca('estados', "");
    $cidades = $this->model->selecionaBusca('cidades', "");
    $this->load->view('admin/cadastrar_fornecedor', [
      'estados' => $estados,
      'cidades' => $cidades
    ]);
  }

  public function editar($id)
  {
    if (!buscaPermissao('servico', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $fornecedor = $this->model->setTable($this->table)->get($id);
    foreach ($fornecedor as &$e) {
      $e['contas'] = $this->model->setTable('conta_fornecedor')->where('id_fornecedor', $e['id'])->fetch('array');
    }
    $estados = $this->model->selecionaBusca('estados', "");
    $cidades = $this->model->selecionaBusca('cidades', "");
    if (!$fornecedor) gera_aviso('erro', ucfirst($this->label) . ' não encontrado.', $this->errRedirect);

    $this->load->view('admin/editar_fornecedor', [
      'fornecedor' => $fornecedor,
      'estados' => $estados,
      'cidades' => $cidades
    ]);
  }

  public function insere()
  {
    if (!buscaPermissao('servico', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $update = returnArray($this->table);

    $idFornecedor = $this->model->insere_id($this->table, $update);
    if ($idFornecedor) {
      $tipos_conta = $this->input->post('tipo_conta');
      $contas = $this->input->post('conta');
      $bancos = $this->input->post('banco');
      $agencias = $this->input->post('agencia');

      if (isset($contas[0])) {
        for ($i = 0; $i < count($contas); $i++) {
          $banco = $bancos[$i];
          $tipo_conta = $tipos_conta[$i];
          $agencia = $agencias[$i];
          $conta = $contas[$i];

          $insert = [
            'id_fornecedor' => $idFornecedor,
            'tipo_conta' => $tipo_conta,
            'conta' => $conta,
            'agencia' => $agencia,
            'banco' => $banco
          ];

          $this->model->insere('conta_fornecedor', $insert);
        }
      }
      gera_aviso('sucesso', ucfirst($this->label) . ' cadastrad' . $this->sChar . ' com sucesso.', $this->successRedirect);
    }
    gera_aviso('erro', 'Falha ao cadastrar ' . $this->sChar . ' ' . $this->label . ', tente novamente.', $this->errRedirect);
  }

  public function update($id)
  {
    if (!buscaPermissao('servico', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $checker =  $this->model->selecionaBusca($this->table, "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])) {
      $update = returnArray($this->table);

      if ($this->model->update($this->table, $update, $checker[0]['id'])) {
        $this->model->removeKey('conta_fornecedor', "id_fornecedor", $checker[0]['id']);

        $tipos_conta = $this->input->post('tipo_conta');
        $contas = $this->input->post('conta');
        $bancos = $this->input->post('banco');
        $agencias = $this->input->post('agencia');

        if (isset($contas[0])) {
          for ($i = 0; $i < count($contas); $i++) {
            $banco = $bancos[$i];
            $tipo_conta = $tipos_conta[$i];
            $agencia = $agencias[$i];
            $conta = $contas[$i];

            $insert = [
              'id_fornecedor' => $checker[0]['id'],
              'tipo_conta' => $tipo_conta,
              'conta' => $conta,
              'agencia' => $agencia,
              'banco' => $banco
            ];

            $this->model->insere('conta_fornecedor', $insert);
          }
        }
        gera_aviso('sucesso', ucfirst($this->label) . ' atualizad' . $this->sChar . ' com sucesso.', $this->successRedirect);
      }
    }
    gera_aviso('erro', 'Falha ao atualizar ' . $this->sChar . ' ' . $this->label . ', tente novamente.', $this->errRedirect);
  }

  public function remove($id)
  {
    if (!buscaPermissao('servico', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $checker =  $this->model->selecionaBusca($this->table, "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])) {
      if ($this->model->remove($this->table, $checker[0]['id'])) {
        $this->model->removeKey('conta_fornecedor', "id_fornecedor", $checker[0]['id']);
        gera_aviso('sucesso', ucfirst($this->label) . ' removid' . $this->sChar . ' com sucesso.', $this->successRedirect);
      }
    }
    gera_aviso('erro', 'Falha ao remover ' . $this->sChar . ' ' . $this->label . ', tente novamente.', $this->errRedirect);
  }

  public function cadastrarContrato()
  {
    if (!buscaPermissao('servico', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $dados = array();

    chmod($_SERVER['DOCUMENT_ROOT'] . '/clientes/keroser/uploads/contratos', 0777);  // octal; representação correta do modo

    if (isset($_FILES['contrato'])) {
      $contrato = $_FILES['contrato'];

      $config = array(
        'path_url' => './',
        'alloewd_types' => 'pdf',
        'file_name' => 'Contrato-para-fornecedor.pdf',
        'max_size' => 900
      );

      $this->load->library('upload', $config);
      // $this->upload->initialize($config);

      if ($this->upload->do_upload('contrato')) {
        echo 'Success';
        exit;
      } else {
        echo $this->upload->display_errors();
      }
    }

    $this->load->view('admin/addFornecedorContrato');
  }
}
