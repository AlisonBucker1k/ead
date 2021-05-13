<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pedir Saque </h5>

                        <form method="post" action="<?php echo site_url('rede/saques/insere'); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h5 class="card-title mb-4">Meu Saldo Atual: <span class="text-primary pl-2">R$ <?php echo $saldo[0]['saldo']; ?></span></h5>
                                    </center>
                                    <hr>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="valor">Valor do pedido: *</label>
                                        <input name="valor" id="valor" type="number" step="0.01" min="50" max="<?php echo $saldo[0]['saldo']; ?>" class="form-control" placeholder="Digite o valor em R$" required>
                                    </div>
                                    <br/>
                                    <hr class="mt-4">
                                    <h5 class="card-title text-center">Dados de Pagamento</h5>
                                    <div class="alert alert-danger" role="alert">
                                        <b>ATENÇÃO!!</b> - O CPF DO TÍTULAR DA CONTA PRECISA SER CORRESPONDENTE COM O CADASTRADO:
                                        <b><?php echo formataCPF($this->session->userdata('cpf')); ?></b>
                                    </div>
                                    <hr>
                                    <div id="contasUsuario" class="row">
                                        <?php foreach ($contas as $c) : $timeStamp = $c['id']; ?>
                                            <div id="contaB<?php echo $timeStamp; ?>" data-id="<?php echo $c['id']; ?>" class="card <?php if ($c['selecionada'] == 1) {
                                                                                                                                        echo 'text-white bg-primary';
                                                                                                                                    } ?> contasBc col-12 col-md-6">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label class="form-label <?php if ($c['selecionada'] == 1) {
                                                                                            echo 'text-white';
                                                                                        } ?>" for="name">Tipo de Conta: *</label>
                                                            <input type="text" name="tipo_conta[]" class="form-control" value="<?= $c['tipo_conta'] ?>" placeholder="Corrente, Poupança..." disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-row pt-3">
                                                        <div class="col-12">
                                                            <label class="form-label <?php if ($c['selecionada'] == 1) {
                                                                                            echo 'text-white';
                                                                                        } ?>" for="name">Banco: *</label>
                                                            <input type="text" name="banco[]" class="form-control" value="<?= $c['banco'] ?>" placeholder="Digite o banco..." disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-row pt-3 selecionada">
                                                        <div class="col-md-6">
                                                            <label class="form-label <?php if ($c['selecionada'] == 1) {
                                                                                            echo 'text-white';
                                                                                        } ?>" for="name">Agência: *</label>
                                                            <input type="text" name="agencia[]" class="form-control" value="<?= $c['agencia'] ?>" placeholder="XXXXX-X" disabled>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label <?php if ($c['selecionada'] == 1) {
                                                                                            echo 'text-white';
                                                                                        } ?>" for="name">Conta: *</label>
                                                            <input type="text" name="conta[]" class="form-control" value="<?= $c['conta'] ?>" placeholder="XXXXX-X" disabled>
                                                        </div>
                                                    </div>

                                                    <?php if ($c['selecionada'] == 1) { ?>
                                                        <input type="hidden" name="selecionada" id="contaSelecionada" value="<?php echo $c['id']; ?>" />
                                                    <?php } ?>
                                                    <?php if ($c['selecionada'] != 1) {
                                                        echo '
                                                                        <button type="button" onclick="selecionaConta(' . "'contaB" . $timeStamp . "'" . ')" class="btn btn-dark btn-seleciona btn-block mt-4"><i class="fa fa-check"></i>&nbsp;Selecionar Conta</button>
                                                                        ';
                                                    } else {
                                                        echo '
                                                                        <button type="button" onclick="selecionaConta(' . "'contaB" . $timeStamp . "'" . ')" class="btn btn-dark btn-seleciona btn-block mt-4" disabled><i class="fa fa-check"></i>&nbsp;Conta Selecionada</button>
                                                                        ';
                                                    } ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Enviar Pedido</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/rede/footer.php'); ?>
<script>
    function selecionaConta(selector) {
        $('.btn-seleciona').prop('disabled', false).html('Selecionar Conta');
        $('.selecionada').each(function() {
            $(this).parent().parent().removeClass('text-white').removeClass('bg-primary').find('h6').removeClass('text-white');
        });


        $('#' + selector + ' .btn-seleciona').prop('disabled', true).html('Conta Selecionada');
        $('#' + selector).addClass('text-white bg-primary').find('h6').addClass('text-white');
        var data_id = $('#' + selector).attr('data-id');
        $('#contaSelecionada').val(data_id);
    }
</script>