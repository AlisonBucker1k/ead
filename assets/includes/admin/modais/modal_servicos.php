<!-- // END Page Content -->
<div class="modal fade" id="cadastrar_fornecedor" tabindex="-1" role="dialog" aria-labelledby="titulo-cadastrar_fornecedor" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-cadastrar_fornecedor">Novo Fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formcadastrar_fornecedor" action="<?php echo base_url('admin/fornecedores/insere'); ?>" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome: *</label>
                            <input id="nome" type="text" class="form-control" placeholder="Nome do Fornecedor" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="foto">Dados e detalhes</label>
                            <textarea name="dados" class="form-control" placeholder="Dados e detalhes do fornecedor" rows="15"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="button" onclick="enviarFornecedorAjax();" class="btn btn-success">Cadastrar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<?php if (isset($entradas[0]['id'])){ 
   
    
    foreach($entradas as $p){
        $selectFornecedores = "<select name='id_fornecedor' class='form-control selectpicker' data-size='5' data-live-search='true'>";
        foreach($fornecedores as $f){
            
            $selected = $f['id'] == $p['id_fornecedor'] ? 'selected' : '';
            $selectFornecedores .= "<option value='".$f['id']."' ".$selected." >".$f['empresa']."</option>";
        }
        $selectFornecedores .= "</select>";
    echo '<div class="modal fade" id="editar_servico_rede'.$p['id'].'" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_servico_rede'.$p['id'].'" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-editar_servico_rede'.$p['id'].'">Editar Serviço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formeditar_servico_rede" action="'.base_url('admin/servicos/update/'.$p['id']).'" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome: *</label>
                            <input id="nome" type="text" class="form-control" placeholder="Nome do Serviço" value="'.$p['nome'].'" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="name">Fornecedor: *</label>
                            '.$selectFornecedores.'
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="foto">Descrição</label>
                            <textarea name="descricao" class="form-control" placeholder="Descrição do serviço" rows="15">'.$p['descricao'].'</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Serviço</button>
                    </div>
                </form>
            </div>
        </div>
</div>'; } }
 ?>

 <script>
     function reLoadOpcoes(){

     }
     function enviarFornecedorAjax(){
            const XHR = new XMLHttpRequest();

            const FD = new FormData( document.querySelector('#formcadastrar_fornecedor') );

            // Define what happens on successful data submission
            XHR.addEventListener( "load", function(event) {
                reLoadOpcoes();
            });

            // Define what happens in case of error
            XHR.addEventListener( "error", function( event ) {
                aviso('error', "Um erro ocorreu, tente novamente!", "");
            });

            // Set up our request
            XHR.open( "POST", "https://example.com/cors.php" );

            // The data sent is what the user provided in the form
            XHR.send( FD );
        }
 </script>