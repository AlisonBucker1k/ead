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
  <title>Keroser EAD</title>

  <!-- Template CSS -->

  <link rel="stylesheet" href="<?php echo site_url('assets/assets/css/style-liberty.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/assets/css/style-starter.css'); ?>">
  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/summernote/dist/summernote-bs4.css'); ?>">
  <style>
    .nav-item.nav-link:hover {
      cursor: pointer;
      cursor: hand;
    }

    .bootstrap-select .dropdown-menu li a span.text {
      font-size: 18px;
      text-align: left;
    }

    .border-secondary-top {
      border-top: 2px solid #B162AC;
    }

    .border-success-top {
      border-top: 2px solid #03c895;
    }

    .border-warning-top {
      border-top: 2px solid #B162AC;
    }

    .border-danger-top {
      border-top: 2px solid #ff4f81;
    }

    .btn_planos {
      padding-top: 0px;
      padding-bottom: 0px;
      padding-left: 5px;
      padding-right: 5px;
    }
    .sidebar-menu-collapsed .main-content {
        margin-left: 0px;
        padding: 150px;
    }
    
    .main-content{
            background: #eff1f9;
    }
  </style>
</head>

<body class="sidebar-menu-collapsed">
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
  <script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
  
  <body>
    <section>
      <!-- sidebar menu start -->
      <div class="sidebar-menu sticky-sidebar-menu" style="height:0px;width:auto;">

        <!-- logo start -->
        <div class="logo">
          <h1><a href="<?php echo site_url('painel/index'); ?>">Navegação</a></h1>
        </div>

        <!-- if logo is image enable this -->
        <!-- image logo --
    <div class="logo">
      <a href="index.html">
        <img src="image-path" alt="Your logo" title="Your logo" class="img-fluid" style="height:35px;" />
      </a>
    </div>
    <!-- //image logo -->

        <div class="logo-icon text-center" style="background:transparent;margin-left: 20px;">
          <a href="<?php echo site_url('admin/index'); ?>" title="logo"><img src="<?php echo site_url('uploads/logokeroser.png'); ?>" alt="logo-icon" style="max-height:60px;"> </a>
        </div>
        <!-- //logo end -->

        <!-- <div class="sidebar-menu-inner">

          <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="active"><a href="<?php echo site_url('painel/index'); ?>"><i class="fa fa-tachometer"></i><span> Inicio</span></a>
            </li>
            <?php if (temPermissao(0)) { ?>
              <li class="menu-list">
                <a href="#"><i class="fa fa-users"></i>
                  <span>Usuários <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                  <li><a href="<?php echo site_url('admin/usuarios/listar'); ?>">Listar Todos</a> </li>
                  <li><a href="<?php echo site_url('admin/usuarios/listar_volcher'); ?>">Usuários Volcher</a> </li>
                  <li><a href="<?php echo site_url('admin/usuarios/listar_plano'); ?>">Usuários Plano</a> </li>
                </ul>
              </li>
              <li class="menu-list">
                <a href="#"><i class="fa fa-suitcase"></i>
                  <span>Planos Volchers <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                  <li><a href="<?php echo site_url('admin/planos_e_volchers/listar_planos_ativos'); ?>">Listar Planos Ativos</a> </li>
                  <li><a href="<?php echo site_url('admin/planos_e_volchers/listar_volchers_ativos'); ?>">Listar Volchers Ativos</a> </li>
                  <?php if (temPermissao(2)) { ?>
                    <li><a href="<?php echo site_url('admin/planos_e_volchers/ativar_plano'); ?>">Ativar Plano</a></li>
                    <li><a href="<?php echo site_url('admin/planos_e_volchers/ativar_volcher'); ?>">Ativar Volcher</a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="menu-list"><a href="#"><i class="fa fa-money"></i>
                  <span>Saques <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                  <li><a href="<?php echo site_url('admin/saques/pendentes'); ?>">Pendentes</a></li>
                  <li><a href="<?php echo site_url('admin/saques/aceitos'); ?>">Aceitos</a></li>
                  <li><a href="<?php echo site_url('admin/saques/planos_pagos'); ?>">Pagos com saldo</a></li>
                </ul>
              </li>
              <?php if (temPermissao(2)) { ?>
                <li><a href="<?php echo site_url('admin/credito_debito'); ?>"><i class="fa fa-list-alt"></i> <span>Crédito / Débito</span></a></li>
              <?php } ?>
              <li><a href="<?php echo site_url('admin/monitor'); ?>"><i class="fa fa-desktop" aria-hidden="true"></i> <span>Monitor</span></a></li>
              <li class="menu-list"><a href="#"><i class="fa fa-cogs"></i>
                  <span>Configurações <i class="lnr lnr-chevron-right"></i></span></a>
                <ul class="sub-menu-list">
                  <li><a href="<?php echo site_url('admin/configuracoes'); ?>">Configurações Gerais</a></li>
                  <li><a href="<?php echo site_url('admin/configuracoes/notificacao_popup'); ?>">Notificação Popup</a></li>
                </ul>
              </li>
              <?php if (temPermissao(4)) { ?>
                <li class="menu-list"><a href="#"><i class="fa fa-user-o"></i>
                    <span>Administrador <i class="lnr lnr-chevron-right"></i></span></a>
                  <ul class="sub-menu-list">
                    <li><a href="<?php echo site_url('admin/administradores'); ?>">Listar Administradores</a></li>
                    <li><a href="<?php echo site_url('admin/administradores/cadastrar'); ?>">Cadastrar Administrador</a></li>
                  </ul>
                </li>
                <li class="menu-list"><a href="#"><i class="fa fa-envelope-o"></i>
                    <span>Tickets <i class="lnr lnr-chevron-right"></i></span></a>
                  <ul class="sub-menu-list">
                    <li><a href="<?php echo site_url('admin/tickets/abertos'); ?>">Tickets Em Aberto</a></li>
                    <li><a href="<?php echo site_url('admin/tickets/atendimento'); ?>">Tickets Em Atendimento</a></li>
                    <li><a href="<?php echo site_url('admin/tickets/resolvidos'); ?>">Tickets Resolvidos</a></li>
                    <li><a href="<?php echo site_url('admin/tickets'); ?>">Todos os tickets</a></li>
                  </ul>
                </li>
                <li class="menu-list"><a href="#"><i class="fa fa-ticket"></i>
                    <span>Rifas <i class="lnr lnr-chevron-right"></i></span></a>
                  <ul class="sub-menu-list">
                    <li><a href="<?php echo site_url('admin/rifas/novo_sorteio'); ?>">Novo sorteio</a></li>
                    <li><a href="<?php echo site_url('admin/rifas/sorteios_em_andamento'); ?>">Sorteios em andamento</a></li>
                    <li><a href="<?php echo site_url('admin/rifas/sorteios_concluidos'); ?>">Sorteios concluídos</a></li>
                    <li><a href="<?php echo site_url('admin/rifas/regras'); ?>">Regras</a></li>
                  </ul>
                </li>
              <?php } ?>
            <?php } ?>
          </ul>
          <a class="toggle-btn">
            <i class="fa fa-angle-double-left menu-collapsed__left"><span>Esconder Barra Lateral</span></i>
            <i class="fa fa-angle-double-right menu-collapsed__right"></i>
          </a>
        </div> -->
      </div>
      <!-- //sidebar menu end -->
      <!-- header-starts -->
      <div class="header sticky-header">

        <!-- notification menu start -->
        <div class="menu-right">
          <div class="navbar user-panel-top">

            <div class="user-dropdown-details d-flex">
              <div class="profile_details">
                <ul>
                  <li class="dropdown profile_details_drop" style="margin-right: 20px;
    font-size: 20px;
    margin-top: 10px;display:flex;">
                    <span style="padding-right: 10px;">Olá <?php echo $this->session->userdata('nome').' | '; ?></span>
                    <a href="<?php echo site_url('login/logoff'); ?>" ><i class="fa fa-power-off"></i> Sair</a> </li>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!--notification menu end -->

      </div>
      <!-- //header-ends -->