<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">
        <meta name="viewport"
              content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Certificado de conclusão de curso | KEROSER</title>

        <!-- Prevent the demo from appearing in search engines -->
        <meta name="robots"
              content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/spinkit.css"
              rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/perfect-scrollbar.css"
              rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/css/material-icons.css"
              rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/css/fontawesome.css"
              rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/css/preloader.css"
              rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/css/app.css"
              rel="stylesheet">
              
        <!-- Toastr -->
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.css"
              rel="stylesheet">
        <link type="text/css"
              href="<?php echo site_url('assets/assetsAlison'); ?>/css/toastr.css"
              rel="stylesheet">

        <!-- Verificador CSS -->
        <link type="text/css"
              href="<?php echo site_url('assets/css/verificador.css'); ?>"
              rel="stylesheet">
        <style>
            #toast-container>.toast-error {
                background-color: #d9534f!important;
            }
            .posicao-toast{
                width:100%;
            }
            
            .posicao-toast .toast{
                margin:auto!important;
            }
        </style>
    </head>

    <body class="layout-app " onload="print();">

            <!-- <div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-bounce-dot"></div>
  </div> -->

            <!-- More spinner examples at https://github.com/tobiasahlin/SpinKit/blob/master/examples.html -->
        </div>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             style="min-width:1280px;max-width:1280px;width:1280px;">
            <img src="<?php echo site_url('assets/assetsAlison/images/616daea5-4097-476c-bcb8-ac9790b22a3b.jfif') ?>" style="max-width:100%;max-height:905px;height:auto;" />
            <div class="mdk-drawer-layout__content page-content d-flex justify-content-center" style="position: absolute;
    width: 100%!important;
    text-align: center;
    margin-left:10%;
    font-size:18px;
    min-height:905px;
    max-height: 905px;
    height: 905px;">
                <h2>CERTIFICADO DE CONCLUSÃO</h2>
                <br/><br/><br/>
                <p>Certificamos que o aluno <b><?php echo $aluno['nome'] ?></b> concluiu com êxito o<br/>
                curso <b><?php echo $curso['nome'] ?></b> com carga horária de <b><?php echo $curso['duracao_hora'] ?> horas</b> <?php echo $curso['duracao_minutos'] > 0 ? "e <b>".$curso['duracao_minutos']." minutos</b>" : ""; ?>
                <br/>na data de <b><?php echo formataData($conclusao['data_ini'], false, false); ?></b> até <b><?php echo formataData($conclusao['data'], false, false); ?></b>.</p>
                <br/><br/><br/>
                <div style="height:3px;width:400px;border-bottom:1px solid black;margin-left: auto;margin-right: auto;"></div>
                Assinatura do aluno.
            </div>
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

        <!-- Toastr -->
        <script src="<?php echo site_url('assets/assetsAlison'); ?>/vendor/toastr.min.js"></script>
        <script src="<?php echo site_url('assets/assetsAlison'); ?>/js/toastr.js"></script>
        
        <!-- Validador de formulários -->
        <script src="<?php echo site_url('assets/js/verificador.js'); ?>"></script>

        <?php 
        if ($this->session->flashdata('aviso_tipo')){ ?>
        <script>
            $(document).ready(function () {
            var options = {
                "closeButton" : true,
                "positionClass": "posicao-toast",
                "progressBar" : true,
                "timeOut" : 5000
            }
            <?php if ($this->session->flashdata('aviso_tipo') == 'warning' || $this->session->flashdata('aviso_tipo') == '3' || $this->session->flashdata('aviso_tipo') == 'atencao'){ ?>
                toastr.warning('<?php echo $this->session->flashdata('aviso_msg'); ?>', 'Atenção', options);
            <?php } else if ($this->session->flashdata('aviso_tipo') == 'success' || $this->session->flashdata('aviso_tipo') == '0' || $this->session->flashdata('aviso_tipo') == 'sucesso'){ ?>
                toastr.success('<?php echo $this->session->flashdata('aviso_mensagem'); ?>', 'Sucesso!', options);
            <?php } else if ($this->session->flashdata('aviso_tipo') == 'error' || $this->session->flashdata('aviso_tipo') == '1' || $this->session->flashdata('aviso_tipo') == 'danger'|| $this->session->flashdata('aviso_tipo') == 'erro' || $this->session->flashdata('aviso_tipo') == 'perigo'){ ?>
                toastr.error('<?php echo $this->session->flashdata('aviso_mensagem'); ?>', 'Erro!', options);
            <?php } ?>
            });
        </script>
        <?php } ?>
    </body>

</html>