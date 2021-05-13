<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
  }

  public function index() {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    $this->load->view('rede/login');
  }
  
  public function esqueci() {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    $this->load->view('rede/esqueci');
  }

  public function login() {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    //Validação de dados
    $config_rules = array(
      array('field' => 'usuario', 'label' => 'Usuario', 'rules' => 'required|min_length[2]'),
      array('field' => 'senha', 'label' => 'Senha', 'rules' => 'required|min_length[2]'),
    );

    $this->form_validation->set_rules($config_rules);

    if ($this->form_validation->run() == FALSE) {
      gera_aviso('erro', 'O campo usuário precisa ter ao menos 4 dígitos, o campo senha precisa ter ao menos 6 dígitos.', 'rede/login');
    } else {

      $this->load->model('Gerais_model', 'model');

      $dados = array(
        'login' => $this->input->post('usuario'),
        'senha' => $this->input->post('senha'),
      );

      //Conecta ao Model de validação de login
      $login = $this->model->buscaLoginDif('aluno', 'login', $dados['login'], $dados['senha']);
      
      if (isset($login[0]->id) && isset($login[0]->id_niveis) && $login[0]->ativo == 1) {
        $user = (array)$login[0];
        $user['nivel_rede'] = 1;
        $this->session->set_userdata($user);
        $this->session->unset_userdata(['nivel_adm', 'nivel_prof']);
        //print_r($user);
        redirect('rede/index');
      } else {
        $temSenha = $this->model->buscaLoginDif('senha_mestre', 'id', 1, $dados['senha']);
        if ($temSenha){
          $login = $this->model
          ->setTable('aluno')
          ->where('login', $dados['login'])
          ->fetch('array');

          if ($login){
            $user = (array)$login[0];
            $user['nivel_rede'] = 1;
            $this->session->set_userdata($user);
            $this->session->unset_userdata(['nivel_adm', 'nivel_prof']);
            //print_r($user);
            redirect('rede/index');
          } else {
            gera_aviso('erro', 'Aluno não encontrado.', 'rede/login');
          }
        } else {
          gera_aviso('erro', 'Usuário ou senha incorretos.', 'rede/login');
        }
      }
    }
  }
  
  public function gera_recuperacao() {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    $email = $this->input->post('email');
    if ($email != ''){
      $temuser = $this->model->queryString("SELECT id,nome FROM `aluno` WHERE `email`='{$email}' AND `ativo`='1' ");
      if (isset($temuser[0]['id'])){
        $codigonv = RandomStringMaiusculas(150);
        $arr = array(
          'codigo' => $codigonv,
          'tipo' => 'rede',
          'expira' => addTimeData(date('Y-m-d H:i:s'), 6, 'h'),
          'id_rel' => $temuser[0]['id']
        );
        $this->model->removeKeys('recupera', array('id_rel' => $temuser[0]['id'], 'tipo' => 'rede'));   
        if ($this->model->insere('recupera', $arr)){
          $texto = "
            <p>Você solicitou a recuperação de sua conta, para cadastrar uma nova senha clique no botão abaixo:</p><br/>
            <div style='width:100%;text-align:center;'>
              <a href='".site_url('rede/nova_senha/'.$codigonv)."'>
                <button style='padding:7px 15px;cursor:pointer;color: #fff;background-color: #dc3545;border-color: #dc3545;outline:0px;box-shadow:none;border-radius:5px;text-transform:uppercase;font-size:1.2rem;'>
                  Recuperar minha senha
                </button>
              </a>
            </div>
            <br/>
            <small style='font-size:80%'>Ou copie o link a seguir:<br/>".site_url('rede/nova_senha/'.$codigonv)."</small>
            <br/>
            <p><b>Caso você não tenha feito este pedido ignore este email!</b></p>
          ";
          $this->submail->enviar($email, 'Recuperar Senha', $texto, $temuser[0]['nome']);
          gera_aviso('sucesso', 'Um email foi enviado contendo informações para recuperar sua conta.', 'rede/login');
        }
      }
    } else {
      gera_aviso('erro', 'Email não cadastrado.', 'rede/login');
    }
    
  }
  
  public function nova_senha($codigo='') {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    if ($codigo != ''){
        $temcod = $this->model->queryString("SELECT id,expira FROM `recupera` WHERE `codigo`='{$codigo}' AND `tipo`='rede' ");
        if (isset($temcod[0]['id'])){
            if ($temcod[0]['expira'] > date('Y-m-d H:i:s')){
                $data['codigo'] = $codigo;
                $this->load->view('rede/nova_senha', $data);
            } else {
                $this->model->remove('recupera', $temcod[0]['id']);
                gera_aviso('erro', 'Link de recuperação expirado.', 'rede/login');
            }
        }
    } else {
        redirect('rede/index');
    }
  }
  
  public function insere_nova_senha($codigo='') {
    if ($this->session->userdata('nivel_rede') == 1){
        redirect('rede/index');
    }
    if ($codigo != ''){
        $temcod = $this->model->queryString("SELECT id,expira,id_rel FROM `recupera` WHERE `codigo`='{$codigo}' AND `tipo`='rede' ");
        if (isset($temcod[0]['id'])){
            if ($temcod[0]['expira'] > date('Y-m-d H:i:s')){
                $nova_senha = $this->input->post('senha');
                $options = array("cost"=>4);
                $dtadmin['senha'] = password_hash($nova_senha,PASSWORD_BCRYPT,$options);
                if ($this->model->update('aluno', $dtadmin, $temcod[0]['id_rel'])){
                    gera_aviso('sucesso', 'Sua senha foi alterada com sucesso e você já pode fazer login!', 'rede/login');
                } else {
                    gera_aviso('erro', 'Falha ao cadastrar sua nova senha, tente novamente.', 'rede/login');
                }
            } else {
                $this->model->remove('recupera', $temcod[0]['id']);
                gera_aviso('erro', 'Link de recuperação expirado.', 'rede/login');
            }
        }
    } else {
        redirect('rede/index');
    }
  }
  
  //Função que realiza logoff
  public function logoff() {

    $this->session->sess_destroy();
    redirect('rede/login');
  }


}
