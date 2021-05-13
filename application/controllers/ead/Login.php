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
    // $options = array("cost" => 4);
    //             $senhahash = password_hash('dh@pass123', PASSWORD_BCRYPT, $options); echo $senhahash;exit;
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }

    $this->load->view('ead/login');
  }

  public function esqueci()
  {
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }
    $this->load->view('ead/esqueci');
  }

  protected function checaLogin($user)
  {
    if ($user['bloqueado']) {
      gera_aviso("danger", "Você está bloqueado, por favor, contate a administração.", "ead/login");
      return false;
    }
    if ($user['tipo'] == 'rede') {
      if ($user['ativo'] == 0) {
        gera_aviso("danger", "Conta inativa.", "ead/login");
        return false;
      }

      $assinatura = $this->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='{$user['id']}' ");
      if (!$assinatura) {
        gera_aviso("danger", "Conta inativa.", "ead/login");
        return false;
      }

      $plano = $this->model->selecionaBusca('plano_rede', "WHERE id='{$assinatura[0]['id_plano']}' ");
      if (!$plano) {
        gera_aviso("danger", "Conta inativa.", "ead/login");
        return false;
      }

      if ($plano[0]['ead'] == 0) {
        gera_aviso("danger", "Essa conta não possui acesso ao ead.", "ead/login");
        return false;
      }
    }
    return true;
  }

  public function login()
  {
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }
    //Validação de dados
    $config_rules = array(
      array('field' => 'usuario', 'label' => 'Usuario', 'rules' => 'required|min_length[1]'),
      array('field' => 'senha', 'label' => 'Senha', 'rules' => 'required|min_length[6]'),
    );

    $this->form_validation->set_rules($config_rules);

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_userdata(array(
        'notif' => 'O campo usuário precisa ter ao menos 4 dígitos<br/>o campo senha precisa ter ao menos 6 dígitos.',
        'notif_tipo' => 'danger',
        'notif_titulo' => 'Falha na validação!'
      ));
      redirect('ead/login');
    } else {

      $this->load->model('Gerais_model', 'model');

      $dados = array(
        'usuario' => $this->input->post('usuario'),
        'senha' => $this->input->post('senha'),
      );

      //Conecta ao Model de validação de login
      $login = $this->model->buscaLoginDif('aluno', 'login', $dados['usuario'], $dados['senha']);

      if (isset($login[0]->id)) {
        $user = (array)$login[0];
        $user['nivel_user'] = 1;
        if ($this->checaLogin($user)) {
          $mensagens = $this->model->selecionaBusca('mensagem_ava', "WHERE ativa = '1' ORDER BY RAND() LIMIT 1");
          if ($mensagens) {
            $user['mensagem_ava_titulo'] = $mensagens[0]['titulo'];
            $user['mensagem_ava_texto'] = $mensagens[0]['texto'];
          }

          $this->session->set_userdata($user);
          redirect('ead/index');
        }
      } else {
        $temSenha = $this->model->buscaLoginDif('senha_mestre', 'id', 1, $dados['senha']);
        if ($temSenha){
          $login = $this->model
          ->setTable('aluno')
          ->where('login', $dados['login'])
          ->fetch('array');

          if ($login){
            $user = (array)$login[0];
            $user['nivel_user'] = 1;
            if ($this->checaLogin($user)) {
              $mensagens = $this->model->selecionaBusca('mensagem_ava', "WHERE ativa = '1' ORDER BY RAND() LIMIT 1");
              if ($mensagens) {
                $user['mensagem_ava_titulo'] = $mensagens[0]['titulo'];
                $user['mensagem_ava_texto'] = $mensagens[0]['texto'];
              }

              $this->session->set_userdata($user);
              redirect('ead/index');
            }
          } else {
            gera_aviso('erro', 'Aluno não encontrado.', 'ead/login');
          }
        } else {
          gera_aviso('erro', 'Usuário ou senha incorretos.', 'ead/login');
        }
      }
    }
  }

  // Função para recuperar senha
  public function gera_recuperacao()
  {
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }
    $email = $this->input->post('email');
    if ($email != '') {
      $temuser = $this->model->queryString("SELECT id,nome FROM `aluno` WHERE `email`='{$email}' AND `ativo`='1' ");
      if (isset($temuser[0]['id'])) {
        $codigonv = RandomStringMaiusculas(150);
        $arr = array(
          'codigo' => $codigonv,
          'tipo' => 'aluno',
          'expira' => addTimeData(date('Y-m-d H:i:s'), 6, 'h'),
          'id_rel' => $temuser[0]['id']
        );
        $this->model->removeKeys('recupera', array('id_rel' => $temuser[0]['id'], 'tipo' => 'aluno'));
        if ($this->model->insere('recupera', $arr)) {
          $texto = "
            <p>Você solicitou a recuperação de sua conta, para cadastrar uma nova senha clique no botão abaixo:</p><br/>
            <div style='width:100%;text-align:center;'>
              <a href='" . site_url('ead/login/nova_senha/' . $codigonv) . "'>
                <button style='padding:7px 15px;cursor:pointer;color: #fff;background-color: #dc3545;border-color: #dc3545;outline:0px;box-shadow:none;border-radius:5px;text-transform:uppercase;font-size:1.2rem;'>
                  Recuperar minha senha
                </button>
              </a>
            </div>
            <br/>
            <small style='font-size:80%'>Ou copie o link a seguir:<br/>" . site_url('ead/login/nova_senha/' . $codigonv) . "</small>
            <br/>
            <p><b>Caso você não tenha feito este pedido ignore este email!</b></p>
          ";
          $this->submail->enviar($email, 'Recuperar Senha', $texto, $temuser[0]['nome']);
          gera_aviso('sucesso', 'Um email foi enviado contendo informações para recuperar sua conta.', 'ead/login');
        }
      }
    } else {
      gera_aviso('erro', 'Email não cadastrado.', 'ead/login');
    }
  }

  public function nova_senha($codigo = '')
  {
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }
    if ($codigo != '') {
      $temcod = $this->model->queryString("SELECT id,expira FROM `recupera` WHERE `codigo`='{$codigo}' AND `tipo`='aluno' ");
      if (isset($temcod[0]['id'])) {
        if ($temcod[0]['expira'] > date('Y-m-d H:i:s')) {
          $data['codigo'] = $codigo;
          $this->load->view('ead/nova_senha', $data);
        } else {
          $this->model->remove('recupera', $temcod[0]['id']);
          gera_aviso('erro', 'Link de recuperação expirado.', 'ead/login');
        }
      }
    } else {
      redirect('ead/index');
    }
  }

  public function insere_nova_senha($codigo = '')
  {
    if ($this->session->userdata('nivel_user') == 1) {
      redirect('ead/index');
    }
    if ($codigo != '') {
      $temcod = $this->model->queryString("SELECT id,expira,id_rel FROM `recupera` WHERE `codigo`='{$codigo}' AND `tipo`='aluno' ");
      if (isset($temcod[0]['id'])) {
        if ($temcod[0]['expira'] > date('Y-m-d H:i:s')) {
          $nova_senha = $this->input->post('senha');
          $options = array("cost" => 4);
          $dtadmin['senha'] = password_hash($nova_senha, PASSWORD_BCRYPT, $options);
          if ($this->model->update('aluno', $dtadmin, $temcod[0]['id_rel'])) {
            gera_aviso('sucesso', 'Sua senha foi alterada com sucesso e você já pode fazer login!', 'ead/login');
          } else {
            gera_aviso('erro', 'Falha ao cadastrar sua nova senha, tente novamente.', 'ead/login');
          }
        } else {
          $this->model->remove('recupera', $temcod[0]['id']);
          gera_aviso('erro', 'Link de recuperação expirado.', 'ead/login');
        }
      }
    } else {
      redirect('ead/index');
    }
  }


  //Função que realiza logoff
  public function logoff()
  {

    $this->session->sess_destroy();
    redirect('ead/login');
  }
}
