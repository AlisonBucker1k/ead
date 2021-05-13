<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<style>
    
</style>

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
                Listagem de cursos
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">

        <div class="table-responsive">
            <table class="table mb-0 thead-border-top-0 table-nowrap data-tables">
                <thead>
                    <tr>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>

                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Curso</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Professor</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-email">Tipo</a>
                        </th>
                        <th>P. Venda</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($usuarios as $ent) {
                        $status = '<span class="badge badge-secondary" style="font-size: .7rem;">' . ucfirst($ent['status']) . '</span>';
                        $btns = '<a class="dropdown-item" 
                            href="javascript:void(0);"
                            data-href="' . site_url('admin/cursos/ativar/' . $ent['id']) . '"
                            data-titulo="<i class=' . "'fas fa-check'" . '></i> Ativar Curso"
                            data-texto="Deseja realmente ativar o curso <b>' . $ent['nome'] . '</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Ativar curso"
                            data-toggle="aviso-modal"
                            title="Ativar curso"><i class="fa fa-check"></i>&nbsp;Ativar curso</a>';
                        if ($ent['status'] == 'ativo') {
                            $status = '<span class="badge badge-success" style="font-size: .7rem;">' . ucfirst($ent['status']) . '</span>';
                            $btns = '<a class="dropdown-item" 
                                href="javascript:void(0);"
                                data-href="' . site_url('admin/cursos/desativar/' . $ent['id']) . '"
                                data-titulo="<i class=' . "'fas fa-ban'" . '></i> Desativar Curso"
                                data-texto="Deseja realmente desativar o curso <b>' . $ent['nome'] . '</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Desativar curso"
                                data-toggle="aviso-modal"
                                title="Ativar curso"><i class="fa fa-ban"></i>&nbsp;Desativar Curso</a>';
                        } else if ($ent['status'] == 'inativo') {
                            $status = '<span class="badge badge-accent" style="font-size: .7rem;">' . ucfirst($ent['status']) . '</span>';
                        }

                        echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">#' . $ent['id'] . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['nome'] . '<br/>' . $status . '<br/><small class="text-muted">' . $ent['modalidade'] . '</small>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['professor'] . '
                            </td>
                            <td class="js-lists-values-telefone">
                                ' . $ent['tipo'] . '
                            </td>
                            <td>
                                R$ ' . number_format($ent['venda'], 2, ',', '') . '
                            </td>
                            <td>';
                            if (buscaPermissao('curso', 'editar')) {
                                echo '<div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . site_url('admin/cursos/editar/' . $ent['id'] . '-' . rawurlencode($ent['nome'])) . '">
                                        <i class="fas fa-pencil-alt"></i>&nbsp;Editar
                                    </a>
                                    ' . $btns;
                                
                                if (buscaPermissao('curso', 'remover')) {
                                    '<a class="dropdown-item" 
                                    href="javascript:void(0);"
                                        data-href="' . site_url('admin/cursos/remover/' . $ent['id']) . '"
                                        data-titulo="<i class=' . "'fas fa-trash'" . '></i> Remover curso"
                                        data-texto="Deseja realmente remover o curso <b>' . $ent['nome'] . '</b> ?"
                                        data-btn="Cancelar"
                                        data-btn-acao="Remover curso"
                                        data-toggle="aviso-modal"
                                        title="Remover curso"
                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Remover</a>';
                                }
                                echo '<div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="' . site_url('admin/cursos/aulas/' . $ent['id'] . '-' . rawurlencode($ent['nome'])) . '">
                                        <i class="fas fa-graduation-cap"></i>&nbsp;Editar aulas
                                    </a>
                                    <a class="dropdown-item" href="' . site_url('admin/cursos/provas/' . $ent['id'] . '-' . rawurlencode($ent['nome'])) . '">
                                    <i class="fas fa-id-card-alt"></i>&nbsp;Editar provas
                                    </a>
                                    <a class="dropdown-item" href="' . site_url('admin/cursos/tarefas/' . $ent['id'] . '-' . rawurlencode($ent['nome'])) . '">
                                        <i class="far fa-id-card"></i>&nbsp;Editar tarefas
                                    </a>
                                </div>
                            </div>';
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