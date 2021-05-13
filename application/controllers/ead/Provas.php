<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Provas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_user') != 1) {
            redirect('ead/login');
        }
    }

    protected function verifyNota($id){
        //VERIFICA SE A PROVA FOI CONCLUÍDA E, SE FOI, ADCIONA A NOTA AO ALUNO
        $prova = $this->model->setTable('prova_curso')->get($id);

        if (!$prova) return false;

        $exercicios = $this->model->setTable('prova_exercicios')->getKey('id_prova', $id);

        if (!$exercicios) return false;

        $provaFim = $this->model->setTable('provaFinalizada')
        ->where('id_prova', $id)
        ->where('id_aluno', $this->session->userdata('id'))
        ->fetch('array');

        if ($provaFim) return $provaFim; //caso a prova ja tenha sido concluída e o registro já exista, retorna esse registro

        $achou = true;
        $somatorio = 0;
        foreach($exercicios as $ex){
            //VERIFICANDO SE O EXERCÍCIO ESTA FEITO PELO ALUNO
            // @TABLE = prova_aluno
            // @params
            #id_aluno - id do aluno
            #id_prova - id da prova
            #pos - id do exercício
            $feitos = $this->model->setTable('prova_aluno')
            ->where('id_aluno', $this->session->userdata('id'))
            ->where('id_prova', $id)
            ->where('pos', $ex['id'])
            ->fetch('array');

            //Caso o exercício esteja feito (seja encontrado na tabela)
            if ($feitos){
                $escolhas = json_decode($ex['escolhas'], true); //recebe os dados das escolhas possíveis
                foreach($escolhas as $e){ //interagindo por cada escolha possível
                    if ($e['correta']){
                        if ($e['letra'] == $feitos[0]['letra']){ //caso essa seja a escolha correta e o aluno tenha a selecionado
                            $this->model->update('prova_aluno', ['nota' => $ex['val_nota'] ], $feitos[0]['id']);
                            $somatorio += $ex['val_nota'];
                            break;
                        } else { //caso contrário
                            $this->model->update('prova_aluno', ['nota' => 0 ], $feitos[0]['id']);
                            break;
                        }
                    }
                }
            } else {
                //se existe pelo menos 1 exercício que não foi encontrado como feito pelo aluno, define a variável como false
                $achou = false;
            }
        }

        if ($achou){ //caso todos os exercícios tenham sido feitos pelo aluno, registra a nota e a prova finalizada.
            $this->model->insere('provaFinalizada', [
                'id_aluno' => $this->session->userdata('id'),
                'id_prova' => $id,
                'nota' => $somatorio
            ]);
            return true;
        }
        return false;
    }

    /*
        Salva a escolha do aluno no exercício,
        caso ela já exista, apenas a retorna
        @TABLE = prova_aluno
        @params
            #id_aluno - id do aluno
            #id_prova - id da prova
            #pos - id do exercício
    */
    protected function setTarAluno(int $id, int $pos, array $tarAln, int $id_curso, string $letra){
        foreach($tarAln as $tal){
            if ($tal['id_prova'] == $id && $tal['id_curso'] == $id_curso && $tal['pos'] == $pos){
                return $tarAln[0];
            }
        }

        $arr = [
            'id_aluno' => $this->session->userdata('id'),
            'id_prova' => $id,
            'id_curso' => $id_curso,
            'letra' => $letra,
            'pos' => $pos
        ];
        return $this->model->insere('prova_aluno', $arr);
    }

    /*
        Inicia a resposta do aluno à algum exercício \/
    */
    protected function responder(array $val, array $tarAln, int $id_curso){
        if (isset($val['id']) && !empty($val['id'])){
            $exercicios = $this->model->selecionaBusca('prova_exercicios', "WHERE `id_prova`='{$val['id']}' ");
            
            if (!$exercicios) return false;

            if ($this->setTarAluno($val['id'], $val['pos'], $tarAln, $id_curso, $val['letra'])){
                return $this->model->selecionaBusca('prova_aluno', "WHERE `id_prova`='{$val['id']}' AND `id_aluno`='".$this->session->userdata('id')."' ");
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
        

        $data['tarefa'] = $this->model->selecionaBusca('prova_curso', "WHERE `id`='{$id}' ");
        $data['tarAln'] = $this->model->selecionaBusca('prova_aluno', "WHERE `id_prova`='{$id}' AND `id_aluno`='".$this->session->userdata('id')."' ");
        
        if (isset($data['tarefa'][0]['id'])) {
            $data['tarAln'] = $this->responder($arr, $data['tarAln'], $data['tarefa'][0]['id_curso']);
            
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['tarefa'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $data['nota_final'] = $this->verifyNota($id);
                if ($data['nota_final']){
                    gera_aviso('success', 'Prova finalizada.', 'ead/cursos/'.$data['cur'][0]['id'].'-'.rawurlencode($data['cur'][0]['nome']));
                } else {
                    $data['professor'] = $this->model->getDataCourse('professor', 'id', $data['cur'][0]['id_professor']);
                    $data['modalidade'] = $this->model->getDataCourse('modalidade', 'id', $data['cur'][0]['id_modalidade']);
                    $exercicios = $this->model->selecionaBusca('prova_exercicios', "WHERE `id_prova`='{$id}' ");
                    $data['tarefa'][0]['exercicios'] = [];
                    for ($i = 0; $i < count($exercicios); $i++) {
                        $arraynv = array(
                            'id' => $exercicios[$i]['id'],
                            'n_questao' => $exercicios[$i]['n_questao'],
                            'questao' => $exercicios[$i]['questao'],
                            'val_nota' => $exercicios[$i]['val_nota'],
                            'escolhas' => json_decode($exercicios[$i]['escolhas'], true)
                        );
                        $data['tarefa'][0]['exercicios'][] = $arraynv;
                    }
                    
                    $this->load->view('ead/provas/visualizar', $data);
                }
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'ead/cursos/meusCursos');
            }
        } else {
            gera_aviso('erro', 'Prova não encontrada.', 'ead/cursos/meusCursos');
        }
    }
}
