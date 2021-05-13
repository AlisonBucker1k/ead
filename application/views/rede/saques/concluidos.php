<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pedidos de saque concluídos</h5>
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
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Comprovante</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Data da conclusão</a>
                                        </th>
                                        <th>
                                            Mais Detalhes
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($pedidos) > 0) {
                                        foreach ($pedidos as $fat) {
                                            $hrefsaque = '<button type="button" disabled class="btn btn-light"><i class="fa fa-download"></i>&nbsp;&nbsp;N/A</button>';
                                            if ($fat['comprovante']){
                                                $hrefsaque = '<a href="'.site_url('uploads/'.$fat['comprovante']).'" download>
                                                    <button type="button" class="btn btn-light"><i class="fa fa-download"></i>&nbsp;&nbsp;Baixar</button>
                                                </a>';
                                            }
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
                                                '.$hrefsaque.'
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['pago_em']) . '
                                            </td>
                                            <td>
                                            <a href="javascript:void(0);"
                                                    data-href="javascript:void(0)"
                                                    data-titulo="<i class=' . "'fas fa-search'" . '></i> Mais detalhes"
                                                    data-texto="<b>Criado em: </b>' . formataData($fat['criado_em']) . '<br/><b>Dados do pagamento :</b> '.nl2br($fat['dados_pagamento']).'"
                                                    data-btn="Cancelar"
                                                    data-btn-acao=""
                                                    data-toggle="aviso-modal"
                                                    title="Mais detalhes"
                                                    >
                                                <button type="button" class="btn btn-primary" ><i class="fa fa-search"></i>&nbsp;&nbsp;Mais detalhes</button>
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