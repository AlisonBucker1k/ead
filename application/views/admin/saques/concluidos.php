<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<style>
                    tr>td:nth-child(7), tr>td:nth-child(7) a, tr>td:nth-child(7) span{
                        max-width: 150px;
                        white-space : nowrap;
                        overflow : hidden;
                        text-overflow : ellipsis;
                    }
                </style>
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
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Aluno</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Valor</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Status</a>
                                        </th>
                                        <th>
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">DT. Conclusão</a>
                                        </th>
                                        <th>
                                            + Detalhes
                                        </th>
                                        <th>
                                            Comprovante
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
                                            <td>
                                                <a href="javascript:void(0);"
                                                    data-href="javascript:void(0)"
                                                    data-titulo="<i class=' . "'fas fa-user'" . '></i> Usuário"
                                                    data-texto="<b>ID: </b>'.$fat['id_aluno'].'<br/>
                                                    <b>Login: </b>'.$fat['login'].'<br/>
                                                    <b>CPF: </b>'.$fat['cpf'].'<br/>
                                                    <b>Email: </b>'.$fat['email'].'<br/>
                                                    <b>Telefone: </b>'.$fat['telefone'].'"
                                                    data-btn="Cancelar"
                                                    data-btn-acao=""
                                                    data-toggle="aviso-modal"
                                                    title="Dados do usuário" >
                                                    <button type="button" class="btn btn-light" ><i class="fa fa-search"></i></button>
                                                </a>
                                            </td>
                                            <td class="js-lists-values-login">
                                                ' . number_format($fat['valor'], 2, ',', '') . '
                                            </td>
                                            <td class="js-lists-values-email">
                                                <span class="badge badge-success">' . $fat['status'] . '</span>
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
                                                        title="Mais detalhes" >
                                                    <button type="button" class="btn btn-light" ><i class="fa fa-search"></i>&nbsp;&nbsp;Visualizar</button>
                                                </a>
                                            </td>
                                            <td style="max-width:100px;">
                                                '.$hrefsaque.'
                                            </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhum saque em aberto encontrado!</td></tr>';
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
<script>
    function concluir_saque(login, cpf, email, valor, id){
        var modal = `<div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titulo-modal-aviso"><i class="fa fa-check"></i> Definir saque como concluído</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?php echo site_url('admin/saques/aceitar_saque'); ?>/${id}" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="alert alert-info" role="alert">
                                    Concluído o saque do usuário <b>${login}</b><br/>CPF: <b>${cpf}</b><br/>Email: <b>${email}</b><br/>Valor de: R$ ${valor}
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Comprovante do saque:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="comprovante" type="file" class="form-control" placeholder="Comprovante">
                                        <label class="custom-file-label" for="thumb">Escolher arquivo</label>
                                    </div>
                                    <small class="text-secondary">Caso não deseje enviar um comprovante, deixe em branco</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;Concluir saque</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>`;
        if ($('#modal-aviso').length) {
            $('#modal-aviso').remove();
        }
        $('body').append(modal);
        $('#modal-aviso').modal('show');
    }

    function rejeitar_saque(login, cpf, email, valor, id){
        var modal = `<div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog" aria-labelledby="titulo-modal-aviso" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titulo-modal-aviso"><i class="fa fa-trash"></i> Estornar e excluir saque</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?php echo site_url('admin/saques/estornar_saque'); ?>/${id}" >
                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert">
                                    Estornando e excluindo o saque do usuário <b>${login}</b><br/>CPF: <b>${cpf}</b><br/>Email: <b>${email}</b><br/>Valor de: R$ ${valor}
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">Motivo do estorno:</label>
                                    <textarea name="motivo" class="form-control" rows="5" placeholder="Digite aqui o motivo do estorno, o aluno receberá um email e uma notificação com este conteúdo."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i>&nbsp;&nbsp;Estornar saque</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>`;
        if ($('#modal-aviso').length) {
            $('#modal-aviso').remove();
        }
        $('body').append(modal);
        $('#modal-aviso').modal('show');
    }
</script>