<?php
function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

function getIdString($s){
    if (strpos($s, '-') === false) return $s;

    return explode('-', $s)[0];
}


/* =============================================================================================================== */
/* GERADOR DE ERROS GERAIS */
/* PASSAR MENSAGEM DE ERRO OU DEIXAR A MSG PADRÃO */
# SEGUNDO CAMPO É O RETORNO DA FUNÇÃO < DEFAULT: FALSE >
function throwError($msgErro = "Um erro inesperado ocorreu.", $retorno=false){
    $CI = &get_instance();
    $CI->session->set_flashdata(array('aviso_tipo' => 1, 'aviso_mensagem' => $msgErro));
    return $retorno;
}
// ====================================================================================================================

function formataCPF($cpf){
    $newcpf = preg_replace("[^0-9]","", $cpf);
    $concat = substr_replace($newcpf, '.', 3, 0);
    $concat = substr_replace($concat, '.', 7, 0);
    $concat = substr_replace($concat, '-', 11, 0);
    return $concat;
}

function formataTel($tel){
    $newtel = preg_replace("[^0-9]","", $tel);
    $concat = '';
    if (strlen($newtel) >= 10){
        $concat2 = strlen($newtel) - 1;
        $newtel = '('.$newtel;
        $concat = substr_replace($newtel, ') ', 3, 0);
        $concat = substr_replace($concat, '-', $concat2, 0);
    } else {
        $concat2 = strlen($newtel) - 4;
        $concat = substr_replace($newtel, '-', $concat2, 0);
    }
    return $concat;
}

function formataCep($cep){
    $newcep = preg_replace("[^0-9]","", $cep);
    $concat2 = strlen($newcep) - 3;
    $concat = substr_replace($newcep, '-', $concat2, 0);
    return $concat;
}

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
}

function gera_aviso($tipo, $mensagem, $redirect)
{
    $CI = get_instance(); //precisa disso aqui pq dentro do helper n���o funciona $this, dai ao inves de $this vc usa $CI->mimimi

    $CI->session->set_flashdata(array('aviso_tipo' => $tipo, 'aviso_mensagem' => $mensagem));

    redirect($redirect);
}

function formataNome($nome)
{
    $exp = explode(' ', $nome);
    return isset($exp[0]) ? $exp[0] : $nome;
}

function RandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function checaRotaTem($val, $unique=false)
{
    $rotaAtual = uri_string();
    if ($unique){
        $exploder = explode('/', $rotaAtual);
        foreach($exploder as $exp){
            if ($exp == $val){
                return true;
            }
        }
    } else {
        if (strpos($rotaAtual, $val) !== false) {
            return true;
        }
    }
    return false;
}

function RandomStringMaiusculas($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function dateDiffInDays($date1, $date2)
{
    // Calculating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1);

    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400));
}

function selecionaProx($id, $dir)
{
    $CI = get_instance();
    $usuario = $CI->model->selecionaBusca("usuario", "WHERE `id_link`='{$id}' AND `perna`='{$dir}' ");
    return $usuario;
}

function contains($str, $arr)
{
    foreach ($arr as $a) {
        if (stripos($str, $a) !== false) return true;
        if (stripos($str, ucfirst($a)) !== false) return true;
    }
    return false;
}

function verifDataPossui($dt, $format=true){
    if (isset($dt) && !empty($dt) && $dt != '0000-00-00 00:00:00'){
        return $format ? formataData($dt) : $dt;
    } else {
        return "Não possui";
    }
}

function formataData($dt, $seconds = false, $minutes = true){
    if (strpos($dt, ' ') !== false){
        $obj = explode(' ', $dt);
        $news = explode('-', $obj[0]);

        if ($seconds){
            return $news[2].'/'.$news[1].'/'.$news[0].' '.$obj[1];
        }

        if ($minutes){
            $hhmm = explode(':', $obj[1]);
            return $news[2].'/'.$news[1].'/'.$news[0].' '.$hhmm[0].':'.$hhmm[1];
        } else {
            return $news[2].'/'.$news[1].'/'.$news[0];
        }
    }

    $news = explode('-', $dt);
    return $news[2].'/'.$news[1].'/'.$news[0];
}

function formataDataBL($dt){
    if (strpos($dt, ' ') !== false){
        $obj = explode(' ', $dt);
        $news = explode('-', $obj[0]);
        return $news[2].'/'.$news[1].'/'.$news[0].'<br/>'.$obj[1];
    }

    $news = explode('-', $dt);
    return $news[2].'/'.$news[1].'/'.$news[0];
}

function formataDataInsert($dt){
    if (strpos($dt, ' ') !== false){
        $obj = explode(' ', $dt);
        $news = explode('/', $obj[0]);

        $exploder2 = explode(':', $obj[1]);
        if (count($exploder2) == 3){
            return $news[2].'-'.$news[1].'-'.$news[0].' '.$obj[1];
        } else {
            return $news[2].'-'.$news[1].'-'.$news[0].' '.$exploder2[0].':'.$exploder2[1].':00';
        }
    }

    $news = explode('/', $dt);
    return $news[2].'-'.$news[1].'-'.$news[0];
}

function temPermissao($n)
{
    $CI = get_instance();
    $permissoes = explode(';', $CI->session->userdata('permissoes'));
    if (isset($permissoes[$n]) && $permissoes[$n] == 1) {
        return true;
    }
    return false;
}

function retorna_permissao($n)
{
    switch ($n) {
        case 0:
            return "Visualizar Conteudo";
            break;
        case 1:
            return "Notificacao Popup";
            break;
        case 2:
            return "Editar Conteudos";
            break;
        case 3:
            return "Aceitar Saques";
            break;
        case 4:
            return "Cadastrar / Editar Administradores";
            break;
    }
}

function retorna_perms_cor($n)
{
    switch ($n) {
        case 0:
            return "<b>Visualizar Conteudo</b>";
            break;
        case 1:
            return "<b class='text-info'>Notificacao Popup</b>";
            break;
        case 2:
            return "<b class='text-primary'>Editar Conteudos</b>";
            break;
        case 3:
            return "<b class='text-secondary'>Aceitar Saques</b>";
            break;
        case 4:
            return "<b class='text-danger'>Cadastrar / Editar Administradores</b>";
            break;
    }
}


function addTimeData($data, $val, $time = 'dia')
{
    $writer = 'days';
    if ($time == 'hora' || $time == 'h') {
        $writer = 'hours';
    } else if ($time == 'min' || $time == 'mm') {
        $writer = 'minutes';
    } else if ($time == 'seg' || $time == 'ss') {
        $writer = 'seconds';
    } else if ($time == 'mes' || $time == 'M') {
        $writer = 'months';
    } else if ($time == 'ano' || $time == 'A') {
        $writer = 'years';
    }
    $start = new DateTimeImmutable($data);
    $datetime = $start->modify('+' . $val . ' ' . $writer);
    return $datetime->format('Y-m-d H:i:s');
}

function removerDir($dir){
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? removerDir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

function inserir_obj($tabela, $post)
{
    $CI = &get_instance();
    $fields = $CI->db->list_fields($tabela);
    $insere = array();
    foreach ($fields as $field) {
        if (isset($post[$field])) {
            if ($field == "senha") {
                $options = array("cost" => 4);
                $senhahash = password_hash($post[$field], PASSWORD_BCRYPT, $options);
                $insere[$field] = $senhahash;
            } else {
                $insere[$field] = $post[$field];
            }
        } else if (strpos($field, "arquivos") !== false || 
        strpos($field, "imagens") !== false || 
        strpos($field, "fotos") !== false || 
        strpos($field, "foto") !== false || 
        strpos($field, "imagem") !== false || 
        strpos($field, "arquivo") !== false || 
        strpos($field, "capa") !== false ||
        strpos($field, "caminho") !== false || 
        strpos($field, "ficha_tecnica") !== false
        || strpos($field, "thumb") !== false) {
            $tipouser =  'aluno/';
            $idadd = 1;
            if ($tabela == 'admin') {
                $lastid = $CI->model->queryString("SELECT id FROM `admin` ORDER BY id DESC LIMIT 1");
                $idadd = isset($lastid[0]['id']) ? $lastid[0]['id'] + 1 : $idadd;
                $tipouser =  'admin/';
                $insere['id'] = $idadd;
            } else if ($tabela == 'professor') {
                $tipouser =  'professor/';
                $lastid = $CI->model->queryString("SELECT id FROM `professor` ORDER BY id DESC LIMIT 1");
                $idadd = isset($lastid[0]['id']) ? $lastid[0]['id'] + 1 : $idadd;
                $insere['id'] = $idadd;
            } else if ($tabela == "aluno"){
                $lastid = $CI->model->queryString("SELECT id FROM `aluno` ORDER BY id DESC LIMIT 1");
                $idadd = isset($lastid[0]['id']) ? $lastid[0]['id'] + 1 : $idadd;
                $insere['id'] = $idadd;
            } else if ($tabela == 'curso') {
                $tipouser =  'curso/';
                $lastid = $CI->model->queryString("SELECT id FROM `curso` ORDER BY id DESC LIMIT 1");
                $idadd = isset($lastid[0]['id']) ? $lastid[0]['id'] + 1 : $idadd;
                $insere['id'] = $idadd;
            } else {
                $idadd = 0;
            }
            
            $idpasta = $idadd != 0 ? $idadd : $CI->session->userdata('id');
            $nompasta = isset($post['login']) ? rawurlencode($post['login']) : rawurlencode($CI->session->userdata('login'));
            if ($tabela == 'curso'){
                $nompasta = $post['nome'];
            }


            $folder = ROOT_PATH . '/uploads/' . $tipouser . '/' . $idpasta . '-' . $nompasta . '/';
            $uploadpath = './uploads/' . $tipouser . '/' . $idpasta . '-' . $nompasta . '/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx';
            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);
            if ($CI->upload->do_upload($field)) {
                $data = array('arquivo_data' => $CI->upload->data());
                $insere[$field] = $data['arquivo_data']['file_name'];
            } else {
                $insere[$field] = "padrao.jpg";
            }
        }
    }
    //print_r($insere);
    $att = $CI->model->insere_id($tabela, $insere);
    return $att;
}

function atualizar_obj($tabela, $post, $id, $key = "id")
{
    $CI = &get_instance();
    $fields = $CI->db->list_fields($tabela);
    $insere = array();
    $anterior = $CI->model->selecionaBusca($tabela, "WHERE `" . $key . "`='{$id}' ");
    foreach ($fields as $field) {
        if (isset($post[$field])) {
            if ($field == "senha") {
                if ($post[$field] != "") {
                    $options = array("cost" => 4);
                    $senhahash = password_hash($post[$field], PASSWORD_BCRYPT, $options);
                    $insere[$field] = $senhahash;
                }
            } else {
                $insere[$field] = $post[$field];
            }
        } else if (strpos($field, "arquivos") !== false 
        || strpos($field, "imagens") !== false 
        || strpos($field, "fotos") !== false 
        || strpos($field, "foto") !== false 
        || strpos($field, "imagem") !== false 
        || strpos($field, "arquivo") !== false 
        || strpos($field, "caminho") !== false 
        || strpos($field, "ficha_tecnica") !== false
        || strpos($field, "capa") !== false
        || strpos($field, "thumb") !== false) {
            $tipouser =  'aluno/';
            $idadd = $id;
            if ($tabela == 'admin') {
                $tipouser =  'admin/';
            } else if ($tabela == 'professor') {
                $tipouser =  'professor/';
            } else if ($tabela == 'curso') {
                $tipouser =  'curso/';
            }
            $idpasta = $idadd != 0 ? $idadd : $CI->session->userdata('id');
            $nompasta = isset($post['login']) ? rawurlencode($post['login']) : rawurlencode($CI->session->userdata('login'));
            if ($tabela == 'curso'){
                $idpasta = $anterior[0]['id'];
                $nompasta = $post['nome'];
            }

            $folder = ROOT_PATH . '/uploads/' . $tipouser . '/' . $idpasta . '-' . $nompasta . '/';
            $uploadpath = './uploads/' . $tipouser . '/' . $idpasta . '-' . $nompasta . '/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $config['upload_path'] = $uploadpath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx';
            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);
            if ($CI->upload->do_upload($field)) {
                $data = array('arquivo_data' => $CI->upload->data());
                $insere[$field] = $data['arquivo_data']['file_name'];
                //if (isset($anterior[0][$field]) && !empty($anterior[0][$field]) && $anterior[0][$field] != $data['arquivo_data']['file_name']) {
                    //if ($tabela != 'curso'){
                        //$path = $folder . $anterior[0][$field];
                        //unlink($path);
                    //} else {
                        //$path = get_url($id, $anterior[0]['nome'], $anterior[0]['capa']);
                        //unlink($path);
                   // }
                //}
            } else if ($tabela == 'curso') {
                if ($anterior[0]['nome'] != $post['nome']){
                    try{
                        rename(get_url_h($id, $anterior[0]['nome'], $anterior[0]['capa']), $folder.'/'.$anterior[0]['capa']);
                     } catch (Exception $e){
                     }
                }
            }
        }
    }
    //print_r($insere);
    $att = $CI->model->updateKey($tabela, $insere, $key, $id);
    return $att;
}

function returnPath($imagem)
{
    if ($imagem != "padrao.jpg"){
        $CI = &get_instance();
        $tipouser =  'aluno/';
        if ($CI->session->userdata('nivel_adm') == 1) {
            $tipouser =  'admin/';
        } else if ($CI->session->userdata('nivel_prof') == 1) {
            $tipouser =  'professor/';
        }
        return site_url('uploads/' . $tipouser . '/' . $CI->session->userdata('id') . '-' . rawurlencode($CI->session->userdata('login')) . '/' . $imagem);
    } else {
        return site_url('assets/imagens/padrao.jpg');
    }
}

function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);
    if($result !== FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getImgPerf($imagem)
{
    $img = returnPath($imagem);
    if (!checkRemoteFile($img)){
        $img = site_url('uploads/'.$imagem);
        if (!checkRemoteFile($img)){
            $img = site_url('assets/imagens/padrao.jpg');
        }
    }
    return $img;
}

function returnPath2($imagem, $path, $id, $login)
{
    if ($imagem != "padrao.jpg" && $imagem != ""){
        $CI = &get_instance();
        $tipouser =  $path.'/';
        return site_url('uploads/' . $tipouser . '/' . $id . '-' . rawurlencode($login) . '/' . $imagem);
    } else {
        return site_url('assets/imagens/padrao.jpg');
    }
}

function addRegistro($acao)
{
    $CI = get_instance();
    $reg = array(
        'id_admin' => $CI->session->userdata('id'),
        'acao' => $acao
    );
    $CI->model->insere('registro_admin', $reg);
}
