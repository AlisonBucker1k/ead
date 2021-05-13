<?php
//RECEBER ULTIMO ALUNO CADASTRADO
function get_last_user(){
    $CI = &get_instance();

    return $CI->model->selecionaBusca('aluno', "ORDER BY id_niveis DESC LIMIT 1");
}

//RECEBER ULTIMO ID DE REDE CADASTRADO
function get_last_user_id(){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "ORDER BY id_niveis DESC LIMIT 1");
    return ($aluno) ? $aluno[0]['id_niveis'] : '';
}

//RECEBER ULTIMO ALUNO CADASTRADO EM RELAÇÃO A UM ID DE ALUNO
function get_last_user_relative($id){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id}' ");
    if ($aluno) return $CI->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '{$aluno[0]['id_niveis']}%' ORDER BY id_niveis DESC LIMIT 1");
    return array();
}

//RECEBER ULTIMO ID DE REDE CADASTRADO EM RELAÇÃO A UM ID DE ALUNO
function get_last_user_id_relative($id){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id}' ");
    if ($aluno){
        $check = $CI->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '{$aluno[0]['id_niveis']}%' ORDER BY id_niveis DESC LIMIT 1");
        return ($check) ? $check[0]['id_niveis'] : '';
    }
    
    return '';
}

//RECEBER ULTIMO ALUNO CADASTRADO EM RELAÇÃO A UM ID DE REDE
function get_last_user_rel($id_niveis){
    $CI = &get_instance();
    return $CI->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '{$id_niveis}%' ORDER BY id_niveis DESC LIMIT 1");
}

//RECEBER ULTIMO ID DE REDE CADASTRADO EM RELAÇÃO A UM ID DE REDE
function get_last_user_id_rel($id_niveis){
    $CI = &get_instance();
    $check = $CI->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '{$id_niveis}%' ORDER BY id_niveis DESC LIMIT 1");
    return ($check) ? $check[0]['id_niveis'] : '';
}


//Busca o ultimo cadastro válido do id de rede atual
function get_valid_last($id_niveis, $lengthat=null){
    $CI = &get_instance();
    
    $lengthat = isset($lengthat) ? $lengthat + 1 : strlen($id_niveis) + 1;

    $busca = $CI->model->selecionaBusca('aluno', "WHERE id_niveis LIKE '{$id_niveis}%' AND LENGTH(id_niveis) = $lengthat ORDER BY id_niveis DESC LIMIT 1");
    if (!$busca) {
        $append = $id_niveis;
        for ($i=strlen($id_niveis); $i<$lengthat; $i++){
            $append .= '1';
        }
        return $append;
    }

    $substr = str_replace_first($id_niveis, '', $busca[0]['id_niveis']);

    $length = strlen($substr);
    $lC = $substr[$length - 1];
    if ($length == 1 && $lC == 5){
        return get_valid_last($id_niveis, $lengthat);
    } else {
        for ($i=$length -1; $i>=0; $i--){
            
            $v = intval($substr[$i]);
            if ($v < 5){
                $v++;
                $string = $substr;
                $string[$i] = $v;
                for ($j=$i+1; $j<$length; $j++){
                    $string[$j] = 1;
                }
                return $id_niveis.$string;
            }
        }
        return get_valid_last($id_niveis, $lengthat);
    }
    return false;
}

//Busca o próximo nível do usuário a ser cadastrado baseado no ID de usuário
function buscarNivel($id_usuario){
    $CI = &get_instance();
    $user = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_usuario}' ");
    if (!$user) return false;

    return get_valid_last($user[0]['id_niveis']);
}


//Salva relatório de erros em alguma função
function errorCallback($callback, $descricao){
    $CI = &get_instance();
    $arr = [
        'descricao' => $descricao,
        'callback' => $callback
    ];
    $CI->model->insere('relatorio_erros', $arr);
}

/* RETORNA USUÁRIOS ATIVOS NO NÍVEL INFORMADO */
function searchActivesByLevel($id_aluno, $nivel = 1){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_aluno}' ");
    if (isset($aluno[0]['id'])){
        $lenghter = strlen($aluno[0]['id_niveis']);
        $lenbusca = $lenghter+$nivel;
        $searcherNv = 'AND LENGTH(id_niveis) = '.$lenbusca;
        $retorno = $CI->model->selecionaBusca("aluno",
        "WHERE id_niveis LIKE '".$aluno[0]['id_niveis']."%'
        AND id_niveis != '".$id_aluno."'
        AND ativo = '1'
        ".$searcherNv);
        return $retorno;
    }
    return false;
}

/* RETORNA USUÁRIOS ATIVOS ATÉ O NÍVEL INFORMADO ABAIXO DO ALUNO */
function searchActives($id_aluno, $nivel = 0){
    $CI = &get_instance();
    $aluno = $CI->model->selecionaBusca('aluno', "WHERE id='{$id_aluno}' ");
    if (isset($aluno[0]['id'])){
        $lenghter = strlen($aluno[0]['id_niveis']);
        $lenbusca = $lenghter+$nivel;
        $searcherNv = ($nivel != 0) ? 'AND LENGTH(id_niveis) <= '.$lenbusca : "";
        $retorno = $CI->model->selecionaBusca("aluno",
        "WHERE id_niveis LIKE '".$aluno[0]['id_niveis']."%'
        AND id_niveis != '".$id_aluno."'
        AND ativo = '1'
        ".$searcherNv);
        return $retorno;
    }
    return false;
}

/* RETORNA A PORCENTAGEM DE GANHO DE 1 ALUNO BASEADO EM 1 REGRA INSERIDA NO BANCO DE DADOS */
/* FORMATO DA REGRA DEVE SER 
    n_ativos => NUMERO DE ATIVOS QUE O USUÁRIO PRECISA TER
    ganho_pct => GANHO EM PORCENTAGEM CASO A REGRA SEJA CUMPRIDA
*/
function verifyCond($rules, $id_aluno){
    $CI = &get_instance();
    $indicados = $CI->db->query("SELECT id FROM aluno WHERE id_indicador='{$id_aluno}' ")->num_rows();
    $returnpct = 0;
    foreach($rules as $rule){
        if ($rule['n_ativos'] <= $indicados && $rule['ganho_pct'] > $returnpct){
            $returnpct = $rule['ganho_pct'];
        }
    }
    return $returnpct;
}