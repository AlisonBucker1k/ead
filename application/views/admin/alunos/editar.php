<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>

<script>
    function alterarSenha() {
        if ($('#senhaAt').prop('readonly')) {
            $('#senhaAt').prop('readonly', false);
            $('#confirm_password').prop('readonly', false);
            $('#alterar_password').html('Não alterar');
        } else {
            $('#senhaAt').prop('readonly', true);
            $('#confirm_password').prop('readonly', true);
            $('#alterar_password').html('Alterar');
        }
    }
</script>
<div class="page-section border-bottom-2">
    <div class="container page__container">
    <form method="post" action="<?php echo site_url('admin/alunos/update/'.$aluno[0]['id']); ?>" enctype="multipart/form-data" class="col-md-12 p-0 mx-auto">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title mb-4">Dados de login</h5>
                        <div class="form-group">
                            <label class="form-label" for="username">Usuario: *</label>
                            <input name="login" id="username" type="text" class="form-control" value="<?php echo $aluno[0]['login'] ?>" placeholder="Seu usuario..." required>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label class="form-label" for="password">Senha: </label>
                                <div class="input-group mb-3">
                                    <input name="senha" id="senhaAt" type="password" class="form-control" placeholder="*********************" readonly>
                                    <div class="input-group-append">
                                        <button id="alterar_password" class="btn btn-light" type="button" onclick="alterarSenha();" style="height: 36px;">
                                            Alterar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label" for="confirm_password">Confirmar Senha: *</label>
                                <input name="confirmar_senha" igual="senha" id="confirm_password" type="password" class="form-control" placeholder="*********************" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email: *</label>
                            <input name="email" id="email" type="email" class="form-control" value="<?php echo $aluno[0]['email'] ?>" placeholder="Seu email..." required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Dados Pessoais</h5>
                        <div class="form-group">
                            <label class="form-label" for="username">Nome: *</label>
                            <input name="nome" id="nome" type="text" class="form-control" value="<?php echo $aluno[0]['nome'] ?>" placeholder="Seu nome completo..." required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="username">CPF / CNPJ: *</label>
                            <input name="cpf" id="cpf" type="cpf" class="form-control cpf" value="<?php echo $aluno[0]['cpf']; ?>" placeholder="XXX.XXX.XXX-XX" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Telefone: *</label>
                            <input name="telefone" id="telefone" type="telefone" class="form-control telefone" value="<?php echo $aluno[0]['telefone']; ?>" 
                            placeholder="(XX) XXXXX-XXXX" required>
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
                                    <input type="cep" id="cep" name="cep" class="form-control cep" value="<?php echo $aluno[0]['cep']; ?>" placeholder="XXXXX-XXX" aria-describedby="basic-addon2" required>
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
                                        $selected = $estd['nome'] == $aluno[0]['estado'] ? "selected" : "";
                                        echo '<option value="' . $estd['nome'] . '" ' . $selected . '>' . $estd['uf'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="username">Cidade: *</label>
                                <select id="cidade" class="form-control selectpicker" name="cidade" data-live-search="true" title="Selecione uma cidade..." data-size="5" required>
                                    <?php foreach ($cidades as $estd) {
                                        $selected = $estd['nome'] == $aluno[0]['cidade'] ? "selected" : "";
                                        echo '<option value="' . $estd['nome'] . '" ' . $selected . '>' . $estd['nome'] . '</option>';
                                    } ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-row pt-3">
                            <div class="col-md-5">
                                <label class="form-label" for="username">Logradouro: *</label>
                                <input name="endereco" id="endereco" type="text" value="<?php echo $aluno[0]['endereco'] ?>" class="form-control" placeholder="Rua, avenida..." required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="username">Numero: *</label>
                                <input id="numero" type="number" class="form-control" name="numero" value="<?php echo $aluno[0]['numero'] ?>" placeholder="XXX" step="1" min="0" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="username">Complemento:</label>
                                <input name="complemento" id="complemento" type="text" class="form-control" value="<?php echo $aluno[0]['complemento'] ?>" placeholder="">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="username">Bairro: *</label>
                                <input name="bairro" id="bairro" type="text" class="form-control" value="<?php echo $aluno[0]['bairro'] ?>" placeholder="Seu bairro..." required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i>&nbsp;&nbsp;Salvar Alterações</button>
        </div>
        </form>
    </div>
</div>

<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>

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

        var obj2 = document.querySelector('.cpf');
        mascaraCPF(obj2);

        var obj3 = document.querySelector('#telefone');
        mascara(obj3, mtel);

        $('.cep').on('keyup', function() {
            mascaraCep(this);
        });

        $('.cpf').on('keyup', function() {
            mascaraCPF(this);
        });
    });
</script>