<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <!-- <a href="pricing.html"
                class="progression-bar__item progression-bar__item--complete">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon">done</i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Pricing</span>
                </span>
            </a>
            <a href="signup.html"
                class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                </span>
            </a>
            <a href="signup-payment.html"
                class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Payment details</span>
                </span>
            </a> -->

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Cadastro de tarefas do curso <?= $cur[0]['id'] . ' - ' . $cur[0]['nome'] ?>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-12 mb-24pt mb-md-0">
                <form id="formTarefas" action="<?php echo base_url(); ?>admin/tarefas/inserir/<?php echo $cur[0]['id'] ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input name="ativo" id="customCheck00" type="checkbox" checked class="custom-control-input">
                            <label for="customCheck00" class="custom-control-label">Ativa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: * (Apenas para identificação)</label>
                        <input id="nome" type="text" class="form-control" placeholder="Nome da tarefa para identificação" name="nome" required>
                    </div>

                    <br>
                    <hr>
                    <h5>Exercícios</h5>
                    <div class="card mb-4">
                        <div id="exercicios" class="card-body">
                            <button type="button" class="btn btn-secondary btn-block" onclick="openExercicio('')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adcionar</button>
                            <hr>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Cadastrar Tarefa</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>
<script>
    function possuiData(obj){
        $('#data_limite_c').remove();
        if ($(obj).prop('checked')){
            var newHtml = `<div id="data_limite_c" class="form-group">
                        <label class="form-label" for="name">Data limite: * (data limite para fazer a tarefa)</label>
                        <input id="data_limite" type="data" class="form-control" placeholder="dd/mm/YYYY" onkeyup="MascaraData(this)" name="data_limite" required>
                    </div>`;
            $('#possuiData').after(newHtml);
        }
    }

    $('#formTarefas').on('submit', function(e) {
        if (!$('.questoes').length) {
            e.preventDefault();
            aviso('erro', 'Erro!', 'Você precisa adcionar pelo menos um exercício para cadastrar uma tarefa!');
        }
    });
</script>