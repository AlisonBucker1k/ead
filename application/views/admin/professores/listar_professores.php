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
                Listagem de professores
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-login">Login</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-email">Email</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-telefone">Telefone</a>
                        </th>
                        <th>Status</th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($usuarios as $ent) {
                            $badge = $ent['ativo'] == 1 ? '<span class="badge badge-notifications badge-success">&nbsp;</span>' : '<span class="badge badge-notifications badge-accent">&nbsp;</span>';
                            $badge = $ent['bloqueado'] == 1 ? '<span class="badge badge-notifications badge-accent">&nbsp;</span>' : $badge;
                            
                            $btnblock = '<button class="btn btn-outline-dark btn-rounded" 
                            data-href="' . site_url('admin/professor/bloquear/' . $ent['id']) . '"
                            data-titulo="<i class='."'fa fa-ban'".'></i> Bloquear professor"
                            data-texto="Deseja realmente bloquear o professor <b>'.$ent['login'] .'</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Bloquear professor"
                            data-toggle="aviso-modal"
                            title="Bloquear professor"><i class="fa fa-ban"></i></button>';

                            if($ent['bloqueado'] == 1){
                                $btnblock = '<button class="btn btn-outline-dark btn-rounded" 
                                data-href="' . site_url('admin/professor/desbloquear/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-undo'".'></i> Desbloquear professor"
                                data-texto="Deseja realmente desbloquear o professor <b>'.$ent['login'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Desbloquear professor"
                                data-toggle="aviso-modal"
                                title="Desbloquear professor"><i class="fa fa-undo"></i></button>';
                            }

                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <span class="avatar avatar-sm">
                                        <img src="' . returnPath2($ent['foto'], 'professor', $ent['id'], $ent['login']) . '" class="avatar-title rounded-circle img-fluid bg-primary" alt="perfil" />
                                    </span>
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">' . formataNome($ent['nome']) . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['login'] . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['email'] . '
                            </td>
                            <td class="js-lists-values-telefone">
                                ' . $ent['telefone'] . '
                            </td>
                            <td>
                                ' . $badge . '
                            </td>
                            <td>';
                            if (buscaPermissao('professor', 'editar')) {
                                echo '<a href="' . site_url('admin/professor/editar/' . $ent['id'] . '-' . rawurlencode($ent['login'])) . '">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar professor"><i class="fa fa-pencil-alt"></i></button>
                                </a>'.$btnblock;
                            }
                            if (buscaPermissao('professor', 'remover')) {
                                echo '<button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/professor/remover/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-trash'".'></i> Remover professor"
                                data-texto="Deseja realmente remover o professor <b>'.$ent['login'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover professor"
                                data-toggle="aviso-modal"
                                title="Remover professor"><i class="fa fa-trash"></i></button>';
                            }
                        echo '   </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>