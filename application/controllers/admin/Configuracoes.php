<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
    } else if (!buscaPermissao('rede', 'configurar')) {
        gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }
  
  public function index() {
    $data['config'] = $this->model->selecionaBusca('configuracoes', "");
    $date = new DateTime(date('Y-m-d'));
    $date->modify('first day of this month');
    $data['week'] = $date->format('w');
    $date->modify('last day of this month');
    $data['maxdias'] = $date->format('d');
    $data['diaAt'] = date('d');
    
    $mes = date('m');
    $mesant = $mes - 1 > 0 ? $mes - 1 : 12;
    $mexapos = $mes + 1 <= 12 ? $mes + 1 : 1;
    
    switch ($mes){
        case 1: $mes = "Janeiro"; break;
        case 2: $mes = "Fevereiro"; break;
        case 3: $mes = "Março"; break;
        case 4: $mes = "Abril"; break;
        case 5: $mes = "Maio"; break;
        case 6: $mes = "Junho"; break;
        case 7: $mes = "Julho"; break;
        case 8: $mes = "Agosto"; break;
        case 9: $mes = "Setembro"; break;
        case 10: $mes = "Outubro"; break;
        case 11: $mes = "Novembro"; break;
        case 12: $mes = "Dezembro"; break;
    
    }
    switch ($mesant){
        case 1: $mesant = "Janeiro"; break;
        case 2: $mesant = "Fevereiro"; break;
        case 3: $mesant = "Março"; break;
        case 4: $mesant = "Abril"; break;
        case 5: $mesant = "Maio"; break;
        case 6: $mesant = "Junho"; break;
        case 7: $mesant = "Julho"; break;
        case 8: $mesant = "Agosto"; break;
        case 9: $mesant = "Setembro"; break;
        case 10: $mesant = "Outubro"; break;
        case 11: $mesant = "Novembro"; break;
        case 12: $mesant = "Dezembro"; break;
    
    }
    switch ($mexapos){
        case 1: $mexapos = "Janeiro"; break;
        case 2: $mexapos = "Fevereiro"; break;
        case 3: $mexapos = "Março"; break;
        case 4: $mexapos = "Abril"; break;
        case 5: $mexapos = "Maio"; break;
        case 6: $mexapos = "Junho"; break;
        case 7: $mexapos = "Julho"; break;
        case 8: $mexapos = "Agosto"; break;
        case 9: $mexapos = "Setembro"; break;
        case 10: $mexapos = "Outubro"; break;
        case 11: $mexapos = "Novembro"; break;
        case 12: $mexapos = "Dezembro"; break;
    
    }
    $data['mes'] = $mes;
    $data['mesant'] = $mesant;
    $data['mesapos'] = $mexapos;
    
    $data['somatorio'] = 0;
    for ($i=1; $i<=31; $i++){
        $data['somatorio'] += $data['config'][0]['ganho_diario_'.$i];
    }
    
    $footer['script'] = '$(document).ready(function (){
        $(".diasSoma").on("keyup keypress change blur focus", function () {
           var total = 0;
           $(".diasSoma").each(function () {
               total += parseFloat($(this).val());
           });
           $("#somatorioprct").html(""+total.toFixed(2)+"%");
        });
    });';
    
    $this->load->view('admin/header');
    $this->load->view('admin/configuracoes', $data);
    $this->load->view('admin/footer', $footer);
  }
  
  public function notificacao_popup(){
    $data['notif'] = $this->model->selecionaBusca("notificacao", "");
      
    $this->load->view('admin/header');
    $this->load->view('admin/notificacao', $data);
    $this->load->view('admin/footer');
  }
  
  public function atualizar(){

    $config = $this->model->selecionaBusca("configuracoes", "");
    $datanew = $_POST;
    $dataupdate = array();
    foreach($datanew as $key=>$value){
        if (isset($config[0][$key])){
            $dataupdate[$key] = $value;
        }
    }
    $dataupdate['pagar_com_saldo'] = 0;
    if ($this->input->post('pagar_com_saldo')){
       $dataupdate['pagar_com_saldo'] = 1; 
    }
    
    $upd = $this->model->update("configuracoes", $dataupdate, 1);
    if ($upd){
        addRegistro("Atualizou as configurações<br/>Dados: ".print_r($dataupdate, true));
        $this->session->set_userdata(array(
            'notif' => "Configurações atualizadas com sucesso!",
            'notif_tipo' => 'success',
            'notif_titulo' => 'Sucesso!'
        ));
        redirect('admin/configuracoes');
    } else {
        $this->session->set_userdata(array(
            'notif' => "Falha ao atualizar as configurações, tente novamente!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        ));
        redirect('admin/configuracoes');
    }
  }
  
  public function altera_notificacao(){
    $config = $this->model->selecionaBusca("notificacao", "");
    $datanew = $_POST;
    $dataupdate = array();
    foreach($datanew as $key=>$value){
        if (isset($config[0][$key])){
            $dataupdate[$key] = $value;
        }
    }
    $upd = $this->model->update("notificacao", $dataupdate, 1);
    if ($upd){
        addRegistro("Atualizou a notificação popup<br/>Dados: ".print_r($dataupdate, true));
        $this->session->set_userdata(array(
            'notif' => "Notificação atualizada com sucesso!",
            'notif_tipo' => 'success',
            'notif_titulo' => 'Sucesso!'
        ));
        redirect('admin/configuracoes/notificacao_popup');
    } else {
        $this->session->set_userdata(array(
            'notif' => "Falha ao atualizar a notificação, tente novamente!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        ));
        redirect('admin/configuracoes/notificacao_popup');
    }  
  }
}