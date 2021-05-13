<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Financeiro extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('nivel_rede') == ''){
        redirect('rede/login');
    }
  }

  public function balanco() {
    $data['balanco'] = $this->model->selecionaBusca('balanco', "WHERE id_aluno='{$this->session->userdata('id')}' ");

    $this->load->view('rede/balanco', $data);
  }

  public function relatorio_por_datas() {
    $data['data_inicio'] = $this->input->get('data_inicial');
    $data['data_fim'] = $this->input->get('data_final');
    $data_inicial = formataSql($data['data_inicio'], false).' 00:00:00';
    $data_final = formataSql($data['data_fim'], false).' 23:59:59';


    $data['balanco'] = $this->model->selecionaBusca('balanco', "WHERE id_aluno='{$this->session->userdata('id')}' AND criado_em >= '".$data_inicial."' AND criado_em <= '".$data_final."' ");

    $this->load->view('rede/balanco', $data);
  }
}
