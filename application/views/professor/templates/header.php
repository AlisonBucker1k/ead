<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Luma</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/vendor/spinkit.css"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/css/material-icons.css"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/css/fontawesome.css"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/css/preloader.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="<?php echo base_url();?>assets/assetsAlison/css/app.css"
              rel="stylesheet">

    </head>

    <body class="layout-app ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <div class="navbar navbar-expand navbar-light border-bottom-2"
                     id="default-navbar"
                     data-primary>

                    <!-- Navbar toggler -->
                    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0"
                            type="button"
                            data-toggle="sidebar">
                        <span class="material-icons">short_text</span>
                    </button>

                    <!-- Navbar Brand -->
                    <a href="index.html"
                       class="navbar-brand mr-16pt d-lg-none">
                        <!-- <img class="navbar-brand-icon" src="../../public/images/logo/white-100@2x.png" width="30" alt="Luma"> -->

                        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                            <span class="avatar-title rounded bg-primary"><img src="../../public/images/illustration/student/128/white.svg"
                                     alt="logo"
                                     class="img-fluid" /></span>

                        </span>

                        <span class="d-none d-lg-block">Luma</span>
                    </a>

                    <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                        <li class="nav-item active">
                            <a href="index.html"
                               class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               data-caret="false">Courses</a>
                            <div class="dropdown-menu">
                                <a href="courses.html"
                                   class="dropdown-item">Browse Courses</a>
                                <a href="student-course.html"
                                   class="dropdown-item">Preview Course</a>
                                <a href="student-lesson.html"
                                   class="dropdown-item">Preview Lesson</a>
                                <a href="student-take-course.html"
                                   class="dropdown-item"><span class="mr-16pt">Take Course</span> <span class="badge badge-notifications badge-accent text-uppercase ml-auto">Pro</span></a>
                                <a href="student-take-lesson.html"
                                   class="dropdown-item">Take Lesson</a>
                                <a href="student-take-quiz.html"
                                   class="dropdown-item">Take Quiz</a>
                                <a href="student-quiz-result-details.html"
                                   class="dropdown-item">Quiz Result</a>
                                <a href="student-dashboard.html"
                                   class="dropdown-item">Student Dashboard</a>
                                <a href="student-my-courses.html"
                                   class="dropdown-item">My Courses</a>
                                <a href="student-quiz-results.html"
                                   class="dropdown-item">My Quizzes</a>
                                <a href="help-center.html"
                                   class="dropdown-item">Help Center</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               data-caret="false">Paths</a>
                            <div class="dropdown-menu">
                                <a href="paths.html"
                                   class="dropdown-item">Browse Paths</a>
                                <a href="student-path.html"
                                   class="dropdown-item">Path Details</a>
                                <a href="student-path-assessment.html"
                                   class="dropdown-item">Skill Assessment</a>
                                <a href="student-path-assessment-result.html"
                                   class="dropdown-item">Skill Result</a>
                                <a href="student-paths.html"
                                   class="dropdown-item">My Paths</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="pricing.html"
                               class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               data-caret="false">Teachers</a>
                            <div class="dropdown-menu">
                                <a href="instructor-dashboard.html"
                                   class="dropdown-item">Instructor Dashboard</a>
                                <a href="instructor-courses.html"
                                   class="dropdown-item">Manage Courses</a>
                                <a href="instructor-quizzes.html"
                                   class="dropdown-item">Manage Quizzes</a>
                                <a href="instructor-earnings.html"
                                   class="dropdown-item">Earnings</a>
                                <a href="instructor-statement.html"
                                   class="dropdown-item">Statement</a>
                                <a href="instructor-edit-course.html"
                                   class="dropdown-item">Edit Course</a>
                                <a href="instructor-edit-quiz.html"
                                   class="dropdown-item">Edit Quiz</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown"
                            data-toggle="tooltip"
                            data-title="Community"
                            data-placement="bottom"
                            data-boundary="window">
                            <a href="#"
                               class="nav-link dropdown-toggle"
                               data-toggle="dropdown"
                               data-caret="false">
                                <i class="material-icons">people_outline</i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="teachers.html"
                                   class="dropdown-item">Browse Teachers</a>
                                <a href="student-profile.html"
                                   class="dropdown-item">Student Profile</a>
                                <a href="teacher-profile.html"
                                   class="dropdown-item">Instructor Profile</a>
                                <a href="blog.html"
                                   class="dropdown-item">Blog</a>
                                <a href="blog-post.html"
                                   class="dropdown-item">Blog Post</a>
                                <a href="faq.html"
                                   class="dropdown-item">FAQ</a>
                                <a href="help-center.html"
                                   class="dropdown-item">Help Center</a>
                                <a href="discussions.html"
                                   class="dropdown-item">Discussions</a>
                                <a href="discussion.html"
                                   class="dropdown-item">Discussion Details</a>
                                <a href="discussions-ask.html"
                                   class="dropdown-item">Ask Question</a>
                            </div>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                            <a href="login.html"
                               class="nav-link"
                               data-toggle="tooltip"
                               data-title="Login"
                               data-placement="bottom"
                               data-boundary="window"><i class="material-icons">lock_open</i></a>
                        </li>
                        <li class="nav-item">
                            <a href="signup.html"
                               class="btn btn-outline-dark">Get Started</a>
                        </li>
                    </ul>
                </div>

                <!-- // END Header -->

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->