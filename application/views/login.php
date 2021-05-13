
<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="<?php echo site_url('uploads/favicon.jpg'); ?>"/>
  <title>Keroser EAD - login</title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo site_url('assets/assets/css/style-starter.css'); ?>">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>

<body>

  <section>

    <!-- content -->
    <div class="">
        <!-- login form -->
        <section class="login-form py-md-5 py-3">
            <div class="card card_border p-md-4">
                <div class="card-body">
                    <!-- form -->
                    <form action="<?php echo site_url('login/login'); ?>" method="POST">
                        <div class="login__header text-center mb-lg-5 mb-3">
                            <img src="<?php echo site_url('uploads/logokeroser.png'); ?>" /><br/>
                            <p style="margin-top:20px;">Seja bem vindo ao keroser EAD, faça login abaixo</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Email</label>
                            <input type="email" name="email" class="form-control login_text_field_bg input-style"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required=""
                                autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Senha</label>
                            <input type="password" name="senha" class="form-control login_text_field_bg input-style"
                                id="exampleInputPassword1" placeholder="" required>
                        </div>
                        <?php if ($this->session->userdata('notif') != ""){ ?>
                        <div class="alert alert-<?php echo $this->session->userdata('notif_tipo'); ?> alert-dismissible fade show" role="alert">
                          <strong><?php echo $this->session->userdata('notif_titulo'); ?></strong> <?php echo $this->session->userdata('notif'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <?php $this->session->unset_userdata(array('notif', 'notif_titulo', 'notif_tipo')); } ?>
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <button type="submit" class="btn btn-primary btn-style mt-4">Login</button>
                        </div>
                    </form>
                    <!-- //form -->
                </div>
            </div>
        </section>

    </div>
    <!-- //content -->

</section>


</body>

</html>