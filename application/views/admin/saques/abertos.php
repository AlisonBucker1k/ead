<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pedidos de saque em aberto</h5>
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
                                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Data</a>
                                        </th>
                                        <th>
                                            Pagamento
                                        </th>
                                        <th>
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
                                                <span class="badge badge-accent">' . $fat['status'] . '</span>
                                            </td>
                                            <td class="js-lists-values-email">
                                                ' . formataDataBL($fat['criado_em']) . '
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                        data-href="javascript:void(0)"
                                                        data-titulo="<i class=' . "'fas fa-search'" . '></i> Dados de pagamento"
                                                        data-texto="'.nl2br($fat['dados_pagamento']).'"
                                                        data-btn="Cancelar"
                                                        data-btn-acao=""
                                                        data-toggle="aviso-modal"
                                                        title="Dados de pagamento" >
                                                    <button type="button" class="btn btn-light" ><i class="fa fa-search"></i>&nbsp;&nbsp;Visualizar</button>
                                                </a>
                                            </td>
                                            <td>';
                                            if (buscaPermissao('saque', 'administrar')) {
                                                echo '<button type="button" 
                                                class="btn btn-primary 
                                                dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-expanded="false">Opções</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" 
                                                    href="javascript:concluir_saque('."'".$fat['login']."', '".$fat['cpf']."', '".$fat['email']."', '".number_format($fat['valor'], 2, ',', '')."', '".$fat['id']."'".')">
                                                        <i class="fas fa-check"></i>&nbsp;Definir como concluído
                                                    </a>
                                                    <a class="dropdown-item" 
                                                    href="javascript:rejeitar_saque('."'".$fat['login']."', '".$fat['cpf']."', '".$fat['email']."', '".number_format($fat['valor'], 2, ',', '')."', '".$fat['id']."'".')">
                                                        <i class="fas fa-ban"></i>&nbsp;Estornar e excluir
                                                    </a>
                                                </div>
                                                </button>';
                                            } 
                                        echo '   </td>
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