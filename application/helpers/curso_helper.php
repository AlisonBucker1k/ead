<?php

function getTipoUser(){
    $CI = get_instance();
    if ($CI->session->userdata('nivel_adm') == 1){ 
        return 'admin'; 
    } else if ($CI->session->userdata('nivel_prof') == 1){
        return 'professor';
    }
    return 'aluno';
}

function getCursos(){
    $CI = get_instance();
    return $CI->model->selecionaBusca('curso', "");
}

function deldir($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            deldir( $file );      
        }

        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

function get_url($id, $nome, $arquivo)
{
    return $arquivo != 'padrao.jpg' ? site_url('uploads/curso/' . $id . '-' . rawurlencode($nome) . '/' . rawurlencode(str_replace(' ', '_', $arquivo))) : site_url('uploads/curso/padrao.jpg');
}

function get_url_h($id, $nome, $arquivo)
{
    return ROOT_PATH . '/uploads/curso/' . $id . '-' . $nome . '/' . $arquivo;
}

function get_up_path_aula($id, $id_aula, $nome)
{
    return './uploads/curso/' . $id . '-' . $nome . '/aula-' . $id_aula . '/';
}

// function get_up_path_aula_download($id, $id_aula, $nome, $file)
// {
//     return 'uploads/curso/' . $id . '-' . rawurlencode(str_replace(' ', '_', $nome)) . '/aula-' . $id_aula . '/'.rawurlencode(str_replace(' ', '_', $file));
// }

function get_up_root_path_aula($id, $id_aula, $nome)
{
    return ROOT_PATH . '/uploads/curso/' . $id . '-' . $nome . '/aula-' . $id_aula . '/';
}

function get_url_aula($id, $id_aula, $nome, $arquivo)
{
    return site_url('uploads/curso/' . $id . '-' . rawurlencode($nome) . '/aula-' . $id_aula . '/' . rawurlencode(str_replace(' ', '_', $arquivo)));
}

function get_url_h_aula($id, $id_aula, $nome, $arquivo)
{
    return ROOT_PATH . '/uploads/curso/' . $id . '-' . $nome . '/aula-' . $id_aula . '/' . $arquivo;
}

// function checaRotaTem($val, $unique=false)
// {
//     $rotaAtual = uri_string();
//     if ($unique){
//         $exploder = explode('/', $rotaAtual);
//         foreach($exploder as $exp){
//             if ($exp == $val){
//                 return true;
//             }
//         }
//     } else {
//         if (strpos($rotaAtual, $val) !== false) {
//             return true;
//         }
//     }
//     return false;
// }

// function includesModais($search){
//     $searcher = 'aluno';
//     $CI = get_instance();
//     if ($CI->session->userdata('nivel_adm') == 1){
//         $searcher = 'admin';
//     } else if ($CI->session->userdata('nivel_prof') == 1){
//         $searcher = 'professor';
//     }
//     return ROOT_PATH . '/assets/includes/'.$searcher.'/modais/modal_'.$search.'.php';
// }

// function checaIncludes()
// {
//     if (checaRotaTem('cursos/aulas')){
//         return includesModais('aulas');
//     } else if (checaRotaTem('cursos/tarefas/cadastrar') || checaRotaTem('cursos/tarefas/editar')){
//         return includesModais('tarefas');
//     } else if (checaRotaTem('cursos/provas')){
//         return includesModais('provas');
//     }
//     return '';
// }

function getIndiceF($indice){
    $letras = ['A)', 'B)', 'C)', 'D)', 'E)', 'F)', 'G)', 'H)', 'I)', 'J)', 'K)', 'L)', 'M)', 'N)', 'O)', 'P)', 'Q)', 'R)', 'S)', 'T)', 'U)', 'W)', 'Y)', 'V)', 'X)', 'Z)'];
    $sobra = intval(floatval($indice) / 25);
    if ($sobra <= 0){
        return $letras[$indice];
    }
    $index = $indice - (25 * $sobra);
    $ret = $indice - $index;
    return '' . $ret . $letras[$index];
}

function parseHtml($htm, $parser='"'){
    return str_replace(array('``', '´´'), array($parser, $parser), $htm);
}

function writeTimer(array $curso){
    if ($curso['duracao_hora'] > 0){
        if ($curso['duracao_minutos'] > 0){
            return $curso['duracao_hora'].'h '.$curso['duracao_minutos'].'m';
        } else {
            return $curso['duracao_hora'].' horas';
        }
    } else if ($curso['duracao_minutos'] > 0){
        return $curso['duracao_minutos'].' minutos';
    }
    return 'duração indefinida';
}

function usuarioDependente(){
    $CI = &get_instance();

    $familiar = $CI->model
    ->setTable('dependente')
    ->where('id_aluno', $CI->session->userdata('id'))
    ->fetch('array');

    if (!$familiar) return false;

    $parente = $CI->model
    ->setTable('aluno')
    ->get($familiar[0]['id_familia']);

    if (!$parente || $parente[0]['tipo'] != 'rede' || $parente[0]['ativo'] == 0 || $parente[0]['bloqueado'] == 1) return false;

    return true;
}

function getTipoLogin(){
    $CI = &get_instance();
    if ($CI->session->userdata('nivel_prof') == 1){
        return 'professor';
    }
    if ($CI->session->userdata('nivel_rede') == 1){
        return 'rede';
    }
    if ($CI->session->userdata('nivel_user') == 1){
        return 'ead';
    }
    return 'admin';
}

function setRedirect($set){
    $CI = &get_instance();
    $setter = getTipoLogin().'/'.$set;
    $CI->session->set_userdata(['redirect' => $set ]);
    return true;
}

function getRedirect($default="index"){
    $CI = &get_instance();
    $default = getTipoLogin().'/'.$default;
    $redirect = $CI->session->userdata('redirect') ?? $default;
    $CI->session->unset_userdata('redirect');
    return $redirect;
}