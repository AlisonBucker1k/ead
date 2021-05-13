<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Professor extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_user') == ''){
        redirect('ead/login');
    }
  }

  public function getById($id)
  {
    $prof = $this->model->selecionaBusca('professor', "WHERE id='{$id}' ");
    $echo = [
        'nome' => '',
        'email' => '',
        'telefone' => '',
        'img' => ''
    ];
    if ($prof){
        $prof = $prof[0];
        $echo = [
            'nome' => $prof['nome'] ?? '',
            'email' => $prof['email'] ?? '',
            'telefone' => $prof['telefone'] ?? '',
            'graduacao' => $prof['graduacao']?? '',
            'img' => ($prof['foto']) ? returnPath2($prof['foto'], 'professor', $prof['id'], $prof['login']) : returnPath2('padrao.jpg', 'aluno', $aluno['id'], $aluno['login'])
        ];
    }
    echo json_encode($echo);
  }
}
