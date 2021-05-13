<?php
/* ENVIA O EMAIL PARA QUALQUER OBJETO */
function sendEmailObj($obj, $titulo, $texto){
    $CI = &get_instance();

    if (isset($obj['email'])){
        $CI->submail->enviar($obj['email'], $titulo, $texto, $obj['login']);
        return true;
    }

    if (isset($obj[0]['email'])){
        $CI->submail->enviar($obj[0]['email'], $titulo, $texto, $obj[0]['login']);
        return true;
    }

    return false;
}


/* ENVIAR EMAIL PARA ALUNOS */
function sendEmailAluno($aluno, $titulo, $texto){
    $CI = &get_instance();

    if (isset($aluno['email']) && isset($aluno['cpf'])){
        return sendEmailObj($aluno['email'], $titulo, $texto);
    }

    if (isset($aluno[0]['email']) && isset($aluno[0]['cpf'])){
        return sendEmailObj($aluno[0]['email'], $titulo, $texto);
    }

    return false;
}


/* ENVIAR EMAIL PARA ADMINISTRADORES */
function sendEmailAdmin($admin, $titulo, $texto){
    $CI = &get_instance();

    if (isset($admin['email'])){
        return sendEmailObj($admin['email'], $titulo, $texto);
    }

    if (isset($admin[0]['email'])){
        return sendEmailObj($admin[0]['email'], $titulo, $texto);
    }

    return false;
}