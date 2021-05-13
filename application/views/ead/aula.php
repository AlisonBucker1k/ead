<?php include_once(ROOT_PATH . '/assets/includes/ead/header.php'); ?>
<!-- Page Content -->

<div class="bg-primary pb-lg-64pt py-32pt">
    <div class="container page__container">
        <nav class="course-nav">
            <?php if (count($menuSup) > 0) :
                $first = true;
                $next = true;
                foreach ($menuSup as $item) :
                    $href = base_url('ead/aula/' . $item['id_curso'] . '/' . $item['id'] . '-' . rawurlencode($item['nome']));
                    $icon = '<span class="material-icons">account_circle</span>';
                    if ($first) {
                        if ($item['id'] == $aula[0]['id']) {
                            $icon = '<span class="material-icons text-primary">account_circle</span>';
                            $first = false;
                        }
                    } else if ($next) {
                        $href = base_url('ead/aula/' . $item['id_curso'] . '/' . $item['id'] . '-' . rawurlencode($item['nome']));
                        $icon = '<span class="material-icons">account_circle</span>';
                        $next = false;
                    } else {
                        $href = base_url('ead/aula/' . $item['id_curso'] . '/' . $item['id'] . '-' . rawurlencode($item['nome']));
                        $icon = '<span class="material-icons">lock</span>';
                    }
            ?>
                    <a data-toggle="tooltip" data-placement="bottom" data-title="<?php echo $item['nome']; ?>" href="<?php echo $href; ?>">
                        <?php echo $icon; ?>
                    </a>
            <?php endforeach;
            endif; ?>
        </nav>
        <?php if ($aula[0]['url_video'] !== "") : ?>
            <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                <div class="player embed-responsive-item">
                    <iframe class="embed-responsive-item" src="<?php echo transforma_vimeo_url($aula[0]['url_video']); ?>" allowfullscreen=""></iframe>
                    <!-- <iframe width="1280" height="720" src="https://www.youtube.com/embed/4591dCHe_sE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
            </div>
        <?php endif; ?>
        <div class="d-flex flex-wrap align-items-end mb-16pt">
            <h1 class="text-white flex m-0"><?php echo $aula[0]['nome']; ?> </h1>

        </div>

        <p class="hero__lead measure-hero-lead text-white-50 mb-24pt"><?php echo $aula[0]['descricao']; ?></p>

        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-end">
            <?php if (isset($ant[0]['id'])) {
                $href = base_url('ead/aula/' . $ant[0]['id_curso'] . '/' . $ant[0]['id'] . '-' . rawurlencode($ant[0]['nome'])); ?>
                <a href="<?php echo $href; ?>" class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">
                    <i class="material-icons icon--left" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);">play_circle_outline</i> Aula Anterior</a>
            <?php }
            if (isset($prox[0]['id'])) {
                $href = base_url('ead/aula/' . $prox[0]['id_curso'] . '/' . $prox[0]['id'] . '-' . rawurlencode($prox[0]['nome'])); ?>
                <a href="<?php echo $href; ?>" class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">Próxima Aula <i class="material-icons icon--right">play_circle_outline</i></a>
            <?php } ?>
            <?php if (count($files) > 0) : ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-color:#fff;color:#141414;background-color:#fff;">
                        <span class="material-icons">file_download</span>&nbsp;&nbsp;Downloads
                    </button>
                    <div class="dropdown-menu" style="">
                        <?php foreach ($files as $item) : ?>
                            <!-- <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div> -->

                            <a class="dropdown-item" href=" <?php echo get_url_aula($curso[0]['id'], $aula[0]['id'], $curso[0]['nome'], $item['arquivo']); ?>" download><?php echo $item['arquivo']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

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
                        <a class="card-title m-0" href="javascript:showProfessor('<?php echo $professor[0]['id']; ?>');"><?php echo $professor[0]['nome']; ?></a>
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

<div class="container page__container" style="margin-top:50px;">
    <?php if (count($tarefas) > 0 || count($provas) > 0) {
        include(ROOT_PATH . '/application/views/ead/templates/aulasProvasTarefas.php');
    } else { ?>
        <div class="d-flex align-items-center page-num-container">
            <div class="page-num">1</div>
            <h4><?php echo $curso[0]['nome'] ?></h4>
        </div>

        <div class="card mb-32pt mb-lg-64pt">
            <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-1">
                <li class="accordion__item open">
                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-1" href="#toc-content-1">
                        <span class="flex">Aulas</span>
                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                    </a>
                    <div class="accordion__menu">
                        <ul class="list-unstyled collapse show" id="toc-content-1">
                            <?php foreach ($aulasCurso as $item) : ?>
                                <li class="accordion__menu-link">
                                    <span class="material-icons icon-16pt icon--left text-body">play_circle_outline
                                        <!--check_circle--></span>
                                    <a class="flex <?php if ($item['id'] == $aula[0]['id']) {
                                                        echo "text-primary";
                                                    } ?>" href="<?php echo base_url('ead/aula/' . $item['id_curso'] . '/' . $item['id'] . '-' . rawurlencode($item['nome'])); ?>"><?php echo $item['nome'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>

<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/ead/footer.php'); ?>