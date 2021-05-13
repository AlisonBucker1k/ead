<?php
/* CAMPOS NA DATABASE QUE SÃO DE ARQUIVOS \/\/\/\/ || ADCIONAR MAIS CAMPOS AQUI */
function getFileFields(){
  return [
    'foto',
    'comprovante',
  ];
}

function getExtension($field){
  $nome = explode('.', $_FILES[$field]['name']);

  $counter = count($nome) - 1;

  return $nome[$counter];
}

/* ============================================================================================================ */

//CONFIGURAÇÕES DEFAULT DE ENVIO DE ARQUIVOS
/* ALTERAR NA CHAMADA DA FUNÇÃO do_upload OS ARGUMENTOS ENVIADOS! */
function defaultConfigUpload(){
  return [
    'upload_path' => './uploads/',
    'allowed_types' => 'gif|jpg|png|jpeg'
  ];
}

/* VERIFICA OS ARGUMENTOS ENVIADOS NA FUNÇÃO DO_UPLOAD E RETORNA OU ELES OU A CONFIG PADRÃO */
function checkArgs($args){
  $config = defaultConfigUpload();
  foreach ($args as $k=>$v){
    $config[$k] = $v;
  }
  return $config;
}

/* FAZ O UPLOAD DO ARQUIVO E RETORNA SEU NOME CASO ELE SEJA ENVIADO */
function doUpload($field, $args=[]){
  $CI = &get_instance();
  $config = checkArgs($args); //recebe as configurações de envio

  $CI->load->library('upload', $config);
  //tenta fazer o upload do arquivo

  if ($CI->upload->do_upload($field)){
    //caso o upload seja feito corretamente =============
    $data = array('arquivo_data' => $CI->upload->data());
    return $data['arquivo_data']['file_name']; //retorna o nome do arquivo enviado.
  } else {
    $error = array('error' => $CI->upload->display_errors());

    $mensagem = "Erro no envio de arquivos";
    if (isset($error['error']) && !empty($error['error'])){
      $mensagem .= "<br/>campo: ".$field.'<br/>'.$error['error'];
    }
    throwError($mensagem);
    return 1;
  }
}


//VERIFICA SE O CAMPO É DE UPLOAD, SE FOR, FAZ O UPLOAD DO ARQUIVO
function searchUploadField($field, $configFile = []){
  $sc = getFileFields();

  foreach($sc as $f){
    if ($field == $f){
      return doUpload($field, $configFile);
    }
  }
  return 0;
}

function returnArray($table, $configFile = []){
    $CI = &get_instance();
    $fields = $CI->db->list_fields($table);
    $data = [];
    foreach ($fields as $field) {
      if ($CI->input->post($field, TRUE) !== null && $CI->input->post($field, TRUE) !== "" ) {
        if ($field == "senha") {
          if ($CI->input->post('senha', TRUE) != "") {
            $options = array("cost" => 4);
            $senhahash = password_hash($CI->input->post('senha', TRUE), PASSWORD_BCRYPT, $options);
            $data[$field] = $senhahash;
          }
        } else if ($field == 'telefone' || $field == 'cpf'){
          $data[$field] = preg_replace('/[^0-9]/', '', $CI->input->post($field, TRUE));
        } else {
          $data[$field] = $CI->input->post($field, TRUE);
        }
      } else {
        $get = searchUploadField($field, $configFile); //verifica se o arquivo precisa ser enviado (UPLOAD)
        if (strlen($get) > 4) {
          $data[$field] = $get;
        }
      }
    }
    return $data;
}