<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Unilevel</h5>
                        <div class="row">
                            <?php for ($i=1; $i<=10; $i++){
                                $class = $selected == $i ? "btn-primary" : "btn-light";
                                if (!isset($user)){
                                    echo '<div class="col" style="padding:0px!important;text-align:center;">
                                        <a href="'.site_url('admin/rede/unilevel/'.$i).'">
                                            <button type="button" class="btn ' . $class . '">'.$i.'º<br/>Nível</button>
                                        </a>
                                    </div>';
                                } else {
                                    echo '<div class="col" style="padding:0px!important;text-align:center;">
                                        <a href="'.site_url('admin/rede/unilevel_usuario/'.$i.'/'.$user).'">
                                            <button type="button" class="btn ' . $class . '">'.$i.'º<br/>Nível</button>
                                        </a>
                                    </div>';
                                }
                            } ?>
                        </div>
                        <hr>
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
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="search">
                                    <?php if (count($unilevel) > 0) {
                                        foreach ($unilevel as $fat) {
                                            $btns = '';
                                            if ($fat['ativo'] == 0){
                                                $btns .= '<a class="dropdown-item" 
                                                href="javascript:void(0);"
                                                    data-href="' . site_url('admin/rede/ativar/' . $fat['id']) . '"
                                                    data-titulo="<i class=' . "'fas fa-check'" . '></i> Ativar usuário"
                                                    data-texto="Deseja realmente ativar o usuário <b>' . $ent['login'] . '</b> ? <small>O usuário passará a poder logar na rede novamente!</small>"
                                                    data-btn="Cancelar"
                                                    data-btn-acao="Ativar usuário"
                                                    data-toggle="aviso-modal"
                                                    title="Ativar usuário"
                                                href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;Ativar</a>';
                                            } else {
                                                $btns .= '<a class="dropdown-item" 
                                                href="javascript:void(0);"
                                                    data-href="' . site_url('admin/rede/desativar/' . $fat['id']) . '"
                                                    data-titulo="<i class=' . "'fas fa-undo'" . '></i> Destivar usuário"
                                                    data-texto="Deseja realmente desativar o usuário <b>' . $fat['login'] . '</b> ? <small>O usuário não poderá mais logar na rede / EAD!</small>"
                                                    data-btn="Cancelar"
                                                    data-btn-acao="Desativar usuário"
                                                    data-toggle="aviso-modal"
                                                    title="Desativar usuário"
                                                href="javascript:void(0);"><i class="fa fa-undo"></i>&nbsp;Desativar</a>';
                                            }
                                            if ($fat['bloqueado'] == 0){
                                                $btns .= '<a class="dropdown-item" 
                                                href="javascript:void(0);"
                                                    data-href="' . site_url('admin/alunos/ban/' . $fat['id'].'/1') . '"
                                                    data-titulo="<i class=' . "'fas fa-ban'" . '></i> Bloquear aluno"
                                                    data-texto="Deseja realmente bloquear o usuário <b>' . $fat['login'] . '</b> ? <small>O usuário não poderá mais logar no EAD nem pedir saques!</small>"
                                                    data-btn="Cancelar"
                                                    data-btn-acao="Bloquear usuário"
                                                    data-toggle="aviso-modal"
                                                    title="Bloquear usuário"
                                                href="javascript:void(0);"><i class="fa fa-ban"></i>&nbsp;Bloquear</a>';
                                            } else {
                                                $btns .= '<a class="dropdown-item" 
                                                href="javascript:void(0);"
                                                    data-href="' . site_url('admin/alunos/unban/' . $fat['id'].'/1') . '"
                                                    data-titulo="<i class=' . "'fas fa-unban'" . '></i> Desbloquear aluno"
                                                    data-texto="Deseja realmente desbloquear o usuário <b>' . $fat['login'] . '</b> ? <small>O usuário poderá logar no EAD e pedir saques!</small>"
                                                    data-btn="Cancelar"
                                                    data-btn-acao="Desbloquear usuário"
                                                    data-toggle="aviso-modal"
                                                    title="Bloquear usuário"
                                                href="javascript:void(0);"><i class="fa fa-unban"></i>&nbsp;Desbloquear</a>';
                                            }
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
                                            <td>';
                                            if (buscaPermissao('rede', 'visualizar')) {
                                                echo '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>
                                                <div class="dropdown-menu">';
                                                    if (buscaPermissao('rede', 'administrar')) {
                                                    echo '<a class="dropdown-item" href="' . site_url('admin/alunos/editar/' . $fat['id']) . '">
                                                            <i class="fas fa-pencil-alt"></i>&nbsp;Editar
                                                        </a>
                                                        ' . $btns . '
                                                        <div class="dropdown-divider"></div>';
                                                    }
                                                    echo '<a class="dropdown-item" href="' . site_url('admin/rede/unilevel_usuario/1/' . $fat['id']) . '">
                                                        <i class="fas fa-list"></i>&nbsp;Unilevel
                                                    </a>
                                                    <a class="dropdown-item" href="' . site_url('admin/rede/visualizar/' . $fat['id_niveis']) . '">
                                                        <i class="fas fa-network-wired"></i>&nbsp;Visualizar Rede
                                                    </a>
                                                </div>
                                                </button>';
                                            }
                                            
                                        echo '    </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align:center;">Nenhum usuário encontrado!</td></tr>';
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