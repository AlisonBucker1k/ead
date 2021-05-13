<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


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
                Cadastro de admin
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>admin/administradores/insere" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input name="nome" id="nome" type="text" class="form-control" placeholder="Nome do Administrador" required>
                    </div>

                    <div class="form-group">                               
                        <label class="form-label" for="name">Cargo: *</label>
                        <div class="input-group input-group-merge mb-3">
                            <select class="form-control" name="id_cargo" aria-describedby="basic-addon2">
                                <?php foreach($cargos as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" ><?php echo $c['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a href="<?php echo site_url('admin/administradores/cargos'); ?>" target="_blank" title="Visualizar cargos">
                                    <button type="button" class="btn btn-outline-primary">
                                        <span class="material-icons">search</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="foto">Foto:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto" id="foto" type="file" class="form-control" placeholder="Nome">
                            <label class="custom-file-label" for="foto">Escolher arquivo</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Login: *</label>
                        <input name="login" id="login" type="text" class="form-control" placeholder="Login" required>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label" for="password">Senha: *</label>
                        <input id="password" name="senha" type="password" class="form-control" placeholder="Senha ..." required>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label" for="password">Confirmar senha: *</label>
                        <input id="password-c" igual="senha" type="password" class="form-control" placeholder="Confirmar senha..." required>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="email">Seu Email: *</label>
                        <input name="email" id="email" type="email" class="form-control" placeholder="Email ..." required>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label" for="password">Telefone: *</label>
                        <input name="telefone" id="telefone" type="text" class="form-control telefone" placeholder="Telefone ..." required>
                    </div>

                    <button class="btn btn-primary">Cadastrar novo Admin</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Cadastrar Admin</h5>
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
                                        Preencha os dados para inserir um novo admin ao sistema.
                                    </small>
                                    <br/>
                                    <b>O administrador terá suas permissões baseadas no cargo inserido</b>
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