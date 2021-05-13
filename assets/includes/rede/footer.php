    <!-- Footer -->

    <div class="bg-white border-top-2 mt-auto">
        <div class="container page__container page-section d-flex flex-column">
        </div>
    </div>

    <!-- // END Footer -->

    </div>

    <!-- // END drawer-layout__content -->

    <!-- Drawer -->

    <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>

                <!-- Sidebar Content -->

                <a href="<?php echo site_url('rede/index'); ?>" class="sidebar-brand ">
                    <!-- <img class="sidebar-brand-icon" src="<?php echo site_url('assets/assetsAlison'); ?>/images/illustration/student/128/white.svg" alt="Luma"> -->

                    <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                        <span class="avatar-title rounded bg-primary" style="background-color:#fff !important; width: 300px!important;"><img src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" class="img-fluid" alt="logo" /></span>

                    </span>

                    <span>KEROSER REDE</span>
                </a>

                <div class="sidebar-heading">Navegação</div>
                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?php echo site_url('rede/index'); ?>">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                            <span class="sidebar-menu-text">Inicio</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-heading">Minha Gestão</div>
                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left" style="max-width:24px;">receipt_long</span>
                            Minha Assinatura
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/faturas/abertas') ?>">
                                    <span class="sidebar-menu-text">Faturas em aberto</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/faturas/pagas') ?>">
                                    <span class="sidebar-menu-text">Faturas pagas</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/assinatura/detalhes') ?>">
                                    <span class="sidebar-menu-text">Detalhes do plano</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu2">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left" style="max-width:24px;">account_tree</span>
                            Minha Rede
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu2">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/visualizar') ?>">
                                    <span class="sidebar-menu-text">Visualizar</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/unilevel') ?>">
                                    <span class="sidebar-menu-text">Unilevel</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/meus_diretos') ?>">
                                    <span class="sidebar-menu-text">Meus diretos</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_family">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left" style="max-width:24px;">groups</span>
                            Dependentes
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_family">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/dependentes/listar') ?>">
                                    <span class="sidebar-menu-text">Listar</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/dependentes/cadastrar') ?>">
                                    <span class="sidebar-menu-text">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu3">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left" style="max-width:24px;">poll</span>
                            Controle Financeiro
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu3">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/financeiro/balanco') ?>">
                                    <span class="sidebar-menu-text">Balanço</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="javascript:void(0)" data-toggle="modal" data-target="#modal_relatorio_balanco">
                                    <span class="sidebar-menu-text">Relatório por datas</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu4">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left" style="max-width:24px;">local_atm</span>
                            Saques
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu4">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/saques/pedir') ?>">
                                    <span class="sidebar-menu-text">Pedir Saque</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/saques/abertos') ?>">
                                    <span class="sidebar-menu-text">Pedidos em aberto</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo site_url('rede/saques/concluidos') ?>">
                                    <span class="sidebar-menu-text">Pedidos concluídos</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="javascript:void(0)" data-toggle="modal" data-target="#modal_relatorio_saques">
                                    <span class="sidebar-menu-text">Relatório por datas</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!-- // END Sidebar Content -->

                <!-- // END Sidebar Content -->
                <div class="sidebar-heading">FAQ</div>
                    <ul class="sidebar-menu">

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?php echo site_url('rede/perguntas_frequentes'); ?>">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">help_outline</span>
                                Perguntas Frequentes
                            </a>
                        </li>
                    </ul>
                    <!-- // END Sidebar Content -->

            </div>
        </div>
    </div>

    <!-- // END Drawer -->

    </div>

    <?php
    $retorno = checaIncludes();
    if ($retorno != '') {
        include_once($retorno);
    }

    $avisos = checaAvisos('rede', $this->session->userdata('id'));
    if ($avisos != ''){
        echo $avisos;
    }
    ?>

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

    <!-- Global Settings -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/settings.js"></script>

    <!-- Flatpickr -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/flatpickr.js"></script>

    <!-- Moment.js -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/moment.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/moment-range.js"></script>

    <!-- Chart.js -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/Chart.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/chartjs.js"></script>

    <!-- Chart.js Samples -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/page.student-dashboard.js"></script>

    <!-- List.js -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/list.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/list.js"></script>

    <!-- Tables -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/toggle-check-all.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/check-selected-row.js"></script>

    <!-- Toastr -->
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.js"></script>
    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/toastr.js"></script>

    <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/toastr.js"></script>

    <!-- Validador de formulários -->
    <script src="<?php echo site_url('assets/js/verificador2.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/verificador_datas8.min.js'); ?>"></script>

    <!-- bootstrap selectpicker -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <?php if (isset($tables) && $tables) { ?>
        <!-- Datatables -->
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.js" integrity="sha512-18QiVdJv36r1ryb5mr1lFpm4wZMORhvGgvz0mHQllOmx3NmSZkYwWuDcecFByaRVWqiQ0F/FZC5pCBMuy8IfkQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.js" integrity="sha512-TtLC7VxmsBn2S6vL3Ib403LU+Gf8cH4wf7UdOxRBRKVrtLXPjA5Tv4/hY7BwIeGAJ/YKNjRtjG4nTzYD/snZOQ==" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.data-tables').dataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
                    },
                    "bInfo": false,
                    "pageLength": 10,
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdf',
                            footer: true,
                            <?php if (isset($colunas)) {
                                echo 'exportOptions: {
                                columns: [' . $colunas . ']
                            }';
                            } ?>
                        },
                        {
                            extend: 'csv',
                            footer: false,
                            <?php if (isset($colunas)) {
                                echo 'exportOptions: {
                                columns: [' . $colunas . ']
                            }';
                            } ?>

                        },
                        {
                            extend: 'excel',
                            footer: false,
                            <?php if (isset($colunas)) {
                                echo 'exportOptions: {
                                columns: [' . $colunas . ']
                            }';
                            } ?>
                        }
                    ]
                });

                $('.data-tables-no-btn').dataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json",
                    },
                    "bInfo": false,
                    "pageLength": 10
                });


            });
        </script>

    <?php } ?>
    <script>
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

        function copiarSelecao(selector, $text = 'Texto copiado para o clipboad.') {
            var copyText = document.querySelector(selector);

            copyText.select();
            copyText.setSelectionRange(0, 99999);

            document.execCommand("copy");

            aviso('success', '', $text);
        }

        function aviso(tipo, titulo, mensagem) {
            var options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 5000
            }
            if (tipo == 'warning' || tipo == '3' || tipo == 'atencao') {
                toastr.warning(mensagem, titulo, {
                    timeOut: 5000
                });
            } else if (tipo == 'success' || tipo == '0' || tipo == 'sucesso') {
                toastr.success(mensagem, titulo, {
                    timeOut: 5000
                });
            } else if (tipo == 'error' || tipo == '1' || tipo == 'danger' || tipo == 'erro' || tipo == 'perifo') {
                toastr.error(mensagem, titulo, {
                    timeOut: 5000
                });
            }
        }

        function showModal(obj) {
            console.log(obj);
            var href = $(obj).attr('data-href');
            var titulo = $(obj).attr('data-titulo');
            var texto = $(obj).attr('data-texto');
            var btn = $(obj).attr('data-btn');
            var btnacao = $(obj).attr('data-btn-acao');
            var action = typeof btnacao == 'undefined' ? `<button type="button" class="btn btn-accent">${btnacao}</button>` : '';
            var modal = `<div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titulo-modal-aviso">${titulo}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ${texto}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">${btn}</button>
                            <a href="${href}">
                                ${action}
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>`;
            if ($('#modal-aviso').length) {
                $('#modal-aviso').remove();
            }
            $('body').append(modal);
            $('#modal-aviso').modal('show');
        }

        $(document).ready(function() {
            $('button[data-toggle="aviso-modal"]').on('click', function() {
                showModal(this);
            });

            $('a[data-toggle="aviso-modal"]').on('click', function() {
                showModal(this);
            });
            if ($('#modal-aviso').length){
                $('#modal-aviso').modal('show');
            }
        });
    </script>
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
    </body>

    </html>