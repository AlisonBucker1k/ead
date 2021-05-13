<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Relatório de saques <?php if (isset($data_inicio) && isset($data_fim)){ echo 'de '.$data_inicio.' à '.$data_fim; } ?></h5>
                        <div class="table-responsive">
                        <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Valor</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Status</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Data do pedido</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Data da conclusão</a>
                                        </th>
                                        <th>
                                            Dados de pagamento
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($pedidos) > 0) {
                                        foreach ($pedidos as $fat) {
                                            echo '<tr>
                                            <td>
                                                ' . $fat['id'] . '
                                            </td>
                                            <td class="js-lists-values-login">
                                                ' . number_format($fat['valor'], 2, ',', '') . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                <span class="badge badge-success">' . $fat['status'] . '</span>
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['criado_em']) . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['pago_em']) . '
                                            </td>
                                            <td>
                                            <a href="javascript:void(0);"
                                                    data-href="javascript:void(0)"
                                                    data-titulo="<i class=' . "'fas fa-search'" . '></i> Dados de pagamento"
                                                    data-texto="'.nl2br($fat['dados_pagamento']).'"
                                                    data-btn="Cancelar"
                                                    data-btn-acao=""
                                                    data-toggle="aviso-modal"
                                                    title="Dados de pagamento"
                                                    onclick="showModal(this);" >
                                                <button type="button" class="btn btn-primary" >Dados de pagamento</button>
                                            </a>
                                            </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhum saque concluído encontrado!</td></tr>';
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