<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Cadastro de Cargo
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <form id="formCadastrarCargo" action="<?php echo base_url(); ?>admin/administradores/insere_cargo" enctype="multipart/form-data" method="POST" style="width:100%;">
                <div class="col-md-12 mb-24pt mb-md-0">

                    <div class="form-group">
                        <label class="form-label" for="name">Nome do cargo: *</label>
                        <input name="nome" class="form-control" placeholder="Digite aqui o nome do cargo..." required />
                    </div>



                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h5>Permissões do cargo</h5>
                            <div class="d-flex mb-8pt">
                                <div class="flex"><strong class="text-70"></strong></div>
                                <strong></strong>
                            </div>

                            <?php foreach ($fields as $f) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <h6><b><?= ucfirst($f['nome']); ?></b></h6>
                                                </div>
                                                <div class="col-12 d-flex" >
                                                    <?php foreach ($f['acoes'] as $a) : ?>
                                                        <div class="container" style="display:flex;margin-bottom:0px!important">
                                                            <input class="permissions" data-inside="<?php echo $a . '|' . $f['id']; ?>" onchange="setPermissions()" type="checkbox" style="width:17px;height:17px;">
                                                            <label style="padding-left:5px;"><?= $a ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div id="appendedIds">
                            </div>
                            <button type="submit" class="btn btn-primary" >Cadastrar Cargo</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>

<script>
    function setPermissions(){
        $('#appendedIds').html('');
        $('.permissions:checked').each(function () {
            $('#appendedIds').append('<input type="hidden" name="action[]" value="'+$(this).attr('data-inside')+'" />');
        });
    }
</script>