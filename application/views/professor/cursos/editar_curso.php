<?php include_once(ROOT_PATH . '/assets/includes/professor/header.php'); ?>
<!-- Page Content -->

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
                Edição de Curso
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url(); ?>professor/cursos/update/<?= $cur[0]['id']; ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="name">Modalidade: *</label>
                        <div class="input-group input-group-merge">
                            <select id="modalidade" name="id_modalidade" class="form-control" placeholder="Modalidade" required>
                                <?php foreach ($modalidades as $modalidade) { ?>
                                    <option value="<?= $modalidade['id']; ?>" <?php if ($modalidade['id'] == $cur[0]['id_modalidade']){ echo 'selected'; } ?> >
                                        <?= $modalidade['nome']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append">
                                <div class="btn btn-success" data-toggle="modal" data-target="#addModalidadeModal">
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input id="nome" type="text" class="form-control" placeholder="Nome do Curso" value="<?=$cur[0]['nome'];?>" name="nome" required>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col">
                            <label class="form-label" for="name">Horas: *</label>
                            <input id="duracao_hora" 
                            type="number" 
                            step="1" 
                            min="0" 
                            class="form-control" 
                            placeholder="Horas do curso" 
                            value="<?=$cur[0]['duracao_hora'];?>" 
                            name="duracao_hora" 
                            required>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name">Minutos: *</label>
                            <input id="duracao_minutos" 
                            type="number" 
                            step="1" 
                            min="0" 
                            class="form-control" 
                            placeholder="Minutos do curso" 
                            value="<?=$cur[0]['duracao_minutos'];?>" 
                            name="duracao_minutos" 
                            required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Tipo: *</label>
                        <select id="tipo" name="tipo" class="form-control" placeholder="Tipo do Curso" required>
                            <option value="livre" <?php if ($cur[0]['tipo'] == 'livre'){ echo 'selected'; } ?> >Livre</option>
                            <option value="supletivo" <?php if ($cur[0]['tipo'] == 'supletivo'){ echo 'selected'; } ?>>Supletivo</option>
                            <option value="tecnico" <?php if ($cur[0]['tipo'] == 'tecnico'){ echo 'selected'; } ?>>Técnico</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="foto">Foto de Capa: <img src="<?php echo get_url($cur[0]['id'], $cur[0]['nome'], $cur[0]['capa']); ?>" style="max-width:64px;" /></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="capa" id="capa" type="file" class="form-control" placeholder="Capa">
                            <label class="custom-file-label" for="foto">Escolher arquivo</label>
                        </div>
                        <small class="text-secondary">Não enviar nenhum arquivo manterá a foto de capa atual!</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Status: *</label>
                        <select id="status" name="status" class="form-control" placeholder="Status do Curso" required>
                            <option value="rascunho" <?php if ($cur[0]['tipo'] == 'rascunho'){ echo 'selected'; } ?> >Rascunho</option>
                            <option value="ativo" <?php if ($cur[0]['tipo'] == 'ativo'){ echo 'selected'; } ?> >Ativo</option>
                            <option value="inativo" <?php if ($cur[0]['tipo'] == 'inativo'){ echo 'selected'; } ?> >Inativo</option>
                        </select>
                        <small class="text-secondary">Rascunho e inativo não aparecem para os usuários</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar Curso</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Editar Curso</h5>
                        <div class="d-flex mb-8pt">
                            <div class="flex"><strong class="text-70"></strong></div>
                            <strong></strong>
                        </div>

                            <div class="d-flex flex-wrap align-items-start">
                                <div class="flex" style="min-width: 180px">
                                    <small class="text-100">
                                    <?php echo '<a href="' . site_url('professor/cursos/aulas/' . $cur[0]['id'] . '-' . rawurlencode($cur[0]['nome'])) . '">'; ?>
                                        <button class="btn btn-outline-primary btn-block" title="Editar aulas"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Cadastrar / Editar Aulas</button>
                                    </a>
                                    <?php echo '<a href="' . site_url('professor/cursos/provas/' . $cur[0]['id'] . '-' . rawurlencode($cur[0]['nome'])) . '">';  ?>
                                        <button class="btn btn-outline-secondary btn-block mt-4" title="Editar provas"><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;Cadastrar / Editar Provas</button>
                                    </a>
                                    <?php echo '<a href="' . site_url('professor/cursos/tarefas/' . $cur[0]['id'] . '-' . rawurlencode($cur[0]['nome'])) . '">'; ?>
                                        <button class="btn btn-outline-info btn-block mt-4" title="Editar aulas"><i class="far fa-id-card"></i>&nbsp;&nbsp;Cadastrar / Editar Tarefas</button>
                                    </a>
                                    </small>
                                </div>
                            </div>

                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                            <!-- <div class="flex"><strong class="text-70">Price</strong></div>
                            <strong>US &dollar;9 per month</strong> -->
                        </div>
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox"
                                    class="custom-control-input"
                                    checked
                                    id="topic-all">
                            <label class="custom-control-label">Terms and conditions</label>
                            <small class="form-text text-muted">By checking here and continuing, I agree to the Luma Terms of Use</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- // END Page Content -->

<?php include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>