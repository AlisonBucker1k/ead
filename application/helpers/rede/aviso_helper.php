<?php

/* AVISOS DA REDE */
function gerarAvisoAluno($id_aluno, $titulo, $texto, $delete_on_read=1, $email=false){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_aluno}' ");

    if (!$aluno){
        throwError("Aluno não encontrado");
        return false;
    } 

    $nvaviso = [
        'id_aluno' => $id_aluno,
        'titulo' => $titulo,
        'texto' => $texto,
        'delete_on_read' => $delete_on_read
    ];

    if ($email){
        sendEmailAluno($aluno, $titulo, $texto);
    }

    return $CI->model->insere('aviso_aluno', $nvaviso);
}


/* AVISOS SOMENTE NO EAD */
function gerarAvisoEAD($id_aluno, $titulo, $texto, $delete_on_read=1, $email=false){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_aluno}' ");

    if (!$aluno){
        throwError("Aluno não encontrado");
        return false;
    } 

    $nvaviso = [
        'id_aluno' => $id_aluno,
        'titulo' => $titulo,
        'texto' => $texto,
        'delete_on_read' => $delete_on_read
    ];

    if ($email){
        sendEmailAluno($aluno, $titulo, $texto);
    }

    return $CI->model->insere('aviso_ead', $nvaviso);
}

function geraModalAviso($titulo, $texto){
    return '<div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titulo-modal-aviso"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;'.$titulo.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            '.$texto.'
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        </div>
            </div>
        </div>
    </div>';
}

function getAvisos($table, $id_aluno){
    $CI = &get_instance();

    $avisos = $CI->model->selecionaBusca($table, "WHERE id_aluno='{$id_aluno}' ORDER BY id DESC LIMIT 1");

    if ($avisos){
        $CI->model->remove($table, $avisos[0]['id']);
        return geraModalAviso($avisos[0]['titulo'], $avisos[0]['texto']);
    }

    return '';
}

function checaAvisos($tipo='', $idref=''){
    switch($tipo){
        case 'rede':
            return getAvisos('aviso_aluno', $idref);
        break;
        case 'ead':
            return getAvisos('aviso_ead', $idref);
        break;
        case 'prof':
            return getAvisos('aviso_prof', $idref);
        break;
        case 'admin':
            return getAvisos('aviso_admin', $idref);
        break;
        default:
    }

    return '';
}