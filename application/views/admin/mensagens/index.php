<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <!-- <a href="pricing.html"
                class="progression-bar__item progression-bar__item--complete">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon">done</i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Pricing</span>
                </span>
            </a>
            <a href="signup.html"
                class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                </span>
            </a>
            <a href="signup-payment.html"
                class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Payment details</span>
                </span>
            </a> -->

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Listagem de mensagens AVA<br/>
                <a href="<?php echo site_url('admin/mensagens/cadastrar'); ?>">
                    <button type="button" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp;&nbsp;Cadastrar nova</button>
                </a>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">

        <div class="table-responsive" >
            <div class="alert alert-info">
                Caso mais de 1 mensagem esteja ativa ao mesmo tempo, será mostrado APENAS uma delas aleatóriamente no login do aluno.
            </div>
            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                <thead>
                    <tr>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Título</a>
                        </th>
                        <th>Inserção</th>
                        <th>Última Atualização</th>
                        <th>Status</th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($mensagens as $ent) {
                            $btnAtiva = '<a href="' . site_url('admin/mensagens/activate/' . $ent['id']) . '">
                                <button class="btn btn-outline-success btn-rounded" title="Ativar mensagem"><i class="fa fa-check"></i></button>
                            </a>';
                            if ($ent['ativa'] == 1) {
                                $btnAtiva = '<a href="' . site_url('admin/mensagens/deactivate') . '">
                                    <button class="btn btn-outline-danger btn-rounded" title="Desativar mensagem" ><i class="fa fa-ban"></i></button>
                                </a>';
                            }
                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">#' . $ent['id'] . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['titulo'] . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['criado_em'] . '
                            </td>
                            <td class="js-lists-values-telefone">
                                ' . $ent['ultima_att'] . '
                            </td>
                            <td class="js-lists-values-telefone">
                                ' . generate_badge($ent['ativa'], "Ativa") . '
                            </td>
                            <td>';
                            if (buscaPermissao('mensagens', 'editar')) {
                                echo '<a href="' . site_url('admin/mensagens/editar/' . $ent['id']) . '">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar mensagem"><i class="fa fa-pencil-alt"></i></button>
                                </a>'.$btnAtiva;
                            } 
                            if (buscaPermissao('professor', 'remover')) {
                                    echo '<button class="btn btn-outline-accent btn-rounded" 
                                    data-href="' . site_url('admin/mensagens/remover/' . $ent['id']) . '"
                                    data-titulo="<i class='."'fa fa-trash'".'></i> Remover modalidade"
                                    data-texto="Deseja realmente remover a mensagem <b>' . $ent['titulo'] . '</b> ?"
                                    data-btn="Cancelar"
                                    data-btn-acao="Remover mensagem"
                                    data-toggle="aviso-modal"
                                    title="Remover mensagem"><i class="fa fa-trash"></i></button>';
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