<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Listagem de fornecedores da rede<br/>
                <a href="<?php echo site_url('admin/fornecedores/cadastrar'); ?>" >
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Cadastrar Novo</button>
                </a>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">

        <div class="table-responsive" >
            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                <thead>
                    <tr>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>
                        <th>Empresa / Pessoa</th>
                        <th>Atividade</th>
                        <th>Telefone</th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($entradas as $ent) {
                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">#' . $ent['id'] . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['empresa'] . '
                            </td>
                            <td class="js-lists-values-login" style="max-width:300px;text-overflow: ellipsis;overflow-x: hidden;">
                                ' . $ent['atividade'] . '
                            </td>
                            <td class="js-lists-values-login" style="max-width:300px;text-overflow: ellipsis;overflow-x: hidden;">
                                ' . $ent['telefone'] . '
                            </td>
                            <td>
                                <a href="'.site_url('admin/fornecedores/editar/'.$ent['id']).'">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar fornecedor"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/fornecedores/remove/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-trash'".'></i> Remover fornecedor"
                                data-texto="Deseja realmente remover o fornecedor <b>'.$ent['empresa'].'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover fornecedor"
                                data-toggle="aviso-modal"
                                title="Remover fornecedor"><i class="fa fa-trash"></i></button>
                                
                            </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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


    async function getCep(id, selEstados, selCidades) {
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