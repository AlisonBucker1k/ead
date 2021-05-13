<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Alunos extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('aluno')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
    $this->load->model('Redes_model', 'modelo');
  }

  public function index()
  {
    $data['tables'] = true;
    $data['alunos'] = $this->modelo->selecionaBusca('aluno', "");

    $this->load->view('admin/alunos/index', $data);
  }

  public function editar($id)
  {
    if (!buscaPermissao('aluno', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['aluno'] = $this->modelo->selecionaBusca('aluno', "WHERE id='{$id}' ");

    if (!$data['aluno']) gera_aviso('erro', 'Aluno não encontrado', 'admin/alunos');
    $data['estados'] = $this->model->selecionaBusca('estados', "");
    $data['cidades'] = $this->model->selecionaBusca('cidades', "");
    $this->load->view('admin/alunos/editar', $data);
  }

  public function cadastrar()
  {
    if (!buscaPermissao('aluno', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['estados'] = $this->model->selecionaBusca('estados', "");

    $this->load->view('admin/alunos/cadastrar', $data);
  }

  public function ban($id, $un=0)
  {
    if (!buscaPermissao('aluno', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $redirect = "admin/alunos/index";
    if ($un == 1){
        $redirect = "admin/rede/unilevel";
    } else if ($un == 2){
        $redirect = "admin/rede/listar_usuarios";
    }

    $check = $this->modelo->selecionaBusca('aluno', "WHERE id='{$id}' ");
    
    if (!$check) gera_aviso('erro', 'Aluno não encontrado', $redirect);
    
    $nvarr = ['bloqueado' => 1];

    $this->model->update('aluno', $nvarr, $id);

    gera_aviso('erro', 'Aluno bloqueado com sucesso!', $redirect);
  }

  public function unban($id, $un=0)
  {
    if (!buscaPermissao('aluno', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $redirect = "admin/alunos/index";
    if ($un == 1){
        $redirect = "admin/rede/unilevel";
    } else if ($un == 2){
        $redirect = "admin/rede/listar_usuarios";
    }

    $check = $this->modelo->selecionaBusca('aluno', "WHERE id='{$id}' ");
    
    if (!$check) gera_aviso('erro', 'Aluno não encontrado', $redirect);
    
    $nvarr = ['bloqueado' => 0];

    $this->model->update('aluno', $nvarr, $id);

    gera_aviso('erro', 'Aluno desbloqueado com sucesso!', $redirect);
  }
  
  public function update($id)
  {
    if (!buscaPermissao('aluno', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data = returnArray('aluno');

    if (empty($data)){
        gera_aviso('erro', 'Dados inválidos', 'admin/alunos');
    }
    if (!loginValidator($data['login'])){
      gera_aviso('erro', 'O login não pode ter espaços em branco nem caracteres especiais.', 'admin/alunos');
      return '';
    }

    $args = [
        [
            'row' => 'login', 
            'op' => '=', 
            'value' => $data['login']
        ],
        [
            'row' => 'id', 
            'op' => '!=', 
            'value' => $id
        ]
    ];

    $args2 = [
        [
            'row' => 'cpf', 
            'op' => '=', 
            'value' => $data['cpf']
        ],
        [
            'row' => 'id', 
            'op' => '!=', 
            'value' => $id
        ]
    ];
    
    if (!checa_ja_cadastrado_multiple($args) && !checa_ja_cadastrado_multiple($args2)){
        gera_aviso('erro', 'Login, CPF já cadastrados em outro aluno!', 'admin/alunos');
        return '';
    }

    if ($this->model->update('aluno', $data, $id)){
        gera_aviso('success', 'Aluno atualizado com sucesso!','admin/alunos');
    }

    gera_aviso('erro', 'Falha ao atualizar o aluno, tente novamente!', 'admin/alunos');
  }

  public function insere()
  {
    if (!buscaPermissao('mensagens', 'aluno')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data = returnArray('aluno');

    if (empty($data)){
        gera_aviso('erro', 'Dados inválidos', 'admin/alunos');
    }

    if (!loginValidator($data['login'])){
      gera_aviso('erro', 'O login não pode ter espaços em branco nem caracteres especiais.', 'admin/alunos');
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
    
    if (!checa_ja_cadastrado($args)){
        gera_aviso('erro', 'Login, CPF já cadastrados em outro aluno!', 'admin/alunos');
    }

    if ($this->model->insere('aluno', $data)){
        gera_aviso('success', 'Aluno cadastrado com sucesso!','admin/alunos');
    }

    gera_aviso('erro', 'Falha ao cadastrar o aluno, tente novamente!', 'admin/alunos');
  }

  
}
