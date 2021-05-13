<?php
//pega o saldo do aluno
function getSaldo($id_aluno)
{
    $CI = &get_instance();
    $saldo = $CI->model->selecionaBusca('saldo_usuario', "WHERE `id_aluno`='{$id_aluno}' ");
    if ($saldo) {
        return $saldo[0];
    } else {
        $newsaldo = array(
            'id_aluno' => $id_aluno,
            'saldo' => 0
        );
        $id_saldo = $CI->model->insere_id('saldo_usuario', $newsaldo);
        if ($id_saldo) {
            $newsaldo['id'] = $id_saldo;
            return $newsaldo;
        }
    }
    return false;
}

//Adcionar entrada no balanço
function addBalanco($id_aluno, $valor, $id_plano, $financa, $tipo, $descricao=null)
{
    $CI = &get_instance();
    $checker = $CI->model->selecionaBusca('balanco', "WHERE id_aluno='{$id_aluno}' AND financa='{$financa}' AND tipo='{$tipo}' AND descricao IS NULL 
    AND criado_em >= '".date('Y-m-d 00:00:00')."' AND criado_em <= '".date('Y-m-d 23:59:59')."' ");
    //verifica se já existe 1 balanço desse tipo no dia e, se tiver, adciona o valor a ele.
    if ($checker){
        $nvarr = [
            'valor' => $checker[0]['valor'] + $valor,
        ];

        return $CI->model->update('balanco', $nvarr, $checker[0]['id']);
    }
    
    $nvarr = [
        'id_aluno' => $id_aluno,
        'financa' => $financa,
        'valor' => $valor,
        'tipo' => $tipo
    ];

    if (isset($id_plano)){
        $nvarr['id_plano'] = $id_plano;
    }
    if (isset($descricao)){
        $nvarr['descricao'] = $descricao;
    }
    return $CI->model->insere('balanco', $nvarr);
}

//adciona valor a uma assinatura
function addGanhoAssinatura($id_aluno, $val){
    $CI = &get_instance();
    $assinatura = $CI->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='{$id_aluno}' ");
    if (!$assinatura) return false;

    $nvarr = [
        'recebido' => $assinatura[0]['recebido'] + $val
    ];
    return $CI->model->update('assinaturas_rede', $nvarr, $assinatura[0]['id']);
}

//subtrai valor de uma assinatura
function subGanhoAssinatura($id_aluno, $val){
    $CI = &get_instance();
    $assinatura = $CI->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='{$id_aluno}' ");
    if (!$assinatura) return false;

    $nvarr = [
        'recebido' => $assinatura[0]['recebido'] - $val
    ];
    return $CI->model->update('assinaturas_rede', $nvarr, $assinatura[0]['id']);
}

//Adcionar saldo ao aluno
function addSaldo($id_aluno, $valor, $id_plano=null, $tipo='')
{
    $CI = &get_instance();
    $saldo = getSaldo($id_aluno);
    if (!$saldo) return false;

    $nvSaldo = [ 'saldo' => $saldo['saldo'] + $valor ];

    if ($CI->model->update('saldo_usuario', $nvSaldo, $saldo['id'])){
        if (isset($id_plano) && $tipo != '') {
            if ($tipo == 'residual' || $tipo == 'carreira'){
                addGanhoAssinatura($id_aluno, $valor);
            }
            return addBalanco($id_aluno, $valor, $id_plano, 'entrada', $tipo);
        }
        return true;
    }
    return false;
}

//Subtrair saldo do aluno
function subSaldo($id_aluno, $valor, $id_plano=null, $tipo='')
{
    $CI = &get_instance();
    $saldo = getSaldo($id_aluno);
    if (!$saldo) return false;

    $nvSaldo = [ 'saldo' => $saldo['saldo'] - $valor ];

    if ($CI->model->update('saldo_usuario', $nvSaldo, $saldo['id'])){
        if (isset($id_plano) && $tipo != ''){
            if ($tipo == 'residual' || $tipo == 'carreira'){
                subGanhoAssinatura($id_aluno, $valor);
            }
            return addBalanco($id_aluno, $valor, $id_plano, 'saida', $tipo);
        }
        return true;
    }
    return false;
}


//Checa as pendencias do aluno
function checarPendencias($id_aluno){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_aluno}' ");
    $assinatura = $CI->model->selecionaBusca('assinaturas_rede', "WHERE id_aluno='{$id_aluno}' ");
    $config = $CI->model->selecionaBusca('configuracoes', "");
    if (!$aluno) return false;

    if (!$assinatura) return false;

    if (!$config) return false;

    $max_vencimento = subDataDias($config[0]['tempo_desativar_usuario']);
    $faturas_vencidas = $CI->model->selecionaBusca('faturas', "WHERE paga='0' AND vencimento < '{$max_vencimento}' ");
    
    if (count($faturas_vencidas) > 0){
        $alnarr = [
            'bloqueado' => 1
        ];

        $CI->model->update('aluno', $alnarr, $id_aluno);

        $arrass = [
            'status' => 'inativo'
        ];

        $CI->model->update('assinaturas_rede', $arrass, $assinatura[0]['id']);
    } else {
        $alnarr = [
            'bloqueado' => 0
        ];

        $CI->model->update('aluno', $alnarr, $id_aluno);

        $arrass = [
            'status' => 'ativo'
        ];

        $CI->model->update('assinaturas_rede', $arrass, $assinatura[0]['id']);
    }
}