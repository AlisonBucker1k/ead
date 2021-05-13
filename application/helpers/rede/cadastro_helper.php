<?php
//args = array row, op, value
//exempo: args ['row' => 'login', 'op' => '=', 'value' => 'usuario'];

function containsSub($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

function loginValidator($login){
    $res = preg_replace('/[^a-zA-Z0-9_ -]/s','', $login);
    $res = str_replace(' ', '', $res);
    if ($res !== $login) return false;

    return true;
}

function checa_ja_cadastrado($args){
    $CI = &get_instance();
    foreach($args as $arg){
        $checa1 = $CI->model->selecionaBusca('aluno', "WHERE ".$arg['row']." ".$arg['op']." '".$arg['value']."' ");
        if ($checa1){
            //echo "TEM ALUNO ".$arg['row'].' '.$arg['op'].' '.$arg['value'];
            return false;
        }
        $checa2 = $CI->model->selecionaBusca('aluno_espera', "WHERE ".$arg['row']." ".$arg['op']." '".$arg['value']."' AND gerou_pagamento='1' ");
        if ($checa2){
            //echo "TEM ALUNO ESPERA ".$arg['row'].' '.$arg['op'].' '.$arg['value'];
            return false;
        }
    }
    return true;
}

function checa_ja_cadastrado_multiple($args){
    $CI = &get_instance();
    $searcher = "";
    foreach($args as $arg){
        $searcher .= $searcher != "" ? "AND ".$arg['row']." ".$arg['op']." '".$arg['value']."' " : "WHERE ".$arg['row']." ".$arg['op']." '".$arg['value']."' ";
    }
    $checa1 = $CI->model->selecionaBusca('aluno', $searcher);
    if ($checa1){
        return false;
    }
    $checa2 = $CI->model->selecionaBusca('aluno_espera', $searcher."AND gerou_pagamento='1' ");
    if ($checa2){
        return false;
    }


    return true;
}

/* DESATIVA UM USUÁRIO E GERA UM AVISO DE QUE ELE POSSUI FATURAS EM ATRASO!! */
function desativarUsuario($id, $id_fatura){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id}' ");
    if (!$aluno) return false;

    $newarr = ['bloqueado' => 1];
    $CI->model->update('aluno', $newarr, $id);
    $newAviso = [
        'id_aluno' => $id,
        'titulo' => '<i class="fa fa-ban"></i> Fatura em atraso',
        'texto' => 'Por possuir pendências em sua conta, seu acesso ao ead e à diversas sessões da rede foram bloqueados. 
        Para voltar a usufruir de todas as vantagens da KEROSER, por favor, regularize sua conta!<br/><br/>
        <span class="text-muted">Você pode pagar sua fatura clicando no botão abaixo!<span><br/>
        <a href="'.site_url('rede/pagarFatura/'.$id_fatura).'"><button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Pagar Fatura</button></a>',
        'delete_on_read' => 1
    ];
    $CI->model->insere('aviso_aluno', $newAviso);
    return true;
}