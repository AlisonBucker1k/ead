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
                Configurações da rede
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php if ($indice == 'geral') {
                                        echo 'active';
                                    } ?>" id="geral-tab" data-toggle="tab" href="#geral" role="tab" aria-controls="geral" aria-selected="true">Geral</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($indice == 'fidelidade') {
                                        echo 'active';
                                    } ?>" id="fidelidade-tab" data-toggle="tab" href="#fidelidade" role="fidelidade" aria-controls="fidelidade" aria-selected="false">Plano Fidelidade</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($indice == 'carreira') {
                                        echo 'active';
                                    } ?>" id="carreira-tab" data-toggle="tab" href="#carreira" role="tab" aria-controls="carreira" aria-selected="false">Plano Carreira</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?php if ($indice == 'geral') {
                                            echo 'show active';
                                        } ?>" id="geral" role="tabpanel" aria-labelledby="geral-tab">
                <form action="<?php echo base_url(); ?>admin/rede/update" enctype="multipart/form-data" method="POST">
                    <h4 class="mt-4">Usuários</h4>
                    <div class="form-group">
                        <label class="form-label" for="name">Máximo de tempo inativo: *</label>
                        <div class="input-group">
                            <input name="max_inativo" id="max_inativo" value="<?php if (isset($configuracoes[0]['max_inativo'])) {
                                                                                    echo $configuracoes[0]['max_inativo'];
                                                                                } ?>" type="number" step="1" min="1" class="form-control" placeholder="X dias" aria-label="X dias" aria-describedby="max_inativo_d" required />
                            <div class="input-group-append">
                                <span class="input-group-text" id="max_inativo_d">dias</span>
                            </div>
                        </div>
                        <div class="text-secondary">
                            <small>Máximo de tempo que um usuário pode ficar inativo (fatura atrasada) em dias antes de ser removido.</small>
                        </div>
                    </div>
                    <hr>
                    <h4>Ganho Residual</h4>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Intervalo de ganho: *</label>
                                <select id="timer_residual" name="timer_residual" class="form-control">
                                    <option value="diario" <?php if (isset($configuracoes[0]['timer_residual']) && $configuracoes[0]['timer_residual'] == 'diario') {
                                                                echo 'selected';
                                                            } ?>>Diario</option>
                                    <option value="semanal" <?php if (isset($configuracoes[0]['timer_residual']) && $configuracoes[0]['timer_residual'] == 'semanal') {
                                                                echo 'selected';
                                                            } ?>>Semanal</option>
                                    <option value="mensal" <?php if (isset($configuracoes[0]['timer_residual']) && $configuracoes[0]['timer_residual'] == 'mensal') {
                                                                echo 'selected';
                                                            } ?>>Mensal</option>
                                    <option value="semestral" <?php if (isset($configuracoes[0]['timer_residual']) && $configuracoes[0]['timer_residual'] == 'semestral') {
                                                                    echo 'selected';
                                                                } ?>>Semestral</option>
                                    <option value="anual" <?php if (isset($configuracoes[0]['timer_residual']) && $configuracoes[0]['timer_residual'] == 'anual') {
                                                                echo 'selected';
                                                            } ?>>Anual</option>
                                </select>
                                <div class="text-secondary">
                                    <small>Residual a cada dia, semana, mes...</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="form-label" for="name">Dia: *</label>
                                <input name="dia_residual" id="dia_residual" value="<?php if (isset($configuracoes[0]['dia_residual'])) {
                                                                                        echo $configuracoes[0]['dia_residual'];
                                                                                    } ?>" type="number" step="1" min="1" max="28" class="form-control" placeholder="1 à 28" aria-label="1 à 28" aria-describedby="dia_residual" required />
                                <div class="text-secondary">
                                    <small>Dia selecionado</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Tipo: *</label>
                                <select id="tipo_residual" name="tipo_residual" class="form-control">
                                    <option value="fixo" <?php if (isset($configuracoes[0]['tipo_residual']) && $configuracoes[0]['tipo_residual'] == 'fixo') {
                                                                echo 'selected';
                                                            } ?>>Dia fixo no mês</option>
                                    <option value="dia" <?php if (isset($configuracoes[0]['tipo_residual']) && $configuracoes[0]['tipo_residual'] == 'dia') {
                                                            echo 'selected';
                                                        } ?>>Após N dias da compra</option>
                                </select>
                                <div class="text-secondary">
                                    <small>Pagamento todo dia fixo ou após N dias da compra.</small>
                                </div>
                            </div>

                        </div>
                    </div>



                    <hr>
                    <h4>Ganho Carreira</h4>
                    <div class="form-row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Intervalo de ganho: *</label>
                                <select id="timer_carreira" name="timer_carreira" class="form-control">
                                    <option value="diario" <?php if (isset($configuracoes[0]['timer_carreira']) && $configuracoes[0]['timer_carreira'] == 'diario') {
                                                                echo 'selected';
                                                            } ?>>Diario</option>
                                    <option value="semanal" <?php if (isset($configuracoes[0]['timer_carreira']) && $configuracoes[0]['timer_carreira'] == 'semanal') {
                                                                echo 'selected';
                                                            } ?>>Semanal</option>
                                    <option value="mensal" <?php if (isset($configuracoes[0]['timer_carreira']) && $configuracoes[0]['timer_carreira'] == 'mensal') {
                                                                echo 'selected';
                                                            } ?>>Mensal</option>
                                    <option value="semestral" <?php if (isset($configuracoes[0]['timer_carreira']) && $configuracoes[0]['timer_carreira'] == 'semestral') {
                                                                    echo 'selected';
                                                                } ?>>Semestral</option>
                                    <option value="anual" <?php if (isset($configuracoes[0]['timer_carreira']) && $configuracoes[0]['timer_carreira'] == 'anual') {
                                                                echo 'selected';
                                                            } ?>>Anual</option>
                                </select>
                                <div class="text-secondary">
                                    <small>Carreira a cada dia, semana, mes...</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="form-label" for="name">Dia: *</label>
                                <input name="dia_carreira" id="dia_carreira" value="<?php if (isset($configuracoes[0]['dia_carreira'])) {
                                                                                        echo $configuracoes[0]['dia_carreira'];
                                                                                    } ?>" type="number" step="1" min="1" max="28" class="form-control" placeholder="1 à 28" aria-label="1 à 28" aria-describedby="dia_carreira" required />
                                <div class="text-secondary">
                                    <small>Dia selecionado</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Tipo: *</label>
                                <select id="tipo_carreira" name="tipo_carreira" class="form-control">
                                    <option value="fixo" <?php if (isset($configuracoes[0]['tipo_carreira']) && $configuracoes[0]['tipo_carreira'] == 'fixo') {
                                                                echo 'selected';
                                                            } ?>>Dia fixo no mês</option>
                                    <option value="dia" <?php if (isset($configuracoes[0]['tipo_carreira']) && $configuracoes[0]['tipo_carreira'] == 'dia') {
                                                            echo 'selected';
                                                        } ?>>Após N dias da compra</option>
                                </select>
                                <div class="text-secondary">
                                    <small>Pagamento todo dia fixo ou após N dias da compra.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Salvar alterações</button>
                </form>
            </div>
            <div class="tab-pane fade <?php if ($indice == 'fidelidade') {
                                            echo 'show active';
                                        } ?>" id="fidelidade" role="tabpanel" aria-labelledby="fidelidade-tab">
                <form action="<?php echo base_url(); ?>admin/residual/update" enctype="multipart/form-data" method="POST">
                    <h4 class="mt-4">Residual por nível</h4>
                    <div class="form-row">
                        <?php for ($i = 1; $i <= 10; $i++) {
                            $value = isset($fidelidade[0]['n' . $i]) ? $fidelidade[0]['n' . $i] : 0;
                            echo '<div class="col col-xs-2">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Nível ' . $i . ' *</label>
                                        <input name="n' . $i . '" id="n' . $i . '" value="' . $value . '" type="number" step="0.01" min="0" class="form-control" placeholder="0.01" style="min-width:60px" required />
                                    </div>   
                                </div>';
                        } ?>
                    </div>
                    <button class="btn btn-primary">Salvar alterações</button>
                    <hr>
                    <h4>Regras Fidelidade <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addRegraFidelidade"><i class="fa fa-plus"></i></button></h4>
                    <div id="regrasFidelidade" class="row">
                        <?php foreach ($regras_fidelidade as $regra) {
                            echo '<div class="col"><div class="card" style="min-width: 18rem;">
                                        <div class="card-body">
                                        <h5 class="card-title">#' . $regra['id'] . '</h5>
                                        <p class="card-text"><b>Nº de ativos:</b> ' . $regra['n_ativos'] . '<br/><b>Ganho: </b> ' . $regra['ganho_pct'] . '%</p>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editar_regra' . $regra['id'] . '" class="btn btn-light"><i class="fa fa-pencil-alt"></i>&nbsp;&nbsp;Editar</a>
                                        <a href="' . site_url('admin/residual/delete_regra/' . $regra['id']) . '" class="btn btn-light float-right"><i class="fa fa-trash"></i>&nbsp;&nbsp;Remover</a>
                                        </div>
                                    </div></div>';
                        } ?>
                    </div>
                    
                </form>

            </div>
            <div class="tab-pane fade <?php if ($indice == 'carreira') {
                                            echo 'show active';
                                        } ?>" id="carreira" role="tabpanel" aria-labelledby="carreira-tab">
                <h4 class="mt-4">Planos de carreira <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addPlanoCarreira"><i class="fa fa-plus"></i></button></h4>
                <div id="PlanosCarreira" class="row">
                    <div class="col">
                        <div class="card" style="min-width: 100%">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><b>ID</b></div>
                                    <div class="col"><b>Ganho</b></div>
                                    <div class="col"><b>Nº Ativos</b></div>
                                    <div class="col"><b>Nível</b></div>
                                    <div class="col"><b>Opções</b></div>
                                </div>
                                <?php foreach ($carreira as $plano) {
                                    echo '<hr><div class="row">
                                                <div class="col">#' . $plano['id'] . '</div>
                                                <div class="col">' . number_format($plano['ganho'], 2, ',', '') . '</div>
                                                <div class="col">' . $plano['ativos'] . '</div>
                                                <div class="col">' . $plano['nivel'] . '</div>
                                                <div class="col">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editar_carreira' . $plano['id'] . '" class="btn btn-light"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="' . site_url('admin/plano_carreira/remove/' . $plano['id']) . '" class="btn btn-light float-right"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>'; } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Regras plano de carreira <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#addRegraCarreira"><i class="fa fa-plus"></i></button></h4>
                <div id="regrasPlanoCarreira" class="row">
                    <?php foreach ($regras_carreira as $regra) {
                        echo '<div class="col"><div class="card" style="min-width: 18rem;">
                                        <div class="card-body">
                                        <h5 class="card-title">#' . $regra['id'] . '</h5>
                                        <p class="card-text"><b>Nº de ativos:</b> ' . $regra['n_ativos'] . '<br/><b>Ganho: </b> ' . $regra['ganho_pct'] . '%</p>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#editar_regra_carreira' . $regra['id'] . '" class="btn btn-light"><i class="fa fa-pencil-alt"></i>&nbsp;&nbsp;Editar</a>
                                        <a href="' . site_url('admin/plano_carreira/delete_regra/' . $regra['id']) . '" class="btn btn-light float-right"><i class="fa fa-trash"></i>&nbsp;&nbsp;Remover</a>
                                        </div>
                                    </div></div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>