<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
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
    return $this->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '1%'  ORDER BY id DESC LIMIT 3 ");
  }

  protected function getTotalUsers(){
    return $this->db->query("SELECT id FROM aluno WHERE id_niveis LIKE '1%' ")->num_rows();
  }

  protected function totalUsers(){
    return $this->db->query("SELECT id FROM aluno WHERE ativo='1' ")->num_rows();
  }

  protected function getDependentes(){
    $dependentes = $this->model->setTable('dependente')->all();

    $count = 0;;
    foreach($dependentes as $dep){
      $m = $this->model->setTable('aluno')
      ->where('id', $dep['id_familia'])
      ->where('status', 'ativo');
      if (!$m) continue;

      $count++;
    }
    return $count;
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
    $data['lastUsers'] = $this->last_users();
    $data['totalUsers'] = $this->getTotalUsers();
    $data['totalAln'] = $this->totalUsers();
    $data['totalDependentes'] = $this->getDependentes();
    $data['config'] = $this->model->selecionaBusca('ganho_residual', "");

    $this->load->view('admin/index', $data);
  }
  
}