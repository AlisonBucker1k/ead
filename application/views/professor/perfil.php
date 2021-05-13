<?php include_once(ROOT_PATH . '/assets/includes/professor/header.php'); ?>
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
                Edição de Perfil
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>professor/perfil/update" enctype="multipart/form-data" method="POST">

                    <div class="form-group row">
                        <div class="col-12">
                            <label class="form-label" for="name">Nome: *</label>
                            <input id="nome" type="text" class="form-control" value="<?php echo $usuario[0]['nome'] ?>" placeholder="Seu nome" name="nome" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="foto">Foto:</label>
                        <div class="media align-items-center">
                            <a href="" class="media-left mr-16pt">
                                <img src="<?php echo returnPath2($usuario[0]['foto'], 'professor', $usuario[0]['id'], $usuario[0]['login']); ?>" alt="people" width="56" class="rounded-circle">
                            </a>
                            <div class="media-body">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="foto" type="file" class="form-control" placeholder="Nome">
                                    <label class="custom-file-label" for="foto">Escolher arquivo</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Login: *</label>
                        <input id="login" type="text" class="form-control" placeholder="Login" value="<?php echo $usuario[0]['login'] ?>" name="login" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="senha">Senha: *</label>
                        <div class="input-group input-group-merge">
                            <input id="password" name="senha" type="password" class="form-control" placeholder="Senha ..." readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-accent" onclick="lock_unlock('#password')">
                                    <span class="material-icons">lock_outline</span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="email">Seu email: *</label>
                        <input id="email" type="email" class="form-control" placeholder="Email ..." value="<?php echo $usuario[0]['email'] ?>" name="email" required>
                    </div>

                    <div class="form-group mb-24pt">
                        <label class="form-label" for="password">Seu Telefone: (este dado é público e aparece para os alunos)</label>
                        <input id="telefone" type="text" class="form-control telefone" placeholder="Telefone ..." value="<?php echo $usuario[0]['telefone'] ?>" name="telefone">
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Meu Perfil</h5>
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
                                        Altere os dados para atualizar seu perfil no sistema.
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

<?php include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>