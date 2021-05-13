<?php

/* =====================================================================================================================

CONFIGURAÇÃO
DE PAGAMENTO JUNO

CASO DESEJE PÔR EM PRODUÇÃO / SANDBOX, BASTA MUDAR A VARIÁVEL ENV:
PRODUÇÃO = 
$arr[
    'env' => "producao"
]

SANDBOX = 
$arr [
    'env' => "sandbox"
]
 */
function configJuno($tipo)
{
    $arr = [
        'ipn_url' => site_url('rede/pagamentos/ipn'), //url de ipn
        'tipo' => $tipo, //Tipo da compra
        'descricao_cadastro' => "Pagamento inicial do plano {val}",
        'descricao_faturas' => "Pagamento mensal do plano {val}",
        'referencia' => 'aluno_espera',
        'clientId_producao' => "5C0GtIvmNqJA3sng", //clientID juno
        'clientSecret_producao' => "@gO=]aF3>fz~u*pqiW~Ac_k&uzSKK1Ob", //clientSecret juno
        'clientId_sandbox' => 'Bt98cM2ybi8MKIzc', //clientID juno SANDBOX
        'clientSecret_sandbox' => '#UVF!wXw<VSryB#+!x1dm-$ja*Rc>+7*', //Secret juno SANDBOX
        'resource_token_sandbox' => '3D8147991DAD51EAAF26D1B81D9CAA2C5A5583A504D0D835FB03D6B338842B7A', //token de recursos sandbox
        'resource_token_producao' => '478CE04F65813B2E04A05628C1063EDC5A78A6DA61335D13AD7BA7E77F41177B', //token de recursos produção
        'url_sandbox' => "https://sandbox.boletobancario.com", //urlSandbox
        'url_producao' => "https://api.juno.com.br", //urlProducao
        //'env' => 'producao'
        'env' => 'sandbox' //ambiente (sandbox ou producao)
    ];
    if ($tipo != 'cadastro'){
        $arr['referencia'] = 'faturas';
    }
    return $arr;
}
/* GERADOR DE ERROS DA CONEXÃO */
function errorHandler($request = null, $msgPadrao = "Um erro ocorreu, tente novamente"){
    $CI = &get_instance();
    if (isset($request->details[0]->message)){
        $CI->session->set_flashdata(array('aviso_tipo' => 1, 'aviso_mensagem' => $request->details[0]->message));
        return false;
    }
    if (isset($request->details->message)){
        $CI->session->set_flashdata(array('aviso_tipo' => 1, 'aviso_mensagem' => $request->details->message));
        return false;
    }
    $CI->session->set_flashdata(array('aviso_tipo' => 1, 'aviso_mensagem' => $msgPadrao));
    return false;
}
/* VERIFICADOR DE ERROS NA REQUEST */
function checkErrors($request){
    if (isset($request->details[0]->message)){
        return errorHandler($request);
    }
    if (isset($request->details->message)){
        return errorHandler($request);
    }
    return true;
}

//RETORNA A AUTORIZAÇÃO EM BASE 64
function returnAuthorization($config)
{
    return base64_encode($config['clientId_' . $config['env']] . ':' . $config['clientSecret_' . $config['env']]);
}

//RETORNA A DATA FORMATADA DE VALIDADE DO TOKEN
function expireTime($time)
{
    $dateNow = new DateTime();
    $dateNow->setTimezone(new DateTimeZone('America/Sao_Paulo'));
    $dateNow->add(new DateInterval('PT' . $time . 'S'));
    return $dateNow->format('Y-m-d H:i:s');
}

//SALVA O TOKEN NA DATABASE E NA SESSION
function storeToken($token)
{
    $CI = &get_instance();
    if ($token->access_token != '') {
        $ntoken = [
            'token' => $token->access_token,
            'expira' => expireTime($token->expires_in)
        ];
        $busca = $CI->model->selecionaBusca('token_juno', "");
        if ($busca){
            $CI->model->update('token_juno', $ntoken, $busca[0]['id']);
        } else {
            $CI->model->insere('token_juno', $ntoken);
        }
        $CI->session->set_userdata(['token_juno' => $token->access_token]);
        return true;
    }
    return false;
}

//PEGA O TOKEN PADRÃO
function getToken()
{
    $CI = &get_instance();
    $token = $CI->session->userdata('token_juno');
    if ($token != '') {
        return $token;
    }
    return false;
}

//PEGA O TOKEN DE RESOURCE
function getResourceToken($config)
{
    return $config['resource_token_' . $config['env']];
}

//VERIFICA SE O TOKEN ESTÁ NA DATABASE E SE ELE AINDA NÃO EXPIROU
function getDBtoken()
{
    $CI = &get_instance();
    $token = $CI->model->selecionaBusca('token_juno', "WHERE `expira`<='" . date('Y-m-d H:i:s') . "' ");
    if ($token) {
        return $token[0];
    }
    return null;
}

//conexão com a API da juno
function conectaJuno($config)
{
    $CI = &get_instance();
    $token = getDBtoken();
    
    if ($token && $token['expira'] >= date('Y-m-d H:i:s')) {
        $CI->session->set_userdata(['token_juno' => $token['token']]);
        return true;
    }

    $auth = returnAuthorization($config);
    $url = $config['url_' . $config['env']] . '/authorization-server/oauth/token';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic {$auth}"
    ]);
    $result = curl_exec($ch);
    $result = json_decode($result);
    if (isset($result->access_token)) {
        return storeToken($result);
    }
    errorHandler($result);
    return false;
}


//CHECA SE EXISTE WEBHOOK DE PAGAMENTO NA RESPOSTA
function checkIfPayment($result){
    if (isset($result->_embedded->webhooks[0]->id)){
        foreach($result->_embedded->webhooks as $hook){
            foreach($hook->eventTypes as $event){
                if ($event->name == "PAYMENT_NOTIFICATION"){
                    return true;
                }
            }
        }
    }
    return false;
}

//CHECA SE O WEBHOOK EXISTE
function checaWebHooks($config)
{
    $authToken = getToken();
    $token = getResourceToken($config);
    if ($token) {
        $url = $config['url_' . $config['env']] . '/api-integration/notifications/webhooks';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-Api-Version: 2",
            "X-Resource-Token: " . $token,
            "Authorization: Bearer {$authToken}"
        ]);
        $result = curl_exec($ch);
        $result = json_decode($result);
        return checkIfPayment($result);
    }
    errorHandler(null, "Erro de conexão com a juno, tente novamente mais tarde!<br/>código do erro WHX0001");
    return false;
}

//INSERIR WEBHOOK CASO NÃO EXISTA
function insertWebHooks($config)
{
    $authToken = getToken();
    $token = getResourceToken($config);
    if ($token) {
        $eventTypes = [
            "PAYMENT_NOTIFICATION",
            "DOCUMENT_STATUS_CHANGED",
            "DIGITAL_ACCOUNT_STATUS_CHANGED",
            "TRANSFER_STATUS_CHANGED",
            "P2P_TRANSFER_STATUS_CHANGED",
            "CHARGE_STATUS_CHANGED"
        ];
        $data = [
            'url' => $config['ipn_url'],
            'eventTypes' => $eventTypes
        ];
        $url = $config['url_' . $config['env']] . '/api-integration/notifications/webhooks';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "charset:UTF-8",
            "X-Api-Version: 2",
            "X-Resource-Token: " . $token,
            "Authorization: Bearer {$authToken}"
        ]);
        $result = curl_exec($ch);
        $result = json_decode($result);


        return checkErrors($result);
    }
    errorHandler(null, "Erro de conexão com a juno, tente novamente mais tarde!<br/>código do erro IHX0001");
    return false;
}

//VERIFICA SE A COBRANÇA FOI EFETUADA E RETORNA A URL DE CHECKOUT CASO TUDO TENHA OCORRIDO BEM
function verifyCobranca($resposta){
    if (!isset($resposta->_embedded->charges[0]->id)){
        errorHandler($resposta, "Erro de conexão com a juno, tente novamente mais tarde!<br/>código do erro VCX0001");
        return false;
    }
    $cobranca = $resposta->_embedded->charges[0];
    if (isset($cobranca->checkoutUrl)){
        return $cobranca->checkoutUrl;
    }
    return false;
}

//GERA UMA COBRANÇA JUNO
function geraCobranca($config, $id, $value, $description, $vencimento, $comprador)
{
    $authToken = getToken();
    $token = getResourceToken($config);
    if ($token) {
        $charge = [
            'description' => $description,
            'amount' => floatval($value),
            'references' => [ $config['referencia'].'-'.$id],
            'dueDate' => $vencimento,
            'maxOverdueDays' => 5,
            'paymentTypes' => ["BOLETO","CREDIT_CARD"]
        ];
        $billing = [
            'name' => $comprador['nome'],
            'document' => $comprador['cpf'],
            'email' => $comprador['email'],
            'phone' => $comprador['telefone'],
            'notify' => true
        ];
        $dataPost = [
            'charge' => $charge,
            'billing' => $billing
        ];

        $url = $config['url_' . $config['env']] . '/api-integration/charges';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataPost));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "charset:UTF-8",
            "X-Api-Version: 2",
            "X-Resource-Token: " . $token,
            "Authorization: Bearer {$authToken}"
        ]);
        $result = curl_exec($ch);
        
        
        $result = json_decode($result);
        return verifyCobranca($result);
    }
    return false;
}

/* =====================================================================================================================

GERADOR DE PAGAMENTOS
GERA UM PAGAMENTO JUNO

PARÂMETROS: 
id = id do usuário ou da fatura,
valor = valor do plano / fatura,
nome_plano = nome do plano,
vencimento = data de vencimento da fatura (CINCO DIAS),
comprador = ARRAY DE DADOS DO USUÁRIO -> $this->model->selecionaBusca('aluno', "WHERE id=$id")[0];
tipo = "cadastro", "mensalidade"
redirect = link de redirecionamento de erros

As configurações são definidas baseadas no tipo de pagamento =========
PARA PRODUÇÃO / DEV, BASTA MUDAR O ENV NA FUNÇÃO configJuno.
 */
function gerarPagamentoJuno($id, $valor, $nome_plano, $vencimento, $comprador, $tipo = 'cadastro')
{
    $config = configJuno($tipo);
    
    if (!conectaJuno($config)) {
        return false;
    }
    if (!checaWebHooks($config)){
        insertWebHooks($config);
    }
    $descricao = str_replace('{val}', $nome_plano, $config['descricao_'.$tipo]);
    return geraCobranca($config, $id, $valor, $descricao, $vencimento, $comprador);
}
