<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Edição de Pergunta Frequente <?= $tipo_txt; ?>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>admin/faq/update/<?= $faq[0]['id']; ?>" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="tipo" value="<?= $tipo_bd; ?>" >
                    <div class="form-group">
                        <label class="form-label" for="name">Pergunta: *</label>
                        <textarea name="pergunta" class="form-control" placeholder="Digite aqui a pergunta..." rows="3" required><?php echo $faq[0]['pergunta']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Resposta: *</label>
                        <textarea name="resposta" class="form-control" placeholder="Digite aqui a resposta..." rows="5" required><?php echo $faq[0]['resposta']; ?></textarea>
                    </div>

                    <button class="btn btn-primary">Atualizar Pergunta Frequente <?= $tipo_txt; ?></button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Atualizar Pergunta Frequente <?= $tipo_txt; ?></h5>
                        <div class="d-flex mb-8pt">
                            <div class="flex"><strong class="text-70"></strong></div>
                            <strong></strong>
                        </div>

                        <div class="alert alert-soft-warning">
                            <div class="d-flex flex-wrap align-items-start">
                                <div class="mr-8pt">
                                    <i class="material-icons">check</i>
                                </div>
                                <div class="flex" style="min-width: 180px">
                                    <small class="text-100">
                                        Preencha os dados para atualizar uma pergunta frequente <?= $tipo_txt; ?>.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                        </div>
                        <div class="custom-control custom-checkbox">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>