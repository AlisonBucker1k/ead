<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Listagem de perguntas frequentes <?= $tipo_txt; ?><br/>
                <a href="<?php echo site_url('admin/faq/cadastrar/'.$tipo); ?>" >
                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Cadastrar Nova</button>
                </a>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Pergunta</a>
                        </th>
                        <th>Resposta</th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($entradas as $ent) {
                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">#' . $ent['id'] . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['nome'] . '
                            </td>
                            <td class="js-lists-values-login" style="max-width:300px;text-overflow: ellipsis;overflow-x: hidden;">
                                ' . nl2br($ent['resposta']) . '
                            </td>
                            <td>
                                <a href="'.site_url('admin/faq/editar/'.$ent['id']).'">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar pergunta"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/faq/remove/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-trash'".'></i> Remover Pergunta"
                                data-texto="Deseja realmente remover a pergunta frequente <b>#'.$ent['id'].'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover Pergunta"
                                data-toggle="aviso-modal"
                                title="Remover Pergunta"><i class="fa fa-trash"></i></button>
                                
                            </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>