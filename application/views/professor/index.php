
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
                LISTAGEM E EDIÇÃO DOS MEUS CURSOS
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">

    <?php foreach($entCursos as $ent){ ?>   
    <div class="page-separator">
        <div class="page-separator__text"><?php echo $ent[0]['nome_modalidade'] ?></div>
    </div>

    <div class="row">
        <?php foreach($ent as $crs){ ?>
        <!-- curso -->
        <div class="col-sm-6 col-md-4 col-xl-3">

            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card "

                data-force-reveal
                data-partial-height="44"
                data-toggle="popover"
                data-trigger="click">
                <a href="<?php echo site_url('professor/cursos/editar/' . $crs['id'] . '-' . rawurlencode($crs['nome'])); ?>"
                class="js-image"
                data-position="">
                    <img style="max-width: 250px;" src="<?php echo get_url($crs['id'], $crs['nome'], $crs['capa']); ?>"
                        alt="<?php echo $crs['nome']; ?>">
                    <span class="overlay__content align-items-start justify-content-start">
                        <span class="overlay__action card-body d-flex align-items-center">
                            <i class="material-icons mr-4pt">edit</i>
                            <span class="card-title text-white">Editar</span>
                        </span>
                    </span>
                </a>
                <div class="mdk-reveal__content">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                href="<?php echo site_url('professor/cursos/editar/' . $crs['id'] . '-' . rawurlencode($crs['nome'])); ?>"><?php echo $crs['nome']; ?></a>
                            </div>
                            <a href="<?php echo site_url('professor/cursos/editar/' . $crs['id'] . '-' . rawurlencode($crs['nome'])); ?>"
                            class="ml-4pt material-icons text-20 card-course__icon-favorite">edit</a>
                        </div>
                        <div class="d-flex">
                            <small class="text-50"><?php echo $crs['ttl_alunos'].' alunos ativos'; ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popoverContainer d-none">
                <div class="media">
                    <div class="media-left mr-12pt">
                        <img src="<?php echo get_url($crs['id'], $crs['nome'], $crs['capa']); ?>"
                            width="40"
                            height="40"
                            alt="<?php echo $crs['nome']; ?>"
                            class="rounded">
                    </div>
                    <div class="media-body">
                        <div class="card-title mb-0"><?php echo $crs['nome']; ?></div>
                        <p class="lh-1">
                            <span class="text-50 small">com</span>
                            <span class="text-50 small font-weight-bold"><?php echo ucfirst($this->session->userdata('nome')); ?></span>
                        </p>
                    </div>
                </div>

                <p class="my-16pt text-70">Neste curso você irá passar pelas seguintes aulas:</p>

                <div class="mb-16pt">
                    <?php foreach($crs['aulas'] as $aula){ ?>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                            <p class="flex text-50 lh-1 mb-0"><small><?php echo $aula['nome'] ?></small></p>
                        </div>
                    <?php } ?>
                </div>

                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="d-flex align-items-center mb-4pt">
                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                            <p class="flex text-50 lh-1 mb-0"><small><?php echo count($crs['aulas']).' aulas'; ?></small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                            <p class="flex text-50 lh-1 mb-0"><small><?php echo $crs['ttl_alunos'].' alunos ativos'; ?></small></p>
                        </div>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo site_url('professor/cursos/editar/' . $crs['id'] . '-' . rawurlencode($crs['nome'])); ?>"
                        class="btn btn-primary">Editar curso</a>
                    </div>
                </div>

            </div>

        </div>

        <?php } ?>
    </div>
    <?php } ?>
</div>
    <?php include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>