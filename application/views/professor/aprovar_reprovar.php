<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/professor/header.php'); ?>


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
                Aprovar ou reprovar alunos do curso #<?=$curso[0]['id'].' - '.$curso[0]['nome']?><br/>
                <button class="btn btn-primary" onclick="mudarCurso()"><i class="fa fa-search"></i>&nbsp;&nbsp;Alterar Curso</button>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">
        <div class="row">
            <div class="col-md-12 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>professor/aluno/aprovar_reprovar" enctype="multipart/form-data" method="POST">
                    <div class="form-group mb-4">
                        <label class="form-label" >Aluno:</label>
                        <select class="form-control selectpicker" name="aluno" data-size="5" data-live-search="true" data-title="selecione um aluno..." required>
                            <?php foreach($assinaturas as $ass):
                                if (!isset($ass['aluno']['id']) || $ass['aluno']['ativo'] == 0) continue;
                                ?>
                                <option value="<?php echo $ass['aluno']['id'] ?>"><?php echo $ass['aluno']['nome']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label mt-4" >Ação:</label>
                        <select class="form-control" name="acao" required>
                            <option value="1">Aprovar</option>
                            <option value="0">Reprovar</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Aplicar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>