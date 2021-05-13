<?php include_once(ROOT_PATH . '/assets/includes/ead/header.php'); ?>
<!-- Page Content -->

<div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
    <div class="mdk-box__content">
        <div class="hero py-64pt text-center text-sm-left">
            <div class="container page__container">
                <h1 class="text-white">PROVA <?php echo $tarefa[0]['nome']; ?></h1>
                <p class="lead text-white-50 measure-hero-lead mb-24pt">Curso: <?php echo $cur[0]['nome']; ?></p>
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-end">
                    <a href="<?php echo base_url('ead/cursos/' . $cur[0]['id'] . '-' . rawurlencode($cur[0]['nome'])) ?>" class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">
                        <i class="material-icons icon--left" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);">play_circle_outline</i> Voltar ao curso</a>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
            <div class="container page__container">
                <ul class="nav navbar-nav flex align-items-sm-center">
                    <li class="nav-item navbar-list__item">
                        <div class="media align-items-center">
                            <span class="media-left mr-16pt">
                                <img src="<?php echo returnPath2($professor[0]['foto'], 'professor', $professor[0]['id'], $professor[0]['login']) ?>" width="40" alt="avatar" class="rounded-circle">
                            </span>
                            <div class="media-body">
                                <a class="card-title m-0" href="javascript:showProfessor('<?php echo $professor[0]['id']; ?>');"><?php echo $professor[0]['nome'] ?></a>
                                <p class="text-50 lh-1 mb-0">Professor</p>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item navbar-list__item">
                        <i class="material-icons text-muted icon--left">assessment</i>
                        <?php echo $modalidade[0]['nome']; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-12 mb-24pt mb-md-0">
                <?php if (isset($nota_final[0]['id'])){ ?>
                    <div class="card mb-32pt mb-lg-64pt pl-4 pt-2">
                        <h4>Nota Final: <?php echo $nota_final[0]['nota']; ?></h4>
                    </div>
                <?php } ?>
                <?php foreach ($tarefa[0]['exercicios'] as $item) :
                    include(ROOT_PATH . '/application/views/ead/templates/questoesProva.php');
                endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/ead/footer.php'); ?>