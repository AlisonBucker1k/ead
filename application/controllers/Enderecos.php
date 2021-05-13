<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Enderecos extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  protected function getEstado($val){
      $estado = $this->model->selecionaBusca('estados', "WHERE nome='{$val}' OR uf='{$val}' ");
      return isset($estado[0]['id']) ? $estado[0] : null;
  }

  protected function getCidade($val){
    $estado = $this->model->selecionaBusca('cidades', "WHERE nome='{$val}' ");
    return isset($estado[0]['id']) ? $estado[0] : null;
}

  public function buscar_cidades(){
    $estado = $this->input->post('estado', TRUE);
    if (!is_numeric($estado)){
        $buscar = $this->getEstado($estado);
        if (isset($buscar['id'])){
            $estado = $buscar['id'];
        } else {
            exit();
            die();
        }
    }

    $cidades = $this->model->selecionaBusca('cidades', "WHERE `id_estado`='{$estado}' ");
    echo json_encode($cidades);
  }

  protected function getCep($cep){  
    $get = 'http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $get);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $resultado = $output;
    if(!$resultado){  
        $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
    }  
    parse_str($resultado, $retorno);   
    return $retorno;  
} 

  public function buscar_cep(){
    $cep = $this->input->post('cep', TRUE);
    if (!is_numeric($cep)){
        $cep = preg_replace('/[^0-9]/', '', $cep);
    }
    $retorno = $this->getCep($cep);

    $estado = $this->getEstado(utf8_encode($retorno['uf']));
    $cidades = isset($estado['id']) ? $this->model->selecionaBusca('cidades', "WHERE `id_estado`='{$estado['id']}' ") : [];
    $cidade = $this->getCidade(utf8_encode($retorno['cidade']));

    $retorno = [
        'cep' => $cep,
        'estado' => isset($estado['id']) ? $estado : null,
        'cidades' => $cidades,
        'cidade' => isset($cidade['id']) ? $cidade : null
    ];
    echo json_encode($retorno);
  }
}
