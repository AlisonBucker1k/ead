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
                Listagem de provas do curso #<?=$cur[0]['id'].' - '.$cur[0]['nome']?><br/>
                <a href="<?php echo site_url('admin/cursos/provas/cadastrar/'.$cur[0]['id'].'-'.$cur[0]['nome']); ?>">
                    <button type="button" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp;&nbsp;Cadastrar prova</button>
                </a>
                <a href="<?php echo site_url('admin/cursos'); ?>">
                    <button class="btn btn-secondary"><i class="fa fa-undo"></i>&nbsp;&nbsp;Voltar aos cursos</button>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Nome</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Nº de questões</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">NT Máxima</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Status</a>
                        </th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <style>
                    tr>td:first-child{
                        min-width:80px;
                    }
                    tr>td:nth-child(4), tr>td:nth-child(4) a, tr>td:nth-child(4) span{
                        max-width: 150px;
                        white-space : nowrap;
                        overflow : hidden;
                        text-overflow : ellipsis;
                    }
                </style>
                <tbody class="list" id="search">
                    <?php $totalAulas = count($usuarios);
                        foreach ($usuarios as $ent) {
                            $status = '<span class="badge badge-notifications badge-accent">&nbsp;</span>';
                            $btns = '<button class="btn btn-outline-success btn-rounded" 
                            data-href="' . site_url('admin/cursos/provas/ativar/' . $ent['id']) . '"
                            data-titulo="<i class='."'fas fa-check'".'></i> Ativar prova"
                            data-texto="Deseja realmente ativar a prova <b>'.$ent['nome'] .'</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Ativar prova"
                            data-toggle="aviso-modal"
                            title="Ativar prova"><i class="fa fa-check"></i></button>';
                            if ($ent['ativo'] == 1){
                                $status = '<span class="badge badge-notifications badge-success">&nbsp;</span>';
                                $btns = '<button class="btn btn-outline-success btn-rounded" 
                                data-href="' . site_url('admin/cursos/provas/desativar/' . $ent['id']) . '"
                                data-titulo="<i class='."'fas fa-ban'".'></i> Desativar prova"
                                data-texto="Deseja realmente desativar a prova <b>'.$ent['nome'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Desativar prova"
                                data-toggle="aviso-modal"
                                title="Desativar prova"><i class="fa fa-ban"></i></button>';
                            }

                            echo '<tr>
                            <td class="js-lists-values-login">
                                ' . $ent['nome'] . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['n_provas'] . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['nota_maxima'] . '
                            </td>
                            <td class="js-lists-values-telefone">
                                ' . $status . '
                            </td>
                            <td>
                                <a href="' . site_url('admin/cursos/provas/editar/' . $ent['id']) . '">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar prova"><i class="fas fa-pencil-alt"></i></button>
                                </a>
                                '.$btns.'
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/cursos/provas/remover/' . $ent['id']) . '"
                                data-titulo="<i class='."'fas fa-trash'".'></i> Remover prova"
                                data-texto="Deseja realmente remover a prova <b>'.$ent['nome'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover prova"
                                data-toggle="aviso-modal"
                                title="Remover prova"><i class="fa fa-trash"></i></button><br/>
                            </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>