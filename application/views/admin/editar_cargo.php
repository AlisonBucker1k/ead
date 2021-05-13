<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Edição de Cargo
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <form id="formCadastrarCargo" action="<?php echo base_url(); ?>admin/administradores/update_cargo/<?php echo $cargo[0]['id']; ?>" enctype="multipart/form-data" method="POST" style="width:100%;">
                <div class="col-md-12 mb-24pt mb-md-0">

                    <div class="form-group">
                        <label class="form-label" for="name">Nome do cargo: *</label>
                        <input name="nome" class="form-control" placeholder="Digite aqui o nome do cargo..." value="<?php echo $cargo[0]['nome']; ?>" required />
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
                            <div class="d-flex pb-4">
                                <button type="button" class="btn btn-success" onclick="setAllPerm()"><i class="fa fa-check"></i>&nbsp;&nbsp;Ativar Todas</button>
                                <button type="button" class="btn btn-danger ml-4" onclick="setNonePerm()"><i class="fa fa-ban"></i>&nbsp;&nbsp;Desativar Todas</button>
                            </div>
                            <div class="row">
                            <?php foreach ($fields as $f) : ?>
                                
                                    <div class="col-md-6 col-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                
                                                <div class="col-12">
                                                    <h6><b><?= ucfirst($f['nome']); ?></b></h6>
                                                </div>
                                                <div class="col-12" >
                                                    <?php foreach ($f['acoes'] as $a) :
                                                        $checked = '';
                                                        foreach($permissoes as $p) :
                                                            if ($p['action'] == $a && $p['id_field'] == $f['id']){
                                                                $checked = 'checked';
                                                                break;
                                                            }
                                                        endforeach;
                                                        ?>
                                                        <div class="container" style="display:flex;margin-bottom:0px!important">
                                                            <input class="permissions" 
                                                            <?php echo $checked; ?>
                                                            data-inside="<?php echo $a . '|' . $f['id']; ?>" 
                                                            onchange="setPermissions()" 
                                                            type="checkbox" 
                                                            style="width:17px;height:17px;">
                                                            <label style="padding-left:5px;"><?= $a ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            <?php endforeach; ?>
                            </div>
                            <div id="appendedIds">
                            </div>
                            <button type="submit" class="btn btn-primary" >Atualizar Cargo</button>
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
    $(document).ready(function () {
        setPermissions();
    });

    function setAllPerm(){
        $('.permissions').prop('checked', true);
        $('#setNone').prop('checked', false);
        setPermissions();
    }

    function setNonePerm(){
        $('.permissions:checked').prop('checked', false);
        $('#setAll').prop('checked', false);
        setPermissions();
    }
</script>