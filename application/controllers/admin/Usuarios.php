<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Usuarios extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
    } else if (!buscaPermissao('rede', 'visualizar')) {
        gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }
  
  public function listar() {
    $data['usuarios'] = $this->model->selecionaBusca('usuario', "");
    for ($i=0; $i<count($data['usuarios']); $i++){
        if (isset($data['usuarios'][$i]['indicado_por'])){
            $aux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$data['usuarios'][$i]['indicado_por']}' ");
            $data['usuarios'][$i]['indicador'] = isset($aux[0]['login']) ? $aux[0]['login'] : "Não encontrado";
        } else {
            $data['usuarios'][$i]['indicador'] = "Não possui";
        }
        $aux = $this->model->selecionaBusca("plano_usuario", "WHERE `id_usuario`='{$data['usuarios'][$i]['id']}' AND `ativo`='1' ");
        $data['usuarios'][$i]['plano'] = '<span class="badge badge-danger">Não Possui</span>';
        if (isset($aux[0]['id'])){
            $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$aux[0]['id_plano']}' ");
            $dtAtivacao = explode(" ", $aux[0]['data_resposta']);
            $parte1 = explode("-", $dtAtivacao[0]);
            $parte2 = explode(':', $dtAtivacao[1]);
            $data['usuarios'][$i]['plano'] = '<button class="btn btn-success btn_planos" 
            onclick="informacoesAss('."'plano', '".$data['usuarios'][$i]['login']."', '".$planoat[0]['nome']."', '".$planoat[0]['valor']."', '".$parte1[2]."/".$parte1[1]."/".$parte1[0]." as ".$parte2[0].":".$parte2[1]."'".');" ><i class="fa fa-search"></i></button><span class="badge badge-success">Plano '.$planoat[0]['nome'].'</span>';
        } else {
            $aux = $this->model->selecionaBusca("voucher_usuario", "WHERE `id_usuario`='{$data['usuarios'][$i]['id']}' ");
            if (isset($aux[0]['id'])){
                $dtAtivacao = explode(" ", $aux[0]['data_pedido']);
            $parte1 = explode("-", $dtAtivacao[0]);
            $parte2 = explode(':', $dtAtivacao[1]);
                $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$aux[0]['id_plano']}' ");
                $data['usuarios'][$i]['plano'] = '<button class="btn btn-warning btn_planos" 
            onclick="informacoesAss('."'plano', '".$data['usuarios'][$i]['login']."', '".$planoat[0]['nome']."', '".$planoat[0]['valor']."', '".$parte1[2]."/".$parte1[1]."/".$parte1[0]." as ".$parte2[0].":".$parte2[1]."'".');" ><i class="fa fa-search"></i></button><span class="badge badge-warning">Volcher '.$planoat[0]['nome'].'</span>';
            }
        }
    }
    
    $this->load->view('admin/header');
    $this->load->view('admin/usuarios', $data);
    $this->load->view('admin/footer');
  }
  
  
  public function visualizarRede($id) {
    $data['id_usuario'] = $id;
    $data['users'] = $this->model->selecionaBusca("usuario", "");
    $footer['script'] = '$(document).ready(function () { getTree(); });';
    $this->load->view('admin/header');
    $this->load->view('admin/visualizarRede', $data);
    $this->load->view('admin/footer', $footer);
  }
  
  public function show_raiz_arvore_usuarios()
  {
    $post = file_get_contents('php://input');
    $post = json_decode($post);
    $post = (array)$post;
    if (isset($post['data'])){
        $array = (array)$post['data'];

          $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$array['id']}' ");
          $idbusca = isset($array['id_usuario']) ? $array['id_usuario'] : $arvore[0]['raiz'];
          $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$idbusca}' LIMIT 1");
          
          if (isset($usuario[0]['id']) && isset($usuario[0]['id'])){
            $detalhado = isset($array['detalhado']) ? $array['detalhado'] : true;
            $n_ramos = isset($array['n_ramos']) ? $array['n_ramos'] : 0;
            $modo = isset($array['modo']) ? $array['modo'] : 1;
            $resposta['tipo'] = 'success';
            $resposta['msg'] = '';
            $resposta['formato'] = listaUsuariosRede($usuario[0]['id'], $detalhado, $n_ramos, $modo);
          } else {
            $resposta['tipo'] = "error";
            $resposta['msg'] = "user not found";
          }
         echo json_encode($resposta);
    }
  }
  
  public function retorna_saldo()
  {
    $post = file_get_contents('php://input');
    $post = json_decode($post);
    $post = (array)$post;
    if (isset($post['data'])){
        $array = (array)$post['data'];
      $resposta['tipo'] = "success";
      $resposta['saldo'] = 0;
      $resposta['pontos_direita'] = 0;
      $resposta['pontos_esquerda'] = 0;
      $resposta['score_direita'] = 0;
      $resposta['score_esquerda'] = 0;
      $resposta['pontos_carreira'] = 0;
      
      $verificador = $this->model->selecionaBusca("verificador", "");
      $saldo_at = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id']}' ");
      $resposta['data_verificacao'] = date('d/m/Y');
      if (isset($verificador[0]['id'])){
          $config = $this->model->selecionaBusca("configuracoes", "");
          $dia = explode(' ', $verificador[0]['ultima_verificacao']);
          $verifdata = $dia[0];
          $dataverf = explode("-",$dia[0]);
          $dia = explode('-', $dia[0])[2];
          
          $resposta['data_verificacao'] = $dataverf[2].'/'.$dataverf[1].'/'.$dataverf[0];
          $balanco = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='{$array['id']}' AND `criado_em`>='".$verifdata." 00:00:00' AND `criado_em`<='".$verifdata." 23:59:59' AND `tipo`='diario' ORDER BY id DESC ");
          $resposta['daily'][0] = isset($balanco[0]['id']) ? number_format($balanco[0]['valor'], 2, '.', '') : 0;
          $diab = intval($dia);
            $resposta['daily'][1] = isset($config[0]['ganho_diario_'.$diab]) ? $config[0]['ganho_diario_'.$diab] : 0;
        
      } else {
            $balanco = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='{$array['id']}' AND `criado_em`>='".date('Y-m-d 00:00:00')."' AND `tipo`='diario' ORDER BY id DESC ");
          $dia = intval(date('d'));
          $resposta['daily'][0] = isset($balanco[0]['id']) ? number_format($balanco[0]['valor'], 2, '.', '') : 0;
            $resposta['daily'][1] = isset($config[0]['ganho_diario_'.$diab]) ? $config[0]['ganho_diario_'.$diab] : 0;
          
      }
      
      
      
      $config = $this->model->selecionaBusca('configuracoes', "WHERE `id`='1'");
      
      
      
      if (isset($saldo_at[0]['id'])){
        $resposta['saldo'] = number_format($saldo_at[0]['saldo'], 2, '.', '');
        $resposta['pontos_direita'] = $saldo_at[0]['pontos_direita'];
        $resposta['pontos_esquerda'] = $saldo_at[0]['pontos_esquerda'];
        $resposta['score_direita'] = $saldo_at[0]['score_direita'];
        $resposta['score_esquerda'] = $saldo_at[0]['score_esquerda'];
        $resposta['pontos_carreira'] = $saldo_at[0]['pontos_carreira'];
      }
      echo json_encode($resposta);
    }
    
  }
  
  
  public function listar_volcher() {
    $data['usuarios'] = array();
    $i = 0;
    $entradas = $this->model->selecionaBusca("voucher_usuario", "");
    foreach ($entradas as $ent){
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$ent['id_usuario']}' ");
        if (isset($usuario[0]['id'])){
            $data['usuarios'][$i] = $usuario[0];
            $aux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$data['usuarios'][$i]['indicado_por']}' ");
            $data['usuarios'][$i]['indicador'] = isset($aux[0]['login']) ? $aux[0]['login'] : "Não encontrado";
            $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$ent['id_plano']}' ");
            $dtAtivacao = explode(" ", $ent['data_pedido']);
            $parte1 = explode("-", $dtAtivacao[0]);
            $parte2 = explode(':', $dtAtivacao[1]);
            
            $data['usuarios'][$i]['plano'] = '<button class="btn btn-warning btn_planos" 
            onclick="informacoesAss('."'plano', '".$data['usuarios'][$i]['login']."', '".$planoat[0]['nome']."', '".$planoat[0]['valor']."', '".$parte1[2]."/".$parte1[1]."/".$parte1[0]." as ".$parte2[0].":".$parte2[1]."'".');" ><i class="fa fa-search"></i></button><span class="badge badge-warning">Volcher '.$planoat[0]['nome'].'</span>';
            $i++;
        }
    }
    
    $this->load->view('admin/header');
    $this->load->view('admin/usuarios', $data);
    $this->load->view('admin/footer');
  }
  
  public function listar_plano() {
    $data['usuarios'] = array();
    $i = 0;
    $entradas = $this->model->selecionaBusca("plano_usuario", "WHERE `ativo`='1' ");
    foreach ($entradas as $ent){
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$ent['id_usuario']}' ");
        if (isset($usuario[0]['id'])){
            $data['usuarios'][$i] = $usuario[0];
            $aux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$data['usuarios'][$i]['indicado_por']}' ");
            $data['usuarios'][$i]['indicador'] = isset($aux[0]['login']) ? $aux[0]['login'] : "Não encontrado";
            $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$ent['id_plano']}' ");
            $dtAtivacao = explode(" ", $ent['data_resposta']);
            $parte1 = explode("-", $dtAtivacao[0]);
            $parte2 = explode(':', $dtAtivacao[1]);
            $data['usuarios'][$i]['plano'] = '<button class="btn btn-success btn_planos" 
            onclick="informacoesAss('."'plano', '".$data['usuarios'][$i]['login']."', '".$planoat[0]['nome']."', '".$planoat[0]['valor']."', '".$parte1[2]."/".$parte1[1]."/".$parte1[0]." as ".$parte2[0].":".$parte2[1]."'".');" ><i class="fa fa-search"></i></button><span class="badge badge-success">Plano '.$planoat[0]['nome'].'</span>';
            $i++;
        }
    }
    
    $this->load->view('admin/header');
    $this->load->view('admin/usuarios', $data);
    $this->load->view('admin/footer');
  }
  
  public function editar($id) {
    $data['usuario'] = $this->model->selecionaBusca("usuario", "WHERE `id`='".$id."' ");
    if (isset($data['usuario'][0]['id'])){
        $data['saldo_usuario'] = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$id}' ");
        if (!isset($data['saldo_usuario'][0]['id'])){
            $novosaldo = array(
              'id_usuario' => $id,
              'saldo' => 0
            );
            $idsaldo = $this->model->insere_id("saldo_usuario", $novosaldo);
            $data['saldo_usuario'] = $this->model->selecionaBusca('saldo_usuario', "WHERE `id`='{$idsaldo}' ");
        }
        
        $class1 = "'text-center'";
        $class2 = "'".'"+cls+"'."'";
        $classbtn = "'btn btn-primary'";
        $data_toggle= "'modal'";
        $data_target= "'#modal_inserir_entrada'";
        $footer['script'] = '$(document).ready(function () {
            $("#profile").html('."'".'<center><br/><i class="fa fa-spin fa-spinner"></i> Buscando Histórico...</center>'."'".');
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "'.site_url('admin/usuarios/historico_financeiro/'.$id).'",
                success: function (data) {
                    console.log(data);
                    var tabela = "<button class='.$classbtn.' data-toggle='.$data_toggle.' data-target='.$data_target.' >Inserir Entrada</button><br/><table id='."'dataTableH' style='width:100%'".'><thead><tr><th '.$class1.'>Data</th><th '.$class1.'>ID</th><th '.$class1.'>Usuário</th><th '.$class1.'>Descrição</th><th '.$class1.'>Valor</th></tr></thead><tbody>";
                    
                    var totalln = data.balanco.length;
                            if (totalln > 0){
                                var ci = 1;
                                for (var i=totalln-1; i>=0; i--){
                                    var aux = data.balanco[i];
                                    var cls = "text-success";
                                    if (aux.tipo == "saque" || aux.tipo == "debito"){
                                        cls = "text-danger";
                                    }
                                    
                                    tabela += "<tr><td >"+aux.criado_em+"</td><td >"+aux.id+"</td><td >'.$data['usuario'][0]['login'].'</td><td >"+aux.descricao+"</td><td class='.$class2.' >"+aux.vlfm+"</td></tr>";
                                }
                            } else {
                                tabela += "<tr><td colspan='."'5'".' class='."'text-center'".' >Nenhum histórico encontrado.</td></td>";
                            }
                    
                    tabela += "</tbody></table>";
                    $("#profile").html(tabela);
                    $("#dataTableH").DataTable({
                        "bInfo" : false,
                        "pageLength": 10,
                        "order": [[ 0, "desc" ]]
                    });
                },
                error: function (err){
                    console.log(err.responseText);
                }
            });
        });';
        $this->load->view('admin/header');
        $this->load->view('admin/editar_usuario', $data);
        $this->load->view('admin/footer', $footer);
    } else {
       $this->session->set_userdata(array(
            'notif' => "Usuário não encontrado!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        )); 
        redirect('admin/usuarios/listar');
    }
  }
  
  public function update($id) {
    $data['usuario'] = $this->model->selecionaBusca("usuario", "WHERE `id`='".$id."' ");
    if (isset($data['usuario'][0]['id'])){
       $data['saldo_usuario'] = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$id}' ");
        if (!isset($data['saldo_usuario'][0]['id'])){
            $this->session->set_userdata(array(
                'notif' => "Saldo não encontrado!",
                'notif_tipo' => 'danger',
                'notif_titulo' => 'Erro!'
            )); 
            redirect('admin/usuarios/editar/'.$id);
        } else {
            $update = array(
                'saldo' => $this->input->post('saldo'),
                'pontos_carreira' => $this->input->post('pontos_carreira'),
                'score_esquerda' => $this->input->post('score_esquerda'),
                'score_direita' => $this->input->post('score_direita'),
                'pontos_esquerda' => $this->input->post('pontos_esquerda'),
                'pontos_direita' => $this->input->post('pontos_direita')
            );
            
            $upd = $this->model->update("saldo_usuario", $update, $data['saldo_usuario'][0]['id']);
            if ($upd){
                addRegistro("Alterou o saldo do usuário #".$data['usuario'][0]['id']." - ".$data['usuario'][0]['login']."<br/>Dados: ".print_r($update, true));
                
                $this->session->set_userdata(array(
                    'notif' => "Usuário atualizado com sucesso!",
                    'notif_tipo' => 'success',
                    'notif_titulo' => 'Sucesso!'
                ));
                
                redirect('admin/usuarios/editar/'.$id);
            } else {
                $this->session->set_userdata(array(
                    'notif' => "Erro ao atualizar o usuário, tente novamente!",
                    'notif_tipo' => 'danger',
                    'notif_titulo' => 'Erro!'
                )); 
                redirect('admin/usuarios/listar');
            }
             
        }
    } else {
       $this->session->set_userdata(array(
            'notif' => "Usuário não encontrado!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        )); 
        redirect('admin/usuarios/listar');
    }
  }
  
  public function update_usuario($id){
        if (isset($_POST['login'])){
            $busca2 = $this->model->selecionaBusca('usuario', "WHERE `login`='{$_POST['login']}' AND `id`!='{$id}'  ");
        }
        if (isset($busca2[0]['id'])){
            $this->session->set_userdata(array(
                'notif' => "Login já registrado em outro usuário!",
                'notif_tipo' => 'danger',
                'notif_titulo' => 'Erro!'
            )); 
            redirect('admin/usuarios/editar/'.$id);
        } else {
              if (atualizar_obj("usuario", $_POST, $id)){
                  addRegistro("Alterou os dados do usuário #".$id." - ".$_POST['login']."<br/>Dados: ".print_r($_POST, true));
                  $this->session->set_userdata(array(
                        'notif' => "Usuário atualizado com sucesso!",
                        'notif_tipo' => 'success',
                        'notif_titulo' => 'Sucesso!'
                    )); 
                    redirect('admin/usuarios/editar/'.$id);
              } else {
                   $this->session->set_userdata(array(
                        'notif' => "Erro ao atualizar o usuário!",
                        'notif_tipo' => 'danger',
                        'notif_titulo' => 'Erro!'
                    )); 
                    redirect('admin/usuarios/editar/'.$id);
              }
        }
  }
  
  public function nova_senha($id){
    $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='".$id."' ");
    if (isset($usuario[0]['id'])){
        if ($usuario[0]['bloqueado'] == 0){
          $nvsenha = RandomString(12);
          
          $options = array("cost"=>4);
          $hashPassword = password_hash($nvsenha,PASSWORD_BCRYPT,$options);
          $update['senha'] = $hashPassword;
          $att = $this->model->update('usuario', $update, $usuario[0]['id']);
          if ($att){
            $assunto = "Password Recovery";
            $texto = "Your new password was generated. As soon as you login into our system again, change it for something of your preference.<br/><br/>New Password: <b>".$nvsenha."</b>";
    
            $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
            addRegistro("Gerou e enviou uma nova senha para o usuário #".$id." - ".$usuario[0]['login']." por email.");
            $this->session->set_userdata(array(
                'notif' => "Nova senha gerada e enviada por email com sucesso!",
                'notif_tipo' => 'success',
                'notif_titulo' => 'Sucesso!'
            )); 
            redirect('admin/usuarios/editar/'.$id);
          }
        } else {
            $this->session->set_userdata(array(
                'notif' => "Falha ao atualizar o usuário!",
                'notif_tipo' => 'danger',
                'notif_titulo' => 'Erro!'
            )); 
            redirect('admin/usuarios/editar/'.$id);
        }
    } else {
       $this->session->set_userdata(array(
            'notif' => "Usuário não encontrado!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        )); 
        redirect('admin/usuarios/listar');
    }
  }
  
  public function inserir_entrada($id){
    $data['usuario'] = $this->model->selecionaBusca("usuario", "WHERE `id`='".$id."' ");
    if (isset($data['usuario'][0]['id'])){
        
        $entrada = array(
            'id_usuario' => $id,
                'tipo' => $this->input->post('tipo'),
                'valor' => $this->input->post('valor')
        );
        $criado_em = $this->input->post('criado_em');
        if (strpos($criado_em, " ") !== false){
            $checa = explode(" ", $criado_em);
            if (count($checa) == 2 && strpos($checa[0], "-") !== false && strpos($checa[1], ":") !== false){
                $digitos = explode('-', $checa[0]);
                $timer = explode(':', $checa[1]);
                
                $ano = isset($digitos[0]) ? $digitos[0] : date('Y');
                $mes = isset($digitos[1]) ? $digitos[1] : date('m');
                $dia = isset($digitos[2]) ? $digitos[2] : date('d');
                
                $HH = isset($timer[0]) ? $timer[0] : date('H');
                $ii = isset($timer[1]) ? $timer[1] : date('i');
                $ss = isset($timer[2]) ? $timer[2] : date('s');
                
                $entrada['criado_em'] = $ano.'-'.$mes.'-'.$dia.' '.$HH.':'.$ii.':'.$ss;
                $entrada['ultima_att'] = $entrada['criado_em'];
            }
        }    
            $upd = $this->model->insere("balanco", $entrada);
            if ($upd){
                addRegistro("Adcionou uma entrada ao historico financeiro do usuário #".$data['usuario'][0]['id']." - ".$data['usuario'][0]['login']."<br/>Dados: ".print_r($entrada, true));
                $this->session->set_userdata(array(
                    'notif' => "Entrada inserida com sucesso!",
                    'notif_tipo' => 'success',
                    'notif_titulo' => 'Sucesso!'
                ));
                
                redirect('admin/usuarios/editar/'.$id);
            } else {
                $this->session->set_userdata(array(
                    'notif' => "Erro ao inserir a entrada, tente novamente!",
                    'notif_tipo' => 'danger',
                    'notif_titulo' => 'Erro!'
                )); 
                redirect('admin/usuarios/listar');
            }
    } else {
       $this->session->set_userdata(array(
            'notif' => "Usuário não encontrado!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        )); 
        redirect('admin/usuarios/listar');
    }
  }
  
  public function buscarUniLv($us, $nivel){
      $retorno = getUnilevelNV($us, $nivel);
      echo json_encode($retorno);
  }
  
  public function bloquear($id){
      $update = array('bloqueado' => 1);
      $upd = $this->model->update("usuario", $update, $id);
      if ($upd){
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$id}' ");
        if (isset($usuario[0]['id'])){
            addRegistro("Bloqueou o acesso do usuário #".$usuario[0]['id']." - ".$usuario[0]['login']);
        }
        
        $this->session->set_userdata(array(
            'notif' => "Usuário bloqueado com sucesso!",
            'notif_tipo' => 'success',
            'notif_titulo' => 'Sucesso!'
        ));
        
        redirect('admin/usuarios/listar');
      } else {
          $this->session->set_userdata(array(
            'notif' => "Falha ao bloquear o usuário!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        ));
        
        redirect('admin/usuarios/listar');
      }
  }
  
  public function desbloquear($id){
      $update = array('bloqueado' => 0);
      $upd = $this->model->update("usuario", $update, $id);
      if ($upd){
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$id}' ");
        if (isset($usuario[0]['id'])){
            addRegistro("Desbloqueou o acesso do usuário #".$usuario[0]['id']." - ".$usuario[0]['login']);
        }
        $this->session->set_userdata(array(
            'notif' => "Usuário desbloqueado com sucesso!",
            'notif_tipo' => 'success',
            'notif_titulo' => 'Sucesso!'
        ));
        
        redirect('admin/usuarios/listar');
      } else {
          $this->session->set_userdata(array(
            'notif' => "Falha ao desbloquear o usuário!",
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Erro!'
        ));
        
        redirect('admin/usuarios/listar');
      }
  }
  
  public function historico_financeiro($id){
      $busca = "WHERE `id_usuario`='{$id}' ";
      $saldo = $this->model->selecionaBusca('balanco', $busca." ORDER BY `criado_em` DESC");
      $resposta['entradas_total'] = 0;
      $resposta['saidas_total'] = 0;
      $resposta['saques_total'] = 0;
      $resposta['total_taxas'] = 0;
      $resposta['saldo_total'] = 0;
      
      $resposta['diario_total'] = 0;
      $resposta['binario_total'] = 0;
      $resposta['indicacao_total'] = 0;
      $resposta['residual_total'] = 0;
      
      $resposta['balanco'] = array();
      
      $entradas['reposta'] = array();
      
      $binttl = array();
      $resttl = array();
      $cbal = 0;
      for ($i=0; $i<count($saldo); $i++){
        
        if ($saldo[$i]['tipo'] == 'diario'){
            $resposta['balanco'][$cbal] = $saldo[$i];
            $resposta['balanco'][$cbal]['descricao'] = str_replace(" from subscription plano teste", "", $resposta['balanco'][$cbal]['descricao']);
             $resposta['balanco'][$cbal]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
            $resposta['balanco'][$cbal]['valor_total'] = $saldo[$i]['valor_plano'];
        $resposta['balanco'][$cbal]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            unset($resposta['balanco'][$cbal]['usuario']);
            unset($resposta['balanco'][$cbal]['valor_plano']);
            unset($resposta['balanco'][$cbal]['plano']);
            
            $resposta['diario_total']  += $saldo[$i]['valor'];
            

              $resposta['saldo_total'] += $saldo[$i]['valor'];
              $resposta['entradas_total'] += $saldo[$i]['valor'];
              unset($resposta['balanco'][$cbal]['tx_pct']);
              unset($resposta['balanco'][$cbal]['tx_valor']);
            $resposta['balanco'][$cbal]['vlfm'] = number_format($saldo[$i]['valor'], 2, '.', '');
            
            $cbal++;
        } else if ($saldo[$i]['tipo'] == 'binario'){
            $achou = false;
            $dtcheck = explode(' ', $saldo[$i]['criado_em']);
            $nttl = count($binttl);
            for ($k=0; $k<$nttl; $k++){
                $datadia = explode(' ', $binttl[$k]['criado_em']);
                if ($dtcheck[0] == $datadia[0]){
                    $binttl[$k]['valor'] += $saldo[$i]['valor'];
                    $achou = true;
                    break;
                }
            }
            if (!$achou){
                $resposta['balanco'][$cbal] = array();
                $binttl[$nttl] = $saldo[$i];
                $binttl[$nttl]['index'] = $cbal;
                $binttl[$nttl]['descricao'] = "Daily binary profit";
                $cbal++;
            }
            $resposta['saldo_total'] += $saldo[$i]['valor'];
              $resposta['entradas_total'] += $saldo[$i]['valor'];
          $resposta['binario_total']  += $saldo[$i]['valor'];
        } else if ($saldo[$i]['tipo'] == 'residual'){
            $achou = false;
            $dtcheck = explode(' ', $saldo[$i]['criado_em']);
            $nttl = count($resttl);
            for ($k=0; $k<$nttl; $k++){
                $datadia = explode(' ', $resttl[$k]['criado_em']);
                if ($dtcheck[0] == $datadia[0]){
                    $resttl[$k]['plano'] = '';
                    $resttl[$k]['valor'] += $saldo[$i]['valor'];
                    $resttl[$k]['valor_plano'] += $saldo[$i]['valor_plano'];
                    $achou = true;
                    break;
                }
            }
            if (!$achou){
                $resposta['balanco'][$cbal] = array();
                $resttl[$nttl] = $saldo[$i];
                $resttl[$nttl]['valor'] = $saldo[$i]['valor'];
                $resttl[$nttl]['index'] = $cbal;
                $resttl[$nttl]['descricao'] = "Daily residual profit";
                $cbal++;
            }
            $resposta['saldo_total'] += $saldo[$i]['valor'];
              $resposta['entradas_total'] += $saldo[$i]['valor'];
          $resposta['residual_total']  += $saldo[$i]['valor'];
        } else if ($saldo[$i]['tipo'] == 'indicacao'){
            
            $resposta['balanco'][$cbal] = $saldo[$i];
             $resposta['balanco'][$cbal]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
        $resposta['balanco'][$cbal]['valor_total'] = $saldo[$i]['valor_plano'];
        $resposta['balanco'][$cbal]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            unset($resposta['balanco'][$cbal]['usuario']);
            unset($resposta['balanco'][$cbal]['valor_plano']);
            unset($resposta['balanco'][$cbal]['plano']);
          $resposta['indicacao_total']  += $saldo[$i]['valor'];
          

              $resposta['saldo_total'] += $saldo[$i]['valor'];
              $resposta['entradas_total'] += $saldo[$i]['valor'];
              unset($resposta['balanco'][$cbal]['tx_pct']);
              unset($resposta['balanco'][$cbal]['tx_valor']);
          $resposta['balanco'][$cbal]['vlfm'] = number_format($saldo[$i]['valor'], 2, '.', '');
          $cbal++;
        } else if($saldo[$i]['tipo'] == "saque") {
             $resposta['balanco'][$cbal] = $saldo[$i];
             $resposta['balanco'][$cbal]['descricao'] = '$'.$resposta['balanco'][$cbal]['valor'].' - '.$resposta['balanco'][$cbal]['descricao'];
             $resposta['balanco'][$cbal]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
        $resposta['balanco'][$cbal]['valor_total'] = $saldo[$i]['valor_plano'];
        $resposta['balanco'][$cbal]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            unset($resposta['balanco'][$cbal]['usuario']);
            unset($resposta['balanco'][$cbal]['valor_plano']);
            unset($resposta['balanco'][$cbal]['plano']);
              $resposta['saldo_total'] -= $saldo[$i]['valor'];
              $resposta['saidas_total'] += $saldo[$i]['valor'];
              $resposta['saques_total'] += $saldo[$i]['valor'] - $saldo[$i]['tx_valor'];
              $resposta['total_taxas'] += $saldo[$i]['tx_valor'];
              $resposta['balanco'][$cbal]['vlfm'] = number_format($saldo[$i]['valor'], 2, '.', '');
              $cbal++;
        } else if ($saldo[$i]['tipo'] == "debito"){
             $resposta['balanco'][$cbal] = $saldo[$i];
             $resposta['balanco'][$cbal]['descricao'] = '$'.$resposta['balanco'][$cbal]['valor'].' - '.$resposta['balanco'][$cbal]['descricao'];
             $resposta['balanco'][$cbal]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
        $resposta['balanco'][$cbal]['valor_total'] = $saldo[$i]['valor_plano'];
        $resposta['balanco'][$cbal]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            unset($resposta['balanco'][$cbal]['usuario']);
            unset($resposta['balanco'][$cbal]['valor_plano']);
            unset($resposta['balanco'][$cbal]['plano']);
            $resposta['saldo_total'] -= $saldo[$i]['valor'];
            $resposta['saidas_total'] += $saldo[$i]['valor'];
            $resposta['balanco'][$cbal]['vlfm'] = number_format($saldo[$i]['valor'], 2, '.', '');
              $cbal++;
        } else if ($saldo[$i]['tipo'] == "credito" || $saldo[$i]['tipo'] == "estorno"){
             $resposta['balanco'][$cbal] = $saldo[$i];
             $resposta['balanco'][$cbal]['descricao'] = '$'.$resposta['balanco'][$cbal]['valor'].' - '.$resposta['balanco'][$cbal]['descricao'];
             $resposta['balanco'][$cbal]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
        $resposta['balanco'][$cbal]['valor_total'] = $saldo[$i]['valor_plano'];
        $resposta['balanco'][$cbal]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            unset($resposta['balanco'][$cbal]['usuario']);
            unset($resposta['balanco'][$cbal]['valor_plano']);
            unset($resposta['balanco'][$cbal]['plano']);
            $resposta['saldo_total'] += $saldo[$i]['valor'];
            $resposta['balanco'][$cbal]['vlfm'] = number_format($saldo[$i]['valor'], 2, '.', '');
            //$resposta['entradas_total'] += $saldo[$i]['valor'];
              $cbal++;
        }
        
       
        
      }
      
        foreach ($binttl as $bin){
            $resposta['balanco'][$bin['index']] = $bin;
            $resposta['balanco'][$bin['index']]['descricao'] = '$'.number_format($bin['valor'], 2, '.', '').' - Daily binary profit';
            $resposta['balanco'][$bin['index']]['valor_plano'] = number_format($bin['valor'], 2, '.', '');
            $resposta['balanco'][$bin['index']]['valor_total'] = number_format($bin['valor'], 2, '.', '');
            $resposta['balanco'][$bin['index']]['vlfm'] = number_format($bin['valor'], 2, '.', '');
        }
        foreach ($resttl as $bin){
            $resposta['balanco'][$bin['index']] = $bin;
            $resposta['balanco'][$bin['index']]['descricao'] = '$'.number_format($bin['valor'], 2, '.', '').' - Daily residual profit';
            $resposta['balanco'][$bin['index']]['valor_plano'] = number_format($bin['valor'], 2, '.', '');
            $resposta['balanco'][$bin['index']]['valor_total'] = number_format($bin['valor'], 2, '.', '');
            $resposta['balanco'][$bin['index']]['vlfm'] = number_format($bin['valor'], 2, '.', '');
        }
        
       
      
      $resposta['diario_total'] = number_format($resposta['diario_total'], 2, '.', '');
      $resposta['saldo_total'] = number_format($resposta['saldo_total'], 2, '.', '');
      $resposta['saques_total'] = number_format($resposta['saques_total'], 2, '.', '');
      $resposta['total_taxas'] = number_format($resposta['total_taxas'], 2, '.', '');
      $resposta['indicacao_total'] = number_format($resposta['indicacao_total'], 2, '.', '');
      $resposta['diario_total'] = number_format($resposta['diario_total'], 2, '.', '');
      $resposta['binario_total'] = number_format($resposta['binario_total'], 2, '.', '');
      $resposta['residual_total'] = number_format($resposta['residual_total'], 2, '.', '');
      $resposta['tipo'] = "success";
      unset($resposta['msg']);

    echo json_encode($resposta);
  }
  
  public function unilevel($id) {
    $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$id}' ");
    $data['usuario'] = isset($usuario[0]['login']) ? $usuario[0]['login'] : "Não encontrado";
    
    $footer['script'] = 'var nivelat = 0;
    function mudaNivel(nv){
        if (nv != nivelat){
            $("#nav-tabContent").html('."'".'<center><br/><i class="fa fa-spin fa-spinner"></i> Buscando Usuários...</center>'."'".');
            nivelat = nv;
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "'.site_url('admin/usuarios/buscarUniLv/'.$id).'/"+nv,
                success: function (data) {
                    console.log(data["nivel_"+nv]);
                    var tabela = "<table id='."'dataTable' style='width:100%'".'><thead><tr><th>ID</th><th>Usuário</th><th>Nome</th><th>País</th><th>Perna</th></tr></thead><tbody>";
                    for (var i = 0; i < data["nivel_"+nv].length; i++){
                        var ele = data["nivel_"+nv][i];
                        tabela += "<tr><td>"+ele.id+"</td><td>"+ele.login+"</td><td>"+ele.nome+"</td><td>"+ele.pais+"</td><td>"+ele.perna+"</td></tr>";
                    }
                    tabela += "</tbody></table>";
                    $("#nav-tabContent").html(tabela);
                    $("#dataTable").DataTable({
                        "bInfo" : false,
                        "pageLength": 10
                    });
                },
                error: function (err){
                    console.log(err.responseText);
                }
            }); 
        }
    }
    $(document).ready(function () {
       mudaNivel(1);
    });';
    
    $this->load->view('admin/header');
    $this->load->view('admin/unilevel', $data);
    $this->load->view('admin/footer', $footer);
  }
  
}