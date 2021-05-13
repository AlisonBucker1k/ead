<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarefas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_user') != 1) {
            redirect('ead/login');
        }
    }

    protected function setTarAluno(int $id, int $pos, array $tarAln, int $id_curso, string $letra){
        foreach($tarAln as $tal){
            if ($tal['id_tarefa'] == $id && $tal['id_curso'] == $id_curso && $tal['pos'] == $pos){
                return $tarAln[0];
            }
        }

        $arr = [
            'id_aluno' => $this->session->userdata('id'),
            'id_tarefa' => $id,
            'id_curso' => $id_curso,
            'letra' => $letra,
            'pos' => $pos
        ];
        return $this->model->insere('tarefa_aluno', $arr);
    }

    protected function responder(array $val, array $tarAln, int $id_curso){
        if (isset($val['id']) && !empty($val['id'])){
            $exercicios = $this->model->selecionaBusca('tarefa_exercicios', "WHERE `id_tarefa`='{$val['id']}' ");
            
            if (!$exercicios) return false;

            if ($this->setTarAluno($val['id'], $val['pos'], $tarAln, $id_curso, $val['letra'])){
                return $this->model->selecionaBusca('tarefa_aluno', "WHERE `id_tarefa`='{$val['id']}' AND `id_aluno`='".$this->session->userdata('id')."' ");
            }
        }
        return $tarAln;
    }

    public function index($id)
    {
        $arr = [
            'id' => $this->input->post('id', true),
            'pos' => $this->input->post('pos', true),
            'letra' => $this->input->post('letra', true)
        ];
        

        $data['tarefa'] = $this->model->selecionaBusca('tarefa_curso', "WHERE `id`='{$id}' ");
        $data['tarAln'] = $this->model->selecionaBusca('tarefa_aluno', "WHERE `id_tarefa`='{$id}' AND `id_aluno`='".$this->session->userdata('id')."' ");
        
        if (isset($data['tarefa'][0]['id'])) {
            $data['tarAln'] = $this->responder($arr, $data['tarAln'], $data['tarefa'][0]['id_curso']);
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['tarefa'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $data['professor'] = $this->model->getDataCourse('professor', 'id', $data['cur'][0]['id_professor']);
                $data['modalidade'] = $this->model->getDataCourse('modalidade', 'id', $data['cur'][0]['id_modalidade']);
                $exercicios = $this->model->selecionaBusca('tarefa_exercicios', "WHERE `id_tarefa`='{$id}' ");
                $data['tarefa'][0]['exercicios'] = [];
                for ($i = 0; $i < count($exercicios); $i++) {
                    $arraynv = array(
                        'id' => $exercicios[$i]['id'],
                        'n_questao' => $exercicios[$i]['n_questao'],
                        'questao' => $exercicios[$i]['questao'],
                        'escolhas' => json_decode($exercicios[$i]['escolhas'], true),
                        'explicacao' => $exercicios[$i]['explicacao']
                    );
                    $data['tarefa'][0]['exercicios'][] = $arraynv;
                }
                $this->load->view('ead/tarefas/visualizar', $data);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'ead/cursos/meusCursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'ead/cursos/meusCursos');
        }
    }
}
