<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>REDE KEROSER</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
        rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/spinkit.css" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.css"
        rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/material-icons.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/fontawesome.css" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/preloader.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/app.css" rel="stylesheet">

    <!-- Datatables CSS -->
    <link type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Datatables Buttons CSS -->
    <link type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"
        rel="stylesheet">

    <!-- Toastr -->
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/toastr.css" rel="stylesheet">

    <!-- bootstrap selectpicker -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
    #toast-container>.toast-error {
        background-color: #d9534f !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #ffffff !important;
        background: initial !important;
        background-color: #5567ff !important;
        border-color: #5567ff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button,
    button.dt-button,
    div.dt-button,
    a.dt-button,
    input.dt-button {
        background: initial !important;
        background-color: transparent !important;
        border: 1px solid #dee2e6 !important;
        color: rgba(39, 44, 51, .7) !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
    button.dt-button:hover,
    div.dt-button:hover,
    a.dt-button:hover,
    input.dt-button:hover {
        background: initial !important;
        background-color: #e9ecef !important;
        border-color: #dee2e6 !important;
        color: rgba(6, 7, 8, .7) !important;
    }

    .custom-file-input:lang(en)~.custom-file-label:after {
        content: "Selecionar";
    }

    .bootstrap-select .dropdown-menu {
        z-index: 0 !important;
    }

    .bootstrap-select .dropdown-menu.show {
        z-index: 99999 !important;
    }
    </style>
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

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
        <div class="mdk-drawer-layout__content page-content">

            <!-- Header -->

            <!-- Navbar -->

            <div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>

                <!-- Navbar Toggler -->

                <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button"
                    data-toggle="sidebar">
                    <span class="material-icons">short_text</span>
                </button>

                <!-- // END Navbar Toggler -->

                <!-- Navbar Brand -->

                <a href="<?php echo site_url('rede/index'); ?>" class="navbar-brand mr-16pt d-lg-none">

                    <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                        <span class="avatar-title rounded bg-primary"><img
                                src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" alt="logo"
                                class="img-fluid" /></span>

                    </span>

                    <span class="d-none d-lg-block">KEROSER REDE</span>
                </a>

                <!-- // END Navbar Brand -->

                <span class="d-none d-md-flex align-items-center mr-16pt">

                </span>

                <div class="flex"></div>

                <!-- Switch Layout -->


                <!-- // END Switch Layout -->

                <!-- Navbar Menu -->

                <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                            data-caret="false">

                            <span class="avatar avatar-sm mr-8pt2">
                                <img src="<?php echo getImgPerf($this->session->userdata('foto')); ?>"
                                    class="avatar-title rounded-circle img-fluid bg-primary" alt="perfil" />

                            </span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header">
                                <strong><?php echo 'Olá, ' . $this->session->userdata('nome'); ?></strong></div>
                            <a class="dropdown-item" href="<?php echo site_url('rede/dados_pagamento'); ?>">Dados de Pagamento</a>
                            <a class="dropdown-item" href="<?php echo site_url('rede/perfil'); ?>">Editar Conta</a>
                            <a class="dropdown-item" href="<?php echo site_url('rede/login/logoff'); ?>">Sair</a>
                        </div>
                    </div>
                </div>

                <!-- // END Navbar Menu -->

            </div>

            <!-- // END Navbar -->

            <!-- // END Header -->