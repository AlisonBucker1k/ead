<!-- Footer -->
<!-- É NECESSÁRIO ALTERAR AS URLS PARA O USUÁRIO -->
<!-- PROFESSOR OU ADMIN OU ALUNO -->


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

            <a href="<?php echo site_url('professor/index'); ?>" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="<?php echo site_url('assets/assetsAlison'); ?>/images/illustration/student/128/white.svg" alt="Luma"> -->

                <img src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" style="width: 100px;">

                
            </a>

            <div class="sidebar-heading">Navegação</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('professor/index'); ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Inicio</span>
                    </a>
                </li>

            </ul>
            <!-- // END Sidebar Content -->
            <div class="sidebar-heading">Administrando</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="javascript:void(0)" 
                    <?php if ($this->session->userdata('curso_selecionado_id') != ""){ ?> onclick="mudarCurso()" <?php } ?> >
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                        <span class="sidebar-menu-text"><?php echo $this->session->userdata('curso_selecionado'); ?></span>
                    </a>
                    <small class="ml-4" style="font-size:90%;color:rgba(172,182,191,.5);">(Clique para alterar)</small>
                </li>
            </ul>
            <!-- // END Sidebar Content -->
            <div class="sidebar-heading">Alunos</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('professor/assinaturas'); ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                        <span class="sidebar-menu-text">Assinaturas Ativas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('professor/quadro_de_notas'); ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
                        <span class="sidebar-menu-text">Quadro de notas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('professor/aluno/aprovar_ou_reprovar'); ?>">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person_pin</span>
                        <span class="sidebar-menu-text">Aprovar ou reprovar</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="javascript:void(0)" data-toggle="modal" data-target="#alunos_aprovados">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">check_box</span>
                        <span class="sidebar-menu-text">Alunos Aprovados</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="javascript:void(0)" data-toggle="modal" data-target="#alunos_reprovados">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">cancel</span>
                        <span class="sidebar-menu-text">Alunos Reprovados</span>
                    </a>
                </li>
            </ul>

            <!-- // END Sidebar Content -->
            <div class="sidebar-heading">FAQ</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?php echo site_url('professor/perguntas_frequentes'); ?>">
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

$avisos = checaAvisos('prof', $this->session->userdata('id'));
if ($avisos != '') {
    echo $avisos;
}
?>

<?php include_once(__DIR__.'/modais/modal_cursos.php'); ?>
<?php include_once(__DIR__.'/modais/modal_aluno.php'); ?>


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

<!-- Quill -->
<script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/quill.min.js"></script>
<script src="<?php echo site_url('assets/assetsAlison'); ?>/js/quill.js"></script>

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
    function showAlunoModal(){
        $('#alunoModal .avatar').html('');
        $('#alunoModal .conteudoAluno').html('<i class="fa fa-spinner fa-spin" style="font-size:2rem;"></i>');
        $('#alunoModal').modal('show');
    }

    function atualizaAlunoModal(aln){
        $('#alunoModal .imgAluno').html(`
            <div class="avatar avatar-xxl">
                <img src="${aln.img}" alt="Avatar" class="avatar-img rounded-circle">
            </div>
        `);


        $('#alunoModal .conteudoAluno').html(`
            <div class="col mt-2 text-center">
                <b>Nome: </b>${aln.nome}
            </div>
            <div class="col mt-2 text-center">
                <b>Email: </b>${aln.email}
            </div>
            <div class="col mt-2 text-center">
                <b>Telefone: </b>${aln.telefone}
            </div>
        `);
        $('#alunoModal').modal('show');
    }

    function showAluno(id){
        console.log('entrou');
        showAlunoModal();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo site_url('professor/aluno/getById') ?>/" + id, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var aln = JSON.parse(this.responseText);
                console.log(aln);
                atualizaAlunoModal(aln);
            }
        };
        xmlhttp.send();
    }

    function templateCurso(curso){
        return `<div class="col-md-4 col-12">
        <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card " >
                <a href="<?php echo site_url('professor/cursos/selecionar'); ?>/${curso.id}"
                class="js-image"
                data-position="">
                    <img src="${curso.img_brd}"
                        alt="${curso.nome}">
                    <span class="overlay__content align-items-start justify-content-start">
                        <span class="overlay__action card-body d-flex align-items-center">
                            <i class="material-icons mr-4pt">check_circle</i>
                            <span class="card-title text-white">Selecionar</span>
                        </span>
                    </span>
                </a>
                <div class="mdk-reveal__content">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                href="<?php echo site_url('professor/cursos/selecionar'); ?>/${curso.id}">${curso.nome}</a>
                            </div>
                            <a href="<?php echo site_url('professor/cursos/selecionar'); ?>/${curso.id}"
                            class="ml-4pt material-icons text-20 card-course__icon-favorite">check_circle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }
    function mudarCurso(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo site_url('professor/cursos/getJson'); ?>", true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var retorno = JSON.parse(this.responseText);
                
                var ins = '';
                retorno.map((curso) => {
                    ins += templateCurso(curso);
                });
                var templater = `<div class="row">
                    ${ins}
                </div>`;
                $('#modalCursosBody').html(templater);
                $('#modalCursos').modal('show');
            }
        };
        xmlhttp.send();
    }

    $(document).ready(function() {
        $('button[data-toggle="aviso-modal"]').on('click', function() {
            showModal(this);
        });

        $('a[data-toggle="aviso-modal"]').on('click', function() {
            showModal(this);
        });

        if ($('#modal-aviso').length) {
            $('#modal-aviso').modal('show');
        }

        <?php if (isset($scriptFooter)) {
            echo $scriptFooter;
        } ?>
    });

    function binarioVal(obj, selector) {
        if ($(obj).is(":checked")) {
            $(selector).val('1');
        } else {
            $(selector).val('0');
        }
    }

    function lock_unlock(id1, id2 = '') {
        if ($(id1).prop('readonly')) {
            $(id1).prop('readonly', false);
            if (id2 != '') {
                $(id2).prop('readonly', false);
            }
        } else {
            $(id1).prop('readonly', true);
            if (id2 != '') {
                $(id2).prop('readonly', true);
            }
        }
    }
</script>
<!-- Validador de formulários -->
<script src="<?php echo site_url('assets/js/verificador2.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/verificador_datas8.min.js'); ?>"></script>
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

    function showModal(obj) {
        var href = $(obj).attr('data-href');
        var titulo = $(obj).attr('data-titulo');
        var texto = $(obj).attr('data-texto');
        var btn = $(obj).attr('data-btn');
        var btnacao = $(obj).attr('data-btn-acao');
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
                                <button type="button" class="btn btn-accent">${btnacao}</button>
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
</script>
<script>
    function realocaModalidades(data) {
        if (data.tipo == 'success') {
            aviso('success', "Sucesso!", data.mensagem);
            var options = '';
            data.modalidades.map((modalidade) => {
                options += '<option value="' + modalidade.id + '">' + modalidade.nome + '</option>';
            });
            $('#modalidade').html(options);
        } else {
            aviso('danger', "Erro!", data.mensagem);
        }
    }

    function realocaProfessores(data) {
        if (data.tipo == 'success') {
            aviso('success', "Sucesso!", data.mensagem);
            var options = '';
            data.professores.map((prof) => {
                options += '<option value="' + prof.id + '">' + prof.nome + '</option>';
            });
            $('#professor').html(options);
        } else {
            aviso('danger', "Erro!", data.mensagem);
        }
    }

    function insereAjax(formmodal, callback) {
        var formulario = document.querySelector(formmodal);
        dataFormAj = new FormData(formulario);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", formulario.getAttribute('action'), true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var retorno = JSON.parse(this.responseText);
                $(".modal.fade.show").modal('hide');
                callback(retorno);
            }
        };
        xmlhttp.send(dataFormAj);
    }

    function realocaAulas(data) {
        if (data.tipo == 'success') {
            aviso('success', "Sucesso!", data.mensagem);
            var options = '';
            var totalAulas = data.aulas.length;
            console.log(data.aulas);
            data.aulas.map((aula) => {
                var status = '<span class="badge badge-notifications badge-accent">&nbsp;</span>';
                var btns = `<button class="btn btn-outline-success btn-rounded" 
                            data-href="<?php echo site_url() . '/' . getTipoUser(); ?>/cursos/ativar_aula/${aula.id}"
                            data-titulo="<i class='fas fa-check'></i> Ativar Aula"
                            data-texto="Deseja realmente ativar a aula <b>${aula.nome}</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Ativar aula"
                            data-toggle="aviso-modal"
                            title="Ativar aula"><i class='fa fa-check'></i></button>`;
                if (aula.ativo == 1) {
                    status = '<span class="badge badge-notifications badge-success">&nbsp;</span>';
                    var btns = `<button class="btn btn-outline-success btn-rounded" 
                            data-href="<?php echo site_url() . '/' . getTipoUser(); ?>/cursos/desativar_aula/${aula.id}"
                            data-titulo="<i class='fas fa-check'></i> Desativar Aula"
                            data-texto="Deseja realmente desativar a aula <b>${aula.nome}</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Desativar aula"
                            data-toggle="aviso-modal"
                            title="Desativar aula"><i class='fa fa-check'></i></button>`;
                }
                options += `<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <select name="n_aula" class="form-control" onchange="mudaAula('${aula.id}', this);" >`;
                for (var $i = 1; $i <= totalAulas; $i++) {
                    var $selected = aula.n_aula == $i ? 'selected' : '';
                    options += '<option value="' + $i + '" ' + $selected + ' >' + $i + '</option>';
                }

                var iframer = "";
                if (aula.url_video !== ""){
                    iframer = `<br/><iframe src="${aula.url_video}" width="100" height="75" ></iframe>`;
                }

                options += `        </select>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ${aula.nome+iframer}
                            </td>
                            <td class="js-lists-values-email">
                                ${aula.descricao}
                            </td>
                            <td class="js-lists-values-email">`;
                aula.arquivos.map((arqv) => {
                    options += `<span style="display:block"><a href="${arqv.url}">${arqv.arquivo}</a></span>`
                });

                options += `<td class="js-lists-values-telefone">
                                ${status}
                            </td>
                            <td>
                                <a href="javascript:editarAula('${aula.id}')">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar aula"><i class="fas fa-pencil-alt"></i></button>
                                </a>
                                ${btns}
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="<?php echo site_url() . '/' . getTipoUser(); ?>/cursos/remover_aula/${aula.id}"
                                data-titulo="<i class='fas fa-trash'></i> Remover aula"
                                data-texto="Deseja realmente remover a aula <b>${aula.nome}</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover aula"
                                data-toggle="aviso-modal"
                                title="Remover aula"><i class='fa fa-trash'></i></button><br/>
                            </td>
                        </tr>`;
            });
            $('#search').html(options);
            $('button[data-toggle="aviso-modal"]').on('click', function() {
                showModal(this);
            });
        } else {
            aviso('danger', "Erro!", data.mensagem);
        }
    }

    function mudaAula(id, obj) {
        var val = obj.value;
        var xmlhttp = new XMLHttpRequest();
        var urlopen = "<?php echo site_url(getTipoUser() . '/cursos/mudaAula') ?>/" + id + '/' + val;
        xmlhttp.open("GET", urlopen, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var retorno = JSON.parse(this.responseText);
                realocaAulas(retorno);
            }
        };
        xmlhttp.send();
    }

    function removeDiv(ele) {
        document.querySelector(ele).remove();
    }

    function openEditorAula(data) {
        if (data.tipo == 'danger') {
            $('#modalEditarAula').modal('hide');
            aviso(data.tipo, "Erro!", data.mensagem);
        } else {
            var aula = data.aula;
            var ativo = aula.ativo == 1 ? 'checked' : '';
            var arquivos = '';
            data.aula.arquivos.map((arqv) => {
                arquivos += `<div id="arqv${arqv.id}" class="input-group input-group-merge">
                                    <input type="hidden" name="arqv_ant[]" value="${arqv.id}" />
                                    <input type="text" class="form-control form-control-appended is-valid" required="" value="${arqv.arquivo}" readonly placeholder="">
                                    <div class="input-group-append">
                                        <div class="btn btn-danger" onclick="removeDiv('#arqv${arqv.id}')">
                                            <i class="fa fa-trash"></i>
                                        </div>
                                    </div>
                                </div>`;

            });
            var texto = `<form id="formAulaEdit" action="<?php echo base_url(); ?>professor/cursos/update_aulaAjax/${aula.id}" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id_curso" value="<?php if (isset($cur[0]['id'])) {
                                                                    echo $cur[0]['id'];
                                                                }  ?>" />
                    <div class="form-group">
                        <input type="checkbox" name="ativo" ${ativo}  />
                        <label class="form-label" for="name">Ativa</label>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input type="text" class="form-control" value="${aula.nome}" placeholder="Nome da aula" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Thumbnail: (<b>Atual:</b> ${aula.thumb})</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumb" type="file" class="form-control" placeholder="Nome">
                            <label class="custom-file-label" for="thumb">Escolher arquivo</label>
                        </div>
                        <small class="text-secondary">Deixe em branco para não alterar a thumbnail</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Url do vídeo (sem iframe):</label>
                        <input type="text" class="form-control" value="${aula.url_video}" placeholder="https://video" name="url_video">
                        <small class="text-primary" style="font-size:90%">Para inserir uma aula sem vídeo, deixe este campo em branco</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Descrição: *</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição da aula">${aula.descricao}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Arquivos Complementares:</label>
                        ${arquivos}
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="arquivos[]" type="file" class="form-control" multiple placeholder="Nome">
                            <label class="custom-file-label" for="thumb">Escolher arquivos</label>
                        </div>
                    </div>
                </form>`;

            var footer = `<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                         <button type="button" onclick="insereAjax('#formAulaEdit', realocaAulas);" class="btn btn-success">Atualizar Aula</button>`;
            $('#modalEditarAula .modal-body').html(texto);
            $('#modalEditarAula .modal-footer').html(footer);
        }
    }

    function editarAula(id) {
        $('#modalEditarAula').remove();
        var modal = `<div class="modal fade" id="modalEditarAula" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulo-modal-aviso">Editar Aula</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <i class="fa fa-spinner fa-spin"></i> Buscando...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                        </div>`;
        $('body').append(modal);
        $('#modalEditarAula').modal('show');
        var xmlhttp = new XMLHttpRequest();
        var urlopen = "<?php echo site_url(getTipoUser() . '/cursos/getAula') ?>/" + id;
        xmlhttp.open("GET", urlopen, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var retorno = JSON.parse(this.responseText);
                openEditorAula(retorno);
            }
        };
        xmlhttp.send();
    }
</script>
<?php
if ($this->session->flashdata('aviso_tipo')) { ?>
    <script>
        $(document).ready(function() {
            var options = {
                "closeButton": true,
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