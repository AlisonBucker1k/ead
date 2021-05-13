<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Cadastro de Serviços
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>admin/servicos/insere" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input id="nome" type="text" class="form-control" placeholder="Nome do Serviço" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Fornecedor: * 
                        <a href="<?php echo site_url('admin/fornecedores/cadastrar'); ?>">
                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button></label>
                        </a>
                        <select name='id_fornecedor' class='form-control selectpicker' data-size='5' data-title="selecione um fornecedor" data-live-search='true'>
                        <?php foreach($fornecedores as $f): ?>
                            <option value="<?= $f['id'] ?>" ><?= $f['empresa'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="foto">Descrição</label>
                        <textarea name="descricao" class="form-control" placeholder="Descrição do serviço" rows="15"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar Serviço</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Cadastrar Serviço</h5>
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
                                        Preencha os dados para inserir um novo serviço no sistema.
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