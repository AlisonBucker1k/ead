<?php
//Gerador de links de cadastros
//RETORNA O LINK O GERANDO CASO ELE AINDA NÃO EXISTA
function geraLinkCadastro($id, $force = false)
{
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id}' ");

    if (!$aluno) return false;

    $aluno = $aluno[0];

    $link = $CI->model->selecionaBusca('link_rede', "WHERE `id_usuario`='{$id}' ");
    if ($link && !$force) {
        return $link[0];
    } else {
        if ($force) {
            $CI->model->removeKey('link_rede', 'id_usuario', $id);
        }
        $token = $id . '_' . urlencode($aluno['login']) . '-'.time();
        $newlink = array(
            'id_usuario' => $id,
            'link' => $token
        );
        if ($CI->model->insere('link_rede', $newlink)) {
            return $newlink;
        }
    }
    return false;
}

//PEGAR O LINK DE CADASTRO DO USUÁRIO DA REDE, CASO NÃO TENHA, CRIA UM NOVO
function getLinkCadastro($id)
{
    $CI = &get_instance();
    $link = $CI->model->selecionaBusca('link_rede', "WHERE `id_usuario`='{$id}' ");
    $resposta = ['tipo' => 1, 'link' => ''];
    if (isset($link[0]['id'])) {
        $resposta = ['tipo' => 0, 'link' => $link[0]['linkCadastro']];
    }
    return $resposta;
}



function newLinkCadastro($id)
{
    $CI = &get_instance();
    $link = geraLinkCadastro($id);
    $resposta = ['tipo' => 1, 'link' => ''];
    if (isset($link[0]['id'])) {
        $resposta = ['tipo' => 0, 'link' => $link[0]['linkCadastro']];
    }
    return $resposta;
}
