<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Edição de Mensagem AVA
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form id="formCadastroMensagem" action="<?php echo base_url(); ?>admin/mensagens/update/<?php echo $mensagem[0]['id']; ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Título: *</label>
                        <input id="titulo" name="titulo" class="form-control" value="<?php echo $mensagem[0]['titulo'] ?>" placeholder="Digite aqui o título do modal de mensagem..." required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Texto: *</label>
                        <div id="texto-mensagem" style="height: 150px;" class="mb-0" >
                            <?php echo $mensagem[0]['texto']; ?>
                        </div>
                        <input type="hidden" name="texto" id="txthidden" value='<?php echo $mensagem[0]['texto']; ?>' >
                    </div>
                    
                    <div class="form-group" style="display:flex;margin-bottom:0px!important">
                        <input name="ativa" type="checkbox" style="width:17px;height:17px;" <?php if ($mensagem[0]['ativa'] == 1): echo 'checked'; endif ?>>
                        <label style="padding-left:5px;">Ativa</label>
                        
                    </div>
                    <div class="form-group">
                        <small style="font-size:80%">Caso mais de 1 mensagem esteja ativa ao mesmo tempo, será mostrado APENAS uma delas aleatóriamente no login do aluno.</small>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="validaCamposMSG();">Atualizar Mensagem AVA</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Atualizar Mensagem AVA</h5>
                        <div class="d-flex mb-8pt">
                            <div class="flex"><strong class="text-70"></strong></div>
                            <strong></strong>
                        </div>

                        <div class="alert alert-soft-warning">
                            <div class="d-flex flex-wrap align-items-start">
                                <div class="mr-8pt">
                                    <i class="material-icons">check</i>
                                </div>
                                <div class="flex" style="min-width: 180px">
                                    <small class="text-100">
                                        Preencha os dados para atualizar uma mensagem AVA.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                        </div>
                        <div class="custom-control custom-checkbox">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>
<script>
    let txtnow = null;
    function initializeQuill(){
        txtnow = new Quill('#texto-mensagem', {
            placeholder: 'Digite o texto do modal de mensagem...',
            modules: {
                toolbar: [["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]
            },
            theme: 'snow'
        });
        
    }

    function validaCamposMSG(){
        var text1 = txtnow.getText();

        var retorno = true;
        if (text1.replace(/\s/g,"") == ""){
            $('#texto-mensagem').after(`<div class="label-erro text-danger">Preencha o texto!</div>`);
            retorno = false;
        }

        if ($('#titulo').val().replace(/\s/g,"") == ""){
            $('#titulo').after(`<div class="label-erro text-danger">Preencha o título!</div>`);
            retorno = false;
        } else {
            var txtInner = txtnow.container.firstChild.innerHTML;
            $('#txthidden').val(txtInner);
        }

        if (retorno){
            $('#formCadastroMensagem').submit();
        }
    }

    initializeQuill();
</script>