<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Acesso extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
    }
  }
  
  
  
  public function index() {
    $this->load->view('admin/header');
    $this->load->view('admin/acesso');
    $this->load->view('admin/footer');
  }
  
  public function atualizar(){
    $data['usuario'] = $this->input->post('usuario');
    if ($this->input->post('senha') != ""){
        $options = array("cost"=>4);
        $senhahash = password_hash($this->input->post('senha'),PASSWORD_BCRYPT,$options);
        $data['senha'] = $senhahash;
    }
    $this->model->update("admin", $data, $this->session->userdata('id'));
    if ($this->input->post('senha_mestre') != ""){
        $options = array("cost"=>4);
        $senhahash = password_hash($this->input->post('senha_mestre'),PASSWORD_BCRYPT,$options);
        $dtnv = array("senha" => $senhahash);
        $this->model->update("senha_mestre", $dtnv, 1);
    }
    
    $this->session->set_userdata(array(
                        'notif' => "Dados de acesso atualizados com sucesso!",
                        'notif_tipo' => 'success',
                        'notif_titulo' => 'Sucesso!'
                      ));
    redirect('admin/acesso');
  }
}