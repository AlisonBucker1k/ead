<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pagamentos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //TRANSFORMA O CADASTRO TEMPORÁRIO DE ALUNO EM PERMANENTE CASO O PAGAMENTO TENHA SIDO EFETUADO COM SUCESSO.
    protected function cadastrarAluno($id){
        $dados = $this->model->selecionaBusca('aluno_espera', "WHERE `id`='{$id}' ");
        if (!$dados) return false;

        $arr = $dados[0];
        unset($arr['gerou_pagamento']);
        unset($arr['id']);
        $id_niveis = buscarNivel($arr['id_indicador']);
        $plano = $this->model->selecionaBusca('plano_rede', "WHERE id='{$arr['id_plano']}' ");
        unset($arr['id_plano']);
        $arr['tipo'] = 'rede';
        
        if (!$plano) return false;
        if (!$id_niveis) return false;

        $arr['id_niveis'] = $id_niveis;
        $idusuario = $this->model->insere_id('aluno', $arr);
        if ($idusuario){
            $this->model->insere('assinaturas_rede', [
                'id_aluno' => $idusuario, 
                'id_plano' => $plano[0]['id'], 
                'valor' => $plano[0]['valor'],
                'pago' => $plano[0]['valor'],
                'recebido' => 0,
                'status' => 'ativo',
                'data_pagamento_inicial' => date('Y-m-d H:i:s')
            ]);
            return $this->model->remove('aluno_espera', $dados[0]['id']);
        }
        return false;
    }

    //DEFINE A FATURA COMO PAGA CASO O PAGAMENTO SEJA EFETUADO COM SUCESSO.
    protected function pagarFatura($id_ipn, $id){
        
        $dados = $this->model->selecionaBusca('faturas', "WHERE `id`='{$id}' ");
        
        if (!$dados) return false;

        $ass = $this->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='{$dados[0]['id_aluno']}' ");

        if (!$ass) return false;


        $nvarr = ['pagamento' => date('Y-m-d H:i:s'), 'paga' => 1, 'custom' => $id_ipn];
        $valpaid = $ass[0]['pago'] + $dados[0]['valor'];
        $nvarr2 = ['pago' => $valpaid ];
        if ($this->model->update('faturas', $nvarr, $id)){
            $this->model->update("assinaturas_rede", $nvarr2, $ass[0]['id']);

            checarPendencias($dados[0]['id_aluno']); //financeiro_helper
        }
    }

    //PAGAMENTO EFETUADO COM SUCESSO.
    protected function paidIpn($id_ipn, $ref)
    {
        $rf = explode('-', $ref);
        if (!isset($rf[1])) return false;

        if ($rf[0] == 'aluno_espera'){
            return $this->cadastrarAluno($rf[1]);
        } else {
            return $this->pagarFatura($id_ipn, $rf[1]);
        }
    }

    //REMOVE O CADASTRO TEMPORÁRIO DE ALUNO CASO O PAGAMENTO SEJA CANCELADO.
    protected function cancelarAluno($id){
        $dados = $this->model->selecionaBusca('aluno_espera', "WHERE `id`='{$id}' ");
        if (!$dados) return false;

        return $this->model->remove('aluno_espera', $id);
    }

    //RESPOSTA CANCELADA NA IPN.
    protected function canceledIpn($ref)
    {
        $rf = explode('-', $ref);
        
        if (!isset($rf[1])) return false;

        if ($rf[0] == 'aluno_espera'){
            return $this->cancelarAluno($rf[1]);
        }
    }

    //RESPOSTA FALHA NA IPN.
    protected function failedIpn($ref)
    {
        $rf = explode('-', $ref);
        if (!isset($rf[1])) return false;

        if ($rf[0] == 'aluno_espera'){
            return $this->cancelarAluno($rf[1]);
        }
    }

    //VERIFICA O CÓDIGO DA IPN
    /* ==================================================================================
    FUNÇÃO QUE TRATA O CÓDIGO IPN RECEBIDO */
    protected function verifyIpnCode($id_ipn, $status, $reference)
    {
        switch ($status) {
            case "PAID":
                return $this->paidIpn($id_ipn, $reference);
                break;
            case "CANCELLED":
                return $this->canceledIpn($reference);
                break;
            case "FAILED":
                return $this->failedIpn($reference);
                break;
            default:
                return true;
        }
    }


    //RETORNO DA IPN
    /* ==================================================================================
    FUNÇÃO QUE RECEBE O RETORNO GERAL DA IPN */
    public function ipn()
    {
        $data['response_json'] = $this->input->raw_input_stream;
        $array = json_decode($data['response_json'], true);
        $data['response_post'] = print_r($array, TRUE);

        if (isset($array['data'][0]['attributes']['status'])) {
            $tipo = $array['eventType'];
            $data['status'] = $array['data'][0]['attributes']['status'];
            $data['reference'] = $array['data'][0]['attributes']['reference'];

            $idipn = $this->model->insere_id('ipn_juno', $data);
            if ($tipo == "CHARGE_STATUS_CHANGED") {
                $this->verifyIpnCode($idipn, $data['status'], $data['reference']);
                //chamando a função de tratamento do status recebido
            }
        }
    }
}
