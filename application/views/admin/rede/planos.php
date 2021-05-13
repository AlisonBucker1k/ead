<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Listagem de planos da rede<br/>
                <button type="button" data-toggle="modal" data-target="#cadastrar_plano_rede" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Cadastrar Novo</button>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Nome</a>
                        </th>
                        <th>Descrição</th>
                        <th>Serviços</th>
                        <th>Valor Mensal</th>
                        <th>Opcoes</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php foreach ($planos as $ent) {
                        $adcionados = explode(',', $ent['servicos']);
                        $servicesTxt = "";
                            foreach($servicos as $s):
                                foreach($adcionados as $add){
                                    if ($add == $s['id']){
                                        $servicesTxt .= $servicesTxt != "" ? "<br/>" : "";

                                        $servicesTxt .= '<button type="button" onclick="showServico('."'".$s['id']."'".')" class="btn btn-light btn-block" style="justify-content: flex-start;"><i class="fa fa-search mr-3"></i> '.$s['nome'].'</button>';
                                    }
                                }
                            endforeach;
                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <strong class="js-lists-values-nome pl-2" style="line-height:40px">#' . $ent['id'] . '</strong>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['nome'] . '
                            </td>
                            <td class="js-lists-values-login" style="max-width:300px;text-overflow: ellipsis;overflow-x: hidden;">
                                ' . nl2br($ent['descricao']) . '
                            </td>
                            <td class="js-lists-values-login" style="max-width:300px;text-overflow: ellipsis;overflow-x: hidden;">
                                ' . $servicesTxt . '
                            </td>
                            <td class="js-lists-values-login">
                                R$ ' . number_format($ent['valor'], 2, ',', '') . '
                            </td>
                            <td>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#editar_plano_rede'.$ent['id'].'">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar plano"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/planos/remove/' . $ent['id']) . '"
                                data-titulo="<i class='."'fa fa-trash'".'></i> Remover plano"
                                data-texto="Deseja realmente remover o plano <b>'.$ent['nome'].'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover plano"
                                data-toggle="aviso-modal"
                                title="Remover plano"><i class="fa fa-trash"></i></button>
                                
                            </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>