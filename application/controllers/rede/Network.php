<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Network extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('nivel_rede') == ''){
        redirect('rede/login');
    }
  }

  public function visualizar($idNetwork='') {
    if ($idNetwork === '') $idNetwork = $this->session->userdata('id_niveis');

    if (!startsWith($idNetwork, $this->session->userdata('id_niveis'))) gera_aviso('erro', 'Usuário não encontrado.', 'rede/visualizar'); //caso o usuário não pertença a rede do atual.

    $user = $this->model->selecionaBusca('aluno', "WHERE id_niveis='{$idNetwork}' ");

    if (!$user) gera_aviso('erro', 'Usuário não encontrado.', 'rede/visualizar'); //usuário não encontrado

    $data['user'] = $user[0];
    
    $nivel1 = searchActivesByLevel($user[0]['id'], 1); //primeiro nível do usuário
    $nivel2 = searchActivesByLevel($user[0]['id'], 2); //segundo nível do usuário
    $nivel3 = searchActivesByLevel($user[0]['id'], 3); //terceiro nível do usuário

    $data = array_merge($data, formatterRede($nivel1, $nivel2, $nivel3));

    $this->load->view('rede/visualizar', $data);
  }

  public function unilevel($nivel=1) {
    $data['tables'] = true;
    $data['unilevel'] = searchActivesByLevel($this->session->userdata('id'), $nivel);
    $data['selected'] = $nivel;
    $this->load->view('rede/unilevel', $data);
  }


  public function meus_diretos() {
    $data['diretos'] = $this->model->selecionaBusca('aluno', "WHERE id_indicador='".$this->session->userdata('id')."' ");
    $data['tables'] = true;
    $this->load->view('rede/meus_diretos', $data);
  }
}
