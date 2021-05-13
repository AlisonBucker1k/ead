<?php
function includesModais($search){
    $searcher = 'ead';
    $CI = &get_instance();
    if ($CI->session->userdata('nivel_adm') == 1){
        $searcher = 'admin';
    } else if ($CI->session->userdata('nivel_prof') == 1){
        $searcher = 'professor';
    }
    return ROOT_PATH . '/assets/includes/'.$searcher.'/modais/modal_'.$search.'.php';
}

function checaIncludes()
{
    if (checaRotaTem('cursos/aulas')){
        return includesModais('aulas');
    } else if (checaRotaTem('cursos/tarefas/cadastrar') || checaRotaTem('cursos/tarefas/editar')){
        return includesModais('tarefas');
    } else if (checaRotaTem('cursos/provas')){
        return includesModais('provas');
    } else if (checaRotaTem('rede/configuracoes')){
        return includesModais('configuracoes');
    } else if (checaRotaTem('rede/planos')){
        return includesModais('planos');
    } else if (checaRotaTem('rede/')){
        return includesModais('relatorio_balanco');
    } else if (checaRotaTem('admin/fornecedores')){
        return includesModais('fornecedores');
    } else if (checaRotaTem('admin/servicos')){
        return includesModais('servicos');
    }
    return '';
}