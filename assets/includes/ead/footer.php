<!-- Footer -->

<div class="bg-white border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
        <!-- <p class="text-70 brand mb-24pt">
            <img class="brand-icon" src="<?php echo site_url('assets/assetsAlison'); ?>/images/logo/black-70@2x.png" width="30" alt="Luma"> Luma
        </p>
        <p class="measure-lead-max text-50 small mr-8pt">Luma is a beautifully crafted user interface for modern Education Platforms, including Courses & Tutorials, Video Lessons, Student and Teacher Dashboard, Curriculum Management, Earnings and Reporting, ERP, HR, CMS, Tasks, Projects, eCommerce and more.</p>
        <p class="mb-8pt d-flex">
            <a href="" class="text-70 text-underline mr-8pt small">Terms</a>
            <a href="" class="text-70 text-underline small">Privacy policy</a>
        </p>
        <p class="text-50 small mt-n1 mb-0">Copyright 2019 &copy; All rights reserved.</p> -->
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

            <a href="<?php echo site_url('ead/index'); ?>" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="<?php echo site_url('assets/assetsAlison'); ?>/images/illustration/student/128/white.svg" alt="Luma"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <!-- <span class="avatar-title rounded bg-primary" style="background-color:#fff !important; width: 300px!important;"></span> -->
                    <img src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" class="img-fluid" alt="logo" />

                </span>

                <!-- <span>KEROSER</span> -->
            </a>

            <div class="sidebar-heading">Navegação</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('ead/index'); ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Inicio</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">Aprendizado</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button js-sidebar-collapse" data-toggle="collapse" href="#enterprise_menu">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        Cursos
                        <span class="ml-auto sidebar-menu-toggle-icon"></span>
                    </a>
                    <ul class="sidebar-submenu collapse sm-indent" id="enterprise_menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?php echo site_url('ead/cursos/meusCursos/') ?>">
                                <span class="sidebar-menu-text">Meus Cursos</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?php echo site_url('ead/cursos/') ?>">
                                <span class="sidebar-menu-text">Todos os cursos</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('ead/quadro_de_notas') ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment</span>
                        Quadro de notas
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('ead/cursos/concluidos') ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">assignment_turned_in</span>
                        Cursos Concluídos
                    </a>
                </li>
            </ul>
            <!-- // END Sidebar Content -->


            <div class="sidebar-heading">FAQ</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('ead/perguntas_frequentes'); ?>">
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

$avisos = checaAvisos('ead', $this->session->userdata('id'));
if ($avisos != '') {
    echo $avisos;
}
?>

<?php if ($this->session->userdata('mensagem_ava_titulo') != ""): ?>
<div class="modal fade" id="mensagemAvaTxT" tabindex="-1" role="dialog" aria-labelledby="titulo-mensagemAvaTxT" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-mensagemAvaTxT"><?php echo $this->session->userdata('mensagem_ava_titulo'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->session->userdata('mensagem_ava_texto'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php $this->session->unset_userdata(['mensagem_ava_titulo', 'mensagem_ava_texto']); endif; ?>



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
    $(document).ready(function() {
        $('button[data-toggle="aviso-modal"]').on('click', function() {
            showModal(this);
        });

        $('a[data-toggle="aviso-modal"]').on('click', function() {
            showModal(this);
        });

        if ($('#mensagemAvaTxT').length){
            $('#mensagemAvaTxT').modal('show');
        }
        if ($('#modal-aviso').length) {
            $('#modal-aviso').modal('show');
        }

        <?php if (isset($scriptFooter)) {
            echo $scriptFooter;
        } ?>

        
    });
</script>
<script>
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
<script>
    function showProfessorModal(){
        $('#professorModal .avatar').html('');
        $('#professorModal .conteudoProf').html('<i class="fa fa-spinner fa-spin" style="font-size:2rem;"></i>');
        $('#professorModal').modal('show');
    }

    function atualizaProfessorModal(prof){
        $('#professorModal .imgProf').html(`
            <div class="avatar avatar-xxl">
                <img src="${prof.img}" alt="Avatar" class="avatar-img rounded-circle">
            </div>
        `);


        $('#professorModal .conteudoProf').html(`
            <div class="col mt-2 text-center">
                <b>Nome: </b>${prof.nome}
            </div>
            <div class="col mt-2 text-center">
                <b>Email: </b>${prof.email}
            </div>
            <div class="col mt-2 text-center">
                <b>Graduação: </b>${prof.graduacao}
            </div>
            <div class="col mt-2 text-center">
                <b>Telefone: </b>${prof.telefone}
            </div>
        `);
        $('#professorModal').modal('show');
    }

    function showModal(href, titulo, texto, btn, btnacao) {
        var modal = `<div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulo-modal-aviso">${titulo}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="${href}">
                                <div class="modal-body">
                                    ${texto}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">${btn}</button>
                                    
                                    <button type="submit" class="btn btn-accent">${btnacao}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>`;
        if ($('#modal-aviso').length) {
            $('#modal-aviso').remove();
        }
        $('body').append(modal);
        $('#modal-aviso').modal('show');
    }

    function showProfessor(id){
        showProfessorModal();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo site_url('ead/professor/getById') ?>/" + id, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var professor = JSON.parse(this.responseText);
                atualizaProfessorModal(professor);
            }
        };
        xmlhttp.send();
    }
</script>
</body>

</html>