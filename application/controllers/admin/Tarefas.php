<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarefas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_adm') != 1) {
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
            $data['usuarios'] = $this->model->selecionaBusca("tarefa_curso", "WHERE `id_curso`='" . $idd . "' ORDER BY id DESC ");

            foreach ($data['usuarios'] as $key => $value) {
                $data['usuarios'][$key]['n_tarefas'] = $this->db->query("SELECT id FROM tarefa_exercicios WHERE id_tarefa='" . $value['id'] . "' ")->num_rows();
            }
            $this->load->view('admin/cursos/listar_tarefas', $data);
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
        }
    }


    public function cadastrar($id)
    {
        if (!buscaPermissao('curso', 'cadastro')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $exploder = explode('-', $id);
        $idd = isset($exploder[1]) ? $exploder[0] : $id;
        $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $idd . "' ");
        if (isset($data['cur'][0]['id'])) {
            $data['scriptFooter'] = 'initializeQuill();';
            $this->load->view('admin/cursos/cadastrar_tarefa', $data);
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
        }
    }

    public function editar($id)
    {
        if (!buscaPermissao('curso', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $data['tarefa'] = $this->model->selecionaBusca('tarefa_curso', "WHERE `id`='{$id}' ");
        if (isset($data['tarefa'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['tarefa'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
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
                $data['scriptFooter'] = 'initializeQuill();';
                $this->load->view('admin/cursos/editar_tarefa', $data);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'admin/cursos');
        }
    }

    public function ativar($id)
    {
        if (!buscaPermissao('curso', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $data['tarefa'] = $this->model->selecionaBusca('tarefa_curso', "WHERE `id`='{$id}' ");
        if (isset($data['tarefa'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['tarefa'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $nvarr['ativo'] = 1;
                $this->model->update('tarefa_curso', $nvarr, $id);

                gera_aviso('success', 'Tarefa ativada com sucesso.', 'admin/cursos/tarefas/' . $data['cur'][0]['id'] . '-' . $data['cur'][0]['nome']);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'admin/cursos');
        }
    }

    public function desativar($id)
    {
        if (!buscaPermissao('curso', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $data['tarefa'] = $this->model->selecionaBusca('tarefa_curso', "WHERE `id`='{$id}' ");
        if (isset($data['tarefa'][0]['id'])) {
            $data['cur'] = $this->model->selecionaBusca("curso", "WHERE `id`='" . $data['tarefa'][0]['id_curso'] . "' ");
            if (isset($data['cur'][0]['id'])) {
                $nvarr['ativo'] = 0;
                $this->model->update('tarefa_curso', $nvarr, $id);

                gera_aviso('success', 'Tarefa desativada com sucesso.', 'admin/cursos/tarefas/' . $data['cur'][0]['id'] . '-' . $data['cur'][0]['nome']);
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'admin/cursos');
        }
    }

    //INSERÇÃO E UPDATE
    public function inserir($id_curso)
    {
        if (!buscaPermissao('curso', 'cadastro')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $id_curso . "' ");
        if (isset($curso[0]['id'])) {
            $tarefa['id_curso'] = $id_curso;
            $tarefa['nome'] = $this->input->post('nome');
            $tarefa['ativo'] = ($this->input->post('ativo')) ? 1 : 0;
            $data_limite = $this->input->post('data_limite');
            if (!empty($data_limite)) {
                $tarefa['data_limite'] = formataDataInsert($data_limite);
            }

            $questoes = $this->input->post('id_questoes');

            if (isset($questoes[0]) && !empty($questoes[0])) {
                $data['questoes'] = [];

                $id_tarefa = $this->model->insere_id('tarefa_curso', $tarefa);

                if ($id_tarefa) {
                    $n_questao = 1;
                    foreach ($questoes as $quest) {
                        $exercicio['id_tarefa'] = $id_tarefa;
                        $exercicio['questao'] = $this->input->post('questao_' . $quest);
                        $exercicio['explicacao'] = $this->input->post('explicacao_' . $quest);
                        $exercicio['n_questao'] = $n_questao;
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
                        $this->model->insere('tarefa_exercicios', $exercicio);
                        $n_questao++;
                    }
                    gera_aviso('sucesso', 'Tarefa inserida com sucesso!', 'admin/cursos/tarefas/' . $id_curso . '-' . $curso[0]['nome']);
                } else {
                    gera_aviso('erro', 'Falha ao inserir tarefa, tente novamente.', 'admin/cursos/tarefas/' . $id_curso . '-' . $curso[0]['nome']);
                }
            } else {
                gera_aviso('erro', 'É necessário cadastrar ao menos uma questão para inserir uma tarefa.', 'admin/cursos/tarefas/' . $id_curso . '-' . $curso[0]['nome']);
            }
        } else {
            gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
        }
    }

    public function update($id)
    {
        if (!buscaPermissao('curso', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $tarefaSrc = $this->model->selecionaBusca('tarefa_curso', "WHERE `id`='" . $id . "' ");
        if (isset($tarefaSrc[0]['id'])) {
            $id_curso = $tarefaSrc[0]['id_curso'];
            $curso = $this->model->selecionaBusca('curso', "WHERE `id`='" . $id_curso . "' ");
            if (isset($curso[0]['id'])) {
                $tarefa['nome'] = $this->input->post('nome');
                $tarefa['ativo'] = ($this->input->post('ativo')) ? 1 : 0;
                $data_limite = $this->input->post('data_limite');
                if (!empty($data_limite)) {
                    $tarefa['data_limite'] = formataDataInsert($data_limite);
                } else {
                    $tarefa['data_limite'] = null;
                }

                $questoes = $this->input->post('id_questoes');

                if (isset($questoes[0]) && !empty($questoes[0])) {
                    $data['questoes'] = [];

                    $id_tarefa = $id;
                    $this->model->update('tarefa_curso', $tarefa, $id_tarefa);
                    $this->model->removeKey('tarefa_exercicios', 'id_tarefa', $id_tarefa);
                    if ($id_tarefa) {
                        $n_questao = 1;
                        foreach ($questoes as $quest) {
                            $exercicio['id_tarefa'] = $id_tarefa;
                            $exercicio['questao'] = $this->input->post('questao_' . $quest);
                            $exercicio['explicacao'] = $this->input->post('explicacao_' . $quest);
                            $exercicio['n_questao'] = $n_questao;
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
                            $this->model->insere('tarefa_exercicios', $exercicio);
                            $n_questao++;
                        }
                        gera_aviso('sucesso', 'Tarefa atualizada com sucesso!', 'admin/cursos/tarefas/editar/' . $id);
                    } else {
                        gera_aviso('erro', 'Falha ao atualizar tarefa, tente novamente.', 'admin/cursos/tarefas/editar/' . $id);
                    }
                } else {
                    gera_aviso('erro', 'É necessário enviar ao menos uma questão para atualizar a tarefa.', 'admin/cursos/tarefas/editar/' . $id);
                }
            } else {
                gera_aviso('erro', 'Curso não encontrado.', 'admin/cursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'admin/cursos');
        }
    }

    public function remover($id)
    {
        if (!buscaPermissao('curso', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $admin = $this->model->selecionaBusca("tarefa_curso", "WHERE `id`='{$id}' ");
        if (isset($admin[0]['id'])) {
            if ($this->model->remove("tarefa_curso", $id)) {
                $crs = $this->model->selecionaBusca("curso", "WHERE `id`='{$admin[0]['id_curso']}' ");
                $this->model->removeKey('tarefa_exercicios', 'id_tarefa', $id);

                addRegistro("Removeu a tarefa " . $admin[0]['nome'] . ' <br/>' . print_r($admin, true));
                gera_aviso('sucesso', 'Tarefa removida com sucesso.', 'admin/cursos/tarefas/' . $crs[0]['id'] . '-' . $crs[0]['nome']);
            } else {
                gera_aviso('erro', 'Erro ao remover a tarefa.', 'admin/cursos');
            }
        } else {
            gera_aviso('erro', 'Tarefa não encontrada.', 'admin/cursos');
        }
    }
}
