<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ativar Usuários</h5>
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Usuário</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Email</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Cadastro</a>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($usuarios) > 0) {
                                        foreach ($usuarios as $fat) {
                                            $btns = '<a class="dropdown-item" 
                                                href="javascript:void(0);"
                                                    data-href="' . site_url('admin/rede/ativar_rede/' . $fat['id']) . '"
                                                    data-titulo="<i class=' . "'fas fa-check'" . '></i> Inserir na rede"
                                                    data-texto="Deseja realmente inserir o usuário <b>' . $fat['login'] . '</b> na rede? <small>O usuário será inserido na rede no próximo lugar disponível!</small>"
                                                    data-btn="Cancelar"
                                                    data-btn-acao="Inserir usuário"
                                                    data-toggle="aviso-modal"
                                                    title="Inserir usuário na rede"
                                                href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;Inserir na rede</a>';
                                            echo '<tr>
                                            <td>
                                                #' . $fat['id'] . '
                                            </td>
                                            <td class="js-lists-values-login">
                                                ' . $fat['login'] . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . $fat['email'] . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['criado_em']) . '
                                            </td>
                                            <td>
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>
                                                <div class="dropdown-menu">
                                                    ' . $btns . '
                                                </div>
                                            </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhum usuário encontrado!</td></tr>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>