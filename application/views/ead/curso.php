<?php include_once(ROOT_PATH.'/assets/includes/ead/header.php'); ?>
    <!-- Page Content -->

    <div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
        <div class="mdk-box__content">
            <div class="hero py-64pt text-center text-sm-left">
                <div class="container page__container">
                    <h1 class="text-white"><?php echo $course[0]['nome'];?></h1>
                    <p class="lead text-white-50 measure-hero-lead mb-24pt"><?php echo $course[0]['descricao'];?></p>
                    <a href="<?php echo base_url('ead/aula/'.$aulaAtual[0]['id_curso'].'/'.$aulaAtual[0]['id'].'-'.rawurlencode($aulaAtual[0]['nome']));?>"
                        class="btn btn-white">Continuar <?php echo $aulaAtual[0]['nome']; ?></a>
                </div>
            </div>
            <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
                <div class="container page__container">
                    <ul class="nav navbar-nav flex align-items-sm-center">
                        <li class="nav-item navbar-list__item">
                            <div class="media align-items-center">
                                <span class="media-left mr-16pt">
                                    <img src="<?php echo returnPath2($professor[0]['foto'],'professor', $professor[0]['id'], $professor[0]['login'])?>"
                                            width="40"
                                            alt="avatar"
                                            class="rounded-circle">
                                </span>
                                <div class="media-body">
                                    <a class="card-title m-0"
                                        href="javascript:showProfessor('<?php echo $professor[0]['id']; ?>');"><?php echo $professor[0]['nome']?></a>
                                    <p class="text-50 lh-1 mb-0"><?php echo $professor[0]['graduacao'];?></p>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item navbar-list__item">
                            <i class="material-icons text-muted icon--left">assessment</i>
                            <?php echo $modalidade[0]['nome'];?>
                        </li>
                        <li class="nav-item navbar-list__item">
                            <i class="material-icons text-muted icon--left">access_time</i>
                            <?php echo writeTimer($course[0]); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container page__container">
        <div class="row">
            <div class="col-lg-7">
                <div class="border-left-2 page-section pl-32pt">

                    <div class="d-flex align-items-center page-num-container">
                        <div class="page-num">1</div>
                        <h4><?php echo $course[0]['nome'];?></h4>
                    </div>

                    <p class="text-70 mb-24pt"><?php echo $course[0]['descricao'];?></p>

                    <div class="card mb-32pt mb-lg-64pt">
                        <ul class="accordion accordion--boxed js-accordion mb-0"
                            id="toc-1">
                            <li class="accordion__item open">
                                <a class="accordion__toggle"
                                    data-toggle="collapse"
                                    data-parent="#toc-1"
                                    href="#toc-content-1">
                                    <span class="flex">Aulas</span>
                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                </a>
                                <div class="accordion__menu">
                                    <ul class="list-unstyled collapse show"
                                        id="toc-content-1">
                                        <?php
                                        foreach($aulas as $item):?>
                                            <li class="accordion__menu-link">
                                                <span class="material-icons icon-16pt icon--left text-body">play_circle_outline<!--check_circle--></span>
                                                <a class="flex <?php if ($item['id'] == $aulaAtual[0]['id']){ echo "text-primary"; } ?>"
                                                    href="<?php echo base_url('ead/aula/'.$item['id_curso'].'/'.$item['id'].'-'.rawurlencode($item['nome']));?>">
                                                    <?php echo $item['nome']?></a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 page-nav">
                <?php if (count($tarefas) > 0 || count($provas) > 0){ 
                    include(ROOT_PATH.'/application/views/ead/templates/provasTarefas.php');
                } else { ?>
                    <!-- MODALIDADE É MOSTRADA CASO NÃO HAJA TAREFAS / PROVAS NO CURSO -->
                    <div class="page-section">
                    <div class="page-nav__content">
                        <div class="page-separator">
                            <div class="page-separator__text">Modalidade</div>
                        </div>
                    </div>
                    <nav class="nav page-nav__menu">
                        
                        <a class="nav-link active"
                            href=""><? echo $modalidade[0]['nome'];?></a>
                    </nav>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

                <!-- // END Page Content -->
<?php include_once(ROOT_PATH.'/assets/includes/ead/footer.php'); ?>