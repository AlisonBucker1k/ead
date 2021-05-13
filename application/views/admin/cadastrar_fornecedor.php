<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Cadastro de Fornecedor
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <form action="<?php echo base_url(); ?>admin/fornecedores/insere" enctype="multipart/form-data" method="POST">
            <div class="row">

                <div class="col-md-6 mb-24pt mb-md-0">


                    <div class="form-row">
                        <div class="col-md-12 col-12">
                            <label class="form-label" for="name">Cadastro no Fornecedor: *</label>
                            <input id="cadastro_no_fornecedor" type="text" class="form-control" placeholder="Cadastro no Fornecedor" name="cadastro_no_fornecedor" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-md-12 col-12">
                            <label class="form-label" for="name">Empresa ou Pessoa: *</label>
                            <input id="empresa" type="text" class="form-control" placeholder="Empresa ou Pessoa" name="empresa" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-12">
                            <label class="form-label" for="name">Atividade: *</label>
                            <input id="atividade" type="text" class="form-control" placeholder="Atividade do Fornecedor" name="atividade" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="name">Contato: *</label>
                            <input id="contato" type="telefone" class="form-control telefone" placeholder="(XX) XXXXX-XXXX" name="contato">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="name">Nextel: *</label>
                            <input id="nextel" type="telefone" class="form-control telefone" placeholder="(XX) XXXXX-XXXX" name="nextel">
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="name">Telefone: *</label>
                            <input id="telefone" type="telefone" class="form-control telefone" placeholder="(XX) XXXX-XXXX" name="telefone">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="name">Celular: *</label>
                            <input id="celular" type="telefone" class="form-control telefone" placeholder="(XX) XXXXX-XXXX" name="celular">
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-12">
                            <label class="form-label" for="username">Endereço: *</label>
                            <input name="endereco" id="endereco" type="text" class="form-control" placeholder="Rua, avenida..., Nº" required>
                        </div>
                    </div>

                    <div class="form-row pt-3">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label class="form-label" for="username">Estado: *</label>
                            <select id="estado" onchange="getCidades($(this).val(), '#cidade')" class="form-control selectpicker" title="UF" name="estado" data-live-search="true" data-size="5" required>
                                <?php foreach ($estados as $estd) {
                                    echo '<option value="' . $estd['nome'] . '" >' . $estd['uf'] . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12">
                            <label class="form-label" for="username">Cidade: *</label>
                            <select id="cidade" class="form-control selectpicker" name="cidade" data-live-search="true" title="Selecione uma cidade..." data-size="5" required>
                            </select>
                        </div>

                    </div>

                    <div class="form-row pt-3">
                        <div class="col-6">
                            <label class="form-label" for="username">Bairro: </label>
                            <input name="bairro" id="bairro" type="text" class="form-control" placeholder="Bairro do fornecedor...">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="username">Email: </label>
                            <input name="email" id="email" type="text" class="form-control" placeholder="Email do fornecedor...">
                        </div>
                    </div>



                </div>
                <div class="col-md-6">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h5><button type="button" class="btn btn-light" onclick="adcionarContaFornecedor('#contasFornecedor')"><i class="fa fa-plus"></i></button> Contas do fornecedor</h5>
                            <hr>
                            <div id="contasFornecedor">

                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 ml-3">Cadastrar Fornecedor</button>

            </div>
        </form>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>

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
        if (v.length > 14) {
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

    $(document).ready(function() {
        var obj = document.querySelector('.cep');
        mascaraCep(obj);

        var obj3 = document.querySelector('#telefone');
        mascara(obj3, mtel);

        $('.cep').on('keyup', function() {
            mascaraCep(this);
        });
    });
</script>