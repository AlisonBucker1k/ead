<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saques_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    protected $table = "pedido_saque";

    public function concluidos(){
        return $this->queryString("SELECT 
            saque.id,
            saque.id_aluno,
            saque.status, 
            saque.valor,
            saque.taxa,
            saque.dados_pagamento,
            saque.comprovante,
            saque.criado_em,
            saque.pago_em,
            aluno.nome,
            aluno.login,
            aluno.nome,
            aluno.email,
            aluno.telefone,
            aluno.cpf
            FROM pedido_saque AS saque INNER JOIN aluno AS aluno ON aluno.id = saque.id_aluno
            WHERE status='concluido' ");
    }

    public function abertos(){
        return $this->queryString("SELECT 
            saque.id,
            saque.id_aluno,
            saque.status, 
            saque.valor,
            saque.taxa,
            saque.dados_pagamento,
            saque.criado_em,
            saque.pago_em,
            aluno.nome,
            aluno.login,
            aluno.nome,
            aluno.email,
            aluno.telefone,
            aluno.cpf
            FROM pedido_saque AS saque INNER JOIN aluno AS aluno ON aluno.id = saque.id_aluno
            WHERE status='aberto' ");
    }
}