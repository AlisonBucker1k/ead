<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Listagem de cargos
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Nome</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Criado Em</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Última Atualização</a>
                        </th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($cargos as $ent) {
                            echo '<tr>
                            <td>
                                ' . $ent['id'] . '
                            </td>
                            <td>
                                ' . $ent['nome'] . '
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['criado_em'] . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['ultima_att'] . '
                            </td>
                            <td>';
                            if (buscaPermissao('admin', 'editar')) {
                                echo '<a href="' . site_url('admin/administradores/editar_cargo/' . $ent['id']) . '" title="Editar cargo">
                                    <button class="btn btn-outline-info btn-rounded"><i class="fa fa-pencil-alt"></i></button>
                                </a>';
                            }
                            if (buscaPermissao('admin', 'remover')) {
                                echo '<button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/administradores/remove_cargo/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-trash'".'></i> Remover cargo"
                                data-texto="Deseja realmente remover o cargo <b>'.$ent['nome'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover cargo"
                                data-toggle="aviso-modal"
                                title="Remover cargo"><i class="fa fa-trash"></i></button>';
                            } 
                            echo '</td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>