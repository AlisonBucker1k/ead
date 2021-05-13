<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Provas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_prof') != 1) {
            redirect('professor/login');
        }
    }

    public function index($id)
    {
        $exploder = explode('-', $id);
        $idd = isset($exploder[1]) ? $exploder[0] : $id;
        $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
        if (isset($data['cur'][0]['id'])) {
            $data['usuarios'] = $this->model->selecionaBusca("prova_curso", "WHERE `id_curso`='" . $idd . "' ORDER BY id DESC ");

            foreach ($data['usuarios'] as $key => $value) {
                $data['usuarios'][$key]['n_provas'] = $this->db->query("SELECT id FROM prova_exercicios WHERE id_prova='" . $value['id'] . "' ")->num_rows();
            }
            $this->load->view('professor/cursos/listar_provas', $data);
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
        }
    }


    public function cadastrar($id)
    {
        $exploder = explode('-', $id);
        $idd = isset($exploder[1]) ? $exploder[0] : $id;
        $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
        if (isset($data['cur'][0]['id'])) {
            $data['scriptFooter'] = 'initializeQuill();';
            $this->load->view('professor/cursos/cadastrar_prova', $data);
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
        }
    }

    public function editar($id)
    {
        $data['prova'] = $this->model->selecionaBusca('prova_curso', "WHERE `id`='{$id}' ");
        if (isset($data['prova'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['prova'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $exercicios = $this->model->selecionaBusca('prova_exercicios', "WHERE `id_prova`='{$id}' ");
                $data['prova'][0]['exercicios'] = [];
                for ($i = 0; $i < count($exercicios); $i++) {
                    $arraynv = array(
                        'id' => $exercicios[$i]['id'],
                        'val_nota' => $exercicios[$i]['val_nota'],
                        'n_questao' => $exercicios[$i]['n_questao'],
                        'questao' => $exercicios[$i]['questao'],
                        'escolhas' => json_decode($exercicios[$i]['escolhas'], true)
                    );
                    $data['prova'][0]['exercicios'][] = $arraynv;
                }
                $data['scriptFooter'] = 'initializeQuill();';
                $this->load->view('professor/cursos/editar_prova', $data);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
            }
        } else {
            gera_aviso('erro', 'Prova não encontrada.', 'professor/cursos');
        }
    }

    public function ativar($id){
        $data['prova'] = $this->model->selecionaBusca('prova_curso', "WHERE `id`='{$id}' ");
        if (isset($data['prova'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['prova'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $nvarr['ativo'] = 1;
                $this->model->update('prova_curso', $nvarr, $id);

                gera_aviso('success', 'Prova ativada com sucesso.', 'professor/cursos/provas/'.$data['cur'][0]['id'].'-'.$data['cur'][0]['nome']);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
            }
        } else {
            gera_aviso('erro', 'Prova não encontrada.', 'professor/cursos');
        }
    }

    public function desativar($id){
        $data['prova'] = $this->model->selecionaBusca('prova_curso', "WHERE `id`='{$id}' ");
        if (isset($data['prova'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['prova'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $nvarr['ativo'] = 0;
                $this->model->update('prova_curso', $nvarr, $id);

                gera_aviso('success', 'Prova desativada com sucesso.', 'professor/cursos/provas/'.$data['cur'][0]['id'].'-'.$data['cur'][0]['nome']);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
            }
        } else {
            gera_aviso('erro', 'prova não encontrada.', 'professor/cursos');
        }
    }

    //INSERÇÃO E UPDATE
    public function inserir($id_curso)
    {
        $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $id_curso . "' ");
        if (isset($curso[0]['id'])) {
            $prova['id_curso'] = $id_curso;
            $prova['nome'] = $this->input->post('nome');
            $prova['ativo'] = ($this->input->post('ativo')) ? 1 : 0;
            $prova['nota_maxima'] = $this->input->post('nota_maxima');

            $questoes = $this->input->post('id_questoes');

            if (isset($questoes[0]) && !empty($questoes[0])) {
                $data['questoes'] = [];

                $id_prova = $this->model->insere_id('prova_curso', $prova);

                if ($id_prova) {
                    $n_questao = 1;
                    foreach ($questoes as $quest) {
                        $exercicio['id_prova'] = $id_prova;
                        $exercicio['questao'] = $this->input->post('questao_' . $quest);
                        $exercicio['n_questao'] = $n_questao;
                        $exercicio['val_nota'] = $this->input->post('val_nota_' . $quest);
                        $respostas = $this->input->post('respostas_' . $quest);
                        $correta = $this->input->post('resp_correta_' . $quest);

                        $respInsere = [];
                        for ($i = 0; $i < count($respostas); $i++) {
                            $corretaR = $i == $correta ? true : false;
                            $atual = array(
                                'resposta' => $respostas[$i],
                                'correta' => $corretaR,
                                'letra' => getIndiceF($i)
                            );
                            $respInsere[] = $atual;
                        }

                        $exercicio['escolhas'] = json_encode($respInsere);
                        $this->model->insere('prova_exercicios', $exercicio);
                        $n_questao++;
                    }
                    gera_aviso('sucesso', 'prova inserida com sucesso!', 'professor/cursos/provas/' . $id_curso . '-' . $curso[0]['nome']);
                } else {
                    gera_aviso('erro', 'Falha ao inserir prova, tente novamente.', 'professor/cursos/provas/' . $id_curso . '-' . $curso[0]['nome']);
                }
            } else {
                gera_aviso('erro', 'É necessário cadastrar ao menos uma questão para inserir uma prova.', 'professor/cursos/provas/' . $id_curso . '-' . $curso[0]['nome']);
            }
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
        }
    }

    public function update($id)
    {
        $provaSrc = $this->model->selecionaBusca('prova_curso', "WHERE `id`='" . $id . "' ");
        if (isset($provaSrc[0]['id'])) {
            $id_curso = $provaSrc[0]['id_curso'];
            $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $id_curso . "' ");
            if (isset($curso[0]['id'])) {
                $prova['nome'] = $this->input->post('nome');
                $prova['ativo'] = ($this->input->post('ativo')) ? 1 : 0;
                $prova['nota_maxima'] = $this->input->post('nota_maxima');

                $questoes = $this->input->post('id_questoes');

                if (isset($questoes[0]) && !empty($questoes[0])) {
                    $data['questoes'] = [];

                    $id_prova = $id;
                    $this->model->update('prova_curso', $prova, $id_prova);
                    $this->model->removeKey('prova_exercicios', 'id_prova', $id_prova);
                    if ($id_prova) {
                        $n_questao = 1;
                        foreach ($questoes as $quest) {
                            $exercicio['id_prova'] = $id_prova;
                            $exercicio['questao'] = $this->input->post('questao_' . $quest);
                            $exercicio['n_questao'] = $n_questao;
                            $exercicio['val_nota'] = $this->input->post('val_nota_' . $quest);
                            $respostas = $this->input->post('respostas_' . $quest);
                            $correta = $this->input->post('resp_correta_' . $quest);

                            $respInsere = [];
                            for ($i = 0; $i < count($respostas); $i++) {
                                $corretaR = $i == $correta ? true : false;
                                $atual = array(
                                    'resposta' => $respostas[$i],
                                    'correta' => $corretaR,
                                    'letra' => getIndiceF($i)
                                );
                                $respInsere[] = $atual;
                            }

                            $exercicio['escolhas'] = json_encode($respInsere);
                            $this->model->insere('prova_exercicios', $exercicio);
                            $n_questao++;
                        }
                        gera_aviso('sucesso', 'prova atualizada com sucesso!', 'professor/cursos/provas/editar/' . $id);
                    } else {
                        gera_aviso('erro', 'Falha ao atualizar prova, tente novamente.', 'professor/cursos/provas/editar/' . $id);
                    }
                } else {
                    gera_aviso('erro', 'É necessário enviar ao menos uma questão para atualizar a prova.', 'professor/cursos/provas/editar/' . $id);
                }
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'professor/cursos');
            }
        } else {
            gera_aviso('erro', 'prova não encontrada.', 'professor/cursos');
        }
    }

    public function remover($id)
    {
        $admin = $this->model->selecionaBusca("prova_curso", "WHERE `id`='{$id}' ");
        if (isset($admin[0]['id'])) {
            if ($this->model->remove("prova_curso", $id)) {
                $crs = $this->model->selecionaBusca("curso", "WHERE `id`='{$admin[0]['id_curso']}' ");
                $this->model->removeKey('prova_exercicios', 'id_prova', $id);

                addRegistro("Removeu a prova " . $admin[0]['nome'] . ' <br/>' . print_r($admin, true));
                gera_aviso('sucesso', 'prova removida com sucesso.', 'professor/cursos/provas/' . $crs[0]['id'] . '-' . $crs[0]['nome']);
            } else {
                gera_aviso('erro', 'Erro ao remover a prova.', 'professor/cursos');
            }
        } else {
            gera_aviso('erro', 'prova não encontrada.', 'professor/cursos');
        }
    }
}
