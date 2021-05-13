<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('suporte_logado') == 1) {
      redirect('painel/index');
    }
    $this->load->view('login');
  }

  public function esqueci()
  {
    if ($this->session->userdata('suporte_logado') == 1) {
      redirect('painel/index');
    }
    $this->load->view('esqueci');
  }

  public function login()
  {
    if ($this->session->userdata('suporte_logado') == 1) {
      redirect('painel/index');
    }
    //Validação de dados
    $config_rules = array(
      array('field' => 'email', 'label' => 'Email', 'rules' => 'required|min_length[8]'),
      array('field' => 'senha', 'label' => 'Senha', 'rules' => 'required|min_length[6]'),
    );

    $this->form_validation->set_rules($config_rules);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_userdata(array(
        'notif' => 'Email precisa ter no mínimo 8 dígitos.<br/>Senha precisa ter no minimo 6 dígitos.',
        'notif_tipo' => 'danger',
        'notif_titulo' => 'Falha na validação!'
      ));
      redirect('login');
    } else {

      $this->load->model('Gerais_model', 'model');

      $dados = array(
        'login' => $this->input->post('email'),
        'senha' => $this->input->post('senha'),
      );

      //Conecta ao Model de validação de login
      $login = $this->model->buscaLoginDif('cadastro', 'email', $dados['login'], $dados['senha']);

      if (isset($login[0]->id)) {
        if ($login[0]->bloqueado == 0){
          $user = (array)$login[0];
          $user['suporte_logado'] = 1;
          $user['lingua_sistema'] = 'en';
          

          $this->session->set_userdata($user);
          redirect('painel/index');
        } else {
          $this->session->set_userdata(array(
            'notif' => 'Your account is blocked, please contact the administration.',
            'notif_tipo' => 'danger',
            'notif_titulo' => 'Error!'
          ));
          redirect('login');
        }
      } else {

        $this->session->set_userdata(array(
          'notif' => 'Incorrect login or password.',
          'notif_tipo' => 'danger',
          'notif_titulo' => 'Validation fail!'
        ));
        redirect('login');
      }
    }
  }

  //Função que realiza logoff
  public function logoff()
  {

    $this->session->sess_destroy();
    redirect('login');
  }
}
