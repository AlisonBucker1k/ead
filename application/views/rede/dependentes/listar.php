<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Listar Dependentes</h5>
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
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($dependentes) > 0) {
                                        foreach ($dependentes as $aln) {
                                            $fat = $aln['aluno'];
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
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhum aluno encontrado!</td></tr>';
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
<?php include_once(ROOT_PATH . '/assets/includes/rede/footer.php'); ?>