<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Aulas extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    if ($this->session->userdata('nivel_adm') != 1){
        redirect('admin/login');
    } else if (!buscaPermissao('curso')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
    }
  }

  public function index($id)
  {
    $exploder = explode('-', $id);
    $idd = isset($exploder[1]) ? $exploder[0] : $id;
    $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
    if (isset($data['cur'][0]['id'])) {
      $data['course_id'] = $data['cur'][0]['id'];
      $data['usuarios'] = $this->model->selecionaBusca("aula", "WHERE `id_curso`='" . $idd . "' ORDER BY n_aula ASC ");
      foreach ($data['usuarios'] as $key => $value) {
        $data['usuarios'][$key]['arquivos'] = $this->model->selecionaBusca("aula_arquivos", "WHERE `id_aula`='" . $value['id'] . "' ");
      }

      $this->load->view('admin/cursos/listar_aulas', $data);
    } else {
      gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
    }
  }

  //FUNÇÃO DE AJAX PARA RECEBER A AULA \/
  function getAula($id){
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Aula não encontrada!";

    $aula = $this->model->selecionaBusca('aula', "WHERE `id`='" . $id . "' ");
    if (isset($aula[0]['id'])){
      $ret['tipo'] = 'success';
      $ret['aula'] = $aula[0];
      $ret['aula']['arquivos'] = $this->model->selecionaBusca('aula_arquivos', "WHERE `id_aula`='" . $id . "' ");
    }
    echo json_encode($ret);
  }

  public function ativar_aula($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['aula'] = $this->model->selecionaBusca("aula", "WHERE `id`='" . $id . "' ");
    if (isset($data['aula'][0]['id'])) {
      $curso = $this->model->queryString("SELECT id,id_professor,nome FROM curso WHERE id='{$data['aula'][0]['id_curso']}' ");
      if (isset($curso[0]['id'])){
        $upd = ['ativo' => 1];
        if ($this->model->update('aula', $upd, $id)){
          gera_aviso('sucesso', 'Aula ativada com sucesso.', 'admin/cursos/aulas/'.$curso[0]['id'].'-'.$curso[0]['nome']);
        } else {
          gera_aviso('erro', 'Falha ao ativar a aula, tente novamente.', 'admin/cursos/aulas/'.$curso[0]['id'].'-'.$curso[0]['nome']);
        }
      } else {
        gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
      }
    } else {
      gera_aviso('erro', 'Aula não encontrada.', 'admin/cursos');
    }
  }

  public function desativar_aula($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $data['aula'] = $this->model->selecionaBusca("aula", "WHERE `id`='" . $id . "' ");
    if (isset($data['aula'][0]['id'])) {
      $curso = $this->model->queryString("SELECT id,id_professor,nome FROM curso WHERE id='{$data['aula'][0]['id_curso']}' ");
      if (isset($curso[0]['id'])){
        $upd = ['ativo' => 0];
        if ($this->model->update('aula', $upd, $id)){
          gera_aviso('sucesso', 'Aula desativada com sucesso.', 'admin/cursos/aulas/'.$curso[0]['id'].'-'.$curso[0]['nome']);
        } else {
          gera_aviso('erro', 'Falha ao desativar a aula, tente novamente.', 'admin/cursos/aulas/'.$curso[0]['id'].'-'.$curso[0]['nome']);
        }
      } else {
        gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
      }
    } else {
      gera_aviso('erro', 'Aula não encontrada.', 'admin/cursos');
    }
  }

  protected function reOrderAula($aulas, $aula, $nv){
    $achou = false;
    for ($i = 0; $i < count($aulas); $i++) {
      if ($aulas[$i]['id'] == $aula[0]['id'] && !$achou) {
        if ($aulas[$i]['n_aula'] < $nv) {
          $aux = $aulas[$i];
          $achou = true;
          for ($j = $i + 1; $j < count($aulas); $j++) {
            if ($aulas[$j]['n_aula'] != $nv) {
              $ajd = $aulas[$j];
              $aulas[$j]['n_aula'] = $aux['n_aula'];
              $aux = $ajd;
            } else {
              $aulas[$j]['n_aula'] = $aux['n_aula'];
              $aulas[$i]['n_aula'] = $nv;
              $j = count($aulas) + 1;

              break;
            }
          }
        } else {
          $achou = true;
          $aux = $aulas[$i];
          for ($j = $i - 1; $j >= 0; $j--) {
            if ($aulas[$j]['n_aula'] != $nv) {
              $ajd = $aulas[$j];
              $aulas[$j]['n_aula'] = $aux['n_aula'];
              $aux = $ajd;
            } else {
              $aulas[$j]['n_aula'] = $aux['n_aula'];
              $aulas[$i]['n_aula'] = $nv;
              $j = -1;
              break;
            }
          }
        }
      } else if ($achou) {
        break;
      }
    }
    return $aulas;
  }

  protected function initialOrderAula($arr){
    $counter = 1;
    foreach($arr as $k=>$v){
      $arr[$k]['n_aula'] = $counter;
      $counter++;
    }
    return $arr;
  }

  public function mudaAula($id_aula, $nv)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Aula não encontrada!";
    $aula = $this->model->selecionaBusca('aula', "WHERE `id`='" . $id_aula . "' ");
    if (isset($aula[0]['id'])) {
      $aulas = array();
      if ($nv != $aula[0]['n_aula']) {
        $aulas = $this->initialOrderAula($this->model->selecionaBusca('aula', "WHERE `id_curso`='" . $aula[0]['id_curso'] . "' ORDER BY n_aula ASC "));
        $aulas = $this->reOrderAula($aulas, $aula, $nv);

        
        foreach ($aulas as $als) {
          $updater = array('n_aula' => $als['n_aula']);
          $this->model->update('aula', $updater, $als['id']);
        }
      }
      $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $aula[0]['id_curso'] . "' ");
      $aulas = $this->model->selecionaBusca('aula', "WHERE `id_curso`='" . $aula[0]['id_curso'] . "' ORDER BY n_aula ASC ");
      $ret['aulas'] = $aulas;
      foreach ($ret['aulas'] as $key => $value) {
        $ret['aulas'][$key]['arquivos'] = $this->model->selecionaBusca("aula_arquivos", "WHERE `id_aula`='" . $value['id'] . "' ");
        foreach ($ret['aulas'][$key]['arquivos'] as $k => $v) {
          $ret['aulas'][$key]['arquivos'][$k]['url'] = get_url_aula($aula[0]['id_curso'], $value['id'], $curso[0]['nome'], $v['arquivo']);
        }
      }

      $ret['tipo'] = 'success';
      $ret['mensagem'] = "Ordem alterada com sucesso!";
    }
    echo json_encode($ret);
  }

  public function inserir_aulaAjax()
  {
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Erro ao inserir aula, tente novamente";

    $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $this->input->post('id_curso') . "' ");
    if (isset($curso[0]['id'])) {
      $lastAula = $this->model->queryString('SELECT n_aula FROM aula ORDER BY n_aula DESC LIMIT 1 ');
      $n_aula = isset($lastAula[0]['n_aula']) ? $lastAula[0]['n_aula'] : 0;
      $n_aula++;
      $aulaIns = $this->input->post(NULL, TRUE);
      $aulaIns['n_aula'] = $n_aula;
      if ($this->input->post('ativo')) {
        $aulaIns['ativo'] = 1;
      }
      $id = inserir_obj("aula", $aulaIns);
      if ($id) {
        $data = $aulaIns;
        unset($data['senha']);
        $arquivos = upload_files(
          'arquivos_aula_' . $n_aula,
          get_up_path_aula($this->input->post('id_curso'), $id, $curso[0]['nome']),
          get_up_root_path_aula($this->input->post('id_curso'), $id, $curso[0]['nome'])
        );

        foreach ($arquivos as $arquivo) {
          $newFile = array(
            'id_aula' => $id,
            'id_curso' => $curso[0]['id'],
            'arquivo' => $arquivo
          );

          $this->model->insere('aula_arquivos', $newFile);
        }
        addRegistro("Cadastrou a aula #" . $id . ' - ' . $this->input->post('nome') . "<br/>Dados: " . print_r($data, true));
        $ret['tipo'] = 'success';
        $ret['mensagem'] = "Aula cadastrada com sucesso.";
        $ret['aulas'] = $this->model->selecionaBusca('aula',  "WHERE id_curso=" . $this->input->post('id_curso') . " ORDER BY n_aula ASC ");
        foreach ($ret['aulas'] as $key => $value) {
          $ret['aulas'][$key]['arquivos'] = $this->model->selecionaBusca("aula_arquivos", "WHERE `id_aula`='" . $value['id'] . "' ");
          foreach ($ret['aulas'][$key]['arquivos'] as $k => $v) {
            $ret['aulas'][$key]['arquivos'][$k]['url'] = get_url_aula($this->input->post('id_curso'), $value['id'], $value['nome'], $v['arquivo']);
          }
        }
      } else {
        $ret['mensagem'] = "Erro ao cadastrar a aula.";
      }
    } else {
      $ret['mensagem'] = "Curso não encontrado.";
    }
    echo json_encode($ret);
  }

  public function update_aulaAjax($id)
  {
    $ret['tipo'] = 'danger';
    $ret['mensagem'] = "Erro ao inserir aula, tente novamente";

    $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $this->input->post('id_curso') . "' ");
    $aula = $this->model->selecionaBusca('aula', "WHERE `id`='" . $id . "' ");
    if (isset($aula[0]['id']) && isset($curso[0]['id'])) {
      $aulaIns = $this->input->post(NULL, TRUE);
      if ($this->input->post('ativo')) {
        $aulaIns['ativo'] = 1;
      }
      $aulaIns['n_aula'] = $aula[0]['n_aula'];
      $att = atualizar_obj("aula", $aulaIns, $id);
      if ($att) {
        $data = $aulaIns;
        unset($data['senha']);

        $arquiv = $this->model->selecionaBusca('aula_arquivos', "WHERE `id_aula`='{$id}' ");
        if (isset($arquivoAnt[0])){
          $mantem = array_flip($this->input->post('arqv_ant'));
          foreach($arquiv as $arqv){
            if (!isset($mantem[$arqv['id']])){
              $remocao = get_up_root_path_aula($curso[0]['id'], $aula[0]['id'], $curso[0]['nome']).str_replace(' ', '_', $arqv['arquivo']);
              if (file_exists($remocao)) {
                unlink($remocao);
              }
              $this->model->remove('aula_arquivos', $arqv['id']);
            }
          }
        }

        $arquivos = upload_files(
          'arquivos_aula_' . $aula[0]['n_aula'],
          get_up_path_aula($this->input->post('id_curso'), $id, $curso[0]['nome']),
          get_up_root_path_aula($this->input->post('id_curso'), $id, $curso[0]['nome'])
        );

        foreach ($arquivos as $arquivo) {
          $newFile = array(
            'id_aula' => $id,
            'id_curso' => $curso[0]['id'],
            'arquivo' => $arquivo
          );

          $this->model->insere('aula_arquivos', $newFile);
        }
        addRegistro("Atualizou a aula #" . $id . ' - ' . $this->input->post('nome') . "<br/>Dados: " . print_r($data, true));
        $ret['tipo'] = 'success';
        $ret['mensagem'] = "Aula atualizada com sucesso.";
        $ret['aulas'] = $this->model->selecionaBusca('aula',  "WHERE id_curso=" . $this->input->post('id_curso') . " ORDER BY n_aula ASC ");
        foreach ($ret['aulas'] as $key => $value) {
          $ret['aulas'][$key]['arquivos'] = $this->model->selecionaBusca("aula_arquivos", "WHERE `id_aula`='" . $value['id'] . "' ");
          foreach ($ret['aulas'][$key]['arquivos'] as $k => $v) {
            $ret['aulas'][$key]['arquivos'][$k]['url'] = get_url_aula($this->input->post('id_curso'), $value['id'], $value['nome'], $v['arquivo']);
          }
        }
      } else {
        $ret['mensagem'] = "Erro ao atualizar a aula.";
      }
    } else {
      $ret['mensagem'] = "Aula ou curso não encontrados.";
    }
    echo json_encode($ret);
  }

  public function remover_aula($id)
  {
    if (!buscaPermissao('curso', 'editar')) {
      gera_aviso('erro', 'Ação não permitida!', 'admin/index');
      exit;
    }
    $admin = $this->model->selecionaBusca("aula", "WHERE `id`='{$id}' ");
    if (isset($admin[0]['id'])) {
      if ($this->model->remove("aula", $id)) {
        $crs = $this->model->selecionaBusca("curso", "WHERE `id`='{$admin[0]['id_curso']}' ");
        $this->model->removeKey('aula_arquivos', 'id_aula', $id);

        deldir(get_up_root_path_aula($admin[0]['id_curso'], $id, $crs[0]['nome']));

        addRegistro("Removeu a aula " . $admin[0]['nome'] . ' <br/>' . print_r($admin, true));
        gera_aviso('sucesso', 'Aula removida com sucesso.', 'admin/cursos/aulas/' . $crs[0]['id'] . '-' . $crs[0]['nome']);
      } else {
        gera_aviso('erro', 'Erro ao remover a aula.', 'admin/cursos');
      }
    } else {
      gera_aviso('erro', 'Aula não encontrada.', 'admin/cursos');
    }
  }

}