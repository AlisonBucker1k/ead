<?php include_once(ROOT_PATH . '/assets/includes/ead/header.php'); ?>

<!-- Page Content -->
<!--<div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0" data-effects="parallax-background blend-background">-->
<!--    <div class="mdk-box__bg">-->
<!--        <div class="mdk-box__bg-front" style="background-image: url(<?php echo base_url(); ?>assets/assetsAlison/images/photodune-4161018-group-of-students-m.jpg);"></div>-->
<!--    </div>-->
<!--    <div class="mdk-box__content justify-content-center">-->
<!--        <div class="hero container page__container text-center py-112pt">-->
<!--            <h1 class="text-white text-shadow">Aprenda da maneira mais simples</h1>-->
<!--            <p class="lead measure-hero-lead mx-auto text-white text-shadow mb-48pt">Com nosso sistema EAD você será capaz de aprender com os melhores professores e sem sair de casa!</p>-->

<!--            <a href="<?php echo site_url('ead/cursos') ?>" class="btn btn-lg btn-white btn--raised mb-16pt">Veja nossos cursos</a>-->

            <!-- <p class="mb-0"><a href=""
<!--                        class="text-white text-shadow"><strong>Are you a teacher?</strong></a></p> -->

<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="border-bottom-2 py-16pt navbar-light bg-white border-bottom-2">
    <div class="container page__container">
        <div class="row align-items-center">
            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">subscriptions</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt"><?php echo $ttl_cursos == 1 ? $ttl_cursos.' curso' : $ttl_cursos.' cursos'; ?></div>
                    <p class="card-subtitle text-70">Explore nossa grade e aumente suas habilidades.</p>
                </div>
            </div>
            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">verified_user</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt">Aulas on-line e os melhores profissionais</div>
                    <p class="card-subtitle text-70">Tenha acesso as aulas online com os melhores professores.</p>
                </div>
            </div>
            <div class="d-flex col-md align-items-center">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">update</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt">Acesso ilimitado</div>
                    <p class="card-subtitle text-70">Você terá acesso ilimitado às nossas aulas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">


        <div class="page-separator">
            <div class="page-separator__text">Cursos em destaque</div>
        </div>

        <div class="row card-group-row">
            <!-- <?php foreach ($featured as $item) : ?> -->

            <div class="col-md-6 col-lg-4 card-group-row__col">

                <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                    <img src="<?php echo get_url($item['id'], $item['nome'], $item['capa']) ?>" alt="" class="card-img">
                    <div class="fullbleed bg-primary" style="opacity: .5"></div>
                    <div class="posts-card-popular__content">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar-group flex">
                                <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="<?php echo $item['professor'][0]['nome']; ?>">
                                    <a href="javascript:showProfessor('<?php echo $item['professor'][0]['id']; ?>');">
                                        <img src="<?php echo returnPath2($item['professor'][0]['foto'], 'professor', $item['professor'][0]['id'], $item['professor'][0]['login']); ?>" alt="Avatar" class="avatar-img rounded-circle">
                                    </a>
                                </div>
                            </div>
                            <a style="text-decoration: none;" class="d-flex align-items-center" href="">
                                <i class="material-icons mr-1" style="font-size: inherit;">remove_red_eye</i> <small><?php echo $item['alunos_vis']; ?></small>
                            </a>
                        </div>
                        <div class="posts-card-popular__title card-body">
                            <small class="text-muted text-uppercase"><?php echo $item['modalidade'][0]['nome'] ?></small>
                            <a class="card-title" href="<?php echo site_url('ead/cursos/'.$item['id'].'-'.rawurlencode($item['nome'])); ?>"><?php echo $item['nome'] ?></a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <?php endforeach; ?> -->

        </div>
        

         <!-- PROVAS E ATIVIDADES -->
         <div class="page-separator mb-2">
            <div class="page-separator__text">Próximas Atividades</div>
        </div>
        <?php if (count($tarefas) > 0){  ?>
        <div class="card mb-32pt mb-lg-64pt">
            <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-1" data-domfactory-upgraded="accordion">
                <li class="accordion__item open">
                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-1" href="#toc-content-1" aria-expanded="true">
                        <span class="flex">Próximas Atividades</span>
                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                    </a>
                    <div class="accordion__menu">
                        <ul class="list-unstyled collapse show" id="toc-content-1" style="">
                            <?php foreach($tarefas as $tar){ ?>
                            <li class="accordion__menu-link">
                                <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                <a class="flex" href="student-take-lesson.html"><?php echo $tar['nome']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <?php } else {
            echo '<div class="container">Nenhuma atividade encontrada.</div>';
        } ?>
        <!-- PROVAS -->
         <div class="page-separator mt-4">
            <div class="page-separator__text">Próximas Provas</div>
        </div>
        <?php if (count($provas) > 0){  ?>
        <div class="card mb-32pt mb-lg-64pt">
            <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-1" data-domfactory-upgraded="accordion">
                <li class="accordion__item open">
                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-1" href="#toc-content-1" aria-expanded="true">
                        <span class="flex">Próximas Provas</span>
                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                    </a>
                    <div class="accordion__menu">
                        <ul class="list-unstyled collapse show" id="toc-content-1" style="">
                            <?php foreach($provas as $prv){ ?>
                            <li class="accordion__menu-link">
                                <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                <a class="flex" href="student-take-lesson.html"><?php echo $prv['nome']; ?></a>
                                <span class="text-muted">Valor: <?php echo $prv['nota_maxima']; ?></span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <?php } else {
            echo '<div class="container">Nenhuma prova encontrada.</div>';
        } ?>
    </div>
</div>

<!-- LINHA DE APRENDIZADO AQUI \/
A FAZER <div class="page-section border-bottom-2" style="display:none;">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">Linha de aprendizado</div>
        </div>

        <div class="row card-group-row">

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/react_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">React Native</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/react_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">React Native</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with React Native and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/devops_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">Dev Ops</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/devops_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">Dev Ops</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with Dev Ops and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/redis_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">Redis</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/redis_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">Redis</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with Redis and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>

            </div>

        </div>

        <div class="row card-group-row mb-lg-8pt">

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card mb-lg-0" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/mailchimp_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">MailChimp</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/mailchimp_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">MailChimp</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with MailChimp and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card mb-lg-0" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/swift_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">Swift</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/swift_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">Swift</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with Swift and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>

            </div>

            <div class="col-sm-4 card-group-row__col">

                <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card mb-lg-0" data-toggle="popover" data-trigger="click">

                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <div class="flex">
                                <div class="d-flex align-items-center">
                                    <div class="rounded mr-12pt z-0 o-hidden">
                                        <div class="overlay">
                                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/wordpress_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                            <span class="overlay__content overlay__content-transparent">
                                                <span class="overlay__action d-flex flex-column text-center lh-1">
                                                    <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="card-title">WordPress</div>
                                        <p class="flex text-50 lh-1 mb-0"><small>18 courses</small></p>
                                    </div>
                                </div>
                            </div>

                            <a href="student-path.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>

                        </div>

                    </div>
                </div>

                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="<?php echo base_url(); ?>assets/assetsAlison/images/paths/wordpress_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title">WordPress</div>
                            <p class="text-50 d-flex lh-1 mb-0 small">18 courses</p>
                        </div>
                    </div>

                    <p class="mt-16pt text-70">Learn the fundamentals of working with WordPress and how to create basic applications.</p>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>50 minutes left</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-path.html" class="btn btn-primary mr-8pt">Resume</a>
                            <a href="student-path.html" class="btn btn-outline-secondary ml-0">Start over</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-50 mr-8pt">Your rating</small>
                        <div class="rating mr-8pt">
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                        </div>
                        <small class="text-50">4/5</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">Meus Cursos</div>
        </div>
        <div class="row card-group-row">

            <?php $q = 0;
            if (count($courses) > 0){
            foreach ($courses as $item) : ?>
                <!-- <?php echo get_url($item[0]['id'], $item[0]['nome'], $item[0]['capa']) ?> -->
                <?php include(ROOT_PATH . '/application/views/ead/listCourses.php'); ?>

            <?php endforeach;
            } else {
                echo '<div class="container">Você ainda não se inscreveu em nenhum curso!</div>';
            } ?>
        </div>
    </div>
</div>

<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/ead/footer.php'); ?>