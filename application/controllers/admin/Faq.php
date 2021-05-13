<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Faq extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('nivel_adm') != 1) {
      redirect('admin/login');
    } else if (!buscaPermissao('faq')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  protected $table = "faq";
  protected $label = "faq";
  protected $sChar = 'o'; //define o sexo do item da tabela ex: "o" professor para tabela professor, ou "a" professora para tabela professora
  protected $errRedirect = 'admin/faq'; //redirecionamento em caso de erro
  protected $successRedirect = 'admin/faq'; //redirectionamento em caso de sucesso

  public function index($tipo){
    
    $this->successRedirect = 'admin/faq/'.$tipo;
    $this->errRedirect = 'admin/faq/'.$tipo;

    $tpbd = '';
    $tipo_txt = '';
    switch($tipo){
        case 'ead':
            $tpbd = 'ead';
            $tipo_txt = "do EAD";
        break;
        case 'rede':
            $tpbd = 'rede';
            $tipo_txt = "da rede";
        break;
        case 'professor':
            $tpbd = "prof";
            $tipo_txt = "dos professores";
        break;
        default:
    }
    $entradas = $this->model
    ->setTable($this->table)
    ->where('tipo', $tpbd)
    ->fetch('array');

    $this->load->view('admin/faq', [
        'tipo' => $tipo,
        'tipo_txt' => $tipo_txt,
        'entradas' => $entradas,
        'tables' => true,
        'colunas' => '0,1,2',
        'tipo_bd' => $tpbd
    ]);
  }

  public function cadastrar($tipo){
    if (!buscaPermissao('faq', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $tpbd = '';
    $tipo_txt = '';
    switch($tipo){
        case 'ead':
            $tpbd = 'ead';
            $tipo_txt = "do EAD";
        break;
        case 'rede':
            $tpbd = 'rede';
            $tipo_txt = "da rede";
        break;
        case 'professor':
            $tpbd = "prof";
            $tipo_txt = "dos professores";
        break;
        default:
    }
    $this->successRedirect = 'admin/faq/'.$tipo;
    $this->errRedirect = 'admin/faq/'.$tipo;

    $this->load->view('admin/cadastrar_faq', [
        'tipo' => $tipo,
        'tipo_bd' => $tpbd,
        'tipo_txt' => $tipo_txt
    ]);
  }

  protected function retornaTipoFormatado($tipo){
      if ($tipo == 'prof'){
          return "professor";
      }
      return $tipo;
  }

  public function editar($id){
    if (!buscaPermissao('faq', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $servico = $this->model->setTable($this->table)->get($id);

    if (!$servico) gera_aviso('erro', ucfirst($this->label).' não encontrado.', $this->errRedirect);

    $this->successRedirect = 'admin/faq/'.$this->retornaTipoFormatado($servico[0]['tipo']);
    $this->errRedirect = 'admin/faq/'.$this->retornaTipoFormatado($servico[0]['tipo']);

    $this->load->view('admin/editar_faq', [
        'faq' => $servico,
        'tipo_bd' => $servico[0]['tipo'],
        'tipo_txt' => $this->retornaTipoFormatado($servico[0]['tipo'])
    ]);
  }

  public function insere()
  {
    if (!buscaPermissao('faq', 'cadastro')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $update = returnArray($this->table);

    if ($this->model->insere($this->table, $update)){
        $this->successRedirect = 'admin/faq/'.$this->retornaTipoFormatado($update['tipo']);
        $this->errRedirect = 'admin/faq/'.$this->retornaTipoFormatado($update['tipo']);
        gera_aviso('sucesso', ucfirst($this->label).' cadastrad'.$this->sChar.' com sucesso.', $this->successRedirect);
    }
    gera_aviso('erro', 'Falha ao cadastrar '.$this->sChar.' '.$this->label.', tente novamente.', $this->errRedirect);
  }
  
  public function update($id)
  {
    if (!buscaPermissao('faq', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $checker =  $this->model->selecionaBusca($this->table, "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        $this->successRedirect = 'admin/faq/'.$this->retornaTipoFormatado($checker[0]['tipo']);
        $this->errRedirect = 'admin/faq/'.$this->retornaTipoFormatado($checker[0]['tipo']);
        $update = returnArray($this->table);

        if ($this->model->update($this->table, $update, $checker[0]['id'])){
            gera_aviso('sucesso', ucfirst($this->label).' atualizad'.$this->sChar.' com sucesso.', $this->successRedirect);
        }
    }
    gera_aviso('erro', 'Falha ao atualizar '.$this->sChar.' '.$this->label.', tente novamente.', 'admin/index');
  }

  public function remove($id)
  {
    if (!buscaPermissao('faq', 'remover')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $checker =  $this->model->selecionaBusca($this->table, "WHERE id='{$id}' ");
    if (isset($checker[0]['id'])){
        $this->successRedirect = 'admin/faq/'.$this->retornaTipoFormatado($checker[0]['tipo']);
        $this->errRedirect = 'admin/faq/'.$this->retornaTipoFormatado($checker[0]['tipo']);
        if ($this->model->remove($this->table, $checker[0]['id'])){
            gera_aviso('sucesso', ucfirst($this->label).' removid'.$this->sChar.' com sucesso.', $this->successRedirect);
        }
    }
    gera_aviso('erro', 'Falha ao remover '.$this->sChar.' '.$this->label.', tente novamente.', 'admin/index');
  }
}
