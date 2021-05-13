<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('nivel_rede') == ''){
        redirect('rede/login');
    }
  }

  protected $totalUsers = [
    '1' => 0,
    '2' => 0,
    '3' => 0,
    '4' => 0,
    '5' => 0
  ];

  protected function last_users(){
    return $this->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '".$this->session->userdata('id_niveis')."%'  AND id_niveis != '".$this->session->userdata('id_niveis')."' ORDER BY id DESC LIMIT 3 ");
  }

  protected function getTotalUsers(){
    return $this->db->query("SELECT id FROM aluno WHERE id_niveis LIKE '".$this->session->userdata('id_niveis')."%' AND id_niveis != '".$this->session->userdata('id_niveis')."' ")->num_rows();
  }

  protected function getIndicados(){
    return $this->db->query("SELECT id FROM aluno WHERE id_indicador = '".$this->session->userdata('id')."' ")->num_rows();
  }

  public function getNv($n){
    $aln = searchActivesByLevel($this->session->userdata('id'), $n);
    if (isset($aln[0]['id'])){
      $aln = count($aln);
    } else {
      $aln = 0;
    }
    $sum = $n > 1 ? $this->totalUsers[$n - 1] : 0;
    $aln += $sum;
    $this->totalUsers[$n] = $aln;
    
    echo $aln;
  }

  public function index() {
    $data['linkCadastro'] = geraLinkCadastro($this->session->userdata('id')); //rede/link_cadastro_helper
    $data['lastUsers'] = $this->last_users();
    $data['totalUsers'] = $this->getTotalUsers();
    $data['carreira'] = getCarreira($this->session->userdata('id')); //rede/carreira_helper
    $data['assinatura'] = getAssinatura($this->session->userdata('id')); //rede/user_helper
    $data['indicados'] = $this->getIndicados();
    $data['saldo'] = getSaldo($this->session->userdata('id')); //rede/financeiro_helper
    $data['faturas'] = getFaturas($this->session->userdata('id'), 0); //rede/user_helper

    $data['config'] = $this->model->selecionaBusca('ganho_residual', "");

    $this->load->view('rede/index', $data);
  }
}
?>