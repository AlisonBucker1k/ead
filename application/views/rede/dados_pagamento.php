<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Dados de Pagamento
            </span>
        </div>
    </div>
</div>
<?php $estadoId = 0; ?>
<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <form action="<?php echo base_url('rede/dados_pagamento/update'); ?>" enctype="multipart/form-data" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h5><button type="button" class="btn btn-light" onclick="adcionarContaUsuario('#contasUsuario')"><i class="fa fa-plus"></i></button> Minhas Contas Bancárias</h5>
                            <hr>
                            <div id="contasUsuario" class="row">
                                <?php  foreach($contas as $c): $timeStamp = time(); ?>
                                    <div id="contaB<?php echo $timeStamp; ?>" class="card <?php if ($c['selecionada'] == 1){ echo 'text-white bg-primary'; } ?> contasBc col-12 col-md-6">
                                        <div class="card-body">
                                            <h6 <?php if ($c['selecionada'] == 1){ echo 'class="text-white"'; } ?>>Nova Conta <button type="button" class="btn btn-accent float-right"
                                             onclick="removerContaUsuario('#contaB<?php echo $timeStamp; ?>')"><i class="fa fa-trash"></i></button></h6>

                                            <div class="form-row">
                                                <div class="col-12">
                                                    <label class="form-label <?php if ($c['selecionada'] == 1){ echo 'text-white'; } ?>" for="name">Tipo de Conta: *</label>
                                                    <input type="text" name="tipo_conta[]" class="form-control" value="<?= $c['tipo_conta'] ?>" placeholder="Corrente, Poupança..." >
                                                </div>
                                            </div>

                                            <div class="form-row pt-3">
                                                <div class="col-12">
                                                    <label class="form-label <?php if ($c['selecionada'] == 1){ echo 'text-white'; } ?>" for="name">Banco: *</label>
                                                    <input type="text" name="banco[]" class="form-control" value="<?= $c['banco'] ?>" placeholder="Digite o banco..." >
                                                </div>
                                            </div>

                                            <div class="form-row pt-3">
                                                <div class="col-md-6">
                                                    <label class="form-label <?php if ($c['selecionada'] == 1){ echo 'text-white'; } ?>" for="name">Agência: *</label>
                                                    <input type="text" name="agencia[]" class="form-control"value="<?= $c['agencia'] ?>" placeholder="XXXXX-X" >
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label <?php if ($c['selecionada'] == 1){ echo 'text-white'; } ?>" for="name">Conta: *</label>
                                                    <input type="text" name="conta[]" class="form-control" value="<?= $c['conta'] ?>" placeholder="XXXXX-X" >
                                                </div>
                                            </div>

                                            <input type="hidden" class="selecionada" name="selecionada[]" value="<?php echo $c['selecionada']; ?>" />
                                            <?php if ($c['selecionada'] != 1){ 
                                                echo '
                                                <button type="button" onclick="definirPagamento('."'contaB".$timeStamp."'".')" class="btn btn-seleciona btn-dark btn-block mt-4"><i class="fa fa-check"></i>&nbsp;Selecionar Conta</button>
                                                '; 
                                            } else {
                                                echo '
                                                <button type="button" class="btn btn-dark btn-block mt-4 btn-seleciona" disabled><i class="fa fa-check"></i>&nbsp;Conta selecionada</button>
                                                ';
                                            } ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3 ml-3">Atualizar Dados De Pagamento</button>

            </div>
        </form>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/rede/footer.php'); ?>

<script>
    function buscaInObj(obj, key){
        if (key in obj){
            return obj[key];
        }
        return '';
    }

    function definirPagamento(selector){
        $('.selecionada').val('0');
        $('.btn-seleciona').remove();
        $('.selecionada').each(function () {
            var idparent = $(this).parent().parent().prop('id');
            $(this).after(`
            <button type="button" onclick="definirPagamento('${idparent}')" class="btn btn-dark btn-block mt-4 btn-seleciona"><i class="fa fa-check"></i>&nbsp;Selecionar Conta</button>
            `);

            $(this).parent().parent().removeClass('text-white').removeClass('bg-primary').find('h6').removeClass('text-white');
        });

        
        $('#'+selector+' .btn-seleciona').remove();
        $('#'+selector+' .selecionada').val(1).after(`
        <button type="button" class="btn btn-dark btn-block mt-4 btn-seleciona" disabled><i class="fa fa-check"></i>&nbsp;Conta selecionada</button>
        `);
        $('#'+selector).addClass('text-white bg-primary').find('h6').addClass('text-white');
    }

    function getClassNew(){
        if ($('.contasBc').length <= 0){
            return 'text-white bg-primary';
        }
        return '';
    }

    function getSelectedNew(timestamp){
        if ($('.contasBc').length <= 0){
            return `
                <input type="hidden" class="selecionada" name="selecionada[]" value="1" />
                <button type="button" class="btn btn-dark btn-block mt-4 btn-seleciona" disabled><i class="fa fa-check"></i>&nbsp;Conta selecionada</button>
            `;
        }
        return `
            <input type="hidden" class="selecionada" name="selecionada[]" value="0" />
            <button type="button" onclick="definirPagamento('contaB${timestamp}')" class="btn btn-dark btn-block mt-4 btn-seleciona"><i class="fa fa-check"></i>&nbsp;Selecionar Conta</button>
        `;
    }

    function getTextClass(){
        if ($('.contasBc').length <= 0){
            return `text-white`;
        }
        return ``;
    }

    function templateContaUsuario(valores = {}){
        var currentDate = new Date();
        var timestamp = currentDate.getTime();

        var getSel = getSelectedNew(timestamp);
        var classesTop = getClassNew();
        var textClass = getTextClass();
        return `<div id="contaB${timestamp}" class="card ${classesTop} contasBc col-12 col-md-6">
            <div class="card-body">
                <h6 class="${textClass}">Nova Conta <button type="button" class="btn btn-accent float-right" onclick="templateContaUsuario('#contaB${timestamp}')"><i class="fa fa-trash"></i></button></h6>
                <div class="form-row">
                    <div class="col-12">
                        <label class="form-label ${textClass}" for="name">Tipo de Conta: *</label>
                        <input type="text" name="tipo_conta[]" class="form-control" value="${buscaInObj(valores, "tipo_conta")}" placeholder="Corrente, Poupança..." >
                    </div>
                </div>

                <div class="form-row pt-3">
                    <div class="col-12">
                        <label class="form-label ${textClass}" for="name">Banco: *</label>
                        <input type="text" name="banco[]" class="form-control" value="${buscaInObj(valores, "banco")}" placeholder="Digite o banco..." >
                    </div>
                </div>

                <div class="form-row pt-3">
                    <div class="col-md-6">
                        <label class="form-label ${textClass}" for="name">Agência: *</label>
                        <input type="text" name="agencia[]" class="form-control" value="${buscaInObj(valores, "agencia")}" placeholder="XXXXX-X" >
                    </div>
                    <div class="col-md-6">
                        <label class="form-label ${textClass}" for="name">Conta: *</label>
                        <input type="text" name="conta[]" class="form-control" value="${buscaInObj(valores, "conta")}" placeholder="XXXXX-X" >
                    </div>
                </div>
                ${getSel}
            </div>
        </div>
        `
    }

    function removerContaUsuario(val){
        if ($(val).length){
            $(val).remove();
        }
    }

    function adcionarContaUsuario(selector){
        $(selector).append(templateContaUsuario());
    }
</script>