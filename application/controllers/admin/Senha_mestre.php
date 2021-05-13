<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Senha_mestre extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
    } else if (!buscaPermissao('senha', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }
  
  public function index() {
    $this->load->view('admin/senha_mestre');
  }
  
  public function update(){
    $senha = $this->input->post('senha_mestre', TRUE);
    if (!empty($senha)){
        $options = array("cost" => 4);
        $senha = password_hash($senha, PASSWORD_BCRYPT, $options);

        $nvarr = [
            'senha' => $senha
        ];
        if ($this->model->update('senha_mestre', $nvarr, 1)){
            gera_aviso('sucesso', 'Senha mestre atualizada com sucesso.', 'admin/senha_mestre');
        }
    }
    gera_aviso('error', 'Valor inválido para a senha mestre.', 'admin/senha_mestre');
  }
}