<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerais_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function simpleGet($table, $limit=''){
        $sql = "SELECT * FROM `{$table}` $limit";
        $sql = $this->db->query($sql);

        return $sql->result_array();
    }

    // Curosos

    public function getCourses(){
        $array = array();
        $user = $this->session->userdata('nivel_user');
        
        $sql = "SELECT * FROM aluno_curso WHERE id_aluno = '{$user}'";
        $sql = $this->db->query($sql);

        $array = $sql->result_array();

        // echo "<pre>"; print_r($array);exit;
        for($q=0; $q<count($array);$q++){
            
            $array[$q]['dataCourse'] = $this->getDataCourse('curso', 'id', $array[$q]['id_curso']);

            $array[$q]['modalidade'] = $this->getDataCourse('modalidade', 'id', $array[$q]['dataCourse'][0]['id_modalidade']);

            $array[$q]['professor'] = $this->getDataCourse('professor', 'id', $array[$q]['dataCourse'][0]['id_professor']);

            $array[$q]['qtAulas'] = count($this->getDataCourse('aula', 'id_curso', $array[$q]['id_curso']));

            $array[$q]['inscrito'] = $this->setTable('aluno_curso')->getWhere("id_aluno='".$this->session->userdata('id')."' AND id_curso='".$array[$q]['id_curso']."' ");

            $array[$q]['alunos_vis'] = $this->db->query("SELECT id FROM aluno_curso WHERE id_curso='{$array[$q]['id_curso']}' ")->num_rows();
        }


        return $array;
    }

    public function getTarefasAluno($id, $id_curso, $returnFeitas = false){
        $tarefas = $this->selecionaBusca('tarefa_curso', "WHERE id_curso='{$id_curso}' AND ativo='1' ORDER BY id ASC");
        
        $retorno = [];
        $firstM = false;
        foreach($tarefas as $v){
            $tarAln = $this->selecionaBusca('tarefa_aluno', "WHERE id_aluno='{$id}' AND id_tarefa='{$v['id']}' ");
            if (!$returnFeitas){
                if (!$tarAln) {
                    $retorno[] = $v;
                }
            } else {
                $exercicios = $this->selecionaBusca('tarefa_exercicios', "WHERE id_tarefa='{$v['id']}' ");
                $v['feita'] = true;
                $v['first'] = false;
                if (!$tarAln || count($exercicios) > count($tarAln)) {
                    $v['feita'] = false;
                    if (!$firstM){
                        $v['first'] = true;
                        $firstM = true;
                    }
                }
                $retorno[] = $v;
            }
        }

        return $retorno;
    }

    public function getProvasAluno($id, $id_curso, $returnFeitas = false){
        $tarefas = $this->selecionaBusca('prova_curso', "WHERE id_curso='{$id_curso}' AND ativo='1' ORDER BY id ASC");
        
        $retorno = [];
        $firstM = false;
        foreach($tarefas as $v){
            $tarAln = $this->selecionaBusca('prova_aluno', "WHERE id_aluno='{$id}' AND id_prova='{$v['id']}' ");
            if (!$returnFeitas){
                if (!$tarAln) {
                    $retorno[] = $v;
                }
            } else {
                $exercicios = $this->selecionaBusca('prova_exercicios', "WHERE id_prova='{$v['id']}' ");
                $v['feita'] = true;
                $v['first'] = false;
                if (!$tarAln || count($exercicios) > count($tarAln)) {
                    $v['feita'] = false;
                    if (!$firstM){
                        $v['first'] = true;
                        $firstM = true;
                    }
                } else {
                    $finalizada = $this->selecionaBusca('provaFinalizada', "WHERE id_prova='{$v['id']}' AND id_aluno='{$id}' ");
                    $v['notaFinal'] = 0;
                    if ($finalizada){
                        $v['notaFinal'] = $finalizada[0]['nota'];
                    }
                }
                $retorno[] = $v;
            }
        }

        return $retorno;
    }

    public function ttlCourses(){
        $sql = "SELECT * FROM `curso` WHERE `status` = 'ativo' ";
        return $this->db->query($sql)->num_rows();
    }
    
    public function getDataCourse($table, $column, $id){
        $array = array();

        $sql = "SELECT * FROM `{$table}` WHERE `{$column}` = '{$id}'";
        $sql = $this->db->query($sql);

        $array = $sql->result_array();

        for($q=0; $q<count($array);$q++){
            $array[$q]['alunos_vis'] = $this->db->query("SELECT id FROM aluno_curso WHERE id_curso='{$array[$q]['id']}' ")->num_rows();
        }
        
        return $array;
    }

    public function getOrderBy($table, $columnWhere, $whereValue, $columnOrderBy, $orderByType){
        $sql = "SELECT * FROM `{$table}` WHERE `{$columnWhere}` = '{$whereValue}' ORDER BY `{$columnOrderBy}` {$orderByType}";
        // echo $sql;exit;
        $sql = $this->db->query($sql);

        return $sql->result_array();
    }

    public function verifyStudentCourse($id_curso, $id_aluno){ 
        $sql = "SELECT * FROM aluno_curso WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}";
        
        $sql = $this->db->query($sql);

        if(count($sql->result_array()) > 0){
            return true;
        }else{
            return false; 
        }
    }
}