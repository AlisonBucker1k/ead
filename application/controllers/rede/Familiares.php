<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Familiares extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_rede') == '') {
            redirect('rede/login');
        }
    }

    public function listar()
    {
        $data['dependentes'] = $this->model->selecionaBusca('dependente', "WHERE id_familia='{$this->session->userdata('id')}' ");
        foreach($data['dependentes'] as $k => $dep){
            $aluno = $this->model->selecionaBusca('aluno', "WHERE id='{$dep['id_aluno']}' ");
            if ($aluno){
                $data['dependentes'][$k]['aluno'] = $aluno[0];
            }
        }

        $this->load->view('rede/dependentes/listar', $data);
    }

    public function cadastrar()
    {
        $familiares = $this->model->selecionaBusca('dependente', "WHERE id_familia='{$this->session->userdata('id')}' ");
        $num = count($familiares);

        if ($num >= 3) gera_aviso('erro', 'Você já possui 3 dependentes cadastrados.', 'rede/dependentes/listar');

        $data['estados'] = $this->model->selecionaBusca('estados', "");
        $data['cidades'] = $this->model->selecionaBusca('cidades', "");
        $this->load->view('rede/dependentes/cadastrar', $data);
    }

    public function insere(){
        $familiares = $this->model->selecionaBusca('dependente', "WHERE id_familia='{$this->session->userdata('id')}' ");
        $num = count($familiares);

        if ($num >= 3) {
            gera_aviso('erro', 'Você já possui 3 dependentes cadastrados.', 'rede/dependentes/listar');
        } else {
            $dtnasc = $this->input->post('data_nascimento', TRUE);
            $idade = getIdade($dtnasc);
            
            if (intval($idade) > 16) {
                gera_aviso('erro', 'Você só pode inserir dependentes até os 16 anos de idade!', 'rede/dependentes/listar');
                return '';
            }
                
            $data = returnArray('aluno');

            if (!loginValidator($data['login'])){
                gera_aviso('erro', 'O login não pode ter espaços em branco nem caracteres especiais.', 'rede/dependentes/cadastrar');
                return '';
              }
          
              $args = [
                [
                  'row' => 'login',
                  'op' => '=',
                  'value' => $data['login']
                ],
                [
                  'row' => 'cpf',
                  'op' => '=',
                  'value' => $data['cpf']
                ]
              ];
          
              if (!checa_ja_cadastrado($args)) {
                gera_aviso('erro', 'Já existe um usuário com esse login ou CPF / CNPJ, tente novamente.', 'rede/dependentes/cadastrar');
                return '';
              }

            $idusuario = $this->model->insere_id('aluno', $data);
            if ($idusuario){
                $exp = explode('/', $dtnasc);
                $nsc = isset($exp[2]) ? $exp[2].'-'.$exp[1].'-'.$exp[0] : $dtnasc;
                $nvarr = [
                    'id_familia' => $this->session->userdata('id'),
                    'id_aluno' => $idusuario,
                    'nascimento' => $nsc
                ];
                $this->model->insere('dependente', $nvarr);
                gera_aviso('success', 'Dependente inserido com sucesso!', 'rede/dependentes/listar');
            } else {
                gera_aviso('erro', 'Falha ao inserir dependente, tente novamente!', 'rede/dependentes/listar');
            }
        }
        gera_aviso('erro', 'Falha ao inserir dependente, tente novamente!', 'rede/dependentes/listar');
    }

    public function remover($id){
        $dep = $this->model->selecionaBusca('dependente', "WHERE id_familia='{$this->session->userdata('id')}' AND id='{$id}' ");

        if (!$dep) gera_aviso('erro', 'Dependente não encontrado!', 'rede/dependentes/listar');

        $aluno = $this->model->selecionaBusca('aluno', "WHERE id='{$dep[0]['id_aluno']}' ");

        if ($aluno){
            $this->model->remove('aluno', $aluno[0]['id']);
        }
        $this->model->remove('dependente', $id);

        gera_aviso('success', 'Dependente removido com sucesso.', 'rede/dependentes/listar');
    }
}
