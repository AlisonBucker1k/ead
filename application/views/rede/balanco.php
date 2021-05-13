<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>
<style>
    span{
        font-size:.9rem;
    }
</style>
<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Balanço <?php if (isset($data_inicio) && isset($data_fim)){ echo 'de '.$data_inicio.' à '.$data_fim; } ?></h5>
                        <div class="table-responsive">
                            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Tipo</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Descrição</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Data</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Valor</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($balanco) > 0) {
                                        $somatorio = 0;
                                        foreach ($balanco as $fat) {
                                            $financa = $fat['financa'] == 'entrada' ? '<span class="text-primary">Entrada</span>' : '<span class="text-accent">Saída</span>';
                                            $desc = $fat['tipo'] == 'residual' || $fat['tipo'] == 'carreira' ? "Ganho ".$fat['tipo'] : ucfirst($fat['tipo']);
                                            $spanval = $fat['financa'] == 'entrada' ? '<span class="text-primary">' : '<span class="text-accent">';
                                            $somatorio = $fat['financa'] == 'entrada' ? $somatorio + $fat['valor'] : $somatorio - $fat['valor'];
                                            echo '<tr>
                                            <td>
                                                ' . $financa . '
                                            </td>
                                            <td class="js-lists-values-login">
                                                ' . $desc . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['criado_em']) . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . $spanval . number_format($fat['valor'], 2, ',', '') . '</span>
                                            </td>
                                        </tr>';
                                        }

                                        $spanend = $somatorio > 0 ? '<span class="text-primary">' : '<span class="text-accent">';
                                        echo '<tr>
                                            <td colspan="3" style="text-transform: uppercase;
                                            font-family: Exo\ 2,Helvetica Neue,Arial,sans-serif;
                                            font-weight: 600;
                                            letter-spacing: 2px;text-align:right;">Total: </td>
                                            <td>' . $spanend . '<b>'.number_format($somatorio, 2, ',', '') . '</b></span></td>
                                        </tr>';
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhuma entrada encontrada!</td></tr>';
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