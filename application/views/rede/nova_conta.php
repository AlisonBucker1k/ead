<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nova Conta | REDE</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/spinkit.css" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/material-icons.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/fontawesome.css" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/preloader.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/app.css" rel="stylesheet">

    <!-- Toastr -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/toastr.css" rel="stylesheet">

    <!-- Verificador CSS -->
    <link type="text/css" href="<?php echo site_url('assets/css/verificador.css'); ?>" rel="stylesheet">

    <!-- bootstrap selectpicker -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        #toast-container>.toast-error {
            background-color: #d9534f !important;
        }

        .posicao-toast {
            width: 100%;
        }

        .posicao-toast .toast {
            margin: auto !important;
        }
    </style>
</head>

<body class="layout-app ">

    <div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>

        <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

        <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
    </div>

    <!-- Drawer Layout -->

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content d-flex justify-content-center">

            <!-- Header -->



            <!-- // END Header -->

            <!-- BEFORE Page Content -->

            <!-- // END BEFORE Page Content -->

            <!-- Page Content -->

            <div class="pb-32pt">
                <div class="container page__container">

                    <form method="post" action="<?php echo site_url('rede/linkCadastro/cadastrar'); ?>" enctype="multipart/form-data" class="col-md-12 p-0 mx-auto">
                        <input type="hidden" name="id_indicador" value="<?php echo $indicador['id']; ?>" />
                        <input type="hidden" name="link_indicador" value="<?php echo $link; ?>" />
                        <center>
                            <img src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" style="max-width:300px;">
                            <h4>Seja bem vindo à KEROSER!</h4>
                            <p>Escolha seu plano e preencha seus dados abaixo para começar a ter todas as vantagens de ser um <b>membro KEROSER</b>.</p>
                            <h5 style="text-transform:none;"><b>Indicado Por: </b><span class="text-accent"><?php echo $indicador['login']; ?></span><br />
                                <span class="text-primary"><?php echo $indicador['email']; ?></span></h5>
                        </center>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-row justify-content-center">
                                            <div class="col-md-6 pr-5">
                                                <label class="form-label" for="username">PLANO DE PAGAMENTO: *</label>
                                                <select name="plano" id="planos" onchange="mudaPlano($(this).val())" class="form-control selectpicker" data-live-search="true" data-size="5" required>
                                                    <?php foreach ($planos as $pln) {
                                                        echo '<option value="' . $pln['id'] . '">' . $pln['nome'] . ' - R$ ' . number_format($pln['valor'], 2, ',', '') . ' / MÊS</option>';
                                                    } ?>
                                                </select>
                                                <div class="alert alert-warning mt-2" role="alert">
                                                    Caso sua fatura atrase por <b><?php echo $config[0]['tempo_desativar_usuario'] ?> dias</b> você perderá o acesso aos benefícios do plano e não poderá pedir saques até ficar em dia novamente.
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-4">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <b>Plano</b>
                                                    </div>
                                                    <div class="col">
                                                        <b>Valor Mensal</b>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-row">
                                                    <div id="planoRow" class="col">
                                                        <span class="text-primary"><?php echo $planos[0]['nome']; ?></span>
                                                    </div>
                                                    <div id="valorRow" class="col">
                                                        <h5>R$ <?php echo number_format($planos[0]['valor'], 2, ',', ''); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div id="descricaoRow" class="col">
                                                        <p><?php echo $planos[0]['descricao']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h5 class="card-title mb-4">Dados de login</h5>
                                        <div class="form-group">
                                            <label class="form-label" for="username">Usuario: *</label>
                                            <input name="login" id="username" type="text" class="form-control" placeholder="Seu usuario..." required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">Senha: *</label>
                                            <input name="senha" id="password" type="password" class="form-control" placeholder="*********************" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="confirm_password">Confirmar Senha: *</label>
                                            <input name="confirmar_senha" igual="senha" id="confirm_password" type="password" class="form-control" placeholder="*********************" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="email">Email: *</label>
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Seu email..." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Dados Pessoais</h5>
                                        <div class="form-group">
                                            <label class="form-label" for="username">Nome: *</label>
                                            <input name="nome" id="nome" type="text" class="form-control" placeholder="Seu nome completo..." required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="username">CPF / CNPJ: *</label>
                                            <input name="cpf" id="cpf" type="cpf" class="form-control cpf" placeholder="XXX.XXX.XXX-XX" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">Telefone: *</label>
                                            <input name="telefone" id="telefone" type="telefone" class="form-control telefone" placeholder="(XX) XXXXX-XXXX" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="username">Foto:</label>
                                            <div class="custom-file">
                                                <input name="foto" type="file" id="foto" class="custom-file-input">
                                                <label for="foto" class="custom-file-label">Escolher Arquivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h5 class="card-title mb-4">Endereço *</h5>

                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label class="form-label" for="username">Cep: *</label>
                                                <div class="input-group mb-3">
                                                    <input type="cep" id="cep" name="cep" class="form-control cep" placeholder="XXXXX-XXX" aria-describedby="basic-addon2" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-light" type="button" onclick="getCep($('#cep').val(), '#estado', '#cidade');" style="height: 36px;">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label" for="username">Estado: *</label>
                                                <select id="estado" onchange="getCidades($(this).val(), '#cidade')" class="form-control selectpicker" title="UF" name="estado" data-live-search="true" data-size="5" required>
                                                    <?php foreach ($estados as $estd) {
                                                        echo '<option value="' . $estd['nome'] . '">' . $estd['uf'] . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="username">Cidade: *</label>
                                                <select id="cidade" class="form-control selectpicker" name="cidade" data-live-search="true" title="Selecione uma cidade..." data-size="5" required>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-row pt-3">
                                            <div class="col-md-5">
                                                <label class="form-label" for="username">Logradouro: *</label>
                                                <input name="endereco" id="endereco" type="text" class="form-control" placeholder="Rua, avenida..." required>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label" for="username">Numero: *</label>
                                                <input id="numero" type="number" class="form-control" name="numero" placeholder="XXX" step="1" min="0" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label" for="username">Complemento:</label>
                                                <input name="complemento" id="complemento" type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="username">Bairro: *</label>
                                                <input name="bairro" id="bairro" type="text" class="form-control" placeholder="Seu bairro..." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i>&nbsp;&nbsp;Prosseguir para o pagamento!</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- // END Page Content -->


        </div>

        <!-- // END drawer-layout__content -->



    </div>

    <!-- // END Drawer Layout -->

    <!-- jQuery -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/popper.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/app.js"></script>

    <!-- Preloader -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/preloader.js"></script>

    <!-- Toastr -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/toastr.js"></script>

    <!-- Validador de formulários -->
    <script src="<?php echo site_url('assets/js/verificador.js'); ?>"></script>

    <!-- bootstrap selectpicker -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <?php
    if ($this->session->flashdata('aviso_tipo')) { ?>
        <script>
            $(document).ready(function() {
                var options = {
                    "closeButton": true,
                    "positionClass": "posicao-toast",
                    "progressBar": true,
                    "timeOut": 5000
                }
                <?php if ($this->session->flashdata('aviso_tipo') == 'warning' || $this->session->flashdata('aviso_tipo') == '3' || $this->session->flashdata('aviso_tipo') == 'atencao') { ?>
                    toastr.warning('<?php echo $this->session->flashdata('aviso_msg'); ?>', 'Atenção', options);
                <?php } else if ($this->session->flashdata('aviso_tipo') == 'success' || $this->session->flashdata('aviso_tipo') == '0' || $this->session->flashdata('aviso_tipo') == 'sucesso') { ?>
                    toastr.success('<?php echo $this->session->flashdata('aviso_mensagem'); ?>', 'Sucesso!', options);
                <?php } else if ($this->session->flashdata('aviso_tipo') == 'error' || $this->session->flashdata('aviso_tipo') == '1' || $this->session->flashdata('aviso_tipo') == 'danger' || $this->session->flashdata('aviso_tipo') == 'erro' || $this->session->flashdata('aviso_tipo') == 'perigo') { ?>
                    toastr.error('<?php echo $this->session->flashdata('aviso_mensagem'); ?>', 'Erro!', options);
                <?php } ?>
            });
        </script>
    <?php } ?>
    <script>
        function mascaraCep(obj) {
            var i = 0;
            var v = obj.value;
            v = v.replace(/\D/g, "");
            v = v.length > 8 ? v.substring(0, 8) : v;
            v = v.replace(/(\d{5})(\d)/, "$1-$2");
            obj.value = v;
        }

        function mascaraCPF(obj) {
            var or = obj.value;
            var v = or.replace(/\D/g, '');
            if (v.length > 14){
                v = v.substring(0, 14);
            }
            if (v.length >= 10) {
                if (v.length <= 11) { //CPF
                    v = v.replace(/(\d{3})(\d)/, "$1.$2");
                    v = v.replace(/(\d{3})(\d)/, "$1.$2");
                    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
                    obj.value = v;

                } else { //CNPJ
                    v = v.replace(/(\d{2})(\d)/, "$1.$2");
                    v = v.replace(/(\d{3})(\d)/, "$1.$2");
                    v = v.replace(/(\d{3})(\d)/, "$1/$2");
                    v = v.replace(/(\d{4})(\d)/, "$1-$2");
                    obj.value = v;
                }
            } else {
                obj.value = obj.value;
            }
        }


        $(document).ready(function() {
            $('.cep').on('keyup', function() {
                mascaraCep(this);
            });

            $('.cpf').on('keyup', function() {
                mascaraCPF(this);
            });
        });

        var planos = <?php echo json_encode($planos); ?>;

        function mudaPlano(val) {
            var planSel = null;
            planos.map((pln) => {
                if (pln.id == val) {
                    planSel = pln;
                }
            });
            console.log(planSel);
            $('#planoRow span').html(planSel.nome);
            $('#valorRow h5').html(parseFloat(planSel.valor).toFixed(2).toString().replace('.', ','));
            $('#descricaoRow p').html(planSel.descricao);
        }

        function getCidades(id, selector) {
            var xmlhttp = new XMLHttpRequest();
            dataFormAj = new FormData();
            dataFormAj.append('estado', id);
            addLoaderLabel(selector);
            xmlhttp.open("POST", "<?php echo site_url('enderecos/buscar_cidades') ?>", true);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var retorno = JSON.parse(this.responseText);
                    if (typeof retorno !== 'undefined' && retorno !== null) {
                        var opt = '';
                        retorno.map((cid) => {
                            opt += '<option value="' + cid.nome + '">' + cid.nome + '</option>';
                        });
                        document.querySelector(selector).innerHTML = opt;
                        $(selector).selectpicker('destroy');
                        $(selector).selectpicker();
                    }
                }
                removeLoaderLabel(selector);
            };
            xmlhttp.send(dataFormAj);
        }

        function addLoaderLabel(elemento) {
            var label = $(elemento).parent().parent().find('.form-label');
            if (!$(elemento).parent().parent().find('.fa-spinner').length) {
                label[0].innerHTML += ' <i class="fa fa-spinner fa-spin"></i>';
            }
        }

        function removeLoaderLabel(elemento) {
            if ($(elemento).parent().parent().find('.fa-spinner').length) {
                $(elemento).parent().parent().find('.fa-spinner').remove();
            }
        }


        function getCep(id, selEstados, selCidades) {
            var xmlhttp = new XMLHttpRequest();
            dataFormAj = new FormData();
            dataFormAj.append('cep', id);
            console.log(id);
            addLoaderLabel(selEstados);
            addLoaderLabel(selCidades);
            altera = false;
            xmlhttp.open("POST", "<?php echo site_url('enderecos/buscar_cep') ?>", true);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var retorno = JSON.parse(this.responseText);
                    if (typeof retorno.estado !== 'undefined' && retorno.estado !== null) {
                        $(selEstados).val(retorno.estado.nome);
                        console.log($(selEstados).val());
                    }
                    var opt = '';
                    if (typeof retorno.cidades !== 'undefined' && retorno.cidades !== null) {
                        retorno.cidades.map((cid) => {
                            opt += '<option value="' + cid.nome + '">' + cid.nome + '</option>';
                        });
                        document.querySelector(selCidades).innerHTML = opt;
                        $(selCidades).addClass("selectpicker").selectpicker('refresh');
                    }
                    if (typeof retorno.cidade !== 'undefined' && retorno.cidade !== null) {
                        $(selCidades).val(retorno.cidade.nome);
                        $(selCidades).addClass("selectpicker").selectpicker('refresh');
                    }
                    $(selEstados).addClass("selectpicker").selectpicker('refresh');

                }
                removeLoaderLabel(selEstados);
                removeLoaderLabel(selCidades);
            };
            xmlhttp.send(dataFormAj);
        }
    </script>
</body>

</html>