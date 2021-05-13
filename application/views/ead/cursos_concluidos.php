<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/ead/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Meus cursos concluídos
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">

        <div class="table-responsive" >
            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                <thead>
                    <tr>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Curso</a>
                        </th>
                        <th>Média</th>
                        <th>Inicio</th>
                        <th>Conclusão</th>
                        <th>Certificado</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php if (count($aprovacoes) > 0){
                        foreach ($aprovacoes as $ent): ?>
                            <tr>
                                <td class="js-lists-values-login">
                                    <?php echo $ent['curso']['nome']; ?>
                                </td>

                                <td class="js-lists-values-email text-primary">
                                    <?php echo $ent['media_final']; ?>
                                </td>
                                
                                <td>
                                    <?php echo formataData($ent['data_ini'], false, false); ?>
                                </td>

                                <td>
                                    <?php echo formataData($ent['data'], false, false); ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('ead/certificado_de_conclusao/'.$ent['codigo']); ?>" target="_blank">
                                        <button type="button" class="btn btn-primary" ><i class="fa fa-print mr-2"></i> Imprimir</button>
                                        </a>
                                </td>
                            </tr>
                    <?php  endforeach;
                     } else {
                        echo '<tr>
                            <td colspan="6" class="text-center">Nenhum curso foi concluído até o momento.</td>
                        </tr>';
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include_once(ROOT_PATH . '/assets/includes/ead/footer.php'); ?>