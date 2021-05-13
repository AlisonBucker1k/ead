<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mensagens extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('nivel_adm') != 1) {
            redirect('admin/login');
        } else if (!buscaPermissao('mensagens')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
        }

        $this->load->model('Mensagens_model', 'msg');
    }

    public function index()
    {
        $mensagens = $this->msg->all();
        $this->load->view('admin/mensagens/index', [
            'mensagens' => $mensagens
        ]);
    }

    public function cadastrar()
    {
        if (!buscaPermissao('mensagens', 'cadastro')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $this->load->view('admin/mensagens/cadastrar');
    }

    public function editar($id)
    {
        if (!buscaPermissao('mensagens', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $mensagem = $this->msg->get($id);
        $this->load->view('admin/mensagens/editar', [
            'mensagem' => $mensagem
        ]);
    }

    # DESATIVA A MENSAGEM ATUALMENTE ATIVADA (CASO EXISTA) PARA QUE NÃO APARECA PARA OS ALUNOS DO AVA
    protected function desativaMsgAtual()
    {
        $mensagem = $this->msg->where('ativa', 1)->fetch();
        if ($mensagem) {
            return $this->msg->atualiza(['ativa' => 0], $mensagem[0]->id);
        }
        return true;
    }

    # ATIVA A MENSAGEM ENVIADA PARA QUE APAREÇA PARA OS ALUNOS DO AVA
    protected function ativaMsgAtual($id)
    {
        return $this->msg->atualiza(['ativa' => 1], $id);
    }

    #INSERE UMA MENSAGEM NOVA PARA OS ALUNOS DO AVA
    public function insert()
    {
        if (!buscaPermissao('mensagens', 'cadastro')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $new = [
            'titulo' => $this->input->post('titulo'),
            'texto' => $this->input->post('texto'),
            'ativa' => ($this->input->post('ativa')) ? 1 : 0
        ];
        if ($new['ativa'] == 1) {
            $this->desativaMsgAtual();
        }
        if ($this->msg->insert($new)) {
            addRegistro("Cadastrou uma mensagem do AVA:<br/>" . print_r($new, true));
            gera_aviso('sucesso', 'Mensagem cadastrada com sucesso.', 'admin/mensagens');
        } else {
            gera_aviso('erro', 'Falha ao inserir os dados, tente novamente.', 'admin/mensagens');
        }
    }

    #ATUALIZA UMA MENSAGEM PARA OS ALUNOS DO AVA
    public function update($id)
    {
        if (!buscaPermissao('mensagens', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $new = [
            'titulo' => $this->input->post('titulo'),
            'texto' => $this->input->post('texto'),
            'ativa' => ($this->input->post('ativa')) ? 1 : 0
        ];
        if ($new['ativa'] == 1) {
            $this->desativaMsgAtual();
        }
        if ($this->msg->atualiza($new, $id)) {
            addRegistro("Atualizou a mensagem do AVA #".$id.":<br/>" . print_r($new, true));
            gera_aviso('sucesso', 'Mensagem atualizada com sucesso.', 'admin/mensagens/editar/' . $id);
        } else {
            gera_aviso('erro', 'Falha ao atualizar os dados, tente novamente.', 'admin/mensagens/editar/' . $id);
        }
    }

    #CHAMADA DE ATIVAÇÃO DE UMA MENSAGEM DO AVA
    public function activate($id)
    {
        if (!buscaPermissao('mensagens', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        if ($this->ativaMsgAtual($id)) {
            gera_aviso('sucesso', 'Mensagem ativada com sucesso.', 'admin/mensagens');
        } else {
            gera_aviso('erro', 'Falha ao ativar a mensagem, tente novamente.', 'admin/mensagens');
        }
    }

    #CHAMADA DE DESATIVAÇÃO DE UMA MENSAGEM DO AVA
    public function deactivate()
    {
        if (!buscaPermissao('mensagens', 'editar')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        if ($this->desativaMsgAtual()) {
            gera_aviso('sucesso', 'Mensagem desativada com sucesso.', 'admin/mensagens');
        } else {
            gera_aviso('erro', 'Falha ao desativar a mensagem, tente novamente.', 'admin/mensagens');
        }
    }

    #REMOVE UMA MENSAGEM
    public function remove($id)
    {
        if (!buscaPermissao('mensagens', 'remover')) {
            gera_aviso('erro', 'Ação não permitida!', 'admin/index');
            exit;
        }
        $mensagem = $this->msg->get($id);

        if ($mensagem && $this->msg->delete($id)) {
            addRegistro("Removeu a mensagem do AVA #".$id);
            gera_aviso('sucesso', 'Mensagem removida com sucesso.', 'admin/mensagens');
        } else {
            gera_aviso('erro', 'Falha ao remover mensagem, tente novamente.', 'admin/mensagens');
        }
    }
}
