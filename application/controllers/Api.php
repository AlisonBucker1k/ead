<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  public function __construct()
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
      die();
    }
    parent::__construct();
  }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
  /* public function cadastrar_api()
	{
    $array['api_id'] = RandomString(5);
    $array['token'] = RandomString(40);
		$insere = $this->model->insere('api', $array);
    if ($insere){
      print_r($array);
    } else {
      echo 'Falha ao gerar a API';
    }
	} */
/* ====================================================================================================================================================================== */
/* FUNÇÕES MANUAIS ADMIN  =============================================================================================================================================== */
/* ====================================================================================================================================================================== */
/* public function add_seed_auth(){
  header('Content-Type: text/plain');
  require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
  $g = new GoogleAuthenticator();
  $g->test_timer();
  
  $secret = $g->generateSecret();
  $array = array(
    'seed' => $secret
  );
  $this->model->update('google_auth', $array, 1);
  
  print "Get a new Secret: $secret \n";

  print "The QR Code for this secret (to scan with the Google Authenticator App: \n";
  print $g->getURL($_SERVER['SERVER_NAME'], 'teste',$secret);
  print "\n";
}
  
  
  
  
public function test_auth(){
  $gauth = $this->model->selecionaBusca('google_auth', "WHERE `id`='1' ");
  require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
  $secret = $gauth[0]['seed'];
  $time = floor(time() / 30);
  $code = "679129";

  $g = new GoogleAuthenticator();

  print "Current Code is: ";
  print $g->getCode($secret);

  print "\n";

  print "Check if $code is valid: ";

  if ($g->checkCode($secret,$code)) {
      print "YES \n";   
  } else {
      print "NO \n";
  }
} */

public function ganhoDiarioHoje(){
    $ganho_d = $this->model->selecionaBusca("balanco", "WHERE `criado_em`>='".date('Y-m-d 00:00:00')."' AND `tipo`='diario' ");
    for($i=0; $i<count($ganho_d); $i++){
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='".$ganho_d[$i]['id_usuario']."' ");
        $ganho_d[$i]['usuario'] = $usuario[0]['login'];
    }
    echo '<pre>';
    print_r($ganho_d);
    echo '</pre>';
}
    
public function alterar_saldo()
{
  $resposta['tipo'] = "error";
  $resposta['msg'] = "Something went wrong, try again";
  $requeridos = array('id', 'valor');

  $json = file_get_contents('php://input');

  $retorno = verificaCampos($requeridos, $json, 3);

  $resposta['tipo'] = $retorno['topo'];
  $resposta['msg'] = $retorno['msg'];

  if ($retorno['tipo']){
    $array = $retorno['data'];
    if ($array['valor'] != 0){
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuario[0]['id']) && addSaldo($array['id'], $array['valor'])){
        $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id']}' ");
        $resposta['tipo'] = 'success';
        $resposta['usuario'] = $usuario[0];
        $resposta['saldo'] = isset($saldo[0]['saldo']) ? $saldo[0]['saldo'] : 0;
        unset($resposta['msg']);
      }
    }
  } else {
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

  }
  echo json_encode($resposta);
}

public function buscaBalUser()
{
  $balancos = $this->model->selecionaBusca("balanco", "WHERE `id_usuario`='70' AND `tipo`='indicacao' ");
  echo '<pre>';
  print_r($balancos);
  echo '</pre>';
}
  
  public function ativar_key_auth(){
         require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
        $resposta['tipo'] = "error";
        $resposta['msg'] = "Something went wrong, try again";
    
        $json = file_get_contents('php://input');
        $requeridos = array('id', 'gauth');
        $retorno = verificaCampos(array(), $json, 2);
    
        $resposta['tipo'] = $retorno['topo'];
        $resposta['msg'] = $retorno['msg'];
    
        if ($retorno['tipo']){
          $array = $retorno['data'];
          $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
          if (isset($usuario[0]['id'])){
            $secret = $usuario[0]['gAuth_seed'];
            $time = floor(time() / 30);
            $code = str_replace(" ", "", $array['gauth']);
            $g = new GoogleAuthenticator();
            if ($g->checkCode($secret, $code)) {
                $updater = array('google_auth' => 1);
                $this->model->update('usuario', $updater, $usuario[0]['id']);
                
                $resposta['tipo'] = "success";
                $resposta['msg'] = "";
            } else {
                $resposta['tipo'] = "error";
                $resposta['msg'] = "Incorrect google authenticator code, try again.";
            }
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'user not found';
          }
        } else {
          $resposta['tipo'] = $retorno['topo'];
          $resposta['msg'] = $retorno['msg'];
    
        }
        echo json_encode($resposta); 
  }
  
  public function retorna_key_auth(){
    require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $json = file_get_contents('php://input');
    $requeridos = array('id');
    $retorno = verificaCampos(array(), $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuario[0]['id'])){
        $g = new GoogleAuthenticator();
        unset($resposta['msg']);
        $key = $this->model->selecionaBusca('google_auth', "WHERE `id`='1' ");
        $resposta['chave'] = $usuario[0]['gAuth_seed'];
        $url =  $g->getURL($_SERVER['SERVER_NAME'], $usuario[0]['login'],$resposta['chave']);
        $cr = curl_init();
        $url = $url;
        curl_setopt($cr, CURLOPT_URL, $url);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($cr);
        curl_close($cr);
        
        require_once(getcwd().'/phpqrcode/qrlib.php');
        QRcode::png($g->getURL($_SERVER['SERVER_NAME'], $usuario[0]['login'],$resposta['chave']), $usuario[0]['login']."_qr.png");
        $resposta['url_qr_code'] = site_url('uploads/qrcode/'.$usuario[0]['login']."_qr.png");
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function verif_saque(){
      echo '<pre>';
      print_r(podeSacar(25));
      echo '</pre>';
  }
  
public function enviar_email()
{
  $resposta['tipo'] = "error";
  $resposta['msg'] = "Something went wrong, try again";
  $requeridos = array('email', 'assunto', 'texto');

  $json = file_get_contents('php://input');

  $retorno = verificaCampos($requeridos, $json, 2);

  $resposta['tipo'] = $retorno['topo'];
  $resposta['msg'] = $retorno['msg'];

  if ($retorno['tipo']){
    $array = $retorno['data'];
    $usuario = $this->model->selecionaBusca("usuario", "WHERE `email`='{$array['email']}' ");
    if (isset($usuario[0]['id'])){
        $array['texto'] = "<b>Usuário: </b>".$usuario[0]['login']."<br/><b>Nome: </b>".$usuario[0]['nome']."<br/><b>Email: </b>".$usuario[0]['email']."<br/><br/><b>Menssagem: </b>".$array['texto'];
        $this->submail->enviar("support@moneybemoney.com", $array['assunto'], $array['texto'], "Operador");
    }
    
    $resposta['tipo'] = 'success';
    $resposta['msg'] = 'email successfully sent.';
  } else {
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

  }
  echo json_encode($resposta);
}

public function correcaoScriptSaldoUs(){
    $entradas = $this->model->selecionaBusca("balanco", "WHERE `criado_em`='2020-06-11 12:18:11' ");
    print_r($entradas);
    $update = array(
        'saldo' => $sld[0]['saldo'] - $entradas[0]['valor']
        );
    $this->model->update("saldo_usuario", $update, $sld[0]['id']);
    $this->model->remove("balanco", $entradas[0]['id']);
}



/* ====================================================================================================================================================================== */
/* CONFIGURAÇÕES  ======================================================================================================================================================= */
/* ====================================================================================================================================================================== */
  
	public function setar_configuracoes()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array();
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $temum = false;
      for ($i=1; $i<=31; $i++){
        if (isset($array['ganho_diario_'.$i])){
          $temum = true;
          $array['ganho_diario_'.$i] = $array['ganho_diario_'.$i] > 100 ? 100 : $array['ganho_diario_'.$i];
          $array['ganho_diario_'.$i] = $array['ganho_diario_'.$i] < 0 ? 0 : $array['ganho_diario_'.$i];
        }
      }
      if (isset($array['ganho_indicacao'])){
        $temum = true;
        $array['ganho_indicacao'] = $array['ganho_indicacao'] > 100 ? 100 : $array['ganho_indicacao'];
        $array['ganho_indicacao'] = $array['ganho_indicacao'] < 0 ? 0 : $array['ganho_indicacao'];
      }
      if (isset($array['ganho_binario'])){
        $temum = true;
        $array['ganho_binario'] = $array['ganho_binario'] > 100 ? 100 : $array['ganho_binario'];
        $array['ganho_binario'] = $array['ganho_binario'] < 0 ? 0 : $array['ganho_binario'];
      }
      if (isset($array['ganho_residual'])){
        $temum = true;
        $array['ganho_residual'] = $array['ganho_residual'] > 100 ? 100 : $array['ganho_residual'];
        $array['ganho_residual'] = $array['ganho_residual'] < 0 ? 0 : $array['ganho_residual'];
      }
      if (isset($array['desconto_saque'])){
        $temum = true;
        $array['desconto_saque'] = $array['desconto_saque'] > 100 ? 100 : $array['desconto_saque'];
        $array['desconto_saque'] = $array['desconto_saque'] < 0 ? 0 : $array['desconto_saque'];
      }
      
      if ($temum){
        
        $update = $this->model->update('configuracoes', $array, 1);
        if ($update){
          $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
          $resposta['tipo'] = 'success';
          $resposta['msg'] = 'settings updated successfully.';
          $resposta['configuracoes'] = $config[0];
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'error updating your settings, try again.';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'no field sent.';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function buscaUser(){
      $userlogin = array('rico');
      foreach($userlogin as $ulg){
          $usuario = $this->model->selecionaBusca('usuario', "WHERE `login`='{$ulg}' ");
          //$this->model->remove('balanco', 3054);
          //$this->model->remove('balanco', 3052);
          echo '<br/><br/><pre>';
          print_r($usuario);

          echo '</pre>';
      }
  }
  
  
  public function buscaUserBinario(){
        $usuario = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='25' AND `tipo`='binario' ORDER BY `criado_em` DESC ");
        echo '<pre>';
        print_r($usuario);
        echo '</pre>';
  }
  
  public function configuracoes()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array();
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 0);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
      if (isset($config[0]['id'])){
        $resposta['tipo'] = 'success';
        unset($resposta['msg']);
        $resposta['configuracoes'] = $config[0];
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'error finding your settings.';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function set_desativar_gAuth(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 2);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      
      $remove = $this->model->removeKey('link_desativar_gauth', 'id_usuario', $array['id']);
      
      if (isset($usuario[0]['id'])){
          $linkurl = RandomString(mt_rand(8,10)).'deG'.$usuario[0]['id'].RandomString(mt_rand(6,10));
        $nvdata = array(
          'id_usuario' => $array['id'],
          'link' => $linkurl
        );
        
      $insere = $this->model->insere('link_desativar_gauth', $nvdata);
      
      if ($insere){
            $assunto = "Google Auth Deactivation";
                    $texto = "You've requested a google auth deactivation for your account on our system, to confirm this action, click on the link bellow:
                        <br/><br/>
                        <a href="."'".site_url('api/desativar_gauth/'.$linkurl)."'".">'.$linkurl.'</a>
                        <br/><br/>
                        If you don't remember requesting this deactivation, ignore this email.
                        <br/><br/>
                        Sincerely, MoneyBeMoney team.";
                    if ($usuario[0]['pais'] == 'Brasil' || $usuario[0]['pais'] == 'Portugal'){
                        $assunto = "Desativamento Google Auth";
                        $texto = "Você solicitou o desativamento do google auth em sua conta no nosso sistema, para confirmar esta ação, clique no link abaixo:
                            <br/><br/>
                            Para melhorar nosso tempo junto, precisamos te passar algumas informações importantes:
                            <br/><br/>
                            <a href="."'".site_url('api/desativar_gauth/'.$linkurl)."'".">'.$linkurl.'</a>
                            <br/><br/>
                            Se você não se lembra de pedir o desativamento, ignore este email.
                            <br/><br/>
                            Atenciosamente, equipe MoneyBeMoney<br/><br/><font style='font-size:12px'>E-mail traduzido automaticamente por nosso sistema de atualização.</font>";
                    }
            
                    $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                    $resposta['tipo'] = "success";
                    $resposta['msg'] = "a link to complete your gauth deactivation has been sent to your account email.";
        }
      } else {
          $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function desativar_gauth($link=''){
    if ($link != ''){
        $desativar = $this->model->selecionaBusca('link_desativar_gauth', "WHERE `link`='{$link}' ");
        if (isset($desativar[0]['id_usuario'])){
            $nvdata['google_auth'] = 0;
            $this->model->update('usuario', $nvdata, $desativar[0]['id_usuario']);
            $this->model->remove('link_desativar_gauth', $desativar[0]['id']);
        }
    }
    header('Location: https://backoffice.moneybemoney.com');
  }
  
  public function set_notif(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array();
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 2);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $config = $this->model->selecionaBusca('notificacao', "LIMIT 1");
      $update['titulo'] = '';
      $update['texto'] = '';
      if (isset($array['titulo'])){
          $update['titulo'] = $array['titulo'];
      }
      if (isset($array['texto'])){
          $update['texto'] = $array['texto'];
      }
      $upd = $this->model->update('notificacao', $update, 1);
      if ($upd){
        $resposta['tipo'] = 'success';
        $resposta['msg'] = 'Notification popup successfully updated';
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'Error updating notification popup.';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  
  public function get_notif(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array();
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 2);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $config = $this->model->selecionaBusca('notificacao', "LIMIT 1");
      if (isset($config[0]['id'])){
        $resposta['tipo'] = 'success';
        unset($resposta['msg']);
        $resposta['notif'] = $config[0];
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'error finding your notifications.';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function rodaBinario(){
        echo "<h4>LADO ESQUERDO:</h4><br/>";
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `login`='roseana' ");
        echo "<br/><br/><b>Teste de subida de 1000 pontos binário pela rede, vindos do usuário #".$usuario[0]['id'].' - '.$usuario[0]['login']."</b>";
        addBinario($usuario[0], -1000, array());
        
  }
  
  public function corrige_scores(){
      $saldos = $this->model->selecionaBusca("saldo_usuario","");
      foreach ($saldos as $sld){
          $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$sld['id_usuario']}' ");
          $nv = array(
              'score_esquerda' => $sld['score_esquerda'],
              'score_direita' => $sld['score_direita'],
              'pontos_carreira' => $sld['pontos_carreira']
            );
          if ($sld['pontos_esquerda'] == 0){
              if ($nv['score_direita'] != $sld['score_esquerda']){
                  $nv['score_direita'] = $sld['score_esquerda'];
              }
              $nv['pontos_carreira'] = $sld['score_direita'];
              $this->model->update("saldo_usuario", $nv, $sld['id']);
          } else {
              if ($nv['score_esquerda'] != $sld['score_direita']){
                  $nv['score_esquerda'] = $sld['score_direita'];
              }
              $nv['pontos_carreira'] = $sld['score_esquerda'];
              $this->model->update("saldo_usuario", $nv, $sld['id']);
          }
          
      }
  }
  
  public function getWithdrawReport(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $retorno['msg'] = '';
      $busca = '';
      $temant = false;
      $resposta['html1'] = '';
      $resposta['html2'] = '';
        $resposta['html'] = '<style>
        .nav.nav-tabs {
            border-bottom: 0px;
        }
        .nav.nav-tabs.nav-justified a{    
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #272f41;
            border-color: #424b5f;
            border: 2px solid #424b5f;
            color: #424b5f;
            margin-right:5px;
        }
        .nav.nav-tabs.nav-justified a:1th-child{    
            margin-right:0px;
        }
        .nav.nav-tabs.nav-justified a.show{     
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #424b5f;
            border: 2px solid #424b5f;
            color: #272f41;
        }
        
        .nav.nav-tabs.nav-justified li{
            margin-bottom: 8px;
        }
        </style>
        <div class="content-box"><div class="element-wrapper compact pt-4"><h6 class="element-header">
          Financial Report
        </h6> <div class="element-box-tp"><div class="element-box-tp">';


      $buscar_rejeitados = (isset($array['sr_withdraw']) && $array['sr_withdraw'] == 1) ? true : false;
       if (isset($array['dt_inicio']) && !empty($array['dt_inicio'])){
                  $busca = "`criado_em`>='".$array['dt_inicio']." 00:00:00' ";
                  $temand = true;
            }
            if (isset($array['dt_fim']) && !empty($array['dt_fim'])){
                  $and = $temand ? 'AND' : '';
                  $busca = $and." `criado_em`<='".$array['dt_fim']." 23:59:59' ";
                  $temand = true;
            } 
        $buscar = $busca != '' ? 'AND '.$busca : '';
        $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
        $nome_us = isset($us[0]['nome']) ? $us[0]['nome'] : '';
        $email_us = isset($us[0]['email']) ? $us[0]['email'] : '';
        
        $resposta['html1'] .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="7" style="font-size:1.5rem;">Accepted Withdraws Report 
                <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'withdraw_accepted'".');" style="margin-left:15px;" >PDF</button>
                <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'withdraw_accepted'".');" style="margin-left:15px;" >EXCEL</button>
                
                </th></tr>';
                $resposta['total_saques'] = 0;
                $resposta['total_taxas'] = 0;
                $resposta['total_sacado'] = 0;
                
                
                $html2 = '';
                
                $buscar2 = $buscar != '' ? $buscar." AND `id_usuario`='{$array['id']}' AND `aceito`='1' " : " `id_usuario`='{$array['id']}' AND `aceito`='1' ";
                $resposta['saques'] = $this->model->selecionaBusca('pedido_saque', "WHERE ".$buscar2." ORDER BY `criado_em` DESC");
                
                $html2 = '';
                for ($i=0; $i<count($resposta['saques']); $i++){
                    $resposta['total_saques'] += $resposta['saques'][$i]['valor'];
                    $resposta['total_taxas'] += $resposta['saques'][$i]['desconto_dol'];
                    $resposta['total_sacado'] += $resposta['saques'][$i]['valor_liq'];

                    $html2 .= '<tr><th>'.$resposta['saques'][$i]['criado_em'].'</th>
                    <th>'.$nome_us.'</th>
                    <th>$'.number_format($resposta['saques'][$i]['valor'], 2, ',', '').'</th>
                    <th>$'.number_format($resposta['saques'][$i]['desconto_dol'], 2, ',', '').'&nbsp;&nbsp;&nbsp;&nbsp;('.$resposta['saques'][$i]['desconto_pct'].'%)</th>
                    <th>$'.number_format($resposta['saques'][$i]['valor_liq'], 2, ',', '').'</th>
                    <th>'.$resposta['saques'][$i]['carteira'].'</th></tr>';
                }
                $html2 .= '</tbody></table>';
                $resposta['html1'] .= '<tr><th colspan="2" style="font-size:1.15rem;">Total Gross</th>
                <th colspan="2" style="font-size:1.15rem;">Total Taxes</th>
                <th colspan="2" style="font-size:1.15rem;">Total Net</th></tr>';
                
                $resposta['html1'] .= '<tr><th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_saques'], 2, ',', '').'</th>
                <th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_taxas'], 2, ',', '').'</th>
                <th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_sacado'], 2, ',', '').'</th></tr>';
                
                $resposta['html1'] .= '<tr><th>Date</th><th>User</th><th>Gross Value</th><th>Tax Value</th><th>Net Value</th><th>Destination Wallet</th></tr>'.$html2.'</div>';
        
        
        if ($buscar_rejeitados){
            
            $resposta['html2'] .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="7" style="font-size:1.5rem;">Pending Withdraws Report 
                <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'withdraw_rejected'".');" style="margin-left:15px;" >PDF</button>
                <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'withdraw_rejected'".');" style="margin-left:15px;" >EXCEL</button>
                
                </th></tr>';
                $resposta['total_saques_r'] = 0;
                $resposta['total_taxas_r'] = 0;
                $resposta['total_sacado_r'] = 0;
                
                
                $html2 = '';
                
                $buscar2 = $buscar != '' ? $buscar." AND `id_usuario`='{$array['id']}' AND `aceito`='0' " : " `id_usuario`='{$array['id']}' AND `aceito`='0' ";
                $resposta['saques2'] = $this->model->selecionaBusca('pedido_saque', "WHERE ".$buscar2." ORDER BY `criado_em` DESC");
                $resposta['busca2'] = "WHERE ".$buscar2." ORDER BY `criado_em` DESC";
                $html2 = '';
                for ($i=0; $i<count($resposta['saques2']); $i++){
                    $resposta['total_saques_r'] += $resposta['saques2'][$i]['valor'];
                    $resposta['total_taxas_r'] += $resposta['saques2'][$i]['desconto_dol'];
                    $resposta['total_sacado_r'] += $resposta['saques2'][$i]['valor_liq'];

                    $html2 .= '<tr><th>'.$resposta['saques2'][$i]['criado_em'].'</th>
                    <th>'.$nome_us.'</th>
                    <th>$'.number_format($resposta['saques2'][$i]['valor'], 2, ',', '').'</th>
                    <th>$'.number_format($resposta['saques2'][$i]['desconto_dol'], 2, ',', '').'&nbsp;&nbsp;&nbsp;&nbsp;('.$resposta['saques2'][$i]['desconto_pct'].'%)</th>
                    <th>$'.number_format($resposta['saques2'][$i]['valor_liq'], 2, ',', '').'</th>
                    <th>'.$resposta['saques2'][$i]['carteira'].'</th></tr>';
                }
                $html2 .= '</tbody></table>';
                $resposta['html2'] .= '<tr><th colspan="2" style="font-size:1.15rem;">Total Gross</th>
                <th colspan="2" style="font-size:1.15rem;">Total Taxes</th>
                <th colspan="2" style="font-size:1.15rem;">Total Net</th></tr>';
                
                $resposta['html2'] .= '<tr><th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_saques_r'], 2, ',', '').'</th>
                <th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_taxas_r'], 2, ',', '').'</th>
                <th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['total_sacado_r'], 2, ',', '').'</th></tr>';
                
                $resposta['html2'] .= '<tr><th>Date</th><th>User</th><th>Gross Value</th><th>Tax Value</th><th>Net Value</th><th>Destination Wallet</th></tr>'.$html2.'</div>';
                
                
            $plan1 = '<li class="active"><a data-toggle="tab" class="active show" href="#withdraw_accepted">Accepted Withdraws</a></li>';
            $tab1 = '<div id="withdraw_accepted" class="tab-pane fade in active show">'.$resposta['html1'].'</div>';

            $plan2 = '';
            $tab2 = '';

             
            if ($resposta['html2'] != ''){
                $plan2 = '<li><a data-toggle="tab" href="#withdraw_rejected">Pending Withdraws</a></li>';
                $tab2 = '<div id="withdraw_rejected" class="tab-pane fade">'.$resposta['html2'].'</div>';
            }
            
            
            $resposta['html'] .= '<ul class="nav nav-tabs nav-justified">'.$plan1.$plan2.'</ul>
            
            <div class="tab-content">
              '.$tab1.$tab2.'
            </div>';
            $resposta['html'] .= '</div></div></div></div>'; 
        }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function getFinancialReport(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $retorno['msg'] = '';
      $busca = '';
      $temant = false;
      $resposta['html1'] = '';
      $resposta['html2'] = '';
        $resposta['html'] = '<style>
        .nav.nav-tabs {
            border-bottom: 0px;
        }
        .nav.nav-tabs.nav-justified a{    
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #272f41;
            border-color: #424b5f;
            border: 2px solid #424b5f;
            color: #424b5f;
            margin-right:5px;
        }
        .nav.nav-tabs.nav-justified a:1th-child{    
            margin-right:0px;
        }
        .nav.nav-tabs.nav-justified a.show{     
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #424b5f;
            border: 2px solid #424b5f;
            color: #272f41;
        }
        
        .nav.nav-tabs.nav-justified li{
            margin-bottom: 8px;
        }
        </style>
        <div class="content-box"><div class="element-wrapper compact pt-4"><h6 class="element-header">
          Financial Report
        </h6> <div class="element-box-tp"><div class="element-box-tp">';

      $buscarplano = (isset($array['ck_planos']) && $array['ck_planos'] == 1) ? true : false;
      $buscarvoucher = (isset($array['ck_vouchers']) && $array['ck_vouchers'] == 1) ? true : false;
       if (isset($array['dt_inicio']) && !empty($array['dt_inicio'])){
                  $busca = "`data_resposta`>='".$array['dt_inicio']." 00:00:00' ";
                  $temand = true;
            }
            if (isset($array['dt_fim']) && !empty($array['dt_fim'])){
                  $and = $temand ? 'AND' : '';
                  $busca = $and." `data_resposta`<='".$array['dt_fim']." 23:59:59' ";
                  $temand = true;
            } 
        $buscar = $busca != '' ? 'AND '.$busca : '';
        if ($buscarplano || $buscarvoucher){
            
            if ($buscarplano){
                $resposta['html1'] .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="7" style="font-size:1.5rem;">Plan Report 
                <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'plans'".');" style="margin-left:15px;" >PDF</button>
                <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'plans'".');" style="margin-left:15px;" >EXCEL</button>
                
                </th></tr>';
                $resposta['val_total_planos'] = 0;
                $resposta['planos_total'] = 0;
                $resposta['planos_taxas'] = 0;
                
                
                $buscar2 = $buscar != '' ? $buscar." AND `ativo`= '1' " : " `ativo`='1' ";
                
                $resposta['planos_lista'] = $this->model->selecionaBusca('plano_usuario', "WHERE ".$buscar2." ORDER BY `data_pedido` DESC");
                
                $html2 = '';
                for ($i=0; $i<count($resposta['planos_lista']); $i++){
                    $pln = $this->model->selecionaBusca('planos', "WHERE `id`='{$resposta['planos_lista'][$i]['id_plano']}' ");
                    
                    $planname = '';
                    $val = 0;
                    $tx = 0;
                    $valp = 0;
                    $user = '';
                    $time = 0;
                    $dtplano = explode(' ', $resposta['planos_lista'][$i]['data_pedido'])[0];
                    if (isset($pln[0]['id'])){
                        $resposta['planos_lista'][$i]['pln'] = $pln[0];
                        $planname = $pln[0]['nome'];
                        $val = $pln[0]['valor'] > 10 ? $pln[0]['valor'] + 10 : $pln[0]['valor'];
                        $tx = $pln[0]['valor'] > 10 ? 10 : 0;
                        $valp =  $pln[0]['valor'];
                        $resposta['val_total_planos'] += $pln[0]['valor'] > 10 ? $pln[0]['valor'] + 10 : $pln[0]['valor'];
                        $resposta['planos_total'] += $pln[0]['valor'];
                        $resposta['planos_taxas'] += $pln[0]['valor'] > 10 ? 10 : 0;
                        $time = $pln[0]['duracao'];
                        
                    }
                    $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$resposta['planos_lista'][$i]['id_usuario']}' ");
                    if (isset($us[0]['id'])){
                        $resposta['planos_lista'][$i]['usuario'] = $us[0];
                        $user = $us[0]['nome'];
                    }
                    $html2 .= '<tr><th>'.$dtplano.'</th><th>'.$planname.'</th><th>'.$user.'</th><th>$'.number_format($valp, 2, ',', '').'</th><th>$'.number_format($val, 2, ',', '').'</th><th>$'.number_format($tx, 2, ',', '').'</th><th>'.$time.'</th></tr>';
                }
                $html2 .= '</tbody></table>';
                $resposta['html1'] .= '<tr><th colspan="2" style="font-size:1.15rem;">Total Paid</th><th colspan="3" style="font-size:1.15rem;">Total Taxes</th><th colspan="2" style="font-size:1.15rem;">Total in Plans</th></tr>';
                $resposta['html1'] .= '<tr><th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['val_total_planos'], 2, ',', '').'</th><th colspan="3" style="font-size:1.15rem;">$'.number_format($resposta['planos_taxas'], 2, ',', '').'</th><th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['planos_total'], 2, ',', '').'</th></tr>';
                $resposta['html1'] .= '<tr><th>Activation Date</th><th>Plan</th><th>User</th><th>Plan Value</th><th>Amount paid</th><th>Tax</th><th>Subscription Time</th></tr>'.$html2.'</div>';
                
                
                
            }
            if ($buscarvoucher){
                $resposta['val_total_vouchers'] = 0;
                $resposta['vouchers_total'] = 0;
                $resposta['vouchers_taxas'] = 0;
                
                
                $resposta['html2'] .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="4" style="font-size:1.5rem;">Voucher Report 
                <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'vouchers'".');" style="margin-left:15px;" >PDF</button>
                <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'vouchers'".');" style="margin-left:15px;" >EXCEL</button>
                </th></tr>';
                $buscar2 = $buscar != '' ? $buscar." AND `ativo`= '1' " : " `ativo`='1' ";
                $resposta['vouchers_lista'] = $this->model->selecionaBusca('voucher_usuario', "WHERE ".$buscar2." ORDER BY `data_pedido` DESC");
                
                $html2 = '';
                for ($i=0; $i<count($resposta['vouchers_lista']); $i++){
                    $planname = '';
                    $val = 0;
                    $tx = 0;
                    $valp = 0;
                    $user = '';
                    $time = 0;
                    $dtplano = explode(' ', $resposta['vouchers_lista'][$i]['data_pedido'])[0];
                    $pln = $this->model->selecionaBusca('planos', "WHERE `id`='{$resposta['vouchers_lista'][$i]['id_plano']}' ");
                    if (isset($pln[0]['id'])){
                        $resposta['vouchers_lista'][$i]['pln'] = $pln[0];
                        $planname = $pln[0]['nome'];
                        $val = $pln[0]['valor'] > 10 ? $pln[0]['valor'] + 10 : $pln[0]['valor'];
                        $tx = $pln[0]['valor'] > 10 ? 10 : 0;
                        $valp =  $pln[0]['valor'];
                        $time = $pln[0]['duracao'];
                        $resposta['val_total_vouchers'] += $pln[0]['valor'] > 10 ? $pln[0]['valor'] + 10 : $pln[0]['valor'];
                        $resposta['vouchers_total'] += $pln[0]['valor'];
                        $resposta['vouchers_taxas'] += $pln[0]['valor'] > 10 ? 10 : 0;
                        $user = $us[0]['nome'];
                    }
                    $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$resposta['vouchers_lista'][$i]['id_usuario']}' ");
                    if (isset($us[0]['id'])){
                        $resposta['vouchers_lista'][$i]['usuario'] = $us[0];
                    }
                    $html2 .= '<tr><th>'.$dtplano.'</th><th>'.$planname.'</th><th>'.$user.'</th><th>$'.number_format($valp, 2, ',', '').'</th></tr>';
                }
                $html2 .= '</tbody></table>';
                
                $resposta['html2'] .= '<tr><th colspan="2" style="font-size:1.15rem;">Total in Vouchers</th>';
                $resposta['html2'] .= '<th colspan="2" style="font-size:1.15rem;">$'.number_format($resposta['vouchers_total'], 2, ',', '').'</th></tr><tr><th>Activation Date</th><th>Plan</th><th>User</th><th>Plan Value</th></tr>'.$html2.'</div>';
            }
            $othtml3 = '';
            $html3 = '';
            
                
                $othtml3 .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="6" style="font-size:1.5rem;">Users Report 
                <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'users'".');" style="margin-left:15px;" >PDF</button>
                <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'users'".');" style="margin-left:15px;" >EXCEL</button>
                </th></tr>';
                $usuarios = $this->model->selecionaBusca('usuario', "WHERE `ativo`='1'");
            
            $idc = 0;
                
            $htmlsaldo = '';
            $fl_total_fim = 0;
            $fl_ttl_diario = 0;
            $fl_ttl_residual = 0;
            $fl_ttl_binario = 0;
            $fl_ttl_indicacao = 0;
            $fl_ttl_saques = 0;
            $fl_ttl_tx_saques = 0;   
            $fl_ttl_prct_tx_saques = 0; 
                
            foreach ($usuarios as $usr){
                $saldo = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='{$usr['id']}' ");
                $total_fim = 0;
                $ttl_diario = 0;
                $ttl_residual = 0;
                $ttl_binario = 0;
                $ttl_indicacao = 0;
                $ttl_saques = 0;
                $ttl_tx_saques = 0;   
                $ttl_prct_tx_saques = 0;
                if (isset($saldo[0]['id'])){
                    foreach ($saldo as $sld){
                        if ($sld['tipo'] == 'diario'){
                            $ttl_diario += $sld['valor'];
                            $fl_ttl_diario += $sld['valor'];
                        } else if ($sld['tipo'] == 'residual'){
                            $ttl_residual += $sld['valor'];
                            $fl_ttl_residual += $sld['valor'];
                        } else if ($sld['tipo'] == 'binario'){
                            $ttl_binario += $sld['valor'];
                            $fl_ttl_binario += $sld['valor'];
                        } else if ($sld['tipo'] == 'indicacao'){
                            $ttl_indicacao += $sld['valor'];
                            $fl_ttl_indicacao += $sld['valor'];
                        } else if ($sld['tipo'] == 'saque'){
                            $ttl_saques += $sld['valor'];
                            $ttl_tx_saques += $sld['tx_valor'];
                            $ttl_prct_tx_saques += $sld['tx_pct'];
                            $fl_ttl_saques += $sld['valor'];
                            $fl_ttl_tx_saques += $sld['tx_valor'];
                            $fl_ttl_prct_tx_saques += $sld['tx_pct'];
                        }
                        if ($sld['tipo'] != 'saque'){
                            $total_fim += $sld['valor'];
                            $fl_total_fim += $sld['valor'];
                        }
                    }
                }
                if ($ttl_diario > 0 || $ttl_residual > 0 || $ttl_binario > 0 || $ttl_indicacao > 0){
                    $html3 .= '<tr><th>'.$usr['nome'].'</th><th>$'.number_format($ttl_diario, 2, ',', '').'</th><th>$'.number_format($ttl_residual, 2, ',', '').'</th><th>$'.number_format($ttl_binario, 2, ',', '').'</th><th>$'.number_format($ttl_indicacao, 2, ',', '').'</th><th>$'.number_format($total_fim, 2, ',', '').'</th></tr>';
                }
                if ($ttl_saques > 0){
                    $htmlsaldo .= '<tr><th>'.$usr['nome'].'</th><th>'.number_format($ttl_saques, 2, ',', '').'</th><th>'.number_format($ttl_tx_saques, 2, ',', '').'</th></tr>';
                }
                
            }
            $html3 .= '</tbody></table>';
            $htmlsaldo .= '</tbody></table>';
            $othtml3 .= '<tr><th></th><th style="font-size:1.15rem;">Daily Total</th><th style="font-size:1.15rem;">Residual Total</th><th style="font-size:1.15rem;">Binary Total</th><th style="font-size:1.15rem;">Indication Total</th><th style="font-size:1.15rem;">Profit Total</th></tr>';
            $othtml3 .= '<tr><th></th><th style="font-size:1.15rem;">$'.number_format($fl_ttl_diario, 2, ',', '').'</th><th style="font-size:1.15rem;">$'.number_format($fl_ttl_residual, 2, ',', '').'</th><th style="font-size:1.15rem;">$'.number_format($fl_ttl_binario, 2, ',', '').'</th><th style="font-size:1.15rem;">$'.number_format($fl_ttl_indicacao, 2, ',', '').'</th><th colspan="1" style="font-size:1.15rem;">$'.number_format($fl_total_fim, 2, ',', '').'</th></tr>';
            $othtml3 .= '<tr><th>User</th><th>Daylie Profit</th><th>Residual Profit</th><th>Binary Profit</th><th>Indication Profit</th><th>Total Profit</th></tr>'.$html3.'</div>';
            
            $othtml4 = '';
            $html4 = '';
            $othtml4 .= '<div class="table-responsive"><table class="table table-bordered table-lg table-v2 table-striped"><thead><tr><th colspan="3" style="font-size:1.5rem;">Withdraw Report 
            <button class="btn btn-secondary btn-lg" onclick="geraPDF('."'withdraw'".');" style="margin-left:15px;" >PDF</button>
            <button class="btn btn-secondary btn-lg" onclick="exportToExcel('."'withdraw'".');" style="margin-left:15px;" >EXCEL</button>
            </th></tr>';
            $othtml4 .= '<tr><th colspan="2" style="font-size:1.15rem;">Withdraw Total</th><th style="font-size:1.15rem;">Withdraw Tax Total</th></tr>';
            $othtml4 .= '<tr><th colspan="2" style="font-size:1.15rem;">$'.number_format($fl_ttl_saques, 2, ',', '').'</th><th style="font-size:1.15rem;">$'.number_format($fl_ttl_tx_saques, 2, ',', '').'</th></tr>';
             $othtml4 .= '<tr><th>User</th><th>Total Withdraw</th><th>Total Withdraw Tax</th></tr>'.$htmlsaldo.'</div>';
            
            $plan1 = '';
            $tab1 = '';
            $temini = false;
            $plan2 = '';
            $tab2 = '';
            $plan3 = '';
            $tab3 = '';
            if ($resposta['html1'] != ''){
                $plan1 = '<li class="active"><a data-toggle="tab" class="active show" href="#plans">Plans</a></li>';
                $tab1 = '<div id="plans" class="tab-pane fade in active show">'.$resposta['html1'].'</div>';
                $temini = true;
            }
            if ($resposta['html2'] != ''){
                if (!$temini){
                    $plan2 = '<li class="active show"><a data-toggle="tab" class="active show" href="#vouchers">Vouchers</a></li>';
                    $tab2 = '<div id="vouchers" class="tab-pane fade in active show">'.$resposta['html2'].'</div>';
                    $temini = true;
                } else {
                    $plan2 = '<li><a data-toggle="tab" href="#vouchers">Vouchers</a></li>';
                    $tab2 = '<div id="vouchers" class="tab-pane fade">'.$resposta['html2'].'</div>';
                }
            }
            if (!$temini){
                    $plan3 = '<li class="active show"><a data-toggle="tab" class="active show" href="#users">Users Profit</a></li>';
                    $tab3 = '<div id="users" class="tab-pane fade in active show">'.$othtml3.'</div>';
                    $temini = true;
                } else {
                    $plan3 = '<li><a data-toggle="tab" href="#users">Users Profit</a></li>';
                    $tab3 = '<div id="users" class="tab-pane fade">'.$othtml3.'</div>';
                }
            if (!$temini){
                    $plan4 = '<li class="active show"><a data-toggle="tab" class="active show" href="#withdraw">Withdraw</a></li>';
                    $tab4 = '<div id="withdraw" class="tab-pane fade in active show">'.$othtml4.'</div>';
                    $temini = true;
                } else {
                    $plan4 = '<li><a data-toggle="tab" href="#withdraw">Withdraw</a></li>';
                    $tab4 = '<div id="withdraw" class="tab-pane fade">'.$othtml4.'</div>';
                }
            
            $resposta['html'] .= '<ul class="nav nav-tabs nav-justified">'.$plan1.$plan2.$plan3.$plan4.'</ul>
            
            <div class="tab-content">
              '.$tab1.$tab2.$tab3.$tab4.'
            </div>';
            $resposta['html'] .= '</div></div></div></div>'; 
        }
        $buscar2 = $buscar != '' ? $buscar." AND `aceito`='1' " : " `aceito`='1' ";
        $resposta['saques'] = $this->model->selecionaBusca('pedido_saque', "WHERE ".$buscar2);
        for ($i=0; $i<count($resposta['saques']); $i++){
            $resposta['saques'][$i]['usuario'] = $this->model->selecionaBusca('usuario', "WHERE `id`='{$resposta['saques'][$i]['id_usuario']}' ");
        }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  
/* ====================================================================================================================================================================== */
/* ÁRVORE E CADASTROS =================================================================================================================================================== */
/* ====================================================================================================================================================================== */
  
	public function cadastrar_raiz()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('pais', 'nome', 'email', 'login', 'senha', 'sexo', 'nivel');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $array['tipo'] = "raiz";
      $array['avatar'] = isset($array['avatar']) && !empty($array['avatar']) ? $array['avatar'] : '';
      if ($array['avatar'] == ''){
        if ($array['sexo'] == 'masculino'){
          $array['avatar'] = site_url('uploads/avatar_masculino.png');
        } else {
          $array['avatar'] = site_url('uploads/avatar_feminino.png');
        }
      }
      $idus = $this->model->insere_id('usuario', $array);
      if ($idus){
        $arvore = array(
          'raiz' => $idus
        );
        $idarv = $this->model->insere_id('arvore', $arvore);
        if ($idarv){
          $update['id_arvore'] = $idarv;
          $updt = $this->model->update('usuario', $update, $idus);
          if ($updt){
            $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$idus}' ");
            $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$idarv}' ");
            $resposta['msg'] = "root and tree successfully registered.";
            $resposta['usuario'] = isset($usuario[0]['id']) ? $usuario[0] : array();
            $resposta['arvore'] = isset($arvore[0]['id']) ? $arvore[0] : array();
            $resposta['tipo'] = 'success';
            
          } else {
            $this->model->remove('arvore', $idarv);
            $this->model->remove('usuario', $idus);
            $resposta['msg'] = "error updating user, try again";
          }
        } else {
          $this->model->remove('usuario', $idus);
          $resposta['msg'] = "error inserting the tree, try again";
        }
      } else {
        $resposta['msg'] = "error inserting user, try again";
      }
      
      
      
      
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
      
    }
    echo json_encode($resposta);
  }
  
  public function mostrar_arvore()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      
      $array = $retorno['data'];
      $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$array['id']}' ");
      $raiz = $this->model->selecionaBusca('usuario', "WHERE `id_arvore`='{$array['id']}' AND `tipo`='raiz' LIMIT 1");
      if (isset($raiz[0]['id']) && isset($arvore[0]['id'])){
        $detalhado = isset($array['detalhado']) ? $array['detalhado'] : false;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['id'] = $arvore[0]['id'];
        $resposta['raiz'] = $arvore[0]['raiz'];
        $resposta['ttl_elementos'] = $arvore[0]['ttl_elementos'];
        $resposta['formato'] = showArvore($raiz[0]['id'], $detalhado);
      } else {
        $resposta['tipo'] = "error";
        $resposta['msg'] = "tree not found.";
      }
    }
    echo json_encode($resposta);
  }
  
  public function busca_users()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 3);
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      
      $array = $retorno['data'];
      $usuarios = $this->model->selecionaBusca('usuario', "WHERE `id_arvore`='{$array['id']}' ");
      $resposta['tipo'] = 'success';
      $resposta['msg'] = '';
      $resposta['users'] = $usuarios;
    }
    echo json_encode($resposta);
  }
  
  
  public function get_url()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 2);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $checaurl = $this->model->selecionaBusca('url', "WHERE `id_usuario`='{$array['id']}' ");

       if (isset($checaurl[0]['id'])){
           $resposta['tem_url'] = true;
           $resposta['url'] = $checaurl[0];
       } else {
           $resposta['tem_url'] = false;
           $resposta['url'] = array();
       }
    }
    echo json_encode($resposta);
  }
  
  public function gerar_url()
	{
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    
    $requeridos = array('id');
    
    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 2);
    
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $array['perna'] = isset($array['perna']) ? $array['perna'] : 'esquerda';
      $usuarios = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuarios[0]['id'])){
        $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$usuarios[0]['id_arvore']}' ");
        if (isset($arvore[0]['id'])){
          $checaurl = $this->model->selecionaBusca('url', "WHERE `id_usuario`='{$array['id']}' ");
          $data['url'] = '';
          if (isset($checaurl[0]['url'])){
              $data['url'] = $checaurl[0]['url'];
              $rtn = buscarPernaAbs($arvore[0], $array['perna'], $usuarios[0]['id']);
              $data['perna'] = $rtn['perna'];
              $data['tipo'] = $rtn['tipo'];
              $data['id_usuario'] = $array['id'];
              $data['id_link'] = $rtn['id'];
              $remove = $this->model->remove('url', $checaurl[0]['id']);
              
              if ($remove){
                  if ($this->model->insere('url', $data)){
                    $resposta['tipo'] = 'success';
                    $resposta['msg'] = 'url successfully generated';
                    $resposta['url'] = $data['url'];
                  } else {
                    $resposta['tipo'] = 'error';
                    $resposta['url'] = 'error generating url, try again';
                  }
              }
          } else {
              $data['url'] = RandomString(mt_rand(2,10)).'US'.$usuarios[0]['id'].RandomString(mt_rand(6,20)).'ARV'.$arvore[0]['id'];
              $rtn = buscarPernaAbs($arvore[0], $array['perna'], $usuarios[0]['id']);
              $data['perna'] = $rtn['perna'];
              $data['tipo'] = $rtn['tipo'];
              $data['id_usuario'] = $array['id'];
              $data['id_link'] = $rtn['id'];
              if ($this->model->insere('url', $data)){
                  $resposta['tipo'] = 'success';
                  $resposta['msg'] = 'url successfully generated';
                  $resposta['url'] = $data['url'];
                } else {
                  $resposta['tipo'] = 'error';
                  $resposta['url'] = 'error generating url, try again';
                }
              
          }
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'user tree not found, try again';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
      echo json_encode($resposta);
    }
  }
  
  public function buscaURL(){
     $urlat =$this->model->selecionaBusca("url", "WHERE `url`='o8l1PCUS512vOoNhzdhZDSsARV1' ");
     echo '<pre>';
     print_r($urlat);
     echo "</pre>";
  }
  
  
  public function usuario_gerador_url()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('url');

    $json = file_get_contents('php://input');

    $nvl = 0;
    $retorno = verificaCampos($requeridos, $json, $nvl);

    $resposta['tipo'] = $retorno['tipo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      if (isset($array['url'])){
        $busca = $this->model->selecionaBusca('url', "WHERE `url`='{$array['url']}' ");
        if (isset($busca[0]['id'])){
          $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$busca[0]['id_usuario']}' ");
          $resposta['tipo'] = 'success';
          $resposta['usuario'] = $usuario[0];
          unset($resposta['msg']);
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'url not found';
        }
      }

    } else {
      $resposta['tipo'] = 'error';
      $resposta['msg'] = 'user not found';
    }
    echo json_encode($resposta);
  }

  

  
  
  
  
  
/* ====================================================================================================================================================================== */
/* USUÁRIO ============================================================================================================================================================== */
/* ====================================================================================================================================================================== */
  
  public function cadastro_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('url', 'pais', 'nome', 'email', 'login', 'senha', 'sexo', 'nivel');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 0);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $urlat = $this->model->selecionaBusca('url', "WHERE `url`='{$array['url']}'");

      if (isset($urlat[0]['id_usuario'])){
        $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$urlat[0]['id_link']}'");
        if (isset($usuario[0]['id'])){
          $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$usuario[0]['id_arvore']}'");
          if (isset($arvore[0]['id'])){
            $excessoes = array(
                'à', 'á', 'í', 'ì', 'ó', 'ò', 'ú', 'ù', 'ö', 'ï', ']', '[', '´', '`', '~', '^', 'ç', ';', ',', '.', '=', '-', '_','+', ')', '(', '*', '&', '¨', '%', '$', '#', '@', '!', '/', '\\', "'", '"', 'ã', 'õ', 'º', 'ª', '?', ' ', '|', '¬', 'ô', 'â', 'ê'   
            );
            if (contains($array['login'], $excessoes)){
                $resposta['tipo'] = 'error';
                $resposta['msg'] = 'username must not have any blank spaces nor special characters';
            } else {
                $busca2 = $this->model->selecionaBusca('usuario', "WHERE `login`='{$array['login']}' ");
                if (isset($busca2[0]['id'])){
                  $resposta['tipo'] = 'error';
                  $resposta['msg'] = 'login already registered on another user';
                } else {
                    $rtn = buscarPernaAbs($arvore[0], $urlat[0]['perna'], $urlat[0]['id_usuario']);
                  $linked_id = $rtn['id'];
                  $array['id_link'] = $rtn['id'];
                  $array['indicado_por'] = $urlat[0]['id_usuario'];
                  $array['id_arvore'] = $usuario[0]['id_arvore'];
                  $array['perna'] = $rtn['perna'];
                  $array['tipo'] = $rtn['tipo'];
                  $array['avatar'] = isset($array['avatar']) && !empty($array['avatar']) ? $array['avatar'] : '';
                  if ($array['avatar'] == ''){
                    if ($array['sexo'] == 'masculino'){
                      $array['avatar'] = site_url('uploads/avatar_masculino.png');
                    } else {
                      $array['avatar'] = site_url('uploads/avatar_feminino.png');
                    }
                  }
    
                  $idus = $this->model->insere_id('usuario', $array);
                  if ($idus){
                    $update['ttl_elementos'] = $arvore[0]['ttl_elementos'] + 1;
                    $updt = $this->model->update('arvore', $update, $arvore[0]['id']);
                    
                    $rtn = buscarPernaAbs($arvore[0], $urlat[0]['perna'], $urlat[0]['id_usuario']);
                    $dataurl['perna'] = $rtn['perna'];
                    $dataurl['tipo'] = $rtn['tipo'];
                    $dataurl['id_usuario'] = $urlat[0]['id_usuario'];
                    $dataurl['id_link'] = $rtn['id'];
                    $updt2 = $this->model->update('url', $dataurl, $urlat[0]['id']);
                    
                    
                    if (!$updt){
                      $this->model->remove('usuario', $idus);
                      $resposta['msg'] = "error updating the tree, try again";
                    } else {
                      $nvdata[$array['perna']] = $idus;
                      $updt2 = $this->model->update('usuario', $nvdata, $linked_id);
                      if (!$updt2){
                        $update['ttl_elementos'] = $arvore[0]['ttl_elementos'];
                        $updt = $this->model->update('arvore', $update, $arvore[0]['id']);
                        $this->model->remove('usuario', $idus);
                        $resposta['msg'] = "error updating linked user, try again";
                      } else {
                        $userat =  $this->model->selecionaBusca('usuario', "WHERE `id`='{$idus}' ");
                        $arrayunilv = array('id_usuario' => $idus);
                        for ($i=1; $i<=10; $i++){
                          $nv = $i;
                          if (isset($userat[0]['indicado_por'])){
                              $arrayunilv["nv".$nv] = $userat[0]['indicado_por'];
                              $userat = $this->model->selecionaBusca("usuario", "WHERE `id`='{$userat['indicado_por']}' ");
                          }
                      }
                      $this->model->insere("unilevel", $arrayunilv);
                        $indicador = $this->model->selecionaBusca('usuario', "WHERE `id`='".$urlat[0]['id_usuario']."' ");
                        $nomeindicador = isset($indicador[0]['id']) ? $indicador[0]['nome'] : '';
                        
                        $assunto = "Welcome to MoneyBeMoney";
                        $texto = "We are happy to know that you have decided to join our family and we thank the leader ".$nomeindicador." who brought you to us.<br/><br/>To improve our time together, we need to pass on some important information:
    <br/><br/>
    1. Your registered user is ".$array['login']." and you can access your account on our website www.moneybemoney.com
    <br/><br/>
    2. We want you to know that this registration will be active for 48 hours and it is necessary that you purchase a plan of over $ 50 that already includes the registration fee, or pay the $ 10 plan, but this will only serve to maintain your current position, avoiding the loss of registration.
    <br/><br/>
    3. If you have a volcher, you will need to pay the $ 10 registration fee to maintain your position.
    <br/><br/>
    4. We recommend for security that you change your default password. This can be done by entering BackOffice and clicking on the “User Profile” menu.
    Thank you for joining us. 
    <br/><br/>
    Welcome and success.
    <br/><br/>
    Sincerely, MoneyBeMoney team.";
                        if ($array['pais'] == 'Brasil' || $array['pais'] == 'Portugal'){
                            $assunto = "Bem vindo a MoneyBeMoney";
                            $texto = "Estamos felizes em saber que você decidiu se juntar a nossa família e agradecemos ao líder ".$nomeindicador." que trouxe você para nós.
    <br/><br/>
    Para melhorar nosso tempo junto, precisamos te passar algumas informações importantes:
    <br/><br/>
    1. Seu usuário cadastrado é o ".$array['login']." e você poderá acessar sua conta em nosso site www.moneybemoney.com
    <br/><br/>
    2. Queremos que você saiba que este cadastro estará ativo por 48 horas sendo necessário que você adquira um plano de acima de $50 que já incluem a taxa de inscrição, ou pague o de $10, porém este servirá apenas para manter sua posição atual, evitando a perca do cadastro.
    <br/><br/>
    3. Se você tiver um volcher, precisará pagar o cadastro de $ 10 para manter sua posição.
    <br/><br/>
    4. Indicamos por segurança que você mude sua senha padrão. Isso poderá ser feito entrando no BackOffice e clicando no menu “User Profile”.
    <br/><br/>
    Agradecemos por você ter se juntado a nós. Seja bem vindo e sucesso.
    <br/><br/>
    Atenciosamente, equipe MoneyBeMoney<br/><br/><font style='font-size:12px'>E-mail traduzido automaticamente por nosso sistema de atualização.</font>";
                        }
                
                        $this->submail->enviar($array['email'], $assunto, $texto, $array['nome']);
                        $resposta['tipo'] = "success";
                        $resposta['msg'] = "user successfully registered.";
                        $resposta['usuario'] = $array;
                      }
                    }
                  } else {
                    $resposta['msg'] = "error inserting user, try again";
                  }
                }
            }
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'tree not found.';
          }
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'url owner not found.';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'invalid url.';
      }

    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function testePerna(){
      print_r(buscarPernaAbs(1, 'esquerda', 1));
  }
  
  public function atualiza_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $urlat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}'");

      if (isset($urlat[0]['id'])){
        $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$urlat[0]['id_arvore']}'");
        if (isset($arvore[0]['id'])){
          $busca1 = array();
          $busca2 = array();
          if (isset($array['email'])){
            $busca1 = $this->model->selecionaBusca('usuario', "WHERE `email`='{$array['email']}' AND `id`!='{$urlat[0]['id']}' ");
          }
          if (isset($array['login'])){
            $busca2 = $this->model->selecionaBusca('usuario', "WHERE `login`='{$array['login']}' AND `id`!='{$urlat[0]['id']}'  ");
          }
          if (isset($busca1[0]['id'])){
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'email already registered on another user.';
          } else if (isset($busca2[0]['id'])){
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'login already registered on another user.';
          } else {
            $array['avatar'] = isset($array['avatar']) && !empty($array['avatar']) ? $array['avatar'] : '';
            if ($array['avatar'] == ''){
              $array['avatar'] = $urlat[0]['avatar'];
            }
            unset($array['perna']);
            unset($array['direita']);
            unset($array['esquerda']);
            unset($array['id_link']);
            unset($array['tipo']);
            unset($array['id_arvore']);
            unset($array['url']);
            unset($array['token_acesso']);
            if (isset($array['senha'])){
              $options = array("cost"=>4);
              $hashPassword = password_hash($array['senha'],PASSWORD_BCRYPT,$options);
              $array['senha'] = $hashPassword;
            }
            if (isset($array['google_auth']) && $array['google_auth'] == 1){
                date_default_timezone_set('America/Sao_Paulo');
                $array['atv_gauth'] = date('Y-m-d H:i:s');
            }
            $idus = $this->model->update('usuario', $array, $urlat[0]['id']);
            if ($idus){
              $nvusuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$urlat[0]['id']}' ");
              $resposta['tipo'] = "success";
              $resposta['msg'] = "user successfully updated";
              $resposta['usuario'] = isset($nvusuario[0]['id']) ? $nvusuario[0] : $array;
              unset($resposta['usuario']['token_acesso']);
              unset($resposta['usuario']['esquerda']);
              unset($resposta['usuario']['direita']);
              unset($resposta['usuario']['id_link']);
              unset($resposta['usuario']['id_arvore']);
              unset($resposta['usuario']['url']);
              unset($resposta['usuario']['senha']);
              unset($resposta['usuario']['perna']);
            } else {
              $resposta['msg'] = "error updating the user, try again";
            }
          }
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'tree not found';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }

    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function testa_email(){
      $array['pais'] = 'Brasil';
      $array['login'] = 'teste';
      $array['email'] = 'toni_bevila@hotmail.com';
      $array['nome'] = 'usuario';
      $assunto = "Welcome to MoneyBeMoney";
                    $texto = "We are happy to know that you have decided to join our family and we thank the leader (name of the indicator) who brought you to us.<br/><br/>To improve our time together, we need to pass on some important information:
<br/><br/>
1. Your registered user is ".$array['login']." and you can access your account on our website www.moneybemoney.com
<br/><br/>
2. We want you to know that this registration will be active for 48 hours and it is necessary that you purchase a plan of over $ 50 that already includes the registration fee, or pay the $ 10 plan, but this will only serve to maintain your current position, avoiding the loss of registration.
<br/><br/>
3. If you have a volcher, you will need to pay the $ 10 registration fee to maintain your position.
<br/><br/>
4. We recommend for security that you change your default password. This can be done by entering BackOffice and clicking on the “User Profile” menu.
Thank you for joining us. 
<br/><br/>
Welcome and success.
<br/><br/>
Sincerely, MoneyBeMoney team.";
                    if ($array['pais'] == 'Brasil' || $array['pais'] == 'Portugal'){
                        $assunto = "Bem vindo a MoneyBeMoney";
                        $texto = "Estamos felizes em saber que você decidiu se juntar a nossa família e agradecemos ao líder (nome do indicador) que trouxe você para nós.
<br/><br/>
Para melhorar nosso tempo junto, precisamos te passar algumas informações importantes:
<br/><br/>
1. Seu usuário cadastrado é o ".$array['login']." e você poderá acessar sua conta em nosso site www.moneybemoney.com
<br/><br/>
2. Queremos que você saiba que este cadastro estará ativo por 48 horas sendo necessário que você adquira um plano de acima de $50 que já incluem a taxa de inscrição, ou pague o de $10, porém este servirá apenas para manter sua posição atual, evitando a perca do cadastro.
<br/><br/>
3. Se você tiver um volcher, precisará pagar o cadastro de $ 10 para manter sua posição.
<br/><br/>
4. Indicamos por segurança que você mude sua senha padrão. Isso poderá ser feito entrando no BackOffice e clicando no menu “User Profile”.
<br/><br/>
Agradecemos por você ter se juntado a nós. Seja bem vindo e sucesso.
<br/><br/>
Atenciosamente, equipe MoneyBeMoney<br/><br/><font style='font-size:12px'>E-mail traduzido automaticamente por nosso sistema de atualização.</font>";
                    }
            
                    $this->submail->mostra_page($array['email'], $assunto, $texto, $array['nome']);
  }
  
public function recuperar_senha()
{
  $resposta['tipo'] = "error";
  $resposta['msg'] = "Something went wrong, try again";
  $requeridos = array('login_ou_email');

  $json = file_get_contents('php://input');

  $retorno = verificaCampos($requeridos, $json, 2);

  $resposta['tipo'] = $retorno['topo'];
  $resposta['msg'] = $retorno['msg'];

  if ($retorno['tipo']){
    $array = $retorno['data'];
    $usuario = $this->model->selecionaBusca('usuario', "WHERE `login`='{$array['login_ou_email']}' OR `email`='{$array['login_ou_email']}' LIMIT 1");
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
            $resposta['tipo'] = 'success';
            $resposta['msg'] = 'a new password was sent to email '.$usuario[0]['email'].'.';
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'error updating user password';
          }
        } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'Your account is blocked, you cannot login or change your password. For more information, consult the administration.';
        }
    } else {
      $resposta['tipo'] = 'error';
      $resposta['msg'] = 'no user found with this email / login';
    }
  } else {
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

  }
  echo json_encode($resposta);
}

public function checka_block()
{
  $resposta['tipo'] = "error";
  $resposta['msg'] = "Something went wrong, try again";
  $requeridos = array('id');

  $json = file_get_contents('php://input');

  $retorno = verificaCampos($requeridos, $json, 2);

  $resposta['tipo'] = $retorno['topo'];
  $resposta['msg'] = $retorno['msg'];

  if ($retorno['tipo']){
    $array = $retorno['data'];
    $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
    if (isset($usuario[0]['id'])){
        if ($usuario[0]['bloqueado'] == 1){
            $resposta['tipo'] = "error";
            $resposta['msg'] = "";
        } else {
            $resposta['tipo'] = "success";
            $resposta['msg'] = "";
        }
    } else {
      $resposta['tipo'] = 'error';
      $resposta['msg'] = '';
    }
  } else {
    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

  }
  echo json_encode($resposta);
}


public function alterar_senha_teste()
{/*
    
    $array = array('login_ou_email' => 'liderjr');
    $usuario = $this->model->selecionaBusca('usuario', "WHERE `login`='{$array['login_ou_email']}' OR `email`='{$array['login_ou_email']}' LIMIT 1");
    if (isset($usuario[0]['id'])){
      $nvsenha = "ITJGuVhAHu50";
      
      $options = array("cost"=>4);
      $hashPassword = password_hash("ITJGuVhAHu50",PASSWORD_BCRYPT,$options);
      $update['senha'] = $hashPassword;
      $att = $this->model->update('usuario', $update, $usuario[0]['id']);
      echo $nvsenha;
    } else {
      $resposta['tipo'] = 'error';
      $resposta['msg'] = 'no user found with this email / login';
    } */
    $update = array('ativo' => 1);
    $this->model->updateKey('usuario', $update, "ativo", 0);
}
  
  public function remove_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $urlat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}'");

      if (isset($urlat[0]['id'])){
        if ($urlat[0]['tipo'] != 'raiz'){
          if(realoca_pernas($urlat[0]['id'])){
            $remove = $this->model->remove('usuario', $urlat[0]['id']);
            if ($remove){
              $resposta['tipo'] = 'success';
              $resposta['msg'] = 'user successfully deleted';
            } else {
              $resposta['tipo'] = 'error';
              $resposta['msg'] = 'error deleting user';
            }
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'error realocating users branches';
          }
        } else {
          $retorno = verificaCampos($requeridos, $json, 3);
          if ($retorno['tipo']){
            $array = $retorno['data'];
            $urlat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$urlat[0]['id_usuario']}'");

            if (isset($urlat[0]['id'])){
              $remove = $this->model->removeKey('usuario', 'id_arvore', $urlat[0]['id_arvore']);
              $remove2 = $this->model->remove('arvore', $urlat[0]['id_arvore']);
              if ($remove && $remove2){
                $resposta['tipo'] = 'success';
                $resposta['msg'] = 'tree successfully removed';
              } else {
                $resposta['tipo'] = 'error';
                $resposta['msg'] = 'error removing the tree and its users';
              }
            } else {
              $resposta['tipo'] = 'error';
              $resposta['msg'] = 'user not found';
            }
          } else {
            $resposta['tipo'] = $retorno['topo'];
            $resposta['msg'] = $retorno['msg'];
          }
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];
    }
    echo json_encode($resposta);
  }

  public function voucher_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id', 'id_plano');

    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 0, true);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
        $array = $retorno['data'];
        $nvarray = array(
          'id_plano' => $array['id_plano'],
          'id_usuario' => $array['id'],
        );
       $removeoutros = $this->model->removeKey('voucher_usuario', 'id_usuario', $array['id']);
       $idvoucher = $this->model->insere_id('voucher_usuario', $nvarray);
       $voucherat = $this->model->selecionaBusca('voucher_usuario', "WHERE `id`='".$idvoucher."' ");
       $resposta['tipo'] = 'success';
       unset($resposta['msg']);
       $resposta['voucher'] = $voucherat;

    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function gAuth(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('g_auth');

    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 0, true);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
        $array = $retorno['data'];
      if (!isset($array['g_auth'])){
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'g_auth field is missing. Please send your google authenticator code';
          } else {
            $gauth = $this->model->selecionaBusca('google_auth', "WHERE `id`='1' ");
            require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
            $secret = $gauth[0]['seed'];
            $time = floor(time() / 30);
            $code = $array['g_auth'];

            $g = new GoogleAuthenticator();

            if ($g->checkCode($secret,$code)) {
                $resposta['tipo'] = 'success';
                $resposta['msg'] = 'login successfull';
            } else {
                $resposta['tipo'] = 'error';
                $resposta['msg'] = 'invalid google authenticator code.';
            }
          }
    }  else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function login_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('login', 'senha');

    $json = file_get_contents('php://input');
    
    $retorno = verificaCampos($requeridos, $json, 0, true);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->buscaLoginDif('usuario', 'login', $array['login'], $array['senha']);
      if (isset($usuario[0]->id) && $usuario[0]->ativo == 1){
        if ($usuario[0]->bloqueado == 0){
            $usuario[0] = (array)$usuario[0];
            $date = new DateTime( $usuario[0]['last_update'] );
            $date2 = new DateTime( 'NOW' );
            
            $diff = $date2->getTimestamp() - $date->getTimestamp();
            
            date_default_timezone_set('America/Sao_Paulo');
            $hour1 = 0; $hour2 = 0;
    
            $datetimeObj1 = new DateTime($usuario[0]['last_update']);
            $datetimeObj2 = new DateTime("NOW");
            $interval = $datetimeObj1->diff($datetimeObj2);
             
            if($interval->format('%a') > 0){
            $hour1 = $interval->format('%a')*24;
            }
            if($interval->format('%h') > 0){
            $hour2 = $interval->format('%h');
            }
            $diff = $hour1 + $hour2;
            
            if (isset($usuario[0]['token_acesso']) && $usuario[0]['token_acesso'] != '' && $diff <= 1){
               $uparr['token_acesso'] = $usuario[0]['token_acesso'];
    
                $resposta['diff'] = $diff;
                $resposta['tipo'] = 'success';
                $resposta['msg'] = 'login successfull';
                $resposta['id'] = $usuario[0]['id'];
                $resposta['google_auth'] = 0;
                $resposta['token'] = $uparr['token_acesso'];
                $resposta['usuario'] = $usuario[0];
     
            } else {
                $pass = false;
            $uparr['token_acesso'] = "";
            $nwhile = 0;
              while(!$pass){
                $uparr['token_acesso'] = RandomString(40);
                $usbsc = $this->model->selecionaBusca("usuario", "WHERE `token_acesso`='".$uparr['token_acesso']."' ");
                $pass = isset($usbsc[0]['id']) ? false : true;
                $nwhile++;
                if ($nwhile > 5000){
                    break;
                }
              }
              $updt2 = $this->model->update('usuario', $uparr, $usuario[0]['id']);
              $usuario[0]['token'] = $uparr['token_acesso'];
              if ($updt2){
                $resposta['diff'] = $diff;
                $resposta['tipo'] = 'success';
                $resposta['msg'] = 'login successfull';
                $resposta['id'] = $usuario[0]['id'];
                $resposta['google_auth'] = 0;
                $resposta['token'] = $uparr['token_acesso'];
                $resposta['usuario'] = $usuario[0];
              } else {
                $resposta['tipo'] = 'error';
                $resposta['msg'] = 'error generating user token, try again';
              }
            }
        } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'Your account is blocked, you cannot login or change your password. For more information, consult the administration.';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'incorrect login or password';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function retorna_usuario()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuario[0]['id'])){
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['usuario'] = $usuario[0];
        if (!isset($usuario['gAuth_seed']) || $array['google_auth'] == 0){
            require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
            $g = new GoogleAuthenticator();
            $g->test_timer();
                  
            $secret = $g->generateSecret();
            $updater['gAuth_seed'] = $secret;
            $idus = $this->model->update('usuario', $updater, $usuario[0]['id']);
        }
        
        unset($resposta['usuario']['token_acesso']);
        unset($resposta['usuario']['url']); 
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function getunilevel()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuario[0]['id'])){
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['uniLevel'] = getUnilevel($array['id']);
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function buscaUnilv(){
      /* $usuarios = $this->model->selecionaBusca("usuario", "");
      foreach($usuarios as $us){
          $array = array(
            'id_usuario' => $us['id']
            );
            $userat = $us;
          for ($i=1; $i<=10; $i++){
              $nv = $i;
              if (isset($userat['indicado_por'])){
                  $array["nv".$nv] = $userat['indicado_por'];
                  $userat = $this->model->selecionaBusca("usuario", "WHERE `id`='{$userat['indicado_por']}' ");
                  if (isset($userat[0]['id'])){
                      $userat = $userat[0];
                  }
              }
          }
          $this->model->insere("unilevel", $array);
      } */
      
      echo '<pre>';
      print_r(getUnilevel(1));
      echo '</pre>';
  }
  
 public function rodarCronAt(){
     $planos_comprados = $this->model->selecionaBusca('plano_usuario', "WHERE `ativo`='1' AND `id_plano`!='1' AND `id_usuario`='410' ");
          foreach ($planos_comprados as $plano){
              $aux = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano['id_plano']}'");
              $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano['id_usuario']}' ");
              if (isset($aux[0]['id']) && isset($us[0]['id'])){
                if (1 != 0){
                  $valor = $aux[0]['valor'] * 1 / 100;
                  $arrBalanco = array(
                    'id_usuario' => $plano['id_usuario'],
                    'valor' => $valor,
                    'descricao' => '$'.$valor." - Daily profit, 1% of $".$aux[0]['valor'].' from subscription '.$aux[0]['nome'],
                    'plano' => 'plano teste',
                    'valor_prct' =>  1,
                    'valor_plano' => $valor,
                    'tipo' => 'diario',
                    'criado_em' => date('2020-06-12 H:i:s')
                  );
                  $insert = $this->model->insere('balanco', $arrBalanco);
                  addSaldo($plano['id_usuario'], $valor);
                  
                  if (isset($us[0]['indicado_por'])){
                      
                      $residual = $valor * 2 / 100;
                  }
                }
              }
            }
            $drestantes = $plano['dias_restantes'] - 1;
            if ($drestantes >= 0){
              $updplano = array('dias_restantes' => $drestantes);
              $update = $this->model->update('plano_usuario', $updplano, $plano['id']);
            }
 }
  
  
  
/* ====================================================================================================================================================================== */
/* PLANOS =============================================================================================================================================================== */
/* ====================================================================================================================================================================== */
  
  public function cadastrar_plano()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('nome', 'valor', 'duracao');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 3);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $idus = $this->model->insere_id('planos', $array);
      
      if ($idus){
        $array['id'] = $idus;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = 'plan successfully registered';
        $resposta['plano'] = $array;
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'error inserting plan';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function atualiza_plano()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 3);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $idus = $this->model->update('planos', $array, $array['id']);
      
      if ($idus){
        $plano = $this->model->selecionaBusca('planos', "WHERE `id`='{$array['id']}' ");
        $dataShow = isset($plano[0]['id']) ? $plano[0] : $array;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = 'plan successfully updated';
        $resposta['plano'] = $dataShow;
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'error updating plan, try again';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function remove_plano()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 3);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = $this->model->selecionaBusca('planos', "WHERE `id`='{$array['id']}' ");
      
      if (isset($busca[0]['id'])){
        $remove = $this->model->remove('planos', $busca[0]['id']);
        if ($remove){
          $resposta['tipo'] = 'success';
          $resposta['msg'] = 'plan successfully deleted';
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'error deleting plan';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'plan not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function listar_planos()
  {
    $json = file_get_contents('php://input');

    $retorno = verificaCampos(array(), $json, 0);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      
        $resposta['tipo'] = "error";

        $retorno = $this->model->selecionaBusca('planos', "WHERE `ativo`='1' ORDER BY `valor` ASC");

        $resposta['tipo'] = 'success';
        $resposta['planos'] = $retorno;
        unset($resposta['msg']);
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }

  
  public function comprar_plano()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id_usuario', 'id_plano');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 0);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $url_sucesso = "";
      $url_cancelamento = "";
      $url_ipn = site_url('api/ipn');
      if (isset($array['url_sucesso'])){
        $url_sucesso = $array['url_sucesso'];
        unset($array['url_sucesso']);
      }
      if (isset($array['url_cancelamento'])){
        $url_cancelamento = $array['url_cancelamento'];
        unset($array['url_cancelamento']);
      }
      
      $idus = $this->model->insere_id('plano_usuario', $array);
      $resultado = "";
      if ($idus){
        $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='{$array['id_plano']}' ");
        $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id_usuario']}' ");
        $planoscontratados = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$usuario[0]['id']}' AND `ativo`='1' ");
        $temvalmin = true;
        $valreduc = 0;
        foreach ($planoscontratados as $pln){
            $auxp = $this->model->selecionaBusca('planos', "WHERE `id`='{$pln['id_plano']}' ");
            if (isset($auxp[0]['id'])){
                if ($auxp[0]['valor'] > 10){
                    $valreduc = $valreduc < $auxp[0]['valor'] ? $auxp[0]['valor'] : $valreduc;
                }
            }
        }
        if (isset($planoat[0]['id']) && $planoat[0]['valor'] > $valreduc){
            if ($temvalmin){
            
              if (isset($usuario[0]['id']) && isset($planoat[0]['id'])){
                $valatual = $planoat[0]['valor'];
                if ($valatual > 10){
                    $valatual = $planoat[0]['valor'] + 10;
                    $valatual -= $valreduc;
                }
                $postfields = "version=1&key=2e4f8533ea9b70d2a0c41837c2f2390071a635de522aa51e1742bc2125321544";
                $postfields .= "&cmd=create_transaction";
                $postfields .= "&amount=".$valatual;
                $postfields .= "&currency1=USD";
                $postfields .= "&currency2=BTC";
                $postfields .= "&buyer_email=".$usuario[0]['email'];
                $postfields .= "&buyer_name=".$usuario[0]['nome'];
                $postfields .= "&item_name=".$planoat[0]['nome'];
                $postfields .= "&custom=".$idus;
                $postfields .= "&ipn_url=".$url_ipn;
                if ($url_sucesso != ''){
                  $postfields .= "&success_url=".$url_sucesso;
                }
                if ($url_cancelamento != ''){
                  $postfields .= "&cancel_url=".$url_cancelamento;
                }
    
                $hmac = hash_hmac('sha512', $postfields, '16a0d6FbbC802a450cd128dc176Bc3eAEa60e55660f8950a45659b15c132b34A');
    
                //$resposta['postfields'] = $postfields;
                $ch = curl_init("https://www.coinpayments.net/api.php");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'HMAC: '.$hmac));                                                                                                              
    
                $result = curl_exec($ch);
                $result = json_decode($result);
                $resultado = $result;
    
                $assunto = "Pending subscription";
                $texto = "Your subscription for the plan <b>".$planoat[0]['nome'].'</b> is pending.<br/><br/>You can finish your payment trough the following link: <a href="'.$resultado->result->checkout_url.'">'.$resultado->result->checkout_url.'</a><br/><br/>';
                $texto .= 'As soon as your payment is completed, you will receive a confirmation email!';
                $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
              }
              $array['id'] = $idus;
              $resposta['tipo'] = 'success';
              $resposta['msg'] = 'subscription is now pending payment';
              $resposta['compra'] = $array;
              $resposta['coinpayments'] = $resultado;
            } else {
              $resposta['tipo'] = 'error';
              $resposta['msg'] = 'you must buy the network activation plan first.';
            }
        } else {
             $resposta['tipo'] = 'error';
             $resposta['msg'] = 'you already have an active plan that has an equal or higher value.';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'error generating subscription.';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function ipn(){
    $merchant_id = 'Your_Merchant_ID';
    $secret = "2)X3*eWo!vG]";

    $save_text = "";
    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
    //if (true == false) {
      $save_text = "No HMAC signature sent";
    } else {
      $merchant = isset($_POST['merchant']) ? $_POST['merchant']:'';
      //if (empty($merchant)) {
      if (true == false) {
        $save_text = "No Merchant ID passed";
      } else {
        $request = file_get_contents('php://input');
        if ($request === FALSE || empty($request)) {
          $save_text = "Error reading POST data";
        } else {
          $hmac = hash_hmac("sha512", $request, $secret);
          if ($hmac != $_SERVER['HTTP_HMAC']) {
          //if (true == false) {
            $save_text = "HMAC signature does not match";
          } else {
            $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
            $request = $_POST;
            $save_text = print_r($_POST, true);
            if (isset($request['status'])){
              if ($request['status'] < 0){
                 $this->model->remove('plano_usuario', $request['custom']);
                $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id`='{$request['custom']}' ");
                if (isset($plano[0]['id'])){
                  $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano[0]['id_plano']}' ");
                  $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano[0]['id_usuario']}' ");
                  if (isset($planoat[0]['id']) && isset($usuario[0]['id'])){
                    if ($request['status'] == -2){
                        $assunto = "Subscription canceled";
                        $texto = "Your payment for the subscription of <b>".$planoat[0]['nome'].'</b> have been canceled.<br/>';
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                    } else if ($request['status'] == -1){
                        $assunto = "Subscription canceled";
                        $texto = "Your payment for the subscription of <b>".$planoat[0]['nome'].'</b> have been canceled.<br/>';
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                    }
                    $rel = array(
                        'plano' => $planoat[0]['nome'],
                        'id_plano' => $plano[0]['id_plano'],
                        'id_usuario' => $plano[0]['id_usuario'],
                        'estado' => "canceled",
                        'data' => date('Y-m-d H:i:s')
                      );
                      $this->model->insere('relatorio_planos', $rel);
                  }
                }
              } else if ($request['status'] >= 100 || $request['status_text'] == "Complete"){
                $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id`='".$request['custom']."' ");
                if (isset($plano[0]['id'])){
                  if ($plano[0]['ativo'] == 0){
                    $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='".$plano[0]['id_plano']."' ");
                    $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='".$plano[0]['id_usuario']."' ");
                    if (isset($planoat[0]['id']) && isset($usuario[0]['id'])){
                      $upd = array('ativo' => 1, 'data_resposta'=> date('Y-m-d H:i:s'), 'dias_restantes' => $planoat[0]['duracao'], 'resposta' => "Plan activated");
                      $update = $this->model->update('plano_usuario', $upd, $request['custom']);
                      $rel = array(
                        'plano' => $planoat[0]['nome'],
                        'id_plano' => $plano[0]['id_plano'],
                        'id_usuario' => $plano[0]['id_usuario'],
                        'estado' => "activated",
                        'data' => date('Y-m-d H:i:s')
                      );
                      $this->model->insere('relatorio_planos', $rel);
                      
                      if ($update){
                        //echo 'UPDATE OCORRIDO COM SUCESSO... BUSCANDO GANHO BINÁRIO';
                        if (isset($usuario[0]['id_link']) && isset($config[0]['ganho_binario'])){
                              //echo '<br/><br/>USUÁRIO TEM ID_LINK E CONFIG[0]GANHO_BINARIO ENCONTRADOS...';
                              $aux = $usuario[0]['id_link'];
                              $perna = $usuario[0]['perna'];
                              
                              $pontos = $planoat[0]['valor'];
                              
                              $qualificadores = $this->model->selecionaBusca('usuario', "WHERE `indicado_por`='{$usuario[0]['id']}' ORDER BY id ASC LIMIT 2");
                              addBinario($usuario[0], $pontos, $qualificadores);
                        } else {
                            //echo '<br/><br/>USUÁRIO NÃO TEM ID_LINK E /OU CONFIG[0]GANHO_BINARIO NÃO ENCONTRADO...';
                        }
                        if (isset($usuario[0]['indicado_por']) && isset($config[0]['ganho_indicacao'])){
                          $usuarioaux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                          //echo '<br/><br/>(INDICAÇÃO) BUSCANDO USUARIO '.$usuario[0]['id'].' - '.$usuarioaux[0]['nome'];
                          //ADCIONA SALDO AO USUÁRIO QUE INDICOU
                          $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                          $passar = false;
                          if (isset($templano[0]['id'])){
                            //echo '<br/>USUÁRIO TEM PLANO -> ADCIONANDO VALOR';
                            $passar = true;
                          } else {
                            //echo '<br/>USUÁRIO NÃO TEM PLANO... BUSCANDO VOUCHER';
                            $temvoucher = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                            if (isset($temvoucher[0]['id'])){
                             //echo '<br/>USUÁRIO TEM VOUCHER -> ADCIONANDO VALOR';
                              $passar = true;
                            } else {
                              //echo '<br/>USUÁRIO NÃO TEM VOUCHER... VERIFICANDO SE É UM USUÁRIO RAIZ';
                              $usuarioat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                              if (isset($usuarioat[0]['tipo']) && $usuarioat[0]['tipo'] == 'raiz'){
                                  //echo '<br/>USUÁRIO É RAIZ -> ADCIONANDO VALOR';
                                  $passar = true;
                              }
                            }
                          }
                          
                          if ($passar){
                            
                            $valorAdd = $planoat[0]['valor'] * $config[0]['ganho_indicacao'] / 100;
                            addSaldo($usuario[0]['indicado_por'], $valorAdd);
                            $arrBalanco = array(
                              'id_usuario' => $usuario[0]['indicado_por'],
                              'valor' => $valorAdd,
                              'descricao' => "$".$valorAdd." - Indication profit, ".$config[0]['ganho_indicacao'].'% of $'.$planoat[0]['valor'].' from '.$usuario[0]['nome']."'s subscription ".$planoat[0]['nome'],
                              'usuario' => $usuario[0]['nome'],
                              'plano' => $planoat[0]['nome'],
                              'valor_prct' => $config[0]['ganho_indicacao'],
                              'valor_plano' => $planoat[0]['valor'],
                              'tipo' => 'indicacao'
                            );
                            $insert = $this->model->insere('balanco', $arrBalanco);
                            //echo '<br/>SALDO ADCIONADO';
                          }
                        }
                        $assunto = "Subscription active";
                        $texto = "Your payment for the plan <b>".$planoat[0]['nome'].'</b> have been confirmed and your subscription is now active.<br/>';
                        $texto .= "Visit our platform for details.";
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                      }
                    } else {
                        $save_text .= "\r\nNO PLAN OR USER FOUND";
                    }
                  } else {
                      $save_text .= "\r\nPLAN ALREADY ACTIVE";
                  }
                } else {
                    $save_text .= "\r\SUBSCRIPTION NOT FOUND";
                }
              } else {
                  $save_text .= "\r\nREQUEST NOT LESS THAN 0 NOR GREATER OR EQUAL 100";
              }
            } else {
                $save_text .= "\r\nREQUEST NOT FOUND";
            }
          }
        }
      }
    }

    $this->model->insere('ipn', array('request' => $save_text));
  }
  
  
  public function testa_ipn(){
      
      echo '<form method="post" action="'.site_url('api/ipn').'" >
      <input type="number" name="amount1" value="60" />
      <input type="text" name="amount2" value="0.00675" />
      <input type="text" name="buyer_name" value="gigantebrasil1" />
      <input type="text" name="currency1" value="USD" />
      <input type="text" name="currency2" value="BTC" />
      <input type="text" name="custom" value="52" />
      <input type="text" name="email" value="osmarparizotto@gmail.com" />
      <input type="text" name="fee" value="3.0E-5" />
      <input type="text" name="ipn_id" value="78c603e730f346b871f625384b142920" />
      <input type="text" name="ipn_mode" value="hmac" />
      <input type="text" name="ipn_type" value="api" />
      <input type="text" name="ipn_version" value="1.0" />
      <input type="text" name="item_name" value="MBM50" />
      <input type="text" name="merchant" value="e9123e6f29ff83539172c05ce28ee912" />
      <input type="text" name="net" value="0.00673" />
      <input type="text" name="received_amount" value="0.00675" />
      <input type="number" name="received_confirms" value="2" />
      <input type="number" name="status" value="100" />
      <input type="text" name="status_text" value="Complete" />
      <input type="text" name="txn_id" value="CPEE56VX1RYTJEQJKZGKEVAWQJ" />
      <button type="submit">Enviar</button>
      </form>';
  }
  
  public function script_correcao_atual(){
      $balanco = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='117' AND `tipo`='binario' ");
      $valatual = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='117' ");
      foreach($balanco as $bal){
          $valatual[0]['saldo'] -= $bal['valor'];
          $this->model->remove('balanco', $bal['id']);
      }
      $valatual[0]['score_direita'] = 0;
      $valatual[0]['score_esquerda'] = 0;
      $valatual[0]['pontos_carreira'] = 0;
      $this->model->update('saldo_usuario', $valatual[0], $valatual[0]['id']);
  }
  
  public function ativarPlanoUsuario(){
      $data['usuarios'] = $this->model->selecionaBusca('usuario', "");
      $data['planos'] = $this->model->selecionaBusca('planos', "");
      
      
      $this->load->view('ativar_usuario_plano', $data);
  }
  
  public function ativarVoucherUsuario(){
      $data['usuarios'] = $this->model->selecionaBusca('usuario', "");
      $data['planos'] = $this->model->selecionaBusca('planos', "");
      
      
      $this->load->view('ativar_voucher_usuario', $data);
  }
  
  public function checaPlanoUsuario(){
      $data['usuarios'] = $this->model->selecionaBusca('usuario', "");
      
      
      $this->load->view('checa_plano_usuario', $data);
  }
  
  public function debitoCreditoUsuario(){
      $data['usuarios'] = $this->model->selecionaBusca('usuario', "");
      
      
      $this->load->view('debito_credito_usuario', $data);
  }
  
  public function debito_credito(){
      $senha = $this->input->post('senha');
      $login = 'moneybemoney';
      $user = $this->model->buscaLoginDif('usuario', 'login', $login, $senha);
      $config = $this->model->selecionaBusca('configuracoes', "");
      if (isset($user[0]->id)){
          $usuario = $this->input->post('usuario');
            $carteira = $this->model->selecionaBusca("saldo_usuario", "WHERE `id_usuario`='{$usuario}' ");
            $userat = $this->model->selecionaBusca("usuario", "WHERE `id`='{$usuario}' ");
            $funcao = $this->input->post("tipo");
            if ($funcao == "debito"){
                if (isset($carteira[0]['id'])){
                    $nvarray = array(
                      'saldo' => $carteira[0]['saldo'] - $this->input->post('valor')
                    );
                    
                    $this->model->update("saldo_usuario", $nvarray, $carteira[0]['id']);
                } else {
                    $nvarray = array(
                      'pontos_direita' => 0,
                      'pontos_esquerda' => 0,
                      'pt_saldo_esquerda' => 0,
                      'pt_saldo_direita' => 0,
                      'score_direita' => 0,
                      'score_esquerda' => 0,
                      'pontos_carreira' => 0,
                      'id_usuario' => $usuario,
                      'saldo' => 0 - $this->input->post('valor')
                    );
                    $this->model->insere("saldo_usuario", $nvarray);
                }
                $bal = array(
                        'id_usuario' => $usuario,
                        'valor' => $this->input->post("valor"),
                        'usuario' => $userat[0]['nome'],
                        'plano' => '',
                        'descricao' => "Debit of financial value",
                        'valor_prct' => 0,
                        'valor_plano' => 0,
                        'tipo' => "debito",
                    ); 
                    
                    $this->model->insere("balanco", $bal);
                    echo "<br/><b>Débito de $".$this->input->post("valor")." adcionado com sucesso para o usuário ".$userat[0]['login']."</b>";
            } else {
                if (isset($carteira[0]['id'])){
                    $nvarray = array(
                      'saldo' => $carteira[0]['saldo'] + $this->input->post('valor')
                    );
                    
                    $this->model->update("saldo_usuario", $nvarray, $carteira[0]['id']);
                } else {
                    $nvarray = array(
                      'pontos_direita' => 0,
                      'pontos_esquerda' => 0,
                      'pt_saldo_esquerda' => 0,
                      'pt_saldo_direita' => 0,
                      'score_direita' => 0,
                      'score_esquerda' => 0,
                      'pontos_carreira' => 0,
                      'id_usuario' => $usuario,
                      'saldo' => $this->input->post('valor')
                    );
                    $this->model->insere("saldo_usuario", $nvarray);
                }
                $bal = array(
                        'id_usuario' => $usuario,
                        'valor' => $this->input->post("valor"),
                        'usuario' => $userat[0]['nome'],
                        'plano' => '',
                        'descricao' => "Credit of financial value",
                        'valor_prct' => 0,
                        'valor_plano' => 0,
                        'tipo' => "credito",
                    ); 
                    
                    $this->model->insere("balanco", $bal);
                echo "<br/><b>Crédito de $".$this->input->post("valor")." adcionado com sucesso para o usuário ".$userat[0]['login']."</b>";
            }
            
      }
  }
  
  public function sending_voucher_atv(){
      $senha = $this->input->post('senha');
      $login = 'moneybemoney';
      $user = $this->model->buscaLoginDif('usuario', 'login', $login, $senha);
      $config = $this->model->selecionaBusca('configuracoes', "");
      if (isset($user[0]->id)){
            $nvarray = array(
              'id_plano' => $this->input->post('plano'),
              'id_usuario' => $this->input->post('usuario')
            );
           $removeoutros = $this->model->removeKey('voucher_usuario', 'id_usuario', $this->input->post('usuario'));
           $idvoucher = $this->model->insere_id('voucher_usuario', $nvarray);
           echo 'ativado ';
      } else {
          echo "senha incorreta";
      }
  }
  
  public function busca_plano_voucher_us(){
     $senha = $this->input->post('senha');
      $login = 'moneybemoney';
      $user = $this->model->buscaLoginDif('usuario', 'login', $login, $senha);
      $config = $this->model->selecionaBusca('configuracoes', "");
      if (isset($user[0]->id)){
            $id = $this->input->post("usuario");
            $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='".$id."' AND `ativo`='1' ORDER BY `data_pedido` DESC ");

            $valmax = 0;
            $planotxt = "";
            $dataplano = "";
            $horapln = "";
            if (isset($plano[0]['id'])){
                foreach ($plano as $pln){
                    $pat = $this->model->selecionaBusca('planos', "WHERE `id`='".$pln['id_plano']."' ");
                    if (isset($pat[0]['id'])){
                        if ($pat[0]['valor'] > $valmax){
                            $valmax = $pat[0]['valor'];
                            $planotxt = $pat[0]['nome'];
                            $auxdata = explode(' ', $pln['data_resposta']);
                            $horapln = $auxdata[1];
                            $auxdata = explode('-', $auxdata[0]);
                            $dataplano = $auxdata[2].'/'.$auxdata[1].'/'.$auxdata[0];
                        }
                    }
                }
            }
            if ($planotxt != ""){
                echo "PLANO ATIVO - ".$planotxt." || VALOR: ".$valmax." || DATA DE ATIVAÇÃO: ".$dataplano.' às '.$horapln;
            } else {
                $plano = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='".$id."' AND `ativo`='1' ORDER BY `data_pedido` DESC ");
                $valmax = 0;
                $planotxt = "";
                $dataplano = "";
            $horapln = "";
                if (isset($plano[0]['id'])){
                    foreach ($plano as $pln){
                        $pat = $this->model->selecionaBusca('planos', "WHERE `id`='".$pln['id_plano']."' ");
                        if (isset($pat[0]['id'])){
                            if ($pat[0]['valor'] > $valmax){
                                $valmax = $pat[0]['valor'];
                                $planotxt = $pat[0]['nome'];
                                $auxdata = explode(' ', $pln['data_pedido']);
                                $horapln = $auxdata[1];
                                $auxdata = explode('-', $auxdata[0]);
                                $dataplano = $auxdata[2].'/'.$auxdata[1].'/'.$auxdata[0];
                            }
                        }
                    }
                }
                if ($planotxt != ""){
                    echo "VOUCHER ATIVO - ".$planotxt." || VALOR: ".$valmax." || DATA DE ATIVAÇÃO: ".$dataplano.' às '.$horapln;
                } else {
                    echo "USUARIO NÃO POSSUI PLANOS OU VOUCHERS ATIVOS";
                }
            }
      } 
  }
  
  public function sending_plano_atv(){
      $senha = $this->input->post('senha');
      $login = 'moneybemoney';
      $user = $this->model->buscaLoginDif('usuario', 'login', $login, $senha);
      $config = $this->model->selecionaBusca('configuracoes', "");
      if (isset($user[0]->id)){
            $dataplano = array(
                'id_plano' => $this->input->post('plano'),
                'id_usuario' => $this->input->post('usuario')
            );
            $idus = $this->model->insere_id('plano_usuario', $dataplano);
            $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id`='".$idus."' ");
                if (isset($plano[0]['id'])){
                  if ($plano[0]['ativo'] == 0){
                    $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='".$plano[0]['id_plano']."' ");
                    $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='".$plano[0]['id_usuario']."' ");
                    if (isset($planoat[0]['id']) && isset($usuario[0]['id'])){
                      $upd = array('ativo' => 1, 'data_resposta'=> date('Y-m-d H:i:s'), 'dias_restantes' => $planoat[0]['duracao'], 'resposta' => "Plan activated");
                      $update = $this->model->update('plano_usuario', $upd, $idus);
                      $rel = array(
                        'plano' => $planoat[0]['nome'],
                        'id_plano' => $plano[0]['id_plano'],
                        'id_usuario' => $plano[0]['id_usuario'],
                        'estado' => "activated",
                        'data' => date('Y-m-d H:i:s')
                      );
                      $this->model->insere('relatorio_planos', $rel);
                      
                      if ($update){
                        //echo 'UPDATE OCORRIDO COM SUCESSO... BUSCANDO GANHO BINÁRIO';
                        if (isset($usuario[0]['id_link']) && isset($config[0]['ganho_binario'])){
                              //echo '<br/><br/>USUÁRIO TEM ID_LINK E CONFIG[0]GANHO_BINARIO ENCONTRADOS...';
                              $aux = $usuario[0]['id_link'];
                              $perna = $usuario[0]['perna'];
                              
                              $pontos = $planoat[0]['valor'];
                              
                              $qualificadores = $this->model->selecionaBusca('usuario', "WHERE `indicado_por`='{$usuario[0]['id']}' ORDER BY id ASC LIMIT 2");
                              addBinario($usuario[0], $pontos, $qualificadores);
                        } else {
                            //echo '<br/><br/>USUÁRIO NÃO TEM ID_LINK E /OU CONFIG[0]GANHO_BINARIO NÃO ENCONTRADO...';
                        }
                        if (isset($usuario[0]['indicado_por']) && isset($config[0]['ganho_indicacao'])){
                          $usuarioaux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                          //echo '<br/><br/>(INDICAÇÃO) BUSCANDO USUARIO '.$usuario[0]['id'].' - '.$usuarioaux[0]['nome'];
                          //ADCIONA SALDO AO USUÁRIO QUE INDICOU
                          $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                          $passar = false;
                          if (isset($templano[0]['id'])){
                            //echo '<br/>USUÁRIO TEM PLANO -> ADCIONANDO VALOR';
                            $passar = true;
                          } else {
                            //echo '<br/>USUÁRIO NÃO TEM PLANO... BUSCANDO VOUCHER';
                            $temvoucher = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                            if (isset($temvoucher[0]['id'])){
                             //echo '<br/>USUÁRIO TEM VOUCHER -> ADCIONANDO VALOR';
                              $passar = true;
                            } else {
                              //echo '<br/>USUÁRIO NÃO TEM VOUCHER... VERIFICANDO SE É UM USUÁRIO RAIZ';
                              $usuarioat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                              if (isset($usuarioat[0]['tipo']) && $usuarioat[0]['tipo'] == 'raiz'){
                                  //echo '<br/>USUÁRIO É RAIZ -> ADCIONANDO VALOR';
                                  $passar = true;
                              }
                            }
                          }
                          
                          if ($passar){
                            
                            $valorAdd = $planoat[0]['valor'] * $config[0]['ganho_indicacao'] / 100;
                            addSaldo($usuario[0]['indicado_por'], $valorAdd);
                            $arrBalanco = array(
                              'id_usuario' => $usuario[0]['indicado_por'],
                              'valor' => $valorAdd,
                              'descricao' => "$".$valorAdd." - Indication profit, ".$config[0]['ganho_indicacao'].'% of $'.$planoat[0]['valor'].' from '.$usuario[0]['nome']."'s subscription ".$planoat[0]['nome'],
                              'usuario' => $usuario[0]['nome'],
                              'plano' => $planoat[0]['nome'],
                              'valor_prct' => $config[0]['ganho_indicacao'],
                              'valor_plano' => $planoat[0]['valor'],
                              'tipo' => 'indicacao'
                            );
                            $insert = $this->model->insere('balanco', $arrBalanco);
                            //echo '<br/>SALDO ADCIONADO';
                          }
                        }
                        $assunto = "Subscription active";
                        $texto = "Your payment for the plan <b>".$planoat[0]['nome'].'</b> have been confirmed and your subscription is now active.<br/>';
                        $texto .= "Visit our platform for details.";
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                      }
                    }
                  }
                }
      }
  }
  
  public function ativar_plano()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";
    $config = $this->model->selecionaBusca('configuracoes', "");
    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 3);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id`='{$array['id']}' ");
      
      if (isset($plano[0]['id'])){
        if ($plano[0]['ativo'] == 0){
          $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano[0]['id_plano']}' ");
          $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano[0]['id_usuario']}' ");
          if (isset($planoat[0]['id']) && isset($usuario[0]['id'])){

                      $upd = array('ativo' => 1, 'data_resposta'=> date('Y-m-d H:i:s'), 'dias_restantes' => $planoat[0]['duracao'], 'resposta' => "Plan activated");
                      $update = $this->model->update('plano_usuario', $upd, $array['id']);
                      $rel = array(
                        'plano' => $planoat[0]['nome'],
                        'id_plano' => $plano[0]['id_plano'],
                        'id_usuario' => $plano[0]['id_usuario'],
                        'estado' => "activated",
                        'data' => date('Y-m-d H:i:s')
                      );
                      $this->model->insere('relatorio_planos', $rel);
                      
                      if ($update){
                        $plano = $this->model->selecionaBusca('plano_usuario', "WHERE `id`='".$request['custom']."' ");
                if (isset($plano[0]['id'])){
                  if ($plano[0]['ativo'] == 0){
                    $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='".$plano[0]['id_plano']."' ");
                    $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='".$plano[0]['id_usuario']."' ");
                    if (isset($planoat[0]['id']) && isset($usuario[0]['id'])){
                      $upd = array('ativo' => 1, 'data_resposta'=> date('Y-m-d H:i:s'), 'dias_restantes' => $planoat[0]['duracao'], 'resposta' => "Plan activated");
                      $update = $this->model->update('plano_usuario', $upd, $request['custom']);
                      $rel = array(
                        'plano' => $planoat[0]['nome'],
                        'id_plano' => $plano[0]['id_plano'],
                        'id_usuario' => $plano[0]['id_usuario'],
                        'estado' => "activated",
                        'data' => date('Y-m-d H:i:s')
                      );
                      $this->model->insere('relatorio_planos', $rel);
                      
                      if ($update){
                        //echo 'UPDATE OCORRIDO COM SUCESSO... BUSCANDO GANHO BINÁRIO';
                        if (isset($usuario[0]['id_link']) && isset($config[0]['ganho_binario'])){
                              //echo '<br/><br/>USUÁRIO TEM ID_LINK E CONFIG[0]GANHO_BINARIO ENCONTRADOS...';
                              $aux = $usuario[0]['id_link'];
                              $perna = $usuario[0]['perna'];
                              
                              $pontos = $planoat[0]['valor'];
                              
                              $qualificadores = $this->model->selecionaBusca('usuario', "WHERE `indicado_por`='{$usuario[0]['id']}' ORDER BY id ASC LIMIT 2");
                              addBinario($usuario[0], $pontos, $qualificadores);
                        } else {
                            //echo '<br/><br/>USUÁRIO NÃO TEM ID_LINK E /OU CONFIG[0]GANHO_BINARIO NÃO ENCONTRADO...';
                        }
                        if (isset($usuario[0]['indicado_por']) && isset($config[0]['ganho_indicacao'])){
                          $usuarioaux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                          //echo '<br/><br/>(INDICAÇÃO) BUSCANDO USUARIO '.$usuario[0]['id'].' - '.$usuarioaux[0]['nome'];
                          //ADCIONA SALDO AO USUÁRIO QUE INDICOU
                          $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                          $passar = false;
                          if (isset($templano[0]['id'])){
                            //echo '<br/>USUÁRIO TEM PLANO -> ADCIONANDO VALOR';
                            $passar = true;
                          } else {
                            //echo '<br/>USUÁRIO NÃO TEM PLANO... BUSCANDO VOUCHER';
                            $temvoucher = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                            if (isset($temvoucher[0]['id'])){
                             //echo '<br/>USUÁRIO TEM VOUCHER -> ADCIONANDO VALOR';
                              $passar = true;
                            } else {
                              //echo '<br/>USUÁRIO NÃO TEM VOUCHER... VERIFICANDO SE É UM USUÁRIO RAIZ';
                              $usuarioat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                              if (isset($usuarioat[0]['tipo']) && $usuarioat[0]['tipo'] == 'raiz'){
                                  //echo '<br/>USUÁRIO É RAIZ -> ADCIONANDO VALOR';
                                  $passar = true;
                              }
                            }
                          }
                          
                          if ($passar){
                            
                            $valorAdd = $planoat[0]['valor'] * $config[0]['ganho_indicacao'] / 100;
                            addSaldo($usuario[0]['indicado_por'], $valorAdd);
                            $arrBalanco = array(
                              'id_usuario' => $usuario[0]['indicado_por'],
                              'valor' => $valorAdd,
                              'descricao' => "$".$valorAdd." - Indication profit, ".$config[0]['ganho_indicacao'].'% of $'.$planoat[0]['valor'].' from '.$usuario[0]['nome']."'s subscription ".$planoat[0]['nome'],
                              'usuario' => $usuario[0]['nome'],
                              'plano' => $planoat[0]['nome'],
                              'valor_prct' => $config[0]['ganho_indicacao'],
                              'valor_plano' => $planoat[0]['valor'],
                              'tipo' => 'indicacao'
                            );
                            $insert = $this->model->insere('balanco', $arrBalanco);
                            //echo '<br/>SALDO ADCIONADO';
                          }
                        }
                        $assunto = "Subscription active";
                        $texto = "Your payment for the plan <b>".$planoat[0]['nome'].'</b> have been confirmed and your subscription is now active.<br/>';
                        $texto .= "Visit our platform for details.";
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                      }
                    } else {
                        $save_text .= "\r\nNO PLAN OR USER FOUND";
                    }
                  } else {
                      $save_text .= "\r\nPLAN ALREADY ACTIVE";
                  }
                } else {
                    $save_text .= "\r\SUBSCRIPTION NOT FOUND";
                }
            } else {
              $resposta['tipo'] = 'error';
              $resposta['msg'] = 'error activating subscription, try again';
            }
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'subscription user and/or plan not found';
          }
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'subscription already active';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'subscription not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function listar_compras()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = "WHERE `id_usuario`='{$array['id']}' ";
      if (isset($array['estado'])){
        if ($array['estado'] == 'processamento'){
          $busca .= "AND `ativo`='0'";
        } else if ($array['estado'] == 'efetuada'){
          $busca .= "AND `ativo`='1'";
        }
      }
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      $resposta['binaryQ'] = "NO";
      if (isset($usuario[0]['id'])){
          if (equalificador($usuario[0])){
              $resposta['binaryQ'] = "YES";
          }
      }
      $planos = $this->model->selecionaBusca('plano_usuario', $busca);
      for ($i=0; $i<count($planos); $i++){
        $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='{$planos[$i]['id_plano']}' ");
        $planos[$i]['plano'] = array();
        if (isset($planoat[0]['id'])){
          $planos[$i]['plano'] = $planoat[0];
        }
      }
      $vouchers = $this->model->selecionaBusca('voucher_usuario', $busca);
      for ($i=0; $i<count($vouchers); $i++){
        $planoat = $this->model->selecionaBusca('planos', "WHERE `id`='{$vouchers[$i]['id_plano']}' ");
        $vouchers[$i]['plano'] = array();
        if (isset($planoat[0]['id'])){
          $vouchers[$i]['plano'] = $planoat[0];
        }
      }
      
      unset($resposta['msg']);
      if (isset($planos[0]['id'])){
        $resposta['compras'] = $planos;
      } else {
        $resposta['compras'] = array();
      }
      if (isset($vouchers[0]['id'])){
        $resposta['vouchers'] = $vouchers;
      } else {
        $resposta['vouchers'] = array();
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  function corrige_planos(){
      $usuarios = $this->model->selecionaBusca('usuario', "");
      foreach ($usuarios as $usr){
          $saldo = $this->model->selecionaBusca('balanco', "WHERE `id_usuario`='{$usr['id']}' ");
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
          for ($i=0; $i<count($saldo); $i++){
            $resposta['balanco'][$i] = $saldo[$i];
            unset($resposta['balanco'][$i]['usuario']);
            unset($resposta['balanco'][$i]['valor_plano']);
            unset($resposta['balanco'][$i]['plano']);
            if ($saldo[$i]['tipo'] == 'diario'){
              $resposta['diario_total']  += $saldo[$i]['valor'];
            } else if ($saldo[$i]['tipo'] == 'binario'){
              $resposta['binario_total']  += $saldo[$i]['valor'];
            } else if ($saldo[$i]['tipo'] == 'residual'){
              $resposta['residual_total']  += $saldo[$i]['valor'];
            } else if ($saldo[$i]['tipo'] == 'indicacao'){
              $resposta['indicacao_total']  += $saldo[$i]['valor'];
            }
            
            $resposta['balanco'][$i]['nome_usuario_auxiliar'] = $saldo[$i]['usuario'];
            $resposta['balanco'][$i]['valor_total'] = $saldo[$i]['valor_plano'];
            $resposta['balanco'][$i]['nome_plano_auxiliar'] = $saldo[$i]['plano'];
            if ($saldo[$i]['tipo'] != 'saque'){
              $resposta['saldo_total'] += $saldo[$i]['valor'];
              $resposta['entradas_total'] += $saldo[$i]['valor'];
              unset($resposta['balanco'][$i]['tx_pct']);
              unset($resposta['balanco'][$i]['tx_valor']);
            } else {
              $resposta['saldo_total'] -= $saldo[$i]['valor'];
              $resposta['saidas_total'] += $saldo[$i]['valor'];
              $resposta['saques_total'] += $saldo[$i]['valor'] - $resposta['balanco'][$i]['tx_valor'];
              $resposta['total_taxas'] += $resposta['balanco'][$i]['tx_valor'];
            }
          }
          
        $nvdtcart = array(
            'saldo' =>  $resposta['saldo_total']
        ); 
        $this->model->updateKey('saldo_usuario', $nvdtcart, 'id_usuario', $usr['id']);
      }
      
  }


/* ====================================================================================================================================================================== */
/* SALDO E BALANÇO ====================================================================================================================================================== */
/* ====================================================================================================================================================================== */
  
  public function testa_saque(){
      $usuarios = $this->model->selecionaBusca('usuario', "");
      foreach ($usuarios as $us){
          $pln = true;
          $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$us['id']}' ");
          if (!isset($templano[0]['id'])){
            $templano = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$us['id']}' ");  
            if (!isset($templano[0]['id'])){
                $pln = false;   
            }
          }
          if (!$pln){
            $array = array(
                'id_plano' => 1,
                'id_usuario' => $us['id'],
                'data_pedido' => date('Y-m-d H:i:s'),
                'ativo' => 1
            );
            $this->model->insere('voucher_usuario', $array);
          }
      }
  }
  
  
  public function pedir_saque(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id', 'valor', 'carteira', 'gauth_token');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
      $tem_pedido = $this->model->selecionaBusca('pedido_saque', "WHERE `id_usuario`='{$array['id']}' AND `aceito`='0' LIMIT 1");
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' LIMIT 1");
      //if (isset($usuario[0]['id']) && $usuario[0]['google_auth'] == 1){
      if (isset($usuario[0]['id'])){
          $ret = podeSacar($usuario[0]['id']);
          if ($ret['saque']){
              if (!isset($tem_pedido[0]['id'])){
                require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
                $secret = $usuario[0]['gAuth_seed'];
                $time = floor(time() / 30);
                $code = str_replace(" ", "", $array['gauth_token']);
    
                $g = new GoogleAuthenticator();
    
                if ($g->checkCode($secret,$code)) {
                    
                    $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id']}' LIMIT 1");
                    $maxval = 0;
                    $cancelar_extouro_limite = isset($array['cancelar_extouro_limite']) ?  $array['cancelar_extouro_limite'] : false;
                    if (isset($saldo[0]['id'])){
                      $maxval = $saldo[0]['saldo'];
                    }
                    $passar = true;
                    if ($array['valor'] < 50){
                        $resposta['tipo'] = 'error';
                        $resposta['msg'] = "The withdraw value must be higher than ".'$50, actual value: $'.$array['valor'];
                        $resposta['valor_pedido'] = $array['valor'];
                        $resposta['saldo'] = $maxval;
                        $passar = false;
                    } else if ($array['valor'] > $maxval){
                      if ($cancelar_extouro_limite){
                        $resposta['tipo'] = 'error';
                        $resposta['msg'] = "Your withdraw value $".$array['valor']." is higher than your balance $".$maxval;
                        $resposta['valor_pedido'] = $array['valor'];
                        $resposta['saldo'] = $maxval;
                        $passar = false;
                      } else {
                        if ($maxval > 0){
                          $array['valor'] = $maxval;
                        } else {
                          $resposta['tipo'] = 'error';
                          $resposta['msg'] = "Your actual balance is 0";
                          $resposta['valor_pedido'] = $array['valor'];
                          $resposta['saldo'] = $maxval;
                          $passar = false;
                        }
                        
                      }
                    }
                    if ($passar){
                        $ultimo_pedido = $this->model->selecionaBusca('pedido_saque', "WHERE `id_usuario`='{$array['id']}' AND `aceito`='1' ORDER BY `criado_em` LIMIT 1");
                        $taxapgt = 3;
                        if (isset($ultimo_pedido[0]['id'])){
                            $now = time(); // or your date as well
                            $your_date = strtotime($ultimo_pedido[0]['criado_em']);
                            $datediff = $now - $your_date;
                            $dias = round($datediff / (60 * 60 * 24));
                            if ($dias < 7){
                                $taxapgt = 10;
                            } else if ($dias < 30){
                                $taxapgt = 7;
                            } else {
                                $taxapgt = 3;
                            }
                        }
                        
                        
                        
                      $desconto_pct = $taxapgt;
                      $desconto_dol = $array['valor'] * $desconto_pct / 100;
                      $val_liq = $array['valor'] - $desconto_dol;
                      $nvpedido = array(
                        'id_usuario' => $array['id'],
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'aceito' => 0,
                        'valor' => $array['valor'],
                        'carteira' => $array['carteira'],
                        'desconto_pct' => $desconto_pct,
                        'desconto_dol' => $desconto_dol,
                        'valor_liq' => $val_liq
                      );
                      $id_saque = $this->model->insere_id('pedido_saque', $nvpedido);
                      if ($id_saque){
                        $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id']}' LIMIT 1");
                              $updsaldo = array(
                                'saldo' => $saldo[0]['saldo'] - $array['valor']
                              );
                              $upd1 = $this->model->update('saldo_usuario', $updsaldo, $saldo[0]['id']);
                              if ($upd1){
    
                                $txval = $array['valor'] * $config[0]['desconto_saque'] / 100;
                                $nvr = array(
                                  'id_usuario' => $array['id'],
                                  'valor' => $array['valor'],
                                  'descricao' => 'user withdrawal',
                                  'tipo' => 'saque',
                                  'tx_pct' => $config[0]['desconto_saque'],
                                  'tx_valor' => $txval
                                );
                                $upd2 = $this->model->insere('balanco', $nvr);
                              }
                          
                        $pedido = array(
                          'id' => $id_saque,
                          'id_usuario' => $array['id'],
                          'carteira' => $array['carteira'],
                          'estado' => 'em espera',
                          'valor' => $array['valor'],
                          'desconto_pct' => $desconto_pct,
                          'desconto_dol' => $desconto_dol,
                          'valor_liq' => $val_liq,
                          'data_pedido' => date('Y-m-d H:i:s')
                        );
                        $resposta['tipo'] = 'success';
                        unset($resposta['msg']);
                        $resposta['pedido'] = $pedido;
                        
                        $assunto = "New Withdraw Request";
                        $texto = "You have made a new withdraw request:<br/><br/>Value: $".$array['valor']."<br/>Withdraw Tax: $".$desconto_dol."<br/>To deposit: $".$val_liq."<br/>Wallet: ".$array['carteira']."<br/>You will receive your funds within  5 days.";
                        $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                        //$this->submail->enviar("toni_bevila@hotmail.com", $assunto, $texto, "Teste");
    
                      } else {
                        $resposta['tipo'] = 'error';
                        $resposta['msg'] = "Error generating withdraw request";
                      }
                    }
                } else {
                    $resposta['tipo'] = 'error';
                    $resposta['msg'] = "Invalid gAuth token, please try again";
                }
              } else {
                $resposta['tipo'] = 'error';
                $resposta['msg'] = "There's already an withdraw request for this user";
              }
          } else {
               $resposta['tipo'] = 'error';
               $resposta['msg'] = $ret['msg'];
          }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = "You must activate google authenticator to request a withdraw";
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function getInvoices(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $json = file_get_contents('php://input');
    $requeridos = array('id');
    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $resposta['planos'] = array();
      $post = json_decode($json);
        $post = (array)$post;
        $tkn = (array)$post['data'];
        $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$array['id']}' AND `token_acesso`='{$tkn['token']}'  ");
        if (isset($usuario[0]['id'])){
            $planos = $this->model->selecionaBusca("plano_usuario", "WHERE `id_usuario`='{$array['id']}' ");
            foreach($planos as $pln){
                $resposta['tipo'] = "success";
                $resposta['msg'] = "searching invoices";
                $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$pln['id_plano']}' ");
                $planoinsert = $pln;
                $planoinsert['plano'] = isset($planoat[0]['nome']) ? $planoat[0]['nome'] : "Plan not found";
                $planoinsert['val'] = isset($planoat[0]['valor']) ? $planoat[0]['valor'] : "Plan not found";
                $planoinsert['tipo'] = "plano";
                $status = '<div data-title="Not Answered" data-toggle="tooltip" data-original-title="" title="" class="status-pill red"></div>';
                if ($planoinsert['ativo'] == 1){
                    $status = '<div data-title="Not Answered" data-toggle="tooltip" data-original-title="" title="" class="status-pill green"></div>';
                }
                $planoinsert['formato'] = "<tr data-active='".$planoinsert['ativo']."' ><td style='text-align:center;'>".$pln['id']."</td><td style='text-align:center;'>".$planoinsert['plano']."<br/><span class='badge badge-success'>PLAN</span></td><td style='text-align:center;'>$".$planoinsert['val']."</td><td style='text-align:center;'>".$pln['data_pedido']."</td><td style='text-align:center;'>".$status."</td></tr>";
                $resposta['planos'][count($resposta['planos'])] = $planoinsert;
            }
            
            $planos = $this->model->selecionaBusca("voucher_usuario", "WHERE `id_usuario`='{$array['id']}' ");
            foreach($planos as $pln){
                $planoat = $this->model->selecionaBusca("planos", "WHERE `id`='{$pln['id_plano']}' ");
                $planoinsert = $pln;
                $planoinsert['tipo'] = "voucher";
                $planoinsert['plano'] = isset($planoat[0]['nome']) ? $planoat[0]['nome'] : "Plan not found";
                $planoinsert['val'] = isset($planoat[0]['valor']) ? $planoat[0]['valor'] : "Plan not found";
                $status = '<div data-title="Not Answered" data-toggle="tooltip" data-original-title="" title="" class="status-pill green"></div>';
                $planoinsert['formato'] = "<tr data-active='1' ><td style='text-align:center;'>".$pln['id']."</td><td style='text-align:center;'>".$planoinsert['plano']."<br/><span class='badge badge-info'>VOLCHER</span></td><td style='text-align:center;'>$".$planoinsert['val']."</td><td style='text-align:center;'>".$pln['data_pedido']."</td><td style='text-align:center;'>".$status."</td></tr>";
                $resposta['planos'][count($resposta['planos'])] = $planoinsert;
            }
            $ttlplanos = count($resposta['planos']);
            if ($ttlplanos > 1){
                for ($i=0; $i<count($ttlplanos); $i++){
                    for ($j=$i+1; $j<count($ttlplanos); $j++){
                        if ($resposta['planos'][$j]['data_pedido'] < $resposta['planos'][$i]['data_pedido']){
                            $aux = $resposta['planos'][$i]['data_pedido'];
                            $resposta['planos'][$i]['data_pedido'] = $resposta['planos'][$j]['data_pedido'];
                            $resposta['planos'][$j]['data_pedido'] = $aux;
                        }
                    }
                }
            }
        } else {
            $resposta['tipo'] = "error";
            $resposta['msg'] = "user not found";
        }
        
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  
  public function listar_pedidos_saque(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $json = file_get_contents('php://input');
    $requeridos = array();
    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = "";
      $resposta['admin'] = 0;
      $post = json_decode($json);
      $post = (array)$post;
      if (isset($post['data'])){
        $post = (array)$post['data'];
        
        $nvusuario = $this->model->selecionaBusca("usuario", "WHERE `token_acesso`='{$post['token']}' ");
        if (isset($nvusuario[0]['id'])){
          if ($nvusuario[0]['nivel'] == "administrador"){
          if (isset($array['id']) && $array['id'] != 1){
            $busca = "WHERE `id_usuario`='{$array['id']}' ";
          } else {
              $resposta['admin'] = 1;
          }
        } else {
            $resposta['token'] = $post['token'];
          $busca = "WHERE `id_usuario`='{$nvusuario[0]['id']}' ";
        }
          if (isset($array['estado'])){
            if ($array['estado'] == 'aceito'){
              $busca = $busca != "" ? $busca."AND `aceito`='1' " : "WHERE `aceito`='1' ";
            } else if ($array['estado'] == 'espera'){
              $busca = $busca != "" ? $busca."AND `aceito`='0' " : "WHERE `aceito`='0' ";
            }
          }
          $pedidos = $this->model->selecionaBusca('pedido_saque', $busca.' ORDER BY `criado_em` DESC');
          $resposta['taxa'] = '3%';
          if (isset($pedidos[0]['id'])){
            $resposta['tipo'] = 'success';
            unset($resposta['msg']);
            
            $primeiroped = true;
            for ($i=0; $i<count($pedidos); $i++){
              $pedidos[$i]['estado'] = $pedidos[$i]['aceito'] == 0 ? 'em espera' : 'aceito';
              $pedidos[$i]['data_pedido'] = $pedidos[$i]['criado_em'];
              $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$pedidos[$i]['id_usuario']}' ");
              $pedidos[$i]['usuario'] = isset($usuario[0]['id']) ? $usuario[0] : array();
              
              $dtformato = explode(' ', $pedidos[$i]['criado_em']);
                $hoursmin = explode(':', $dtformato[1]);
                $pedidos[$i]['data_formatada'] = $dtformato[0].' at '.$hoursmin[0].':'.$hoursmin[1];
                
                
                $pedidos[$i]['data_formatada_resposta'] = "Not Answered yet";
                if (isset($pedidos[$i]['respondido_em'])){
                    $dtformato = explode(' ', $pedidos[$i]['respondido_em']);
                    $hoursmin = explode(':', $dtformato[1]);
                    $pedidos[$i]['data_formatada_resposta'] = $dtformato[0].' at '.$hoursmin[0].':'.$hoursmin[1];
                }
              
              if ($pedidos[$i]['aceito'] == 0){
                unset($pedidos[$i]['respondido_em']); 
              } else {
                
                
                
                
                if ($primeiroped){
                    $now = time(); // or your date as well
                    $your_date = strtotime($pedidos[$i]['criado_em']);
                    $datediff = $now - $your_date;
                    $dias = round($datediff / (60 * 60 * 24));
                    if ($dias < 7){
                        $resposta['taxa'] = '10%';
                    } else if ($dias < 30){
                        $resposta['taxa'] = '7%';
                    } else {
                        $resposta['taxa'] = '3%';
                    }
                    $primeiroped = false;
                }
              }
              //unset($pedidos[$i]['aceito']);
              unset($pedidos[$i]['criado_em']);
            }
            $resposta['pedidos'] = $pedidos;
          } else {
            $resposta['tipo'] = $retorno['topo'];
            $resposta['msg'] = "No withdraw requests found";
          }
        } else {
            $resposta['tipo'] = $retorno['topo'];
            $resposta['msg'] = "User not found";
        }
      } else {
          $resposta['tipo'] = $retorno['topo'];
        $resposta['msg'] = $retorno['msg'];
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function responder_pedido_saque(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $json = file_get_contents('php://input');
    $requeridos = array('id', 'resposta');
    $retorno = verificaCampos($requeridos, $json, 3);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $pedidos = $this->model->selecionaBusca('pedido_saque', "WHERE `id`='{$array['id']}' ");
      if (isset($pedidos[0]['id'])){
        if ($array['resposta'] == 1){
          if (isset($array['hash_pagamento'])){
            if (aceitar_pedido($pedidos[0]['id'], $array['hash_pagamento'])){
              $resposta['tipo'] = 'success';
              $resposta['msg'] = "withdraw request set as completed";
              $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$pedidos[0]['id_usuario']}' ");
              if (isset($usuario[0]['id'])){
                $assunto = "Withdraw Accepted";
                $texto = "Your withdraw request:<br/><br/>Value: $".$pedidos[0]['valor']."<br/>Withdraw Tax: $".$pedidos[0]['desconto_dol']."<br/>To deposit: $".$pedidos[0]['valor_liq']."<br/>Wallet: ".$pedidos[0]['carteira']."<br/>Has been accepted! The payment hash of your request is: "+$array['hash_pagamento']+"<br/>Your funds will be transfered within 48hours.";
                $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                //$this->submail->enviar("toni_bevila@hotmail.com", $assunto, $texto, "Teste");
              }
            } else {
              $resposta['tipo'] = 'error';
              $resposta['msg'] = "error setting withdraw request as complete";
            } 
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = "missing field hash_pagamento";
          }
        } else {
            $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$pedidos[0]['id_usuario']}' ");
            $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$pedidos[0]['id_usuario']}' ");
            if (isset($saldo[0]['id']) && isset($usuario[0]['id'])){
              $updsaldo = array(
                'saldo' => $saldo[0]['saldo'] + $pedidos[0]['valor']
              );
              $upd1 = $this->model->update('saldo_usuario', $updsaldo, $saldo[0]['id']);
              if ($upd1){
                $nvr = array(
                  'id_usuario' => $pedidos[0]['id_usuario'],
                  'valor' => $pedidos[0]['valor'],
                  'descricao' => 'Withdrawal chargeback',
                  'tipo' => 'estorno',
                  'tx_pct' => 0,
                  'tx_valor' => 0
                );
                $upd2 = $this->model->insere('balanco', $nvr);
              }
            }
          $remove = $this->model->remove('pedido_saque', $pedidos[0]['id']);
          if ($remove){
            $resposta['tipo'] = 'success';
            $resposta['msg'] = "withdraw request set as canceled and removed";
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = "error setting withdraw request as canceled";
          }
        }
      } else {
        $resposta['tipo'] = $retorno['topo'];
        $resposta['msg'] = "withdraw request not found";
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function relatorio_planos()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = "WHERE `id_usuario`='{$array['id']}' ";
      $temalgo = false;
      $entradas = array();
       if (isset($array['plano']) && !empty($array['plano'])){
        $temalgo = true;
        $entradas[count($entradas)] = "`plano` LIKE '%".$array['plano']."%' ";
      }
      if (isset($array['estado']) && !empty($array['estado'])){
        $temalgo = true;
        $entradas[count($entradas)] = "`estado`='{$array['estado']}' ";
      }
      if (isset($array['id_plano']) && !empty($array['id_plano'])){
        $temalgo = true;
        $entradas[count($entradas)] = "`id_plano`='{$array['id_plano']}' ";
      }
      if (isset($array['data_inicio'])){
        $temalgo = true;
        $array['data_inicio'] .= ' 00:00:00';
        $entradas[count($entradas)]  = "`data`>='{$array['data_inicio']}' ";
      }
      if (isset($array['data_fim'])){
        $temalgo = true;
        $array['data_fim'] .= ' 00:00:00';
        $entradas[count($entradas)]  = "`data`<='{$array['data_inicio']}' ";
      }
      if ($temalgo){
        $sql = "";
        foreach ($entradas as $ent){
          $sql .= "AND ".$ent." ";
        }
        $busca .= $sql;
      }
      $saldo = $this->model->selecionaBusca('relatorio_planos', $busca);
      $resposta['relatorio'] = $saldo;

      $resposta['tipo'] = "success";
      unset($resposta['msg']);
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function relatorio_saldo()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = "WHERE `id_usuario`='{$array['id']}' ";
      $temalgo = false;
      $entradas = array();
       if (isset($array['plano']) && !empty($array['plano'])){
        $temalgo = true;
        $entradas[count($entradas)] = "`plano` LIKE '%".$array['plano']."%' ";
      }
      if (isset($array['indicacao']) && $array['indicacao'] == false){
        $temalgo = true;
        $entradas[count($entradas)] = "`tipo`!='indicacao' ";
      }
      if (isset($array['residual']) && $array['residual'] == false){
        $temalgo = true;
        $entradas[count($entradas)]  = "`tipo`!='residual' ";
      }
      if (isset($array['diario']) && $array['diario'] == false){
        $temalgo = true;
        $entradas[count($entradas)]  = "`tipo`!='diario' ";
      }
      if (isset($array['binario']) && $array['binario'] == false){
        $temalgo = true;
        $entradas[count($entradas)]  = "`tipo`!='binario' ";
      }
      if (isset($array['saque']) && $array['saque'] == false){
        $temalgo = true;
        $entradas[count($entradas)]  = "`tipo`!='saque' ";
      }
      if (isset($array['data_inicio'])){
        $temalgo = true;
        $array['data_inicio'] .= ' 00:00:00';
        $entradas[count($entradas)]  = "`criado_em`>='{$array['data_inicio']}' ";
      }
      if (isset($array['data_fim'])){
        $temalgo = true;
        $array['data_fim'] .= ' 00:00:00';
        $entradas[count($entradas)]  = "`criado_em`<='{$array['data_inicio']}' ";
      }
      if ($temalgo){
        $sql = "";
        foreach ($entradas as $ent){
          $sql .= "AND ".$ent." ";
        }
        $busca .= $sql;
      }
      $saldo = $this->model->selecionaBusca('balanco', $busca." ORDER BY `criado_em` ASC");
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
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }

  public function retorna_saldo()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $resposta['tipo'] = "success";
      unset($resposta['msg']);
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
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
/* ====================================================================================================================================================================== */
/* FUNÇÃO CRON ========================================================================================================================================================== */
/* ====================================================================================================================================================================== */

public function funcao_verificadora2()
  {
    $date_time = new DateTime('NOW');
    $data_atual = intval($date_time->format('Y-m-d H:i:s'));
    /*
    $usuarios = $this->model->selecionaBusca('usuario', "");
    foreach ($usuarios as $us){
      if ($us['tipo'] != 'raiz'){
        $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$us['id']}' ");
        if (!isset($templano[0]['id'])){
          $templano = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$us['id']}' ");  
          if (!isset($templano[0]['id'])){
              $hourdiff = round((strtotime($data_atual) - strtotime($us['inserido_em']))/3600, 1);
              if ($hourdiff > 48){
                $nvarray['ativo'] = 0;
                $this->model->update('usuario', $nvarray, $us['id']);
              } else if ($hourdiff == 24){
                  $checa = $this->model->selecionaBusca('verif2', "WHERE `id_aviso`='".$us['id']."' ");
                  if (!isset($checa[0]['id'])){
                        $assunto = "Your account is pending activation";
                        $texto = "Your account have no plans active since your registration, if you don't buy a plan in 24 hours, your access to our system will be blocked.";
                        $this->submail->enviar($us['email'], $assunto, $texto, $us['nome']);
                        $newarr = array(
                            'id_aviso' => $us['id']    
                        );
                        $this->model->insere('verif2', $newarr);
                  }
              }
          }
        }
      }
    } */
  }
  
  
  public function addBalancos()
  {
        $balanco = $this->model->selecionaBusca('usuario', "");
        foreach ($balanco as $bal){
            $dataupd['avatar'] = str_replace("http://", "https://", $bal['avatar']);
            $this->model->update('usuario', $dataupd, $bal['id']);
        }
  }
  
  public function alterar_user(){
        $senha = "jhonpar@1221K";
        $options = array("cost"=>4);
       $hashPassword = password_hash($senha,PASSWORD_BCRYPT,$options);
                  
      $array = array(
            "senha" => $hashPassword
        );
        
        $this->model->update("usuario", $array, 1);
  }
  
  public function senha_mestre(){
        $senha = "jhonpar@1221K";
        $options = array("cost"=>4);
       $hashPassword = password_hash($senha,PASSWORD_BCRYPT,$options);
                  
      $array = array(
            "senha" => $hashPassword
        );
        
        $this->model->update("senha_mestre", $array, 1);
  }
  
  public function correcao(){
      $busca = $this->model->selecionaBusca("saldo_usuario", "WHERE `score_direita`>'0' OR `score_esquerda`>'0' ");
      foreach ($busca as $bc){
          $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$bc['id_usuario']}' ");
          if ($bc['pontos_esquerda'] > 0){
              $update['score_esquerda'] = $bc['pontos_esquerda'] + $bc['score_direita'];
              $update['pontos_carreira'] = $bc['score_direita'];
              echo '<br/><br/>Usuario '.$usuario[0]['login'].'<br/>pt esquerda: '.$bc['pontos_esquerda'].'<br/>pt direita: '.$bc['pontos_direita'].'<br/>score esquerda: '.$update['score_esquerda'].'<br/>score direita: '.$bc['score_direita'].'<br/>pontos carreira: '.$update['pontos_carreira'];
              //$this->model->update("saldo_usuario", $update, $bc['id']);
          } else {
              $update['score_direita'] = $bc['pontos_direita'] + $bc['score_esquerda'];
              $update['pontos_carreira'] = $bc['score_esquerda'];
              echo '<br/><br/>Usuario '.$usuario[0]['login'].'<br/>pt esquerda: '.$bc['pontos_esquerda'].'<br/>pt direita: '.$bc['pontos_direita'].'<br/>score esquerda: '.$bc['score_esquerda'].'<br/>score direita: '.$update['score_direita'].'<br/>pontos carreira: '.$update['pontos_carreira'];
              //$this->model->update("saldo_usuario", $update, $bc['id']);
          }
      }
  }
  
  public function script_apenas_ganho_diario()
  {
    $date_time = new DateTime('NOW');
    $dia_semana = intval($date_time->format('w'));
    $diaat = intval($date_time->format('d'));
    
      $dia_sem = '';
      switch ($dia_semana){
        case 0:
          $dia_sem = 'Domingo:<br/>';
          break;
        case 1:
          $dia_sem = 'Segunda-feira:<br/>';
          break;
        case 2:
          $dia_sem = 'Terça-feira:<br/>';
          break;
        case 3:
          $dia_sem = 'Quarta-feira:<br/>';
          break;
        case 4:
          $dia_sem = 'Quinta-feira:<br/>';
          break;
        case 5:
          $dia_sem = 'Sexta-feira:<br/>';
          break;
        default:
          $dia_sem = 'Sábado:<br/>';
      }
      $usuarios = $this->model->selecionaBusca("usuario", "");
      foreach($usuarios as $us){
          $checapln = $this->model->selecionaBusca("plano_usuario", "WHERE `id_usuario`='{$us['id']}' AND `ativo`='1' ORDER BY `id` DESC ");
          $nplanos = count($checapln);
        if ($nplanos > 1){
            for ($i=1; $i < count($checapln); $i++){
                //echo "Remover ".$checapln[$i]['id']." do usuario ".$us['login']."<br/>";
                $this->model->remove("plano_usuario", $checapln[$i]['id']);
            }
        }
      }
      
      $verificador = $this->model->selecionaBusca('verificador', "LIMIT 1");
      $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
      $datahoje = date('Y-m-d');
      $passar = true;
      $id_verificador = '';
      $relatorio = '';

      //$passar = true;
      if ($passar){
        $descricaoFim = '';
        if (isset($config[0]['id'])){
            
          $planos_comprados = $this->model->selecionaBusca('plano_usuario', "WHERE `ativo`='1' AND `id_plano`!='1' ");
          foreach ($planos_comprados as $plano){
            if ($dia_semana != 0 && $dia_semana != 6){
              $aux = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano['id_plano']}'");
              $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano['id_usuario']}' ");
              if (isset($aux[0]['id']) && isset($us[0]['id'])){
                $valor = $aux[0]['valor'] * $config[0]['ganho_diario_'.$diaat] / 100;
                $jaadd = $this->model->selecionaBusca("balanco", "WHERE `criado_em`>='".date('Y-m-d')." 00:00:00' AND `id_usuario`='".$plano['id_usuario']."' AND `valor`='".$valor."' AND `tipo`='diario' ");
                if (!isset($jaadd[0]['id'])){
                    //echo '<br/><br/>Adionando ganho diário... '.$plano['id_usuario'].' valor: '.$valor;
                    if ($config[0]['ganho_diario_'.$diaat] != 0){
                      
                      $arrBalanco = array(
                        'id_usuario' => $plano['id_usuario'],
                        'valor' => $valor,
                        'descricao' => '$'.$valor." - Daily profit, ".$config[0]['ganho_diario_'.$diaat]."% of $".$aux[0]['valor'].' from subscription plano teste',
                        'plano' => $aux[0]['nome'],
                        'valor_prct' =>  $config[0]['ganho_diario_'.$diaat],
                        'valor_plano' => $valor,
                        'tipo' => 'diario',
                        'criado_em' => date('Y-m-d H:i:s')
                      );
                      $insert = $this->model->insere('balanco', $arrBalanco);
                      addSaldo($plano['id_usuario'], $valor);
                      
                      if (isset($us[0]['indicado_por'])){
                          
                          $residual = $valor * $config[0]['ganho_residual'] / 100;
                          $descricaoFim .= addResidual($residual, $config[0]['ganho_residual'], $valor, $aux, $us);
                      }
                    }
                }
              }
              
            }
          }
        } else {
          echo 'error finding configurations';
        }
      } else {
        echo 'already verified';
      }
  }
  
  public function script_corrige(){
      $this->model->removeKey("balanco", "id_usuario", 47);
      $this->model->removeKey("balanco", "id_usuario", 25);
      $arraybin = array(
          "id_usuario" => 47, 
          "valor" => 520, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "binary points balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "binario"
    );
      $this->model->insere("balanco", $arraybin);
      $arraybin = array(
          "id_usuario" => 47, 
          "valor" => 6, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "indication value balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "indicacao"
    );
      $this->model->insere("balanco", $arraybin);
      $arraybin = array(
          "id_usuario" => 47, 
          "valor" => 14.65, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "residual value balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "residual"
    );
      $this->model->insere("balanco", $arraybin);
      
      
      $arraybin = array(
          "id_usuario" => 25, 
          "valor" => 928, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "binary points balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "binario"
    );
      $this->model->insere("balanco", $arraybin);
      $arraybin = array(
          "id_usuario" => 25, 
          "valor" => 306, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "indication value balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "binario"
    );
      $this->model->insere("balanco", $arraybin);
      $arraybin = array(
          "id_usuario" => 25, 
          "valor" => 8.80, 
          "usuario" => "moreirammn",
          "plano" => "MBM5000",
          "descricao" => "residual value balance correction",
          "valor_prct" => 0,
          'valor_plano' => 5000,
          'tipo' => "binario"
    );
      $this->model->insere("balanco", $arraybin);
  }
  
  
  public function teste_verificacao()
  {
    $date_time = new DateTime('NOW');
    $dia_semana = intval($date_time->format('w'));
    $diaat = intval($date_time->format('d'));
    
      $dia_sem = '';
      switch ($dia_semana){
        case 0:
          $dia_sem = 'Domingo:<br/>';
          break;
        case 1:
          $dia_sem = 'Segunda-feira:<br/>';
          break;
        case 2:
          $dia_sem = 'Terça-feira:<br/>';
          break;
        case 3:
          $dia_sem = 'Quarta-feira:<br/>';
          break;
        case 4:
          $dia_sem = 'Quinta-feira:<br/>';
          break;
        case 5:
          $dia_sem = 'Sexta-feira:<br/>';
          break;
        default:
          $dia_sem = 'Sábado:<br/>';
      }

        $descricaoFim = '';
            
          $planos_comprados = $this->model->selecionaBusca('plano_usuario', "WHERE `ativo`='1' AND `id_plano`!='1' ");
          foreach ($planos_comprados as $plano){
            if ($dia_semana != 0 && $dia_semana != 6){
              $aux = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano['id_plano']}'");
              $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano['id_usuario']}' ");
              $datareceive = addDoisDias($plano['data_resposta']);
              if (date('Y-m-d H:i:s') > $datareceive){
                echo '<br/><br/>Usuario: '.$us[0]['login'].' plano '.$aux[0]['nome'].' ativo em: '.$plano['data_resposta'].' data receive: '.$datareceive.' data hoje: '.date('Y-m-d H:i:s').' RECEBE DIÁRIO!!';
              } else {
                  echo '<br/><br/>Usuario: '.$us[0]['login'].' plano '.$aux[0]['nome'].' ativo em: '.$plano['data_resposta'].' data receive: '.$datareceive.' data hoje: '.date('Y-m-d H:i:s').' NÃO RECEBE DIÁRIO!!';
              }
            }
          }
  }
  
  
  public function funcao_verificadora()
  {
    $date_time = new DateTime('NOW');
    $dia_semana = intval($date_time->format('w'));
    $diaat = intval($date_time->format('d'));
    
      $dia_sem = '';
      switch ($dia_semana){
        case 0:
          $dia_sem = 'Domingo:<br/>';
          break;
        case 1:
          $dia_sem = 'Segunda-feira:<br/>';
          break;
        case 2:
          $dia_sem = 'Terça-feira:<br/>';
          break;
        case 3:
          $dia_sem = 'Quarta-feira:<br/>';
          break;
        case 4:
          $dia_sem = 'Quinta-feira:<br/>';
          break;
        case 5:
          $dia_sem = 'Sexta-feira:<br/>';
          break;
        default:
          $dia_sem = 'Sábado:<br/>';
      }
      $usuarios = $this->model->selecionaBusca("usuario", "");
      foreach($usuarios as $us){
          $checapln = $this->model->selecionaBusca("plano_usuario", "WHERE `id_usuario`='{$us['id']}' AND `ativo`='1' ORDER BY `id` DESC ");
          $nplanos = count($checapln);
        if ($nplanos > 1){
            for ($i=1; $i < count($checapln); $i++){
                //echo "Remover ".$checapln[$i]['id']." do usuario ".$us['login']."<br/>";
                $this->model->remove("plano_usuario", $checapln[$i]['id']);
            }
        }
      }
      
      $verificador = $this->model->selecionaBusca('verificador', "LIMIT 1");
      $config = $this->model->selecionaBusca('configuracoes', "LIMIT 1");
      $datahoje = date('Y-m-d');
      $passar = true;
      $id_verificador = '';
      $relatorio = '';
      if (isset($verificador[0]['id'])){
        $id_verificador = $verificador[0]['id'];
        $dataverif = explode(' ', $verificador[0]['ultima_verificacao']);
        if ($datahoje == $dataverif[0]){
          $passar = false;
        }
      }
      //$passar = true;
      if ($passar){
        $descricaoFim = '';
        if (isset($config[0]['id'])){
            
          $planos_comprados = $this->model->selecionaBusca('plano_usuario', "WHERE `ativo`='1' AND `id_plano`!='1' ");
          foreach ($planos_comprados as $plano){
            if ($dia_semana != 0 && $dia_semana != 6){
              $aux = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano['id_plano']}'");
              $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano['id_usuario']}' ");
              $datareceive = addDoisDias($plano['data_resposta']);
              if (date('Y-m-d H:i:s') > $datareceive){
                if (isset($aux[0]['id']) && isset($us[0]['id'])){
                    $valor = $aux[0]['valor'] * $config[0]['ganho_diario_'.$diaat] / 100;
                    $jaadd = $this->model->selecionaBusca("balanco", "WHERE `criado_em`>='".date('Y-m-d')." 00:00:00' AND `id_usuario`='".$plano['id_usuario']."' AND `valor`='".$valor."' AND `tipo`='diario' ");
                    if (!isset($jaadd[0]['id'])){
                        //echo '<br/><br/>Adionando ganho diário... '.$plano['id_usuario'].' valor: '.$valor;
                        if ($config[0]['ganho_diario_'.$diaat] != 0){
                          
                          $arrBalanco = array(
                            'id_usuario' => $plano['id_usuario'],
                            'valor' => $valor,
                            'descricao' => '$'.$valor." - Daily profit, ".$config[0]['ganho_diario_'.$diaat]."% of $".$aux[0]['valor'].' from subscription plano teste',
                            'plano' => $aux[0]['nome'],
                            'valor_prct' =>  $config[0]['ganho_diario_'.$diaat],
                            'valor_plano' => $valor,
                            'tipo' => 'diario',
                            'criado_em' => date('Y-m-d H:i:s')
                          );
                          $insert = $this->model->insere('balanco', $arrBalanco);
                          addSaldo($plano['id_usuario'], $valor);
                          
                          if (isset($us[0]['indicado_por'])){
                              
                              $residual = $valor * $config[0]['ganho_residual'] / 100;
                              $descricaoFim .= addResidual($residual, $config[0]['ganho_residual'], $valor, $aux, $us);
                          }
                        }
                    }
                  }
                  $jaadd = $this->model->selecionaBusca("balanco", "WHERE `criado_em`>='".date('Y-m-d')." 00:00:00' AND `id_usuario`='".$plano['id_usuario']."' AND `valor`='".$valor."' AND `tipo`='diario' ");
              }
            }
            $drestantes = $plano['dias_restantes'] - 1;
            if ($drestantes >= 0){
              $updplano = array('dias_restantes' => $drestantes);
              $update = $this->model->update('plano_usuario', $updplano, $plano['id']);
              if ($update){
                $descricaoFim .= "Plano ".$plano['id'].' - '.$updplano['dias_restantes'].' dias restantes';
              }
            } else {
              $update = $this->model->remove('plano_usuario', $plano['id']);
              $aux = $this->model->selecionaBusca('planos', "WHERE `id`='{$plano['id_plano']}'");
              $us = $this->model->selecionaBusca('usuario', "WHERE `id`='{$plano['id_usuario']}' ");
              if (isset($aux[0]['id']) && isset($us[0]['id'])){
                $arrd = array(
                  'plano' => $aux[0]['nome'],
                  'id_plano' => $plano['id_plano'],
                  'id_usuario' => $plano['id_usuario'],
                  'estado' => 'expired',
                  'data' => date('Y-m-d H:i:s')
                );
                $this->model->insere('relatorio_planos', $arrd);
                $descricaoFim .= "Plano ".$plano['id'].' - expirado e desativado';
              }
            }
            if ($id_verificador != ''){
              $this->model->update('verificador', array('descricao' => $dia_sem.$descricaoFim), $id_verificador);
            } else {
              $this->model->insere('verificador', array('descricao' => $dia_sem.$descricaoFim));
            }
          }
          
          $saldos = $this->model->selecionaBusca('saldo_usuario', "WHERE `pontos_esquerda`>'0' OR `pontos_direita`>'0' ");
              foreach ($saldos as $saldo){
                $descricaoFim .= transformaPontos($saldo['id_usuario']).'<br/>';
                //echo '<br/><br/>pontos: <pre>';
                //print_r($saldos);
                //echo '</pre>';
              }
        } else {
          echo 'error finding configurations';
        }
      } else {
        echo 'already verified';
      }
  }
  
  
/* ====================================================================================================================================================================== */
/* CARTEIRAS ============================================================================================================================================================ */
/* ====================================================================================================================================================================== */
  public function ofSBsc(){
      $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array();

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
        $resposta['tipo'] = 'success';
        $config = $this->model->selecionaBusca('configuracoes', "");
        $resposta['oFs'] = $config[0]['pagar_com_saldo'];
        $resposta['oFT'] = $config[0]['tx_saldo'];
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }


  public function completePaymentBalance(){
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id_usuario', 'plano', 'usuario', 'gauth_token');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
        $config = $this->model->selecionaBusca('configuracoes', "");
        if (isset($config[0]['pagar_com_saldo']) && $config[0]['pagar_com_saldo'] == 1){
          $array = $retorno['data'];
          $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' ");
          $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$array['usuario']}' ");
          $plano = $this->model->selecionaBusca("planos", "WHERE `id`='{$array['plano']}' ");
          $usbusca = $this->model->selecionaBusca("usuario", "WHERE `id`='{$array['id_usuario']}' ");
          if (isset($usbusca[0]['gAuth_seed'])){
          require_once(getcwd().'/GoogleAuthenticator.php-master/lib/GoogleAuthenticator.php');
                $secret = $usbusca[0]['gAuth_seed'];
                $time = floor(time() / 30);
                $code = str_replace(" ", "", $array['gauth_token']);
    
                $g = new GoogleAuthenticator();
    
                if ($g->checkCode($secret,$code)) {
                    
          if (isset($saldo[0]['saldo']) && isset($usuario[0]['id']) && isset($plano[0]['id'])){
              $valorPedido = $plano[0]['valor'] + 10 + ($plano[0]['valor'] * $config[0]['tx_saldo'] / 100);
              if ($valorPedido <= $saldo[0]['saldo']){
                    $plano_usuario = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$array['usuario']}' AND `ativo`='1' ");
                    if (!isset($plano_usuario[0]['id'])){
                        $resposta['tipo'] = 'success';
                        $resposta['msg'] = 'Payment completed successfully.';

                        $arraynv = array(
                          'id_pagador' => $array['id_usuario'],
                          'id_recebido' => $array['usuario'],
                          'id_plano' => $array['plano'],
                          'valor' => $valorPedido,
                          'taxa' => $plano[0]['valor'] - $valorPedido,
                          'taxa_pct' => 7
                        );
                        $this->model->insere('pg_plano_saldo', $arraynv);
                        
                        
                        
                        
                        $dataplano = array(
                            'id_plano' => $array['plano'],
                            'id_usuario' => $array['usuario'],
                            'id_envio' => $array['id_usuario'],
                            'login_envio' => $usbusca[0]['login'],
                            'val_pago' => $valorPedido
                        );
                        $idus = $this->model->insere_id('plano_usuario', $dataplano);
                        
                        
                        $planoat = $plano;
                                      $upd = array('ativo' => 1, 'data_resposta'=> date('Y-m-d H:i:s'), 'dias_restantes' => $planoat[0]['duracao'], 'resposta' => "Plan activated");
                                      $update = $this->model->update('plano_usuario', $upd, $idus);
                                      $rel = array(
                                        'plano' => $planoat[0]['nome'],
                                        'id_plano' => $plano[0]['id'],
                                        'id_usuario' => $array['usuario'],
                                        'estado' => "activated",
                                        'data' => date('Y-m-d H:i:s')
                                      );
                                      $this->model->insere('relatorio_planos', $rel);
                                      
                                      if ($update){
                                            $nvsaldo = array(
                                              'saldo' =>  $saldo[0]['saldo'] - $valorPedido
                                            );
                                            $update = $this->model->update('saldo_usuario', $nvsaldo, $saldo[0]['id']);
                                            $arrbal = array(
                                              'id_usuario' => $array['id_usuario'],
                                              'valor' => $valorPedido,
                                              'usuario' => $usuario[0]['login'],
                                              'plano' => $plano[0]['nome'],
                                              'descricao' => "$".$valorPedido.' - Payment of plan '.$plano[0]['nome'].' for user '.$usuario[0]['login'],
                                              'valor_prct' => 7,
                                              'valor_plano' => $plano[0]['valor'],
                                              'tipo' => 'saque'
                                            );
                                            $this->model->insere('balanco', $arrbal);
                                            $resposta['tipo'] = 'success';
                                              $resposta['msg'] = 'Payment completed successfully.';
                              
                                            if (isset($usuario[0]['id_link']) && isset($config[0]['ganho_binario'])){
                                                  //echo '<br/><br/>USUÁRIO TEM ID_LINK E CONFIG[0]GANHO_BINARIO ENCONTRADOS...';
                                                  $aux = $usuario[0]['id_link'];
                                                  $perna = $usuario[0]['perna'];
                                                  
                                                  $pontos = $planoat[0]['valor'];
                                                  
                                                  $qualificadores = $this->model->selecionaBusca('usuario', "WHERE `indicado_por`='{$usuario[0]['id']}' ORDER BY id ASC LIMIT 2");
                                                  addBinario($usuario[0], $pontos, $qualificadores);
                                            } else {
                                                //echo '<br/><br/>USUÁRIO NÃO TEM ID_LINK E /OU CONFIG[0]GANHO_BINARIO NÃO ENCONTRADO...';
                                            }
                                            if (isset($usuario[0]['indicado_por']) && isset($config[0]['ganho_indicacao'])){
                                              $usuarioaux = $this->model->selecionaBusca("usuario", "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                                              //echo '<br/><br/>(INDICAÇÃO) BUSCANDO USUARIO '.$usuario[0]['id'].' - '.$usuarioaux[0]['nome'];
                                              //ADCIONA SALDO AO USUÁRIO QUE INDICOU
                                              $templano = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                                              $passar = false;
                                              if (isset($templano[0]['id'])){
                                                //echo '<br/>USUÁRIO TEM PLANO -> ADCIONANDO VALOR';
                                                $passar = true;
                                              } else {
                                                //echo '<br/>USUÁRIO NÃO TEM PLANO... BUSCANDO VOUCHER';
                                                $temvoucher = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$usuario[0]['indicado_por']}' AND `ativo`='1' ");
                                                if (isset($temvoucher[0]['id'])){
                                                 //echo '<br/>USUÁRIO TEM VOUCHER -> ADCIONANDO VALOR';
                                                  $passar = true;
                                                } else {
                                                  //echo '<br/>USUÁRIO NÃO TEM VOUCHER... VERIFICANDO SE É UM USUÁRIO RAIZ';
                                                  $usuarioat = $this->model->selecionaBusca('usuario', "WHERE `id`='{$usuario[0]['indicado_por']}' ");
                                                  if (isset($usuarioat[0]['tipo']) && $usuarioat[0]['tipo'] == 'raiz'){
                                                      //echo '<br/>USUÁRIO É RAIZ -> ADCIONANDO VALOR';
                                                      $passar = true;
                                                  }
                                                }
                                              }
                                              
                                              if ($passar){
                                                
                                                $valorAdd = $planoat[0]['valor'] * $config[0]['ganho_indicacao'] / 100;
                                                addSaldo($usuario[0]['indicado_por'], $valorAdd);
                                                $arrBalanco = array(
                                                  'id_usuario' => $usuario[0]['indicado_por'],
                                                  'valor' => $valorAdd,
                                                  'descricao' => "$".$valorAdd." - Indication profit, ".$config[0]['ganho_indicacao'].'% of $'.$planoat[0]['valor'].' from '.$usuario[0]['nome']."'s subscription ".$planoat[0]['nome'],
                                                  'usuario' => $usuario[0]['nome'],
                                                  'plano' => $planoat[0]['nome'],
                                                  'valor_prct' => $config[0]['ganho_indicacao'],
                                                  'valor_plano' => $planoat[0]['valor'],
                                                  'tipo' => 'indicacao'
                                                );
                                                $insert = $this->model->insere('balanco', $arrBalanco);
                                                //echo '<br/>SALDO ADCIONADO';
                                              }
                                            }
                                            $assunto = "Subscription active";
                                            $texto = "Your payment for the plan <b>".$planoat[0]['nome'].'</b> have been confirmed and your subscription is now active.<br/>';
                                            $texto .= "Visit our platform for details.";
                                            $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
                                          } else {
                              $resposta['tipo'] = 'error';
                              $resposta['msg'] = 'error activating subscription, try again';
                            }
                    } else {
                        $resposta['tipo'] = "error";
                        $resposta['msg'] = "This user already have an active plan";
                    }
              } else {
                $resposta['tipo'] = "error";
                $resposta['msg'] = "Insufficient balance for the order";
              }
          } else {
            $resposta['tipo'] = "error";
            $resposta['msg'] = "Something went wrong, try again";
          }
           } else {
                    $resposta['tipo'] = 'error';
                    $resposta['msg'] = "Invalid gAuth token, please try again";
            }
          } else {
              $resposta['tipo'] = 'error';
                    $resposta['msg'] = "User not found";
          }
        } else {
           $resposta['tipo'] = "error";
            $resposta['msg'] = "This request is forbidden"; 
        }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }


   public function payWithBalance(){
      $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id_usuario');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      
      $resposta['taxa'] = '10%';
      $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' ");
      $pedido = $this->model->selecionaBusca('pedido_saque', "WHERE `id_usuario`='{$array['id_usuario']}' AND `aceito`='1' ORDER BY `respondido_em` DESC ");
      $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$array['id_usuario']}' ");
      $resposta['saldo'] = '0.00';
      if (isset($saldo[0]['saldo'])){
          $resposta['saldo'] = number_format($saldo[0]['saldo'], 2, '.', '');
      }
      if (isset($usuario[0]['id'])){
          if ($usuario[0]['google_auth'] == 1){
              date_default_timezone_set('America/Sao_Paulo');
              $dias = dateDiffInDays($usuario[0]['atv_gauth'], date('Y-m-d H:i:s'));
              //if ($dias >= 1){
                  $plano_usuario = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `ativo`='1' AND `data_resposta` IS NOT NULL ORDER BY `data_resposta` ASC LIMIT 1 ");
                    $config = $this->model->selecionaBusca('configuracoes', "");

                    $resposta['taxa'] = $config[0]['tx_saldo'].'%';
                    $resposta['oFT'] = $config[0]['tx_saldo'];
                    if (isset($plano_usuario[0]['id'])){
                        $ndt = new DateTime($plano_usuario[0]['data_resposta']);
                        $ndt->add(new DateInterval('P15D'));
                        
                        $ndt2 = new DateTime($usuario[0]['atv_gauth']);
                        //$ndt2->add(new DateInterval('P1D'));
                        if ($ndt2->format('Y-m-d') > $ndt->format('Y-m-d')){
                            $ndt = new DateTime($usuario[0]['atv_gauth']);
                        }
                        
                        $resposta['titulo'] = "Payment available in:";
                        $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
                        $resposta['planos'] = $this->model->selecionaBusca("planos", "WHERE `ativo`='1' ORDER BY `valor` ASC");
                        $resposta['usuarios'] = $resposta['formato'] = listaUsuariosRede($array['id_usuario'], 0, 0, 1);
                        $resposta['msg'] = "Payment available";
                    } else {
                        $plano_usuario = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `data_pedido` IS NOT NULL ORDER BY `data_pedido` ASC LIMIT 1 ");
                        if (isset($plano_usuario[0]['id'])){
                            $ndt = new DateTime($plano_usuario[0]['data_resposta']);
                            $ndt->add(new DateInterval('P15D'));
                            
                            $ndt2 = new DateTime($usuario[0]['atv_gauth']);
                            $ndt2->add(new DateInterval('P1D'));
                            if ($ndt2->format('Y-m-d') > $ndt->format('Y-m-d')){
                                $ndt = new DateTime($usuario[0]['atv_gauth']);
                            }
                            $resposta['planos'] = $this->model->selecionaBusca("planos", "WHERE `ativo`='1' ORDER BY `valor` ASC");
                            $resposta['titulo'] = "Payment available in:";
                            $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
                            $resposta['msg'] = "Payment available";
                        } else {
                            $resposta['titulo'] = "Payment not available";
                            $resposta['texto'] = "";
                        }
                    }
              /*} else {
                    $ndt = new DateTime($usuario[0]['atv_gauth']);
                    $ndt->add(new DateInterval('P1D'));
                    $resposta['titulo'] = "Payment available in";
                    $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
              } */
        } else {
            $resposta['titulo'] = "Payment not available";
            $resposta['texto'] = "Pending google auth activation";
        }
      } else {
            $resposta['titulo'] = "Payment not available";
            $resposta['texto'] = "";
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  
  public function lastWithdraw(){
      $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id_usuario');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      
      $resposta['taxa'] = '3%';
      
      $pedido = $this->model->selecionaBusca('pedido_saque', "WHERE `id_usuario`='{$array['id_usuario']}' AND `aceito`='1' ORDER BY `respondido_em` DESC ");
      $usuario = $this->model->selecionaBusca("usuario", "WHERE `id`='{$array['id_usuario']}' ");
      $saldo = $this->model->selecionaBusca('saldo_usuario', "WHERE `id_usuario`='{$array['id_usuario']}'");
      $resposta['saldo'] = isset($saldo[0]['saldo']) ? '$'.$saldo[0]['saldo'] : '$0';
      $resposta['carteiras'] = $this->model->selecionaBusca('carteira_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' ");
      if (isset($usuario[0]['id'])){
          if ($usuario[0]['google_auth'] == 1){
              date_default_timezone_set('America/Sao_Paulo');
              $dias = dateDiffInDays($usuario[0]['atv_gauth'], date('Y-m-d H:i:s'));
              if ($dias >= 1){
                  if (isset($pedido[0]['id'])){
                    $ndt = new DateTime($pedido[0]['respondido_em']);
                    $resposta['titulo'] = "Last Withdrawal:";
                    $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
                    
                    $now = time();
                    $your_date = strtotime($pedido[0]['respondido_em']);
                    $datediff = $now - $your_date;
                    $dias = round($datediff / (60 * 60 * 24));
                    if ($dias < 7){
                        $resposta['taxa'] = '10%';
                    } else if ($dias < 30){
                        $resposta['taxa'] = '7%';
                    } else {
                        $resposta['taxa'] = '3%';
                    }
                  } else {
                    $plano_usuario = $this->model->selecionaBusca('plano_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `data_resposta` IS NOT NULL ORDER BY `data_resposta` ASC LIMIT 1 ");
                    
                    if (isset($plano_usuario[0]['id'])){
                        $ndt = new DateTime($plano_usuario[0]['data_resposta']);
                        $ndt->add(new DateInterval('P15D'));
                        $resposta['titulo'] = "Withdrawal available in:";
                        $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
                        
                    } else {
                        $plano_usuario = $this->model->selecionaBusca('voucher_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `data_pedido` IS NOT NULL ORDER BY `data_pedido` ASC LIMIT 1 ");
                        if (isset($plano_usuario[0]['id'])){
                            $ndt = new DateTime($plano_usuario[0]['data_pedido']);
                            $ndt->add(new DateInterval('P15D'));
                            $resposta['titulo'] = "Withdrawal available in:";
                            $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
                        } else {
                            $resposta['titulo'] = "Withdrawal not available";
                            $resposta['texto'] = "";
                        }
                    }
                  }
              } else {
                    $ndt = new DateTime($usuario[0]['atv_gauth']);
                    $ndt->add(new DateInterval('P1D'));
                    $resposta['titulo'] = "Withdrawal available in";
                    $resposta['texto'] = $ndt->format('F d').'th '.$ndt->format('Y').' at '.$ndt->format('H:i');
              }
        } else {
            $resposta['titulo'] = "Withdrawal not available";
            $resposta['texto'] = "Pending google auth activation";
        }
      } else {
            $resposta['titulo'] = "Withdrawal not available";
            $resposta['texto'] = "";
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function cadastrar_carteira()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id_usuario', 'carteira');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id_usuario']}' ");
      if (isset($usuario[0]['id'])){
        $carteiras = $this->model->selecionaBusca('carteira_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `ativa`='1' ");
        $ttl_carteiras = count($carteiras);
        if ($ttl_carteiras >= 5){
          $resposta['tipo'] = 'error';
          $resposta['msg'] = '5 wallets already registered';
        } else {
          $array['codigo'] = $array['id_usuario'].RandomString(15).$array['id_usuario'].RandomString(15);
          $idus = $this->model->insere_id('carteira_usuario', $array);
          if ($idus){
            $assunto = "Wallet register confirmation";
            $texto = "You have just registered the wallet <b>".$array['carteira'].'</b> into your account '.$usuario[0]['login'].', to confirm this registration, please click on the following link:<br/>';
            $texto .= '<a href="'.site_url('ativar_carteira/'.$array['codigo']).'">'.site_url('ativar_carteira/'.$array['codigo']).'</a><br/><br/><font style="color:red;">This link has a 3 hour expire time!</font>';
            $this->submail->enviar($usuario[0]['email'], $assunto, $texto, $usuario[0]['nome']);
            $array['id'] = $idus;
            $array['ativa'] = 0;
            $resposta['tipo'] = 'success';
            $resposta['msg'] = 'wallet successfully registered and pending email confirmation';
            $resposta['carteira'] = $array;
          } else {
            $resposta['tipo'] = 'error';
            $resposta['msg'] = 'error registering the wallet';
          }
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'user not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function ativar_carteira($codigo='')
  {
    if ($codigo != ''){
      $crt = $this->model->selecionaBusca('carteira_usuario', "WHERE `codigo`='{$codigo}' ");
      if (isset($crt[0]['id'])){
        $data_atual = date('Y-m-d H:i:s');
        $hr1 = 0; $hr2 = 0;
        $date1 = $crt[0]['criado_em'];
        $date2 = $data_atual;
        $datetimeObj1 = new DateTime($date1);
        $datetimeObj2 = new DateTime($date2);
        $interval = $datetimeObj1->diff($datetimeObj2);

        if($interval->format('%a') > 0){
          $hr1 = $interval->format('%a')*24;
        }
        if($interval->format('%h') > 0){
          $hr2 = $interval->format('%h');
        }
        //$dif = ($hr1 + $hr2);
        $dif = true;
        
        if ($dif){
          if ($crt[0]['ativa'] == 0){
            $carteiras = $this->model->selecionaBusca('carteira_usuario', "WHERE `id_usuario`='{$crt[0]['id_usuario']}' AND `ativa`='1' ");
            $ttl_carteiras = count($carteiras);
            if ($ttl_carteiras >= 5){
              $remove = $this->model->remove('carteira_usuario', $crt[0]['id']);
              echo '<center><b>You already have 5 registered wallets!</b></center>';
            } else {
              $update = array('ativa' => 1);
              $upd = $this->model->update('carteira_usuario', $update, $crt[0]['id']);
              if($upd){
                //echo '<center><b>Carteira ativada com sucesso!</b></center>';
                header('Location: https://backoffice.moneybemoney.com/#/wallet');
                die();
              } else {
                echo '<center><b>Error activating your wallet, try again</b></center>';
              }
            }
          } else {
            echo '<center><b>This wallet is already active</b></center>';
          }
        } else {
          $remove = $this->model->remove('carteira_usuario', $crt[0]['id']);
          echo '<center><b>Expired Link</b></center>';
        }
      } else {
        echo 'Invalid Code';
      }
    } else {
      echo 'Invalid Code';
    }
  }
  
  public function remove_carteira()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
      $array = $retorno['data'];
      $busca = $this->model->selecionaBusca('carteira_usuario', "WHERE `id`='{$array['id']}' ");
      
      if (isset($busca[0]['id'])){
        $remove = $this->model->remove('carteira_usuario', $busca[0]['id']);
        if ($remove){
          $resposta['tipo'] = 'success';
          $resposta['msg'] = 'wallet was successfully deleted';
        } else {
          $resposta['tipo'] = 'error';
          $resposta['msg'] = 'error deleting wallet';
        }
      } else {
        $resposta['tipo'] = 'error';
        $resposta['msg'] = 'wallet not found';
      }
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }
  
  public function listar_carteiras()
  {
    $json = file_get_contents('php://input');
    
    $requeridos = array('id_usuario');
    $retorno = verificaCampos($requeridos, $json, 0);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];

    if ($retorno['tipo']){
        $array = $retorno['data'];

        $retorno = $this->model->selecionaBusca('carteira_usuario', "WHERE `id_usuario`='{$array['id_usuario']}' AND `ativa`='1' ");

        $resposta['tipo'] = 'success';
        unset($resposta['msg']);
        $resposta['carteiras'] = $retorno;
    } else {
      $resposta['tipo'] = $retorno['topo'];
      $resposta['msg'] = $retorno['msg'];

    }
    echo json_encode($resposta);
  }  
  
  
  
  
  
  
  
  
  
  
  
/* ====================================================================================================================================================================== */
/* FUNÇÕES SITE ========================================================================================================================================================= */
/* ====================================================================================================================================================================== */
  
  public function listar_ramos()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      if (isset($usuario[0]['id']) && isset($usuario[0]['id'])){
        $detalhado = isset($array['detalhado']) ? $array['detalhado'] : false;
        $n_ramos = isset($array['n_ramos']) ? $array['n_ramos'] : 0;
        $modo = isset($array['modo']) ? $array['modo'] : 0;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['formato'] = listaUsuarios($usuario[0]['id'], $detalhado, $n_ramos, $modo);
      } else {
        $resposta['tipo'] = "error";
        $resposta['msg'] = "user not found";
      }
    }
    echo json_encode($resposta);
  }
  
  
  public function show_raiz_arvore_usuarios()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      $array = $retorno['data'];
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
    }
    echo json_encode($resposta);
  }
  
  
  public function show_usuarios_volcher()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$array['id']}' ");
      $idbusca = isset($array['id_usuario']) ? $array['id_usuario'] : $arvore[0]['raiz'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$idbusca}' LIMIT 1");
      
      if (isset($usuario[0]['id']) && isset($usuario[0]['id'])){
        $detalhado = isset($array['detalhado']) ? $array['detalhado'] : true;
        $n_ramos = isset($array['n_ramos']) ? $array['n_ramos'] : 0;
        $modo = isset($array['modo']) ? $array['modo'] : 1;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['formato'] = listaUsuariosRedeVolcher($usuario[0]['id'], $detalhado, $n_ramos, $modo);
      } else {
        $resposta['tipo'] = "error";
        $resposta['msg'] = "user not found";
      }
    }
    echo json_encode($resposta);
  }
  
  public function show_arvore_usuarios()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $arvore = $this->model->selecionaBusca('arvore', "WHERE `id`='{$array['id']}' ");
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id_arvore`='{$array['id']}' AND `tipo`='raiz' LIMIT 1");
      
      if (isset($usuario[0]['id']) && isset($usuario[0]['id'])){
        $detalhado = isset($array['detalhado']) ? $array['detalhado'] : true;
        $n_ramos = isset($array['n_ramos']) ? $array['n_ramos'] : 0;
        $modo = isset($array['modo']) ? $array['modo'] : 1;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['formato'] = listaUsuarios($usuario[0]['id'], $detalhado, $n_ramos, $modo);
      } else {
        $resposta['tipo'] = "error";
        $resposta['msg'] = "user not found";
      }
    }
    echo json_encode($resposta);
  }
  
  
  public function conta_arvore_usuarios()
  {
    $resposta['tipo'] = "error";
    $resposta['msg'] = "Something went wrong, try again";

    $requeridos = array('id');

    $json = file_get_contents('php://input');

    $retorno = verificaCampos($requeridos, $json, 2);

    $resposta['tipo'] = $retorno['topo'];
    $resposta['msg'] = $retorno['msg'];
    if ($retorno['tipo']){
      $array = $retorno['data'];
      $usuario = $this->model->selecionaBusca('usuario', "WHERE `id`='{$array['id']}' ");
      
      if (isset($usuario[0]['id']) && isset($usuario[0]['id'])){
        $detalhado = isset($array['detalhado']) ? $array['detalhado'] : true;
        $n_ramos = isset($array['n_ramos']) ? $array['n_ramos'] : 0;
        $modo = isset($array['modo']) ? $array['modo'] : 1;
        $resposta['tipo'] = 'success';
        $resposta['msg'] = '';
        $resposta['formato'] = contaUsuarios($usuario[0]['id'], $detalhado, $n_ramos, $modo);
      } else {
        $resposta['tipo'] = "error";
        $resposta['msg'] = "user not found";
      }
    }
    echo json_encode($resposta);
  }
  
  

  /* TESTES APARTIR DAQUI ===================================================================================================================================================================================================== */
  public function teste_recuperar_senha()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "login_ou_email" => "gigantesbrasil"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/recuperar_senha'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_alterar_saldo()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 17,
      "valor" => -7.5
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/alterar_saldo'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_listarcp()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 1
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/listar_compras'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  
  public function teste_pagamento()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "DKTuraZlskKaQizo19cQ8rwZUwF45NDrCyJa5DbZ",
      "id_usuario" => 116,
      "id_plano" => 2,
      "url_sucesso" => "http://google.com"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/comprar_plano'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_configuracoes()
  {
    $data['data'] = array(
      "api_id" => "WqbE0"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/configuracoes'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_setar_configuracoes()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "desconto_saque" => 7
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/setar_configuracoes'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_relatorio_saldo()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 17,
      "data_inicio" => "2020-04-04"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/relatorio_saldo'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
public function teste_alterar_saldo_2()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 52,
      "valor" => 2900
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/alterar_saldo'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
    /* TESTES APARTIR DAQUI ===================================================================================================================================================================================================== */
  
  public function retorna_key()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "bW2mBujXUUdzskpv9GlrV6G2B7sCF18RXadzFxwA",
      'id' => 20,
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/retorna_key_auth'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  
  public function teste_remove_carteira()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "bW2mBujXUUdzskpv9GlrV6G2B7sCF18RXadzFxwA",
      'id' => 3,
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/remove_carteira'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    //echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_listar_carteiras()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "bW2mBujXUUdzskpv9GlrV6G2B7sCF18RXadzFxwA",
      'id_usuario' => 19,
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/listar_carteiras'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    //echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_cadastrar_carteira()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "bW2mBujXUUdzskpv9GlrV6G2B7sCF18RXadzFxwA",
      "carteira" => "HJ8H1BU12H38DHS8UFDH8",
      'id_usuario' => 19,
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/cadastrar_carteira'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    //echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_listar_ramos()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "bW2mBujXUUdzskpv9GlrV6G2B7sCF18RXadzFxwA",
      'id' => 19,
      'modo' => 1,
      'n_ramos' => 2
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/listar_ramos'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    //echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_listar_planos()
  {
    $data['data'] = array(
      "api_id" => "WqbE0"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/listar_planos'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }

  
  public function teste_remove_plano()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      'id' => 1
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/remove_plano'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_atualiza_plano()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      'id' => 1,
      'nome' => 'teste'
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/atualiza_plano'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_cadastro_plano()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      'nome' => 'MBM150',
      'valor' => '150',
      'duracao' => 365
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/cadastrar_plano'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_remove_usuario()
  {
    $data['data'] = array(
      "api_id" => "WqbE0", 
      "token" => "FjWiDfQucCa9c2AhxPnESfTUOqcF6BfLUc3yrU2D",
      'id' => 22
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/remove_usuario'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    //print_r($result);
    //echo $this->session->userdata('msg');
    $result = json_decode($result);
    echo $result->msg;
    
  }
  
  /*
  public function script_indicado(){
    $usuarios = $this->model->selecionaBusca('usuario', "WHERE `tipo`!='raiz' ");
    foreach ($usuarios as $us){
      $upd['indicado_por'] = $us['id_link'];
      $this->model->update('usuario', $upd, $us['id']);
    }
  } */
  
  public function teste_mostrar_arvore()
  {
    /*
    $data['data'] = array(
      "api_id" => "WqbE0", 
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      'id' => 6,
      'detalhado' => false
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/mostrar_arvore'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   
    
    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>'; */
    echo '<script>
    function funcao_retorno(retorno){
      console.log(retorno);
    }
    
    function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 8,
                            "detalhado" : false
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/mostrar_arvore");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
     mostrar_arvore(); </script>';
  }
  
  public function teste_login_usuario()
  {
    $data['data'] = array(
      "api_id" => "WqbE0", 
      'login' => 'testelogin3',
      'senha' => 'Xec6J1eNqmiB',
      'g_auth' => '293529'
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/login_usuario'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
    
  }
  
  public function teste_ativar_plano()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 67
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/ativar_plano'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_pedir_saque()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "8RFTmn0ssvUbOMtP858ibEOhMANIXqY5iDZE107t",
      "id" => 19,
      "valor" => 20,
      "carteira" => "HAUSDHUajsikaodAHUAkoaDSAKO",
      "cancelar_extouro_limite" => false
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/pedir_saque'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_listar_pedidos_saque()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",

    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/listar_pedidos_saque'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  
  public function teste_mostrar_arvore_usuarios()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 1,
      "modo" => 0
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/show_arvore_usuarios'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_responder()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => 3,
      "resposta" => 1
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/responder_pedido_saque'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  
  public function teste_cadastro_raiz()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "pais" => "Brasil",
      "nome" => "Antonio",
      'email' => 'toni_bevila@hotmail.com',
      'login' => 'toniteste',
      'senha' => '231811',
      'sexo' => 'masculino'
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/cadastrar_raiz'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_cadastro_usuario()
  {
    $data['data'] = array(
      "api_id" => "WqbE0", 
      "pais" => "Brasil",
      "nome" => "Teste33",
      'email' => 'usuarioteste3@teste.com.br',
      'login' => 'testeusuario3',
      'senha' => '121131',
      'sexo' => 'masculino',
      'url' => '2Nw36lILWUS52N8JXdAmHJ3rrrGRdv6DARV14',
      'nivel' => 'usuario'
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/cadastro_usuario'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  
  public function teste_atualiza_usuario()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "9HWcaZKiwNcyYv3fpFn1kCGFjvhykQXuxUGITr0q",
      'email' => 'oloquinho@gmail.com',
      'login' => 'testando',
      'id' => 18
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/atualiza_usuario'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    print_r($result);
  }
  
  public function teste_usuario_gerador_url()
  {
    $data['data'] = array(
      "api_id" => "WqbE0",
      'url' => 'HVUS17gKtDgFdNLARV6'
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/usuario_gerador_url'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  public function teste_saldo()
  {
    echo 'teste';
    $data['data'] = array(
      "api_id" => "WqbE0",
      "token" => "HzBFakiittBrz0AO3fBUt0iTgAnrdQmayArEpAx4",
      "id" => "1",
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('retorna_saldo'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
  

  public function teste_gera_url()
  {
    echo 'teste';
    $data['data'] = array(
      "api_id" => "WqbE0", 
      "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
      "id" => "1",
      "perna" => "direita"
    );                                                                    
    $data_string = json_encode($data);

    $ch = curl_init(site_url('api/gerar_url'));                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($data_string))                                                                       
    );                                                                                                                   

    $result = curl_exec($ch);
    echo $result;
    $result = json_decode($result);
    echo '<pre>'.print_r($result, true).'</pre>';
  }
}
