<!doctype html>
<?php 
$entradas[0]['id'] = "cadastrar_plano";
$entradas[0]['header'] = "Função: Cadastrar Plano <font class='text-info'>(ATUALIZADA)</font>";
$entradas[0]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[0]['url'] = 'http://api.agenciazap.com.br/cadastrar_plano';
$entradas[0]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nome, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;valor, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;duracao <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>nome:</b> nome do plano<br/>
                <b>valor:</b> valor em dólares do plano (float)<br/>
                <b>duracao:</b> Duração em dias do plano (int).<br/>
                <hr>';

$entradas[0]['exphp'] = '<textarea readonly rows="27" style="width:100%;">
                      public function cadastrar_plano()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "nome" => "MBM5",
                          "valor" => 50
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/cadastrar_plano");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[0]['exjs'] = '<textarea readonly rows="26" style="width:100%;">
                      function cadastrar_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "nome" : "MBM5",
                            "valor" : 50
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/cadastrar_plano");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[0]['exjq'] = '<textarea readonly rows="31" style="width:100%;">
                      function cadastrar_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "nome" : "MBM5",
                            "valor" : 50
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/cadastrar_plano",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[0]['exrs'] = '<textarea readonly rows="11" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “plano cadastrado com sucesso.”,
                        plano: { 
                          id: 1, 
                          nome: “MBM5”, 
                          valor: “50”
                        }
                      }
                    </textarea>';



$entradas[1]['id'] = "atualiza_plano";
$entradas[1]['header'] = "Função: Atualizar Plano <font class='text-info'>(ATUALIZADA)</font>";
$entradas[1]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[1]['url'] = 'http://api.agenciazap.com.br/atualiza_plano';
$entradas[1]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nome, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;valor, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;duracao <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do plano<br/>
                <b>nome:</b> nome do plano<br/>
                <b>valor:</b> valor em dólares do plano (float)<br/>
                <b>duracao:</b> Duração em dias do plano (int).<br/>
                <hr>';

$entradas[1]['exphp'] = '<textarea readonly rows="27" style="width:100%;">
                      public function atualiza_plano()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1,
                          "valor" => 150
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/atualiza_plano");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[1]['exjs'] = '<textarea readonly rows="26" style="width:100%;">
                      function atualiza_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "valor" : 150
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/atualiza_plano");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[1]['exjq'] = '<textarea readonly rows="31" style="width:100%;">
                      function atualiza_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "valor" : 150
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/atualiza_plano",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[1]['exrs'] = '<textarea readonly rows="13" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “plano atualizado com sucesso.”,
                        plano: { 
                          "id": 1, 
                          "nome": “MBM5”, 
                          "valor": “150”,
                          "criado_em": "2020-02-04 14:00:00",
                          "ultima_att": "2020-02-04 14:05:00"
                        }
                      }
                    </textarea>';


$entradas[2]['id'] = "remove_plano";
$entradas[2]['header'] = "Função: Remover Plano";
$entradas[2]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[2]['url'] = 'http://api.agenciazap.com.br/remove_plano';
$entradas[2]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do plano<br/>
                <hr>';

$entradas[2]['exphp'] = '<textarea readonly rows="27" style="width:100%;">
                      public function remove_plano()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/remove_plano");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[2]['exjs'] = '<textarea readonly rows="26" style="width:100%;">
                      function remove_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/remove_plano");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[2]['exjq'] = '<textarea readonly rows="31" style="width:100%;">
                      function remove_plano(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/remove_plano",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[2]['exrs'] = '<textarea readonly rows="6" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “plano removido com sucesso.”
                      }
                    </textarea>';


$entradas[3]['id'] = "listar_planos";
$entradas[3]['header'] = "Função: Listar Planos";
$entradas[3]['nivel'] = '<b class="text-secondary">Visitante</b>';
$entradas[3]['url'] = 'http://api.agenciazap.com.br/listar_planos';
$entradas[3]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <hr>';

$entradas[3]['exphp'] = '<textarea readonly rows="19" style="width:100%;">
                      public function listar_planos()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/listar_planos");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[3]['exjs'] = '<textarea readonly rows="19" style="width:100%;">
                      function listar_planos(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/listar_planos");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[3]['exjq'] = '<textarea readonly rows="25" style="width:100%;">
                      function listar_planos(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/listar_planos",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[3]['exrs'] = '<textarea readonly rows="15" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        planos: {
                          0 : {
                            "id" : 1,
                            "nome" : "MBM5",
                            "valor" : 150,
                            "criado_em" : "2020-02-04 14:00:00",
                            "ultima_att" : "2020-02-04 14:05:00"
                          }
                        }
                      }
                    </textarea>';



$entradas[4]['id'] = "cadastrar_carteira";
$entradas[4]['header'] = "Função: Cadastrar Carteira";
$entradas[4]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[4]['url'] = 'http://api.agenciazap.com.br/cadastrar_carteira';
$entradas[4]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id_usuario, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;carteira <b class="text-secondary" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id_usuario:</b> id do usuário<br/>
                <b>carteira:</b> carteira do usuário<br/>
                <hr>';

$entradas[4]['exphp'] = '<textarea readonly rows="22" style="width:100%;">
                      public function cadastrar_carteira()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id_usuario" => 1,
                          "carteira" => "X8GAUFH38501HBFGIHAOAJ8781"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/cadastrar_carteira");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[4]['exjs'] = '<textarea readonly rows="22" style="width:100%;">
                      function cadastrar_carteira(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id_usuario" : 1,
                            "carteira" : "X8GAUFH38501HBFGIHAOAJ8781"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/cadastrar_carteira");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[4]['exjq'] = '<textarea readonly rows="28" style="width:100%;">
                      function cadastrar_carteira(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id_usuario" : 1,
                            "carteira" : "X8GAUFH38501HBFGIHAOAJ8781"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/cadastrar_carteira",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[4]['exrs'] = '<textarea readonly rows="14" style="width:100%;">
                      data: {        
                        tipo: “sucesso”,
                        msg: "carteira cadastrada com sucesso.",
                        carteira: {
                           "id" : 1,
                           "id_usuario" : 1,
                           "carteira" : "X8GAUFH38501HBFGIHAOAJ8781",
                           "codigo" : "1BkkPEux1XYaH80c19TfSLUoNQpb6GIvq",
                           "ativa" : 0
                        }
                      }
                    </textarea>';

$entradas[5]['id'] = "remove_carteira";
$entradas[5]['header'] = "Função: Remover Carteira";
$entradas[5]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[5]['url'] = 'http://api.agenciazap.com.br/remove_carteira';
$entradas[5]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id da carteira<br/>
                <hr>';

$entradas[5]['exphp'] = '<textarea readonly rows="27" style="width:100%;">
                      public function remove_carteira()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/remove_carteira");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[5]['exjs'] = '<textarea readonly rows="26" style="width:100%;">
                      function remove_carteira(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/remove_carteira");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[5]['exjq'] = '<textarea readonly rows="31" style="width:100%;">
                      function remove_carteira(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/remove_carteira",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[5]['exrs'] = '<textarea readonly rows="6" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “carteira removida com sucesso.”
                      }
                    </textarea>';

$entradas[6]['id'] = "listar_carteiras";
$entradas[6]['header'] = "Função: Listar Carteiras";
$entradas[6]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[6]['url'] = 'http://api.agenciazap.com.br/listar_carteiras';
$entradas[6]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id_usuario <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário<br/>
                <hr>';

$entradas[6]['exphp'] = '<textarea readonly rows="27" style="width:100%;">
                      public function listar_carteiras()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id_usuario" => 1
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/listar_carteiras");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[6]['exjs'] = '<textarea readonly rows="26" style="width:100%;">
                      function listar_carteiras(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id_usuario" : 1
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/listar_carteiras");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[6]['exjq'] = '<textarea readonly rows="31" style="width:100%;">
                      function listar_carteiras(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id_usuario" : 1
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/listar_carteiras",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[6]['exrs'] = '<textarea readonly rows="17" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        carteiras: {
                          0 : {
                            "id" : 1,
                            "id_usuario": 1,
                            "carteira" : "X8GAUFH38501HBFGIHAOAJ8781",
                            "ativa" : 1,
                            "codigo" : "1BkkPEux1XYaH80c19TfSLUoNQpb6GIvq",
                            "criado_em" : "2020-02-04 14:00:00",
                            "ultima_att" : "2020-02-04 14:05:00"
                          }
                        }
                      }
                    </textarea>';



$entradas[7]['id'] = "listar_ramos";
$entradas[7]['header'] = "Função: Listar Ramos";
$entradas[7]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[7]['url'] = 'http://api.agenciazap.com.br/listar_ramos';
$entradas[7]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;n_ramos, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;modo, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;detalhado <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário<br/>
                <b>n_ramos:</b> número de níveis que serão percorridos após o usuário, por padrão serão retornado todos os níveis abaixo.<br/>
                <b>modo:</b> modo de retorno da resposta (0 ou 1 - PADRÃO 0)<br/><b>0:</b> retorna os usuários de níveis abaixo dentro dos campos "esquerda" e "direita" de cada respectivo usuário acima.<br/>
                <b>qualquer valor diferente de 0:</b> retorna cada usuário separadamente e seus campos "esquerda" e "direita" contem um valor de id do seu respectivo usuário linkado.<br/> 
                <b>detalhado:</b> retorno detalhado ou não dos dados da árvore, o padrão é <font class="text-purple">FALSE</font>, se definido como <font class="text-primary">TRUE</font> os usuários dentro do objeto serão retornados com todos os seus campos do banco de dados; caso contrário, serão retornados apenas<br/><b>nome, email, país, avatar, esquerda, direita de cada usuário.</b>
                <hr>';

$entradas[7]['exphp'] = '<textarea readonly rows="28" style="width:100%;">
                      public function listar_ramos()
                      {
                        $data["data"] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1,
                          "modo" => 1
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init("http://api.agenciazap.com.br/listar_ramos");                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            "Content-Type: application/json",                                                                                
                            "Content-Length: " . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>';
$entradas[7]['exjs'] = '<textarea readonly rows="27" style="width:100%;">
                      function listar_ramos(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "modo" : 1
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/listar_ramos");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>';
$entradas[7]['exjq'] = '<textarea readonly rows="32" style="width:100%;">
                      function listar_ramos(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "modo" : 1
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/listar_ramos",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>';
$entradas[7]['exrs'] = '<textarea readonly rows="28" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        formato: {
                          usuario: {
                            0 : {
                              "id" : 1,
                              "nome": "Pedro",
                              "email" : "pedro@email.com",
                              "pais" : "Brasil",
                              "avatar" : "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                              "esquerda" : null,
                              "direita" : 2
                            },
                            1 : {
                              "id" : 2,
                              "nome": "Joao",
                              "email" : "joao@email.com",
                              "pais" : "Brasil",
                              "avatar" : "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                              "esquerda" : null,
                              "direita" : null
                            }
                          }
                        }
                      }
                    </textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "comprar_plano";
$entradas[$newi]['header'] = "Função: Comprar Plano <font class='text-danger'>(ATUALIZADA)</font>";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/comprar_plano';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id_usuario, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id_plano, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;url_sucesso, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;url_cancelamento, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id_usuario:</b> id do usuário<br/>
                <b>id_plano:</b> id do plano a ser comprado.<br/>
                <b>url_sucesso:</b> url de redirecionamento do usuário em caso de sucesso na sua compra.<br/>
                <b>url_cancelamento:</b> url de redirecionamento do usuário em caso de cancelamento da sua compra.<br/>
                <div class="alert alert-danger" role="alert">
                  A url de checkout será retornada na resposta no caminho <b>data.coinpayments.result.checkout_url</b> e o usuário deverá ser
                  redirecionado para a mesma.<br/>
                  <b>Verifique o exemplo de resposta para mais informações</b>
                </div>
                <div class="alert alert-info" role="alert">
                  Após concluída a compra será ativa <b>AUTOMATICAMENTE</b> sem a necessidade de utilização da função <b>Ativar Plano</b>!
                </div>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;" rows="23">
                    data: {        
                        tipo: “sucesso”,
                        msg: "compra efetuada e no momento em espera!",
                        compra: {
                          id_usuario : 1,
                          id_plano: 1,
                          id: 1
                        }
                        coinpayments: {
                          error : "ok",
                          result : {
                            amount : 0.007...,
                            txn_id : CPED...,
                            address : 3Fyb4M...,
                            confirms_needed : 2,
                            timeout : 27000,
                            checkout_url : https://www.coinpayments.net/index.php?cmd=checkout&id=CPED651IQE9TL...,
                            status_url : https://www.coinpayments.net/index.php?cmd=status&id=CPED...,
                            qrcode_url : https://www.coinpayments.net/qrgen.php?id=CPE...
                          }
                        }
                      }
</textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "ativar_plano";
$entradas[$newi]['header'] = "Função: Ativar Plano";
$entradas[$newi]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/ativar_plano';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id da compra<br/>
                <font class="text-danger">Função para ativar a compra de 1 plano manualmente via administrador.</font><br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "listar_compras";
$entradas[$newi]['header'] = "Função: Listar Compras";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/listar_compras';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;estado, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário<br/>
                <b>estado:</b> estado das compras a serem listadas ("processamento" ou "efetuada"). Por padrão todas as compras são exibidas.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "retorna_saldo";
$entradas[$newi]['header'] = "Função: Retorna Saldo";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/retorna_saldo';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "relatorio_saldo";
$entradas[$newi]['header'] = "Função: Relatório Saldo";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/relatorio_saldo';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;data_inicio, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;data_fim, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;indicacao, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;residual, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;diario, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;binario, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;saque, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário<br/>
                <b>data_inicio:</b> formato: "Y-m-d", data inicial da pesquisa<br/>
                <b>data_fim:</b> formato: "Y-m-d", data final da pesquisa<br/>
                <b>indicacao:</b> padrão: <font class="text-primary">TRUE</font>, valores: <font class="text-primary">TRUE</font> ou <font class="text-purple">FALSE</font>. Se definido como false, não serão mostrados ganhos por indicação.<br/>
                <b>residual:</b> padrão: <font class="text-primary">TRUE</font>, valores: <font class="text-primary">TRUE</font> ou <font class="text-purple">FALSE</font>. Se definido como false, não serão mostrados ganhos residuais.<br/>
                <b>diario:</b> padrão: <font class="text-primary">TRUE</font>, valores: <font class="text-primary">TRUE</font> ou <font class="text-purple">FALSE</font>. Se definido como false, não serão mostrados ganhos diários.<br/>
                <b>binario:</b> padrão: <font class="text-primary">TRUE</font>, valores: <font class="text-primary">TRUE</font> ou <font class="text-purple">FALSE</font>. Se definido como false, não serão mostrados ganhos binários.<br/>
                <b>saque:</b>  padrão: <font class="text-primary">TRUE</font>, valores: <font class="text-primary">TRUE</font> ou <font class="text-purple">FALSE</font>. Se definido como false, não serão mostrados saques efetuados.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "configuracoes";
$entradas[$newi]['header'] = "Função: Configurações";
$entradas[$newi]['nivel'] = '<b class="text-secondary">Visitante</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/configuracoes';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <font class="text-danger">Lista as configurações atuais das porcentagens de ganho diário, ganho indicação, ganho binário e ganho residual.</font><br/><hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "setar_configuracoes";
$entradas[$newi]['header'] = "Função: Setar Configurações";
$entradas[$newi]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/setar_configuracoes';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;ganho_diario, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;ganho_indicacao, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;ganho_binario, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;ganho_residual, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>ganho_diario:</b> 0 a 100, porcentagem de ganho diário por plano para os usuarios.<br/>
                <b>ganho_indicacao:</b> 0 a 100, porcentagem de ganho indicação para os usuarios.<br/>
                <b>ganho_binario:</b> 0 a 100, porcentagem de ganho binário para os usuários.<br/>
                <b>ganho_residual:</b> 0 a 100, porcentagem de ganho residual para os usuários.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "enviar_email";
$entradas[$newi]['header'] = "Função: Enviar Email";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/enviar_email';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;email, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;assunto, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;texto <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>email:</b> email do destinatário.<br/>
                <b>assunto:</b> assunto do email.<br/>
                <b>texto:</b> texto do email, pode ser usado html.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "alterar_saldo";
$entradas[$newi]['header'] = "Função: Alterar Saldo";
$entradas[$newi]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/alterar_saldo';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;valor <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário.<br/>
                <b>valor:</b> qualquer valor diferente de 0, valores negativos irão reduzir o saldo atual do usuário.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "recuperar_senha";
$entradas[$newi]['header'] = "Função: Recuperar Senha";
$entradas[$newi]['nivel'] = '<b class="text-primary">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/recuperar_senha';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;login_ou_email, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>login_ou_email:</b> login ou email do usuário.<br/>
                <font class="text-danger">Caso o login / email seja encontrado, uma nova senha será gerada e enviada para o email cadastrado do usuário.</font><br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "usuario_gerador_url";
$entradas[$newi]['header'] = "Função: Visualizar Usuário Gerador da URL";
$entradas[$newi]['nivel'] = '<b class="text-secondary">Visitante</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/usuario_gerador_url';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;url <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>url:</b> url gerada pelo usuário.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';



$newi = count($entradas);
$entradas[$newi]['id'] = "pedir_saque";
$entradas[$newi]['header'] = "Função: Pedir Saque";
$entradas[$newi]['nivel'] = '<b class="text-info">Usuário</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/pedir_saque';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;valor, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;carteira, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;cancelar_extouro_limite <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API ou gerado no login do usuário<br/>
                <b>id:</b> id do usuário.<br/>
                <b>valor:</b> valor em USD do pedido de saque do usuário.<br/>
                <b>carteira:</b> carteira a ser transferido o valor.<br/>
                <b>cancelar_extouro_limite:</b>(<font class="text-info">TRUE</font> ou <font class="text-purple">FALSE</font>), padrão <font class="text-purple">FALSE</font><br/>
                Cancela o pedido caso o valor dele seja maior que o saldo do usuário. Por padrão o pedido não cancelado e caso o valor pedido seja maior que o saldo, ele é reduzido até o 
                saldo máximo. <br/>
                <b>Obs: caso o saldo seja 0, o pedido é cancelado de qualquer forma.</b>
                <div class="alert alert-danger" role="alert">
                  O usuário <b>não poderá fazer nenhum novo pedido de saque</b> enquanto estiver com algum <b>pendente</b>!
                  O pedido do usuário deverá ser cancelado ou confirmado pelo administrador para que ele possa fazer um novo pedido.
                </div>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';

$newi = count($entradas);
$entradas[$newi]['id'] = "listar_pedidos_saque";
$entradas[$newi]['header'] = "Função: Listar Pedidos de Saque";
$entradas[$newi]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/listar_pedidos_saque';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;estado, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do usuário a listar os pedidos (se não enviado, serão mostrados pedidos de saque de todos os usuários).<br/>
                <b>estado:</b> valores aceitos: ("aceito", "espera"). exibe apenas os pedidos com o estado enviado.<br/>Se for enviado um valor inválido ou não for enviado, serão exibido os pedidos de qualquer estado.<br/>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';


$newi = count($entradas);
$entradas[$newi]['id'] = "responder_pedido_saque";
$entradas[$newi]['header'] = "Função: Responder Pedido de Saque";
$entradas[$newi]['nivel'] = '<b class="text-purple">Administrador</b>';
$entradas[$newi]['url'] = 'http://api.agenciazap.com.br/responder_pedido_saque';
$entradas[$newi]['dados'] = 'dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;resposta, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id do <b>PEDIDO DE SAQUE</b> retornado pela função <b>Listar Pedidos de Saque</b>.<br/>
                <b>resposta:</b> (1 ou 0) 1 para aceitar o pedido, 0 para cancelar o pedido.<br/>
                <div class="alert alert-danger" role="alert">
                  Essa função definirá o pedido de saque como CONCLUÍDO ou CANCELADO, caso seja concluído, o valor de saque será retirado do saldo do usuário correspondente; caso contrário, o pedido
                  será apenas removido. Em ambos os casos de conclusão, será permitido novos pedidos de saque ao usuário.
                </div>
                <hr>';

$entradas[$newi]['exphp'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exjs'] = '<textarea readonly  style="width:100%;"></textarea>';
$entradas[$newi]['exjq'] = '<textarea readonly style="width:100%;"></textarea>';
$entradas[$newi]['exrs'] = '<textarea readonly style="width:100%;"></textarea>';

?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- estilo -->
    <link href="<?php echo site_url('assets/').'estilo.css'; ?>" rel="stylesheet">
    <title>Documentação API</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">DOCUMENTAÇÃO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#como_funciona">Como Funciona <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Árvore</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#cadastrar_raiz">Cadastrar Raiz</a>
              <a class="dropdown-item" href="#mostrar_arvore">Mostrar Árvore</a>
              <a class="dropdown-item" href="#listar_ramos">Listar Ramos</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuário  <span class="badge badge-danger">NOVO!</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown02">
              
              <a class="dropdown-item" href="#gerar_url">Gerar URL</a>
              <a class="dropdown-item" href="#usuario_gerador_url">Visualizar Usuário Gerador da URL <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#cadastro_usuario">Cadastro de Usuário</a>
              <a class="dropdown-item" href="#recuperar_senha">Recuperar Senha <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#login_usuario">Login de Usuário</a>
              <a class="dropdown-item" href="#retorna_usuario">Retornar Usuário</a>
              <a class="dropdown-item" href="#atualiza_usuario">Atualizar Usuário</a>
              <a class="dropdown-item" href="#remove_usuario">Remover Usuário</a>
              <a class="dropdown-item" href="#retorna_saldo">Retornar Saldo <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#relatorio_saldo">Relatório de Saldo <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#listar_compras">Listar Compras <span class="badge badge-danger">NOVO!</span></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Planos <span class="badge badge-danger">NOVO!</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown02">
              <a class="dropdown-item" href="#cadastrar_plano">Cadastro de Plano <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#atualiza_plano">Atualizar Plano <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#remove_plano">Remover Plano</a>
              <a class="dropdown-item" href="#listar_planos">Listar Planos</a>
              <a class="dropdown-item" href="#comprar_plano">Comprar Plano <span class="badge badge-danger">NOVO!</span></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Carteiras e Saques <span class="badge badge-danger">NOVO!</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown02">
              <a class="dropdown-item" href="#cadastrar_carteira">Cadastro de Carteira</a>
              <a class="dropdown-item" href="#remove_carteira">Remover Carteira</a>
              <a class="dropdown-item" href="#listar_carteiras">Listar Carteiras</a>
              <a class="dropdown-item" href="#pedir_saque">Pedir Saque</a>
              <a class="dropdown-item" href="#listar_pedidos_saque">Listar Pedidos de Saque</a>
              <a class="dropdown-item" href="#responder_pedido_saque">Responder Pedido de Saque</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administração <span class="badge badge-danger">NOVO!</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown09">
              <a class="dropdown-item" href="#configuracoes">Configurações <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#setar_configuracoes">Setar Configurações <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#ativar_plano">Ativar Plano <span class="badge badge-danger">NOVO!</span></a>
              <a class="dropdown-item" href="#alterar_saldo">Alterar Saldo <span class="badge badge-danger">NOVO!</span></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Suporte <span class="badge badge-danger">NOVO!</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown10">
              <a class="dropdown-item" href="#enviar_email">Enviar Email <span class="badge badge-danger">NOVO!</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">

      <div id="como_funciona" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Como funciona a API</b>
          </div>
          <div class="card-body">
            <div class="text-danger" >
              <b>formato da url: http://api.agenciazap.com.br/funcao</b>
            </div>
            <b>Esta API funciona baseada em três níveis de usuários com autenticação via API ID e TOKEN.</b><br/><br/><br/>
            <b class="text-purple">Administrador</b> é o nível mais alto e pode fazer qualquer requisição dentro da API.<br/>
            <b class="text-info">Usuário</b> é o nível mais comum e pode fazer requisições diversas utilizando o token retornado no momento do login.<br/>
            <b class="text-secondary">Visitante</b> é o nível mais baixo e suas requisições não possuem token.<br/>
            <hr>
            <br/>
            <b class="text-purple">Para requisições como administrador</b><br/>
            <b>api_id</b> => WqbE0<br/>
            <b>token</b> => c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO<br/><br/><br/>
            <b class="text-info">Para requisições como usuário</b><br/>
            <b>api_id</b> => WqbE0<br/>
            <b>token</b> => o token será recebido como resposta da API no login do usuário<br/><br/><br/>
            <b class="text-secondary">Para requisições como visitante</b><br/>
            <b>api_id</b> => WqbE0<br/>
          </div>
        </div>
      </div>
      
      
       <div id="cadastrar_raiz" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Cadastrar Raiz</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-purple">Administrador</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/cadastrar_raiz</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;pais, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nome, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;email, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;login, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;senha, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;sexo, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;avatar <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>pais:</b> país do usuário raiz<br/>
                <b>nome:</b> nome do usuário raiz<br/>
                <b>email:</b> email do usuário raiz<br/>
                <b>login:</b> login do usuário raiz<br/>
                <b>senha:</b> senha do usuário raiz, a senha enviada será criptografada<br/>
                <b>sexo:</b> masculino ou feminino<br/>
                <b>avatar:</b> url de uma imagem para avatar do usuário, caso não enviada ou enviada em branco, será utilizado o avatar padrão baseado no sexo informado<br/>
                <b class="text-danger">ANOTE O ID DA ÁRVORE, POIS ELE É NECESSÁRIO NA FUNÇÃO DE RETORNO DA MESMA!!</b><br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb1-a" data-toggle="tab" href="#tb1php" role="tab" aria-controls="tb1php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb1-b" data-toggle="tab" href="#tb1js" role="tab" aria-controls="tb1js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb1-c" data-toggle="tab" href="#tb1jq" role="tab" aria-controls="tb1jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb1-d" data-toggle="tab" href="#tb1rs" role="tab" aria-controls="tb1rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb1php" role="tabpanel" aria-labelledby="tb1-a">
                    <textarea readonly rows="27" style="width:100%;">
                      public function cadastrar_raiz()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "pais" => "Brasil",
                          "nome" => "Pedro",
                          "email" => "pedro@email.com",
                          "login" => "pedro",
                          "senha" => "915742",
                          "sexo" => "masculino"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/cadastrar_raiz'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb1js" role="tabpanel" aria-labelledby="tb1-b">
                    <textarea readonly rows="26" style="width:100%;">
                      function cadastrar_raiz(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "pais" : "Brasil",
                            "nome" : "Pedro",
                            "email" : "pedro@email.com",
                            "login" : "pedro",
                            "senha" : "915742",
                            "sexo" : "masculino"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/cadastrar_raiz");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb1jq" role="tabpanel" aria-labelledby="tb1-c">
                    <textarea readonly rows="31" style="width:100%;">
                      function cadastrar_raiz(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "pais" : "Brasil",
                            "nome" : "Pedro",
                            "email" : "pedro@email.com",
                            "login" : "pedro",
                            "senha" : "915742",
                            "sexo" : "masculino"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/cadastrar_raiz",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb1rs" role="tabpanel" aria-labelledby="tb1-d">
                    <textarea readonly rows="30" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “raiz e arvore cadastrados com sucesso.”,
                        usuario: { 
                          id: 1, 
                          nome: “Pedro”, 
                          email: “pedro@email.com”, 
                          login: “pedro”,
                          senha: “$2y$04$..EmFjkO0ajDWuBqLv85a1uMUeGffQGagEBZpWp2cupLL/pLgF9hQC”, 
                          pais: “Brasil”, 
                          avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                          perna: null, 
                          id_link: null, 
                          direita: null, 
                          esquerda: null, 
                          tipo: “raiz”, 
                          id_arvore: 1, 
                          url: null, 
                          sexo: “masculino”, 
                          token_acesso: null
                        },
                        arvore: { 
                          id: 1, 
                          raiz: 1, 
                          ttl_elementos: 1
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
       <!-- FIM FUNÇÃO 1 -->
      
      
      <div id="gerar_url" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Gerar URL</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-info">Usuário</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/gerar_url</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;perna <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API ou fornecido no LOGIN do usuário<br/>
                <b>id:</b> id do usuário linkado ao cadastro<br/>
                <b>perna: (direita, esquerda)</b> perna preferencial a ser inserido o cadastro. <b class="text-warning">Este campo é ignorado caso o usuário cadastrado
seja um qualificador (2 primeiros cadastros).</b> Caso a perna não seja enviada ou seja enviada em branco, o usuário será inserido na perna mais próxima, começando pela esquerda.<br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb2-a" data-toggle="tab" href="#tb2php" role="tab" aria-controls="tb1php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb12-b" data-toggle="tab" href="#tb2js" role="tab" aria-controls="tb1js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb2-c" data-toggle="tab" href="#tb2jq" role="tab" aria-controls="tb1jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb2-d" data-toggle="tab" href="#tb2rs" role="tab" aria-controls="tb1rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb2php" role="tabpanel" aria-labelledby="tb2-a">
                    <textarea readonly rows="26" style="width:100%;">
                      public function gerar_url()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0", 
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1,
                          "perna" => "direita"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/gerar_url'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb2js" role="tabpanel" aria-labelledby="tb2-b">
                    <textarea readonly rows="26" style="width:100%;">
                      function gerar_url(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO"
                            "id" : 1,
                            "perna" : "direita"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/gerar_url");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb2jq" role="tabpanel" aria-labelledby="tb2-c">
                    <textarea readonly rows="30" style="width:100%;">
                      function gerar_url(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO"
                            "id" : 1,
                            "perna" : "direita"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/gerar_url",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb2rs" role="tabpanel" aria-labelledby="tb2-d">
                    <textarea readonly rows="13" style="width:100%;">
                      data: {
                        tipo: “sucesso”, 
                        msg: “url gerada com sucesso.”,
                        url: {
                          id: 1,
                          id_usuario: 1, 
                          tipo: “qualificador”, 
                          perna: “direita”, 
                          url: “018dhfXhUgaoFbnz9i8174hyGHSCZ”
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 2 -->
      
      
      <div id="cadastro_usuario" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Cadastro de Usuário</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-secondary">Visitante</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/cadastro_usuario</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;url, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;pais, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nome, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;email, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;login, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;senha, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;sexo, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nivel, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;avatar <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>url:</b> url fornecida pela função gerar_url ligando este cadastro a outro usuário<br/>
                <b>pais:</b> país do usuário<br/>
                <b>nome:</b> nome do usuário<br/>
                <b>email:</b> email do usuário<br/>
                <b>login:</b> login do usuário<br/>
                <b>senha:</b> senha do usuário, a senha enviada será criptografada<br/>
                <b>sexo:</b> masculino ou feminino<br/>
                <b>nivel:</b> string para definir o nivel do usuario ("admin" ou "usuario" - padrão "usuario")<br/>
                <b>avatar:</b> url de uma imagem para avatar do usuário, caso não enviada ou enviada em branco, será utilizado o avatar padrão baseado no sexo informado<br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb3-a" data-toggle="tab" href="#tb3php" role="tab" aria-controls="tb3php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb3-b" data-toggle="tab" href="#tb3js" role="tab" aria-controls="tb3js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb3-c" data-toggle="tab" href="#tb3jq" role="tab" aria-controls="tb3jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb3-d" data-toggle="tab" href="#tb3rs" role="tab" aria-controls="tb3rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb3php" role="tabpanel" aria-labelledby="tb3-a">
                    <textarea readonly rows="27" style="width:100%;">
                      public function cadastrar_usuario()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "url" => "018dhfXhUgaoFbnz9i8174hyGHSCZ",
                          "pais" => "Brasil",
                          "nome" => "Joao",
                          "email" => "joao@email.com",
                          "login" => "joao",
                          "senha" => "19482sd",
                          "sexo" => "masculino"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/cadastrar_usuario'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb3js" role="tabpanel" aria-labelledby="tb3-b">
                    <textarea readonly rows="26" style="width:100%;">
                      function cadastrar_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "url" : "018dhfXhUgaoFbnz9i8174hyGHSCZ",
                            "pais" : "Brasil",
                            "nome" : "Joao",
                            "email" : "joao@email.com",
                            "login" : "joao",
                            "senha" : "19482sd",
                            "sexo" : "masculino"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/cadastrar_usuario");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb3jq" role="tabpanel" aria-labelledby="tb3-c">
                    <textarea readonly rows="31" style="width:100%;">
                      function cadastrar_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "url" : "018dhfXhUgaoFbnz9i8174hyGHSCZ",
                            "pais" : "Brasil",
                            "nome" : "Joao",
                            "email" : "joao@email.com",
                            "login" : "joao",
                            "senha" : "19482sd",
                            "sexo" : "masculino"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/cadastrar_usuario",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb3rs" role="tabpanel" aria-labelledby="tb3-d">
                    <textarea readonly rows="30" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “usuario cadastrado com sucesso.”,
                        usuario: { 
                          id: 2, 
                          nome: “Joao”, 
                          email: “joao@email.com”, 
                          login: “joao”,
                          senha: “$2y$04$8AEmFjkO0ajD623alkhf85a1uMUeGffQGagEBZpW8fhjFJIA83fP9hQC”, 
                          pais: “Brasil”,
                          nivel: "usuario"
                          avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                          perna: "direita", 
                          id_link: 1, 
                          direita: null, 
                          esquerda: null, 
                          tipo: “qualificador”, 
                          id_arvore: 1, 
                          url: "018dhfXhUgaoFbnz9i8174hyGHSCZ", 
                          sexo: “masculino”, 
                          token_acesso: null
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 3 -->
      
      
      <div id="login_usuario" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Login de Usuário</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-secondary">Visitante</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/login_usuario</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;login, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;senha, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>login:</b> login do usuário<br/>
                <b>senha:</b> senha do usuário<br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb4-a" data-toggle="tab" href="#tb4php" role="tab" aria-controls="tb4php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb4-b" data-toggle="tab" href="#tb4js" role="tab" aria-controls="tb4js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb4-c" data-toggle="tab" href="#tb4jq" role="tab" aria-controls="tb4jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb4-d" data-toggle="tab" href="#tb4rs" role="tab" aria-controls="tb4rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb4php" role="tabpanel" aria-labelledby="tb4-a">
                    <textarea readonly rows="22" style="width:100%;">
                      public function login_usuario()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "login" => "joao",
                          "senha" => "19482sd"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/login_usuario'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb4js" role="tabpanel" aria-labelledby="tb4-b">
                    <textarea readonly rows="21" style="width:100%;">
                      function login_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "login" : "joao",
                            "senha" : "19482sd"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/login_usuario");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb4jq" role="tabpanel" aria-labelledby="tb4-c">
                    <textarea readonly rows="27" style="width:100%;">
                      function login_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "login" : "joao",
                            "senha" : "19482sd"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/login_usuario",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb4rs" role="tabpanel" aria-labelledby="tb4-d">
                    <textarea readonly rows="8" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “login efetuado com sucesso”,
                        id: 2,
                        token: "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r"
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 4 -->
      
      
      <div id="retorna_usuario" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Retornar Usuário</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-info">Usuário</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/retorna_usuario</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API ou fornecido no LOGIN do usuário<br/>
                <b>id:</b> id do usuário<br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb5-a" data-toggle="tab" href="#tb5php" role="tab" aria-controls="tb5php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb5-b" data-toggle="tab" href="#tb5js" role="tab" aria-controls="tb5js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb5-c" data-toggle="tab" href="#tb5jq" role="tab" aria-controls="tb5jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb5-d" data-toggle="tab" href="#tb5rs" role="tab" aria-controls="tb5rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb5php" role="tabpanel" aria-labelledby="tb5-a">
                    <textarea readonly rows="22" style="width:100%;">
                      public function retorna_usuario()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "token" => "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                          "id" => 2
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/retorna_usuario'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb5js" role="tabpanel" aria-labelledby="tb5-b">
                    <textarea readonly rows="21" style="width:100%;">
                      function retorna_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                            "id" : 2
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/retorna_usuario");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb5jq" role="tabpanel" aria-labelledby="tb5-c">
                    <textarea readonly rows="27" style="width:100%;">
                      function retorna_usuario(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                            "id" : 2
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/retorna_usuario",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb5rs" role="tabpanel" aria-labelledby="tb5-d">
                    <textarea readonly rows="22" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “”,
                        usuario: { 
                          id: 2, 
                          nome: “Joao”, 
                          email: “joao@email.com”, 
                          login: “joao”,
                          senha: “$2y$04$8AEmFjkO0ajD623alkhf85a1uMUeGffQGagEBZpW8fhjFJIA83fP9hQC”, 
                          pais: “Brasil”, 
                          avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                          perna: "direita", 
                          id_link: 1, 
                          direita: null, 
                          esquerda: null, 
                          tipo: “qualificador”, 
                          id_arvore: 1,
                          sexo: “masculino”
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 5 -->
      
      
      <div id="mostrar_arvore" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Mostrar Árvore</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-purple">Administrador</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/mostrar_arvore</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;detalhado, <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API<br/>
                <b>id:</b> id da árvore<br/>
                <b>detalhado:</b> retorno detalhado ou não dos dados da árvore, o padrão é <b class="text-purple">FALSE</b>, se definido como <b class="text-primary">TRUE</b> os usuários dentro do objeto serão retornados com todos os seus campos do banco de dados; caso contrário, serão retornados <br/><b>apenas nome, email, país e avatar de cada usuário</b>.<br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb6-a" data-toggle="tab" href="#tb6php" role="tab" aria-controls="tb6php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb6-b" data-toggle="tab" href="#tb6js" role="tab" aria-controls="tb6js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb6-c" data-toggle="tab" href="#tb6jq" role="tab" aria-controls="tb6jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb6-d" data-toggle="tab" href="#tb6rs" role="tab" aria-controls="tb6rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb6php" role="tabpanel" aria-labelledby="tb6-a">
                    <textarea readonly rows="24" style="width:100%;">
                      public function mostrar_arvore()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1,
                          "detalhado" => false
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/mostrar_arvore'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb6js" role="tabpanel" aria-labelledby="tb6-b">
                    <textarea readonly rows="21" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "detalhado" : false
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/mostrar_arvore");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb6jq" role="tabpanel" aria-labelledby="tb6-c">
                    <textarea readonly rows="27" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "detalhado" : false
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/mostrar_arvore",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb6rs" role="tabpanel" aria-labelledby="tb6-d">
                    <textarea readonly rows="28" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “”,
                        id: 1,
                        raiz: 1,
                        ttl_elementos: 2,
                        arvore: { 
                          raiz: {
                              id: 1,
                              nome: Pedro,
                              email: pedro@email.com,
                              pais: Brasil,
                              avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                              esquerda: {},
                              direita: {
                                id: 2,
                                nome: Joao,
                                email: joao@email.com,
                                pais: Brasil,
                                avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                                esquerda: {},
                                direita: {}
                              },
                          },
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 6 -->
      
      
      
      <div id="atualiza_usuario" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Atualizar Usuário</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-info">Usuário</b><br/>
            <b>Url: </b><b>http://api.agenciazap.com.br/atualiza_usuario</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;pais, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nome, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;email, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;login, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;senha, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;sexo, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;nivel, <b class="text-secondary" >(OPCIONAL)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;avatar <b class="text-secondary" >(OPCIONAL)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API ou fornecido no LOGIN do usuário<br/>
                <b>id:</b> id do usuário<br/>
                <b>pais:</b> país do usuário<br/>
                <b>nome:</b> nome do usuário<br/>
                <b>email:</b> email do usuário<br/>
                <b>login:</b> login do usuário<br/>
                <b>senha:</b> senha do usuário, a senha enviada será criptografada<br/>
                <b>sexo:</b> masculino ou feminino<br/>
                <b>nivel:</b> string para definir o nivel do usuario ("admin" ou "usuario" - padrão "usuario")<br/>
                <b>avatar:</b> url de uma imagem para avatar do usuário<br/>
                <font class="text-danger">Caso algum dado não seja informado, o mesmo não será alterado.</font><br/>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb7-a" data-toggle="tab" href="#tb7php" role="tab" aria-controls="tb7php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb7-b" data-toggle="tab" href="#tb7js" role="tab" aria-controls="tb7js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb7-c" data-toggle="tab" href="#tb7jq" role="tab" aria-controls="tb7jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb7-d" data-toggle="tab" href="#tb7rs" role="tab" aria-controls="tb7rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb7php" role="tabpanel" aria-labelledby="tb6-a">
                    <textarea readonly rows="24" style="width:100%;">
                      public function atualiza_usuario()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "token" => "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                          "id" => 1,
                          "nome" => "Alex"
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/atualiza_usuario'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb7js" role="tabpanel" aria-labelledby="tb6-b">
                    <textarea readonly rows="21" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "nome" : "Alex"
                          } 
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/mostrar_arvore");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb7jq" role="tabpanel" aria-labelledby="tb6-c">
                    <textarea readonly rows="27" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "c8JCL2S1XvhaJhbUpyVL0xu7Gh35tH6FPPgAS8CO",
                            "id" : 1,
                            "nome" : "Alex"
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/mostrar_arvore",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb7rs" role="tabpanel" aria-labelledby="tb6-d">
                    <textarea readonly rows="16" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “usuario atualizado com sucesso”,
                        usuario: { 
                            id: 1, 
                            nome: “Alex”, 
                            email: “pedro@email.com”, 
                            login: “pedro”,
                            pais: “Brasil”, 
                            nivel: "usuario",
                            avatar: "http://api.agenciazap.com.br/uploads/avatar_masculino.png",
                            tipo: “raiz”,
                            sexo: “masculino”
                        }
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 7 -->
      
      
      <div id="remove_usuario" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>Função: Remover Usuário</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b><b class="text-info">Usuário</b><br/>
            <div class="alert alert-warning" role="alert"><strong>Atenção! </strong>
              Caso o usuário a ser removido seja a raiz, o nível de usuário requerido é <font class="text-purple">Administrador</font>.
            </div>
            <b>Url: </b><b>http://api.agenciazap.com.br/remove_usuario</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                dados: {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;api_id, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;token, <b class="text-danger" >(REQUERIDO)</b><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;id, <b class="text-danger" >(REQUERIDO)</b><br/>
                }<br/>
                <hr>
                <b>api_id:</b> id da API<br/>
                <b>token:</b> token da API ou fornecido no LOGIN do usuário<br/>
                <b>id:</b> id do usuário<br/>
                <div class="alert alert-info" role="alert">
                  A realocação dos ramos da árvore é baseada no ramo removido<br/>
                  <strong>Exemplo: </strong>caso o usuário removido seja o ramo à direita do usuário anterior, <strong>o ramo a direita do removido subirá 1 nivel (junto com todos os seus subramos à direita)</strong> e caso ele possua um ramo a esquerda e o usuário removido também, <strong>o ramo a esquerda do usuário removido passará a ser o ramo esquerdo do usuário que subiu de nível, o ramo esquerdo deste usuário passará a ser o ramo esquerdo do próximo usuário e assim sucessivamente.</strong>
                </div>
                <hr>
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb8-a" data-toggle="tab" href="#tb8php" role="tab" aria-controls="tb8php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-b" data-toggle="tab" href="#tb8js" role="tab" aria-controls="tb8js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-c" data-toggle="tab" href="#tb8jq" role="tab" aria-controls="tb8jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-d" data-toggle="tab" href="#tb8rs" role="tab" aria-controls="tb8rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb8php" role="tabpanel" aria-labelledby="tb8-a">
                    <textarea readonly rows="24" style="width:100%;">
                      public function remove_usuario()
                      {
                        $data['data'] = array(
                          "api_id" => "WqbE0",
                          "token" => "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                          "id" => 2
                        );                                                                    
                        $data_string = json_encode($data);

                        $ch = curl_init(site_url('http://api.agenciazap.com.br/remove_usuario'));                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($data_string))                                                                       
                        );                                                                                                                   

                        $result = curl_exec($ch);
                        $result = json_decode($result);
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb8js" role="tabpanel" aria-labelledby="tb8-b">
                    <textarea readonly rows="21" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = {
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                            "id" : 2
                          }
                        };
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "http://api.agenciazap.com.br/remove_usuario");
                        xmlhttp.setRequestHeader("Content-Type", "application/json");
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var retorno = JSON.parse(this.responseText);
                              funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                            }
                        };
                        xmlhttp.send(JSON.stringify(obj));
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb8jq" role="tabpanel" aria-labelledby="tb8-c">
                    <textarea readonly rows="27" style="width:100%;">
                      function mostrar_arvore(){
                        var obj = { 
                          data : { 
                            "api_id" : "WqbE0",
                            "token" : "pV9MMsaNkaiJ64CHfPWEdf28Apo8H74KyexlGH8r",
                            "id" : 2
                          } 
                        };
                      
                        $.ajax({
                          url: "http://api.agenciazap.com.br/remove_usuario",
                          type: "POST",
                          data: JSON.stringify(obj),
                          dataType: "json",
                          beforeSend: function(x) {
                            if (x && x.overrideMimeType) {
                              x.overrideMimeType("application/json;charset=UTF-8");
                            }
                          },
                          success: function(retorno) {
                            var retorno = JSON.parse(retorno);
                            funcao_retorno(retorno); //Faça aqui sua função de retorno de dados
                          }
                        });
                      }
                    </textarea>
                  </div>
                  <div class="tab-pane fade" id="tb8rs" role="tabpanel" aria-labelledby="tb8-d">
                    <textarea readonly rows="6" style="width:100%;">
                      data: {        
                        tipo: “sucesso”, 
                        msg: “usuario removido com sucesso”
                      }
                    </textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO 8 -->

      <?php for ($i=0; $i<count($entradas); $i++){
        $nat = 9 + $i;
        echo '<!-- FUNÇÃO '.$nat.' -->';
        echo '<div id="'.$entradas[$i]['id'].'" class="inicio">
        <div class="card">
          <div class="card-header">
            <b>'.$entradas[$i]['header'].'</b> 
          </div>
          <div class="card-body">
            <b>Nível de usuário: </b>'.$entradas[$i]['nivel'].'<br/>
            <b>Url: </b><b>'.$entradas[$i]['url'].'</b><br/>
            <b>Tipo: </b><b class="text-success">POST</b><br/>&nbsp;<br/>
            <div class="card">
              <div class="card-header">
                <b>Formato dos Dados:</b>
              </div>
              <div class="card-body">
                '.$entradas[$i]['dados'].'
                <ul class="nav nav-tabs" id="tab_cadastrar_raiz" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tb8-a" data-toggle="tab" href="#tb'.$nat.'php" role="tab" aria-controls="tb'.$nat.'php" aria-selected="true">Exemplo em PHP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-b" data-toggle="tab" href="#tb'.$nat.'js" role="tab" aria-controls="tb'.$nat.'js" aria-selected="false">Exemplo em javascript</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-c" data-toggle="tab" href="#tb'.$nat.'jq" role="tab" aria-controls="tb'.$nat.'jq" aria-selected="false">Exemplo em JQuery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="tb8-d" data-toggle="tab" href="#tb'.$nat.'rs" role="tab" aria-controls="tb'.$nat.'rs" aria-selected="false">Exemplo de Resposta</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tb'.$nat.'php" role="tabpanel" aria-labelledby="tb'.$nat.'-a">
                    '.$entradas[$i]['exphp'].'
                  </div>
                  <div class="tab-pane fade" id="tb'.$nat.'js" role="tabpanel" aria-labelledby="tb'.$nat.'-b">
                    '.$entradas[$i]['exjs'].'
                  </div>
                  <div class="tab-pane fade" id="tb'.$nat.'jq" role="tabpanel" aria-labelledby="tb'.$nat.'-c">
                    '.$entradas[$i]['exjq'].'
                  </div>
                  <div class="tab-pane fade" id="tb'.$nat.'rs" role="tabpanel" aria-labelledby="tb'.$nat.'-d">
                    '.$entradas[$i]['exrs'].'
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FIM FUNÇÃO '.$nat.' -->';
      } ?>
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
