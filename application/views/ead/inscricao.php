<?php include_once(ROOT_PATH.'/assets/includes/ead/header.php'); ?>
    <!-- Page Content -->

    <div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
        <div class="mdk-box__content">
            <div class="hero py-64pt text-center text-sm-left">
                <div class="container page__container">
                    <h1 class="text-white"><?php echo $course[0]['nome'];?></h1>
                    <p class="lead text-white-50 measure-hero-lead mb-24pt"><?php echo $course[0]['descricao'];?></p>
                    <a href="<?php echo site_url('ead/cursos/inscrever/'.$course[0]['id']); ?>"
                        class="btn btn-white">Me inscrever neste curso</a>
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
                                        href="#"><?php echo $professor[0]['nome']?></a>
                                    <p class="text-50 lh-1 mb-0">Professor</p>
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
                                    <span class="flex"><?php echo count($aulas); ?> Aulas</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 page-nav">
                <div class="page-section">
                    <div class="page-nav__content">
                        <div class="page-separator">
                            <div class="page-separator__text">Modalidade</div>
                        </div>
                        <!-- <h4 class="mb-16pt">Table of contents</h4> -->
                    </div>
                    <nav class="nav page-nav__menu">
                        <a class="nav-link active"
                            href=""><? echo $modalidade[0]['nome'];?></a>
                        <!-- <a class="nav-link"
                            href="">Creating and Communicating Between Angular Components</a>
                        <a class="nav-link"
                            href="">Exploring the Angular Template Syntax</a> -->
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="page-section bg-white border-top-2 border-bottom-2">

        <div class="container page__container">
            <div class="row ">
                <div class="col-md-7">
                    <div class="page-separator">
                        <div class="page-separator__text">About this course</div>
                    </div>
                    <p class="text-70">This course will teach you the fundamentals o*f working with Angular 2. You *will learn everything you need to know to create complete applications including: components, services, directives, pipes, routing, HTTP, and even testing.</p>
                    <p class="text-70 mb-0">This course will teach you the fundamentals o*f working with Angular 2. You *will learn everything you need to know to create complete applications including: components, services, directives, pipes, routing, HTTP, and even testing.</p>
                </div>
                <div class="col-md-5">
                    <div class="page-separator">
                        <div class="page-separator__text bg-white">What you’ll learn</div>
                    </div>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center">
                            <span class="material-icons text-50 mr-8pt">check</span>
                            <span class="text-70">Fundamentals of working with Angular</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="material-icons text-50 mr-8pt">check</span>
                            <span class="text-70">Create complete Angular applications</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="material-icons text-50 mr-8pt">check</span>
                            <span class="text-70">Working with the Angular CLI</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="material-icons text-50 mr-8pt">check</span>
                            <span class="text-70">Understanding Dependency Injection</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="material-icons text-50 mr-8pt">check</span>
                            <span class="text-70">Testing with Angular</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div> -->

    <!-- <div class="page-section bg-white border-bottom-2">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-24pt mb-md-0">
                    <h4>About the author</h4>
                    <p class="text-70 mb-24pt">Eddie Bryan is a software developer at LearnD*ash. With more than 20 years o*f software development experience, he has gained a passion for Agile software development -- especially Lean.</p>

                    <div class="page-separator">
                        <div class="page-separator__text bg-white">More from the author</div>
                    </div>

                    <div class="card card-sm mb-8pt">
                        <div class="card-body d-flex align-items-center">
                            <a href="course.html"
                                class="avatar avatar-4by3 mr-12pt">
                                <img src="public/images/paths/angular_routing_200x168.png"
                                        alt="Angular Routing In-Depth"
                                        class="avatar-img rounded">
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                    href="course.html">Angular Routing In-Depth</a>
                                <div class="d-flex align-items-center">
                                    <div class="rating mr-8pt">

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star_border</span></span>

                                        <span class="rating__item"><span class="material-icons">star_border</span></span>

                                    </div>
                                    <small class="text-muted">3/5</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-sm mb-16pt">
                        <div class="card-body d-flex align-items-center">
                            <a href="course.html"
                                class="avatar avatar-4by3 mr-12pt">
                                <img src="public/images/paths/angular_testing_200x168.png"
                                        alt="Angular Unit Testing"
                                        class="avatar-img rounded">
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt"
                                    href="course.html">Angular Unit Testing</a>
                                <div class="d-flex align-items-center">
                                    <div class="rating mr-8pt">

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star</span></span>

                                        <span class="rating__item"><span class="material-icons">star_border</span></span>

                                    </div>
                                    <small class="text-muted">4/5</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0">
                            <a href=""
                                class="card-title mb-4pt">Angular Best Practices</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                        <div class="list-group-item px-0">
                            <a href=""
                                class="card-title mb-4pt">Unit Testing in Angular</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                        <div class="list-group-item px-0">
                            <a href=""
                                class="card-title mb-4pt">Migrating Applications from AngularJS to Angular</a>
                            <p class="lh-1 mb-0">
                                <small class="text-muted mr-8pt">6h 40m</small>
                                <small class="text-muted mr-8pt">13,876 Views</small>
                                <small class="text-muted">13 May 2018</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pt-sm-32pt pt-md-0 d-flex flex-column align-items-center justify-content-start">
                    <div class="text-center">
                        <p class="mb-16pt">
                            <img src="../../public/images/people/110/guy-6.jpg"
                                    alt="guy-6"
                                    class="rounded-circle"
                                    width="64">
                        </p>
                        <h4 class="m-0">Eddie Bryan</h4>
                        <p class="lh-1">
                            <small class="text-muted">Angular, Web Development</small>
                        </p>
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                            <a href="teacher-profile.html"
                                class="btn btn-outline-primary mb-16pt mb-sm-0 mr-sm-16pt">Follow</a>
                            <a href="teacher-profile.html"
                                class="btn btn-outline-secondary">View Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="page-section border-bottom-2">
        <div class="container">
            <div class="page-headline text-center">
                <h2>Feedback</h2>
                <p class="lead text-70 measure-lead mx-auto">What other students turned professionals have to say about us after learning with us and reaching their goals.</p>
            </div>

            <div class="position-relative carousel-card p-0 mx-auto">
                <div class="row d-block js-mdk-carousel"
                        id="carousel-feedback">
                    <a class="carousel-control-next js-mdk-carousel-control mt-n24pt"
                        href="#carousel-feedback"
                        role="button"
                        data-slide="next">
                        <span class="carousel-control-icon material-icons"
                                aria-hidden="true">keyboard_arrow_right</span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div class="mdk-carousel__content">

                        <div class="col-12 col-md-6">

                            <div class="card card-feedback card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                                </blockquote>
                            </div>
                            <div class="media ml-12pt">
                                <div class="media-left mr-12pt">
                                    <a href="student-profile.html"
                                        class="avatar avatar-sm">
                                        <!-- <img src="../../public/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> 
                                        <span class="avatar-title rounded-circle">UK</span>
                                    </a>
                                </div>
                                <div class="media-body media-middle">
                                    <a href="student-profile.html"
                                        class="card-title">Umberto Kass</a>
                                    <div class="rating mt-4pt">
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="card card-feedback card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                                </blockquote>
                            </div>
                            <div class="media ml-12pt">
                                <div class="media-left mr-12pt">
                                    <a href="student-profile.html"
                                        class="avatar avatar-sm">
                                        <!-- <img src="../../public/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> 
                                        <span class="avatar-title rounded-circle">UK</span>
                                    </a>
                                </div>
                                <div class="media-body media-middle">
                                    <a href="student-profile.html"
                                        class="card-title">Umberto Kass</a>
                                    <div class="rating mt-4pt">
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="card card-feedback card-body">
                                <blockquote class="blockquote mb-0">
                                    <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                                </blockquote>
                            </div>
                            <div class="media ml-12pt">
                                <div class="media-left mr-12pt">
                                    <a href="student-profile.html"
                                        class="avatar avatar-sm">
                                        <!-- <img src="../../public/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> 
                                        <span class="avatar-title rounded-circle">UK</span>
                                    </a>
                                </div>
                                <div class="media-body media-middle">
                                    <a href="student-profile.html"
                                        class="card-title">Umberto Kass</a>
                                    <div class="rating mt-4pt">
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star</span></span>
                                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="page-section bg-white border-bottom-2">

        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Student Feedback</div>
            </div>
            <div class="row mb-32pt">
                <div class="col-md-3 mb-32pt mb-md-0">
                    <div class="display-1">4.7</div>
                    <div class="rating rating-24">
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                    </div>
                    <p class="text-muted mb-0">20 ratings</p>
                </div>
                <div class="col-md-9">

                    <div class="row align-items-center mb-8pt"
                            data-toggle="tooltip"
                            data-title="75% rated 5/5"
                            data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress"
                                    style="height: 8px;">
                                <div class="progress-bar bg-secondary"
                                        role="progressbar"
                                        aria-valuenow="75"
                                        style="width: 75%"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt"
                            data-toggle="tooltip"
                            data-title="16% rated 4/5"
                            data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress"
                                    style="height: 8px;">
                                <div class="progress-bar bg-secondary"
                                        role="progressbar"
                                        aria-valuenow="16"
                                        style="width: 16%"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt"
                            data-toggle="tooltip"
                            data-title="12% rated 3/5"
                            data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress"
                                    style="height: 8px;">
                                <div class="progress-bar bg-secondary"
                                        role="progressbar"
                                        aria-valuenow="12"
                                        style="width: 12%"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt"
                            data-toggle="tooltip"
                            data-title="9% rated 2/5"
                            data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress"
                                    style="height: 8px;">
                                <div class="progress-bar bg-secondary"
                                        role="progressbar"
                                        aria-valuenow="9"
                                        style="width: 9%"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-8pt"
                            data-toggle="tooltip"
                            data-title="0% rated 0/5"
                            data-placement="top">
                        <div class="col-md col-sm-6">
                            <div class="progress"
                                    style="height: 8px;">
                                <div class="progress-bar bg-secondary"
                                        role="progressbar"
                                        aria-valuenow="0"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                            <div class="rating">
                                <span class="rating__item"><span class="material-icons">star</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pb-16pt mb-16pt border-bottom row">
                <div class="col-md-3 mb-16pt mb-md-0">
                    <div class="d-flex">
                        <a href="student-profile.html"
                            class="avatar avatar-sm mr-12pt">
                             <img src="LB" alt="avatar" class="avatar-img rounded-circle"> 
                            <span class="avatar-title rounded-circle">LB</span>
                        </a>
                        <div class="flex">
                            <p class="small text-muted m-0">2 days ago</p>
                            <a href="student-profile.html"
                                class="card-title">Laza Bogdan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="rating mb-8pt">
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                    </div>
                    <p class="text-70 mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                </div>
            </div>

            <div class="pb-16pt mb-16pt border-bottom row">
                <div class="col-md-3 mb-16pt mb-md-0">
                    <div class="d-flex">
                        <a href="student-profile.html"
                            class="avatar avatar-sm mr-12pt">
                            <!-- <img src="UK" alt="avatar" class="avatar-img rounded-circle"> 
                            <span class="avatar-title rounded-circle">UK</span>
                        </a>
                        <div class="flex">
                            <p class="small text-muted m-0">2 days ago</p>
                            <a href="student-profile.html"
                                class="card-title">Umberto Klass</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="rating mb-8pt">
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                    </div>
                    <p class="text-70 mb-0">This course is absolutely amazing, Bryan goes* out of his way to really expl*ain things clearly I couldn&#39;t be happier, so glad I made this purchase!</p>
                </div>
            </div>

            <div class="pb-16pt mb-24pt row">
                <div class="col-md-3 mb-16pt mb-md-0">
                    <div class="d-flex">
                        <a href="student-profile.html"
                            class="avatar avatar-sm mr-12pt">
                            <!-- <img src="AD" alt="avatar" class="avatar-img rounded-circle"> 
                            <span class="avatar-title rounded-circle">AD</span>
                        </a>
                        <div class="flex">
                            <p class="small text-muted m-0">2 days ago</p>
                            <a href="student-profile.html"
                                class="card-title">Adrian Demian</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="rating mb-8pt">
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star</span></span>
                        <span class="rating__item"><span class="material-icons">star_border</span></span>
                    </div>
                    <p class="text-70 mb-0">This course is absolutely amazing, Bryan goes* out of his way to really expl*ain things clearly I couldn&#39;t be happier, so glad I made this purchase!</p>
                </div>
            </div>

        </div>

    </div> -->

    <!-- <div class="page-section">
        <div class="container page__container">
            <div class="page-heading">
                <h4>Top Development Courses</h4>
                <a href=""
                    class="text-underline ml-sm-auto">See Development Courses</a>
            </div>

            <div class="position-relative carousel-card">
                <div class="js-mdk-carousel row d-block"
                        id="carousel-courses1">

                    <a class="carousel-control-next js-mdk-carousel-control mt-n24pt"
                        href="#carousel-courses1"
                        role="button"
                        data-slide="next">
                        <span class="carousel-control-icon material-icons"
                                aria-hidden="true">keyboard_arrow_right</span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="mdk-carousel__content">

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal "
                                    data-partial-height="44"
                                    data-toggle="popover"
                                    data-trigger="click">

                                <a href="student-course.html"
                                    class="js-image"
                                    data-position="">
                                    <img src="../../public/images/paths/angular_430x168.png"
                                            alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <span class="corner-ribbon corner-ribbon--default-right-top corner-ribbon--shadow bg-accent text-white">NEW</span>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                    href="student-course.html">Learn Angular fundamentals</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-course.html"
                                                data-toggle="tooltip"
                                                data-title="Add Favorite"
                                                data-placement="top"
                                                data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>
                                            <small class="text-50">6 hours</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="../../public/images/paths/angular_40x40@2x.png"
                                                width="40"
                                                height="40"
                                                alt="Angular"
                                                class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Learn Angular fundamentals</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">with</span>
                                            <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="student-course.html"
                                            class="btn btn-primary">Watch trailer</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal "
                                    data-partial-height="44"
                                    data-toggle="popover"
                                    data-trigger="click">

                                <a href="student-course.html"
                                    class="js-image"
                                    data-position="">
                                    <img src="../../public/images/paths/swift_430x168.png"
                                            alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                    href="student-course.html">Build an iOS Application in Swift</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-course.html"
                                                data-toggle="tooltip"
                                                data-title="Remove Favorite"
                                                data-placement="top"
                                                data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>
                                            <small class="text-50">6 hours</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="../../public/images/paths/swift_40x40@2x.png"
                                                width="40"
                                                height="40"
                                                alt="Angular"
                                                class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Build an iOS Application in Swift</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">with</span>
                                            <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="student-course.html"
                                            class="btn btn-primary">Watch trailer</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal "
                                    data-partial-height="44"
                                    data-toggle="popover"
                                    data-trigger="click">

                                <a href="student-course.html"
                                    class="js-image"
                                    data-position="">
                                    <img src="../../public/images/paths/wordpress_430x168.png"
                                            alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                    href="student-course.html">Build a WordPress Website</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-course.html"
                                                data-toggle="tooltip"
                                                data-title="Add Favorite"
                                                data-placement="top"
                                                data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>
                                            <small class="text-50">6 hours</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="../../public/images/paths/wordpress_40x40@2x.png"
                                                width="40"
                                                height="40"
                                                alt="Angular"
                                                class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Build a WordPress Website</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">with</span>
                                            <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="student-course.html"
                                            class="btn btn-primary">Watch trailer</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal "
                                    data-partial-height="44"
                                    data-toggle="popover"
                                    data-trigger="click">

                                <a href="student-course.html"
                                    class="js-image"
                                    data-position="left">
                                    <img src="../../public/images/paths/react_430x168.png"
                                            alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                    href="student-course.html">Become a React Native Developer</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-course.html"
                                                data-toggle="tooltip"
                                                data-title="Add Favorite"
                                                data-placement="top"
                                                data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>
                                            <small class="text-50">6 hours</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="../../public/images/paths/react_40x40@2x.png"
                                                width="40"
                                                height="40"
                                                alt="Angular"
                                                class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Become a React Native Developer</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">with</span>
                                            <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                        <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="student-course.html"
                                            class="btn btn-primary">Watch trailer</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div> 
    </div>-->

                <!-- // END Page Content -->
<?php include_once(ROOT_PATH.'/assets/includes/ead/footer.php'); ?>