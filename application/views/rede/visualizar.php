<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>
<style>
    .tree .container_nivel {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .tree .item {
        display: block;
        width: 50px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tree .item .card-body {
        text-align: center !important;
    }

    .tree .item i {
        font-size: 1rem !important;
    }

    .tree .item span {
        font-size: .6rem !important;
    }

    .tree .title-user {
        font-size: .6rem !important;
        text-transform: none !important;
    }

    .tooltip-inner{
        background:#373737!important;
        color:white!important;
        border-color:#373737!important;
    }
    .arrow:before{
        border-top-color:#373737!important;
    }
</style>
<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Visualizar Rede</h5>
                        <hr>
                        <div class="row tree">
                            <div class="col-12 container_nivel">
                                <?php if (isset($user['id'])) { ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . substr($user['id_niveis'], 0, strlen($user['id_niveis']) - 1)); ?>">
                                        <button class="btn btn-secondary item" title="<?php echo $user['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $user['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row tree pt-4 mt-2">
                            <div class="col container_nivel">
                                <?php if (isset($formato[0]['id'])) {
                                    $atual = $formato[0]; ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                        <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="col container_nivel">
                                <?php if (isset($formato[1]['id'])) {
                                    $atual = $formato[1]; ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                        <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="col container_nivel">
                                <?php if (isset($formato[2]['id'])) {
                                    $atual = $formato[2]; ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                        <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="col container_nivel">
                                <?php if (isset($formato[3]['id'])) {
                                    $atual = $formato[3]; ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                        <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                            <div class="col container_nivel">
                                <?php if (isset($formato[4]['id'])) {
                                    $atual = $formato[4]; ?>
                                    <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                        <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                            <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <button disabled class="btn btn-light item" title="">
                                        <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row tree pt-4 mt-2">
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <div class="row tree col">
                                    <?php for ($j = 0; $j < 5; $j++) { ?>
                                        <div class="col container_nivel">
                                            <?php if (isset($formato[$i]['nivel_2'][$j])) {
                                                $atual = $formato[$i]['nivel_2'][$j]; ?>
                                                <a href="<?php echo site_url('rede/visualizar/' . $atual['id_niveis']); ?>">
                                                    <button class="btn btn-primary item" title="<?php echo $atual['login']; ?>">
                                                        <i class="fa fa-user"></i><br /><!-- <small class="title-user"><?php echo $atual['login']; ?></small> -->
                                                    </button>
                                                </a>
                                            <?php } else { ?>
                                                <button disabled class="btn btn-light item" title="">
                                                    <i class="fa fa-ban"></i><br /><!-- <small class="title-user">N/A</small> -->
                                                </button>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/rede/footer.php'); ?>
<script>
    $(function () {
        $('.item').tooltip({
            'html':true
        });
    });
</script>