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
                Cadastro de Curso
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>admin/cursos/inserir" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Modalidade: *</label>
                        <div class="input-group input-group-merge">
                            <select id="modalidade" name="id_modalidade" class="form-control" placeholder="Modalidade" required>
                                <?php foreach ($modalidades as $modalidade) { ?>
                                    <option value="<?= $modalidade['id']; ?>"><?= $modalidade['nome']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                                <div class="btn btn-success" data-toggle="modal" data-target="#addModalidadeModal">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input id="nome" type="text" class="form-control" placeholder="Nome do Curso" name="nome" required>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col">
                            <label class="form-label" for="name">Horas: *</label>
                            <input id="duracao_hora" 
                            type="number" 
                            step="1" 
                            min="0" 
                            class="form-control" 
                            placeholder="Horas do curso" 
                            name="duracao_hora" 
                            required>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name">Minutos: *</label>
                            <input id="duracao_minutos" 
                            type="number" 
                            step="1" 
                            min="0" 
                            class="form-control" 
                            placeholder="Minutos do curso" 
                            name="duracao_minutos" 
                            required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Tipo: *</label>
                        <select id="tipo" name="tipo" class="form-control" placeholder="Tipo do Curso" required>
                            <option value="livre">Livre</option>
                            <option value="supletivo">Supletivo</option>
                            <option value="tecnico">Técnico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Professor: *</label>
                        <div class="input-group input-group-merge">
                            <select id="professor" name="id_professor" class="form-control" placeholder="Professor" required>
                                <?php foreach ($professores as $prof) { ?>
                                    <option value="<?= $prof['id']; ?>" >
                                        <?= $prof['nome']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                                <div class="btn btn-success" data-toggle="modal" data-target="#addProfModal">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="foto">Foto de Capa:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="capa" id="capa" type="file" class="form-control" placeholder="Capa">
                            <label class="custom-file-label" for="foto">Escolher arquivo</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Status: *</label>
                        <select id="status" name="status" class="form-control" placeholder="Status do Curso" required>
                            <option value="rascunho">Rascunho</option>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                        <small class="text-secondary">Rascunho e inativo não aparecem para os usuários</small>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label" for="password">Preço de Venda: *</label>
                        <div class="input-group input-group-merge">
                            <input id="venda" type="number" step="0.01" name="venda" class="form-control form-control-prepended" required placeholder="0.00">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    R$
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar Curso</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Cadastrar Curso</h5>
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
                                        Preencha os dados para inserir um novo Curso ao sistema.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                            <!-- <div class="flex"><strong class="text-70">Price</strong></div>
                            <strong>US &dollar;9 per month</strong> -->
                        </div>
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox"
                                    class="custom-control-input"
                                    checked
                                    id="topic-all">
                            <label class="custom-control-label">Terms and conditions</label>
                            <small class="form-text text-muted">By checking here and continuing, I agree to the Luma Terms of Use</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>