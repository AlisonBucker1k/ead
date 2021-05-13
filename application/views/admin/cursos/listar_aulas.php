<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>
<style>
    tr td:nth-child(3){
        max-width:250px!important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
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
                Listagem de aulas do curso #<?=$cur[0]['id'].' - '.$cur[0]['nome']?><br/>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_aulas"><i class="fa fa-plus"></i>&nbsp;&nbsp;Cadastrar Aula</button>
                <a href="<?php echo site_url('admin/cursos'); ?>"><button class="btn btn-secondary"><i class="fa fa-undo"></i>&nbsp;&nbsp;Voltar aos cursos</button></a>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Nº</a>
                        </th>

                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Aula</a>
                        </th>
                        <th style="width:200px;">
                            <a href="javascript:void(0)"  class="sort" data-sort="js-lists-values-nome">Descrição</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Arquivos</a>
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
                            data-href="' . site_url('admin/cursos/ativar_aula/' . $ent['id']) . '"
                            data-titulo="<i class='."'fas fa-check'".'></i> Ativar Aula"
                            data-texto="Deseja realmente ativar a aula <b>'.$ent['nome'] .'</b> ?"
                            data-btn="Cancelar"
                            data-btn-acao="Ativar aula"
                            data-toggle="aviso-modal"
                            title="Ativar aula"><i class="fa fa-check"></i></button>';
                            if ($ent['ativo'] == 1){
                                $status = '<span class="badge badge-notifications badge-success">&nbsp;</span>';
                                $btns = '<button class="btn btn-outline-success btn-rounded" 
                                data-href="' . site_url('admin/cursos/desativar_aula/' . $ent['id']) . '"
                                data-titulo="<i class='."'fas fa-ban'".'></i> Desativar Aula"
                                data-texto="Deseja realmente desativar a aula <b>'.$ent['nome'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Desativar aula"
                                data-toggle="aviso-modal"
                                title="Desativar aula"><i class="fa fa-ban"></i></button>';
                            }

                            echo '<tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <select name="n_aula" class="form-control" onchange="mudaAula('."'".$ent['id']."', this".');" >';
                                    for($i=1; $i<=$totalAulas; $i++){
                                        $selected = $ent['n_aula'] == $i ? 'selected' : '';
                                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';
                                    }
                                    
                            $iframer = "";
                            if ($ent['url_video'] != ""){
                                $iframer = '<br/><iframe src="'.$ent['url_video'].'" width="100" height="75" ></iframe>';
                            }        
                            echo '       </select>
                                </div>
                            </td>
                            <td class="js-lists-values-login">
                                ' . $ent['nome'] . $iframer . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $ent['descricao'] . '
                            </td>
                            <td class="js-lists-values-email">';
                            foreach($ent['arquivos'] as $arqv){
                                echo '<span style="display:block"><a href="'.get_url_aula($cur[0]['id'], $ent['id'], $cur[0]['nome'], $arqv['arquivo']).'">'.$arqv['arquivo'].'</a></span>';
                            }
                        echo  '</td>
                            <td class="js-lists-values-telefone">
                                ' . $status . '
                            </td>
                            <td>
                                <a href="javascript:editarAula('."'".$ent['id']."'".')">
                                    <button class="btn btn-outline-info btn-rounded" title="Editar aula"><i class="fas fa-pencil-alt"></i></button>
                                </a>
                                '.$btns.'
                                <button class="btn btn-outline-accent btn-rounded" 
                                data-href="' . site_url('admin/cursos/remover_aula/' . $ent['id']) . '"
                                data-titulo="<i class='."'fas fa-trash'".'></i> Remover aula"
                                data-texto="Deseja realmente remover a aula <b>'.$ent['nome'] .'</b> ?"
                                data-btn="Cancelar"
                                data-btn-acao="Remover aula"
                                data-toggle="aviso-modal"
                                title="Remover aula"><i class="fa fa-trash"></i></button><br/>
                            </td>
                        </tr>';
                        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>