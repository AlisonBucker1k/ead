<?php
/* FUNÇÕES DIVERSAS DO USUÁRIO ENTRAM NESSE HELPER */

/* PEGAR ASSINATURA DO USUÁRIO */
function getAssinatura($id_aluno){
    $CI = &get_instance();
    $assinatura = $CI->model->selecionaBusca('assinaturas_rede', "WHERE `id_aluno`='{$id_aluno}' ");
    if (isset($assinatura[0]['id'])){
        $retorno = $assinatura[0];
        $plano = $CI->model->selecionaBusca('plano_rede', "WHERE id='{$assinatura[0]['id_plano']}' ");
        $retorno['plano'] = isset($plano[0]['id']) ? $plano[0] : null;
        return $retorno;
    } else if ($id_aluno == 1){
        return [];
    }
    return null;
}

//PEGA FATURAS DO USUÁRIO
function getFaturas($id_aluno, $tipo='', $vencidas=true){
    $CI = &get_instance();
    
    $querytipo = $tipo !== '' ? "AND `paga`='{$tipo}' " : "";
    $queryvencidas = !$vencidas ? "AND `vencimento`<='".date('Y-m-d H:i:s')."' " : "";

    $faturas = $CI->model->queryString("SELECT 
    fat.id, 
    fat.id_aluno, 
    fat.id_plano, 
    fat.valor, 
    fat.vencimento, 
    fat.custom, 
    fat.paga, 
    fat.pagamento,
    fat.criado_em, 
    fat.ultima_att, 
    pln.nome as nome_plano, 
    pln.descricao as descricao_plano,
    pln.valor as valor_plano,
    pln.criado_em as criado_em_plano,
    pln.ultima_att as ultima_att_plano,
    aln.nome as nome_aluno,
    aln.id_niveis as id_niveis_aluno,
    aln.id_indicador as id_indicador_aluno,
    aln.foto as foto_aluno,
    aln.login as login_aluno,
    aln.email as email_aluno,
    aln.telefone as telefone_aluno,
    aln.cpf as cpf_aluno,
    aln.estado as estado_aluno,
    aln.cidade as cidade_aluno,
    aln.endereco as endereco_aluno,
    aln.numero as numero_aluno,
    aln.bairro as bairro_aluno,
    aln.cep as cep_aluno,
    aln.ativo as ativo_aluno,
    aln.bloqueado as bloqueado_aluno,
    aln.criado_em as criado_em_aluno,
    aln.ultima_att as ultima_att_aluno
    FROM faturas as fat
    JOIN (SELECT * FROM plano_rede ) AS pln ON pln.id = fat.id_plano
    JOIN (SELECT * FROM aluno ) AS aln ON aln.id = fat.id_aluno
    WHERE id_aluno=$id_aluno
    $querytipo
    $queryvencidas ");

    return $faturas;
}

function formatterRede($nivel1, $nivel2, $nivel3){
    $arr['formato'] = [];

    foreach($nivel1 as $nvl){
        $insert = $nvl;
        $insert['nivel_2'] = [];
        $arr['formato'][] = $insert;
    }

    foreach($nivel2 as $k => $v){
        $nivel2[$k]['nivel_3'] = [];
        foreach($nivel3 as $nv3){
            if (startsWith($nv3['id_niveis'], $v['id_niveis'])){
                $nivel2[$k]['nivel_3'][] = $nv3;
            }
        }
    }

    foreach($arr['formato'] as $k => $v){
        foreach($nivel2 as $nv2){
            if (startsWith($nv2['id_niveis'], $v['id_niveis'])){
                $arr['formato'][$k]['nivel_2'][] = $nv2;
            }
        }
    }

    return $arr;
}