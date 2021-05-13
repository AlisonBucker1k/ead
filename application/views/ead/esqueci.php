<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Recuperar Senha</title>

      <!-- Prevent the demo from appearing in search engines -->
      <meta name="robots" content="noindex">

      <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

      <!-- Preloader -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/spinkit.css" rel="stylesheet">

      <!-- Perfect Scrollbar -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.css" rel="stylesheet">

      <!-- Material Design Icons -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/material-icons.css" rel="stylesheet">

      <!-- Font Awesome Icons -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/fontawesome.css" rel="stylesheet">

      <!-- Preloader -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/preloader.css" rel="stylesheet">

      <!-- App CSS -->
      <link type="text/css" href="<?php echo site_url('assets/assetsAlison'); ?>/css/app.css" rel="stylesheet">

      <!-- Verificador CSS -->
      <link type="text/css" href="<?php echo site_url('assets/css/verificador.css'); ?>" rel="stylesheet">
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
            <div class="mdk-drawer-layout__content page-content d-flex justify-content-center">

                  <!-- Header -->



                  <!-- // END Header -->

                  <!-- BEFORE Page Content -->

                  <!-- // END BEFORE Page Content -->

                  <!-- Page Content -->

                  <div class="pb-32pt">
                        <div class="container page__container">

                              <form method="post" action="<?php echo site_url('ead/login/gera_recuperacao'); ?>" class="col-md-5 p-0 mx-auto">
                                    <img src="<?php echo site_url('assets/imagens/LOGO-ESCUDO-2.png'); ?>" style="width:100%;">
                                    <div class="form-group">
                                          <label class="form-label" for="email">Email:</label>
                                          <input name="email" id="email" type="email" class="form-control" placeholder="Seu email ..." required>
                                    </div>

                                    <div class="text-center">
                                          <button class="btn btn-primary btn-block">Recuperar</button>
                                    </div>
                              </form>
                        </div>
                  </div>
                  <!-- // END Page Content -->


            </div>

            <!-- // END drawer-layout__content -->



      </div>

      <!-- // END Drawer Layout -->

      <!-- jQuery -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/jquery.min.js"></script>

      <!-- Bootstrap -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/popper.min.js"></script>
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/bootstrap.min.js"></script>

      <!-- Perfect Scrollbar -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.min.js"></script>

      <!-- DOM Factory -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/dom-factory.js"></script>

      <!-- MDK -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/material-design-kit.js"></script>

      <!-- App JS -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/app.js"></script>

      <!-- Preloader -->
      <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/preloader.js"></script>

      <!-- Validador de formulários -->
      <script src="<?php echo site_url('assets/js/verificador.js'); ?>"></script>
</body>

</html>