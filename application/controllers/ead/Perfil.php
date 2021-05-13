<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Perfil extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_user') != 1) {
      redirect('ead/login');
    }
  }

  public function index()
  {
    $id = $this->session->userdata('id');
    $data['aluno'] = $this->model->selecionaBusca('aluno', "WHERE id='{$id}' ");

    if (!$data['aluno']) gera_aviso('erro', 'Aluno não encontrado', 'ead/login');
    $data['estados'] = $this->model->selecionaBusca('estados', "");
    $data['cidades'] = $this->model->selecionaBusca('cidades', "");
    $this->load->view('ead/perfil', $data);
  }

  public function update()
  {
    $id = $this->session->userdata('id');
    $data = returnArray('aluno');

    if (empty($data)){
        gera_aviso('erro', 'Dados inválidos', 'ead/perfil');
    }

    if (!loginValidator($data['login'])){
      gera_aviso('erro', 'O login não pode ter espaços em branco nem caracteres especiais.', 'ead/perfil');
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
        gera_aviso('erro', 'Login, CPF já cadastrados em outro usuário!', 'ead/perfil');
    }

    if ($this->model->update('aluno', $data, $id)){
        $alunoNv = $this->model->setTable('aluno')->get($id);
        $this->session->set_userdata($alunoNv[0]);
        gera_aviso('success', 'Perfil atualizado com sucesso!','ead/perfil');
    }

    gera_aviso('erro', 'Falha ao atualizar o perfil, tente novamente!', 'ead/perfil');
  }
}
