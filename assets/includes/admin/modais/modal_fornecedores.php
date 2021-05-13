<?php 
if (isset($entradas[0]['id'])){
    
foreach($entradas as $p){
    $optEstados = '';
    foreach ($estados as $estd) {
        $optEstados .= '<option value="' . $estd['nome'] . '" >' . $estd['uf'] . '</option>';
    }
    echo '<div class="modal fade" id="editar_fornecedor_rede'.$p['id'].'" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_fornecedor_rede'.$p['id'].'" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-editar_fornecedor_rede'.$p['id'].'">Editar Fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formeditar_fornecedor_rede" action="'.base_url('admin/fornecedores/update/'.$p['id']).'" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-row">
                        <div class="col-md-12 col-12">
                            <label class="form-label" for="name">Cadastro no Fornecedor: *</label>
                            <input id="cadastro_no_fornecedor'.$p['id'].'" type="text" class="form-control" value="'.$p['cadastro_no_fornecedor'].'" placeholder="Cadastro no Fornecedor" name="cadastro_no_fornecedor" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-md-12 col-12">
                            <label class="form-label" for="name">Empresa ou Pessoa: *</label>
                            <input id="empresa'.$p['id'].'" type="text" class="form-control" value="'.$p['empresa'].'" placeholder="Empresa ou Pessoa" name="empresa" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-12">
                            <label class="form-label" for="name">Atividade: *</label>
                            <input id="atividade'.$p['id'].'" type="text" class="form-control" value="'.$p['atividade'].'" placeholder="Atividade do Fornecedor" name="atividade" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="name">Contato: *</label>
                            <input id="contato'.$p['id'].'" type="telefone" class="form-control telefone" value="'.$p['contato'].'" placeholder="(XX) XXXXX-XXXX" name="contato">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="name">Nextel: *</label>
                            <input id="nextel'.$p['id'].'" type="telefone" class="form-control telefone" value="'.$p['nextel'].'" placeholder="(XX) XXXXX-XXXX" name="nextel">
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="name">Telefone: *</label>
                            <input id="telefone'.$p['id'].'" type="telefone" class="form-control telefone" value="'.$p['telefone'].'" placeholder="(XX) XXXX-XXXX" name="telefone">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="name">Celular: *</label>
                            <input id="celular'.$p['id'].'" type="telefone" class="form-control telefone" value="'.$p['celular'].'" placeholder="(XX) XXXXX-XXXX" name="celular">
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-12">
                            <label class="form-label" for="username">Endereço: *</label>
                            <input name="endereco" id="endereco'.$p['id'].'" type="text" class="form-control" value="'.$p['endereco'].'" placeholder="Rua, avenida..., Nº" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="username">Cep: *</label>
                            <div class="input-group mb-3">
                                <input type="cep" id="cep'.$p['id'].'" name="cep" class="form-control cep" value="'.$p['cep'].'" placeholder="XXXXX-XXX" aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="button" onclick="getCep($(\'#cep'.$p['id'].'\').val(), \'#estado'.$p['id'].'\', \'#cidade'.$p['id'].'\');" style="height: 36px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="username">Estado: *</label>
                            <select id="estado'.$p['id'].'" onchange="getCidades($(this).val(), \'#cidade'.$p['id'].'\')" class="form-control selectpicker" title="UF" name="estado" data-live-search="true" data-size="5" required>
                                '.$optEstados.'
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12">
                            <label class="form-label" for="username">Cidade: *</label>
                            <select id="cidade'.$p['id'].'" class="form-control selectpicker" name="cidade" data-live-search="true" title="Selecione uma cidade..." data-size="5" required>
                            </select>
                        </div>

                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="username">Bairro: </label>
                            <input name="bairro" id="bairro'.$p['id'].'" type="text" class="form-control" value="'.$p['bairro'].'" placeholder="Bairro do fornecedor...">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="username">Email: </label>
                            <input name="email" id="email'.$p['id'].'" type="text" class="form-control" value="'.$p['email'].'" placeholder="Email do fornecedor..." >
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
</div>'; } }
 ?>

 <script>
    function abrirFornecedor(id){
        getCep($('#cep'+id).val(), '#estado'+id, '#cidade'+id).then(() => {
            $('#editar_fornecedor_rede'+id).modal('show');
        });
    }
 </script>