<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Aula extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nivel_user') == ''){
            redirect('ead/login');
        }
    }

    protected function setAula($id, $id_aula){
        $n = [
            'id_aula' => $id_aula
        ];
        return $this->model->update('aluno_curso', $n, $id);
    }

    public function index($id_curso, $url) {
        $id_aula = getIdString($url);
        $curso = $this->model->setTable('curso')->get($id_curso);

        if (!$curso){
            gera_aviso('erro', 'Curso não encontrado.', 'ead/cursos');
            return '';
        }

        $inscrito = $this->model->setTable('aluno_curso')->getWhere("id_aluno='".$this->session->userdata('id')."' AND id_curso='".$id_curso."' ");

        if (!$inscrito){
            redirect('ead/cursos/visualizar/'.$id_curso.'-'.rawurlencode($curso[0]['nome']));
            return '';
        }

        $aula = $this->model->getDataCourse('aula', 'id', $id_aula);
        $files = $this->model->setTable('aula_arquivos')->getWhere("id_aula='{$id_aula}' ");
        $modalidade = $this->model->getDataCourse('modalidade', 'id', $curso[0]['id_modalidade']);
        $professor = $this->model->getDataCourse('professor', 'id', $curso[0]['id_professor']);
        $aulas = $this->model->getOrderBy('aula', 'id_curso', $id_curso, 'n_aula', 'ASC');

        if (!$aula){
            gera_aviso('erro', 'Aula não encontrada.', 'ead/cursos/visualizar/'.$id_curso.'-'.rawurlencode($curso[0]['nome']));
            return '';
        }

        $menuSup = [];

        $prox = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula > '{$aula[0]['n_aula']}' ORDER BY n_aula ASC LIMIT 1");
        $ant = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula < '{$aula[0]['n_aula']}' ORDER BY n_aula DESC LIMIT 1");

        if ($aula[0]['n_aula'] == $aulas[0]['n_aula']){
            $menuSup[] = $aula[0];
            $alsSup = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula > '{$aula[0]['n_aula']}' ORDER BY n_aula ASC LIMIT 3");
            $menuSup = array_merge($menuSup, $alsSup);
        } else if ($aula[0]['n_aula'] == $aulas[count($aulas) - 1]['n_aula']){
            $aulasBaixo = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula < '{$aula[0]['n_aula']}' ORDER BY n_aula DESC LIMIT 3");
            for($i=count($aulasBaixo) - 1; $i>=0; $i--){
                $menuSup[] = $aulasBaixo[$i];
            }
            $menuSup[] = $aula[0];
        } else {
            $aulasCima = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula > '{$aula[0]['n_aula']}' ORDER BY n_aula ASC LIMIT 2");

            $ttl = count($aulasCima);

            $bottom = 3 - $ttl;

            $aulasBaixo = $this->model->setTable('aula')->getWhere("id_curso='{$id_curso}' AND n_aula < '{$aula[0]['n_aula']}' ORDER BY n_aula DESC LIMIT ".$bottom);

            
            for($i=count($aulasBaixo) - 1; $i>=0; $i--){
                $menuSup[] = $aulasBaixo[$i];
            }
            $menuSup[] = $aula[0];
            $menuSup = array_merge($menuSup, $aulasCima);
        }

        $this->setAula($inscrito[0]['id'], $id_aula);

        $tarefas = $this->model->getTarefasAluno($this->session->userdata('id'), $id_curso, true) ?? [];

        $provas = $this->model->getProvasAluno($this->session->userdata('id'), $id_curso, true) ?? [];

        $this->load->view('ead/aula', [
            'aula' => $aula,
            'files' => $files,
            'curso' => $curso,
            'course' => $curso,
            'modalidade' => $modalidade,
            'professor' => $professor,
            'aulasCurso' =>$aulas,
            'menuSup' => $menuSup,
            'ant' => $ant,
            'prox' => $prox,
            'tarefas' => $tarefas,
            'provas' => $provas
        ]); 
    }
}         