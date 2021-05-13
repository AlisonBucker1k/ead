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
                Cadastro de Cursos
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url();?>admin/cursos/inserir" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label"
                                for="name">Modalidade:</label>
                        <select name="id_modalidade" class="form-control">
                            <option value="">Selecionar Modalidade</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="foto">Nome:</label>
                                <input id="login"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="nome">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Capa:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="capa">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Status:</label>
                        <select name="id_modalidade" class="form-control">
                            <option value="">Selecionar Status</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Venda:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="venda">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Assinatura:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="assinatura">
                    </div>

                    <button class="btn btn-primary">Cadastrar novo Curso</button>
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
                                <div class="flex"
                                        style="min-width: 180px">
                                    <small class="text-100">
                                        Preencha os dados abaixo para inserir um novo admin ao sistema.
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