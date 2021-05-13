<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/professor/header.php'); ?>


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
                Quadro de notas do curso #<?=$curso[0]['id'].' - '.$curso[0]['nome']?><br/>
                <button class="btn btn-primary" onclick="mudarCurso()"><i class="fa fa-search"></i>&nbsp;&nbsp;Alterar Curso</button>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Aluno</a>
                        </th>
                        <?php foreach($provas as $prv): ?>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome"><?php echo $prv['nome']; ?></a>
                        </th>
                        <?php endforeach; ?>
                        <th>Média</th>
                        <th>Máxima</th>
                        <th>Aprovar / Reprovar</th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php if (count($assinaturas) > 0){
                        foreach ($assinaturas as $ent) {
                            if (!isset($ent['aluno']['id']) || $ent['aluno']['ativo'] == 0) continue;

                            $nomeAluno = $ent['aluno']['nome'] ?? "Não encontrado";
                            $emailAluno = $ent['aluno']['email'] ?? "Não encontrado";

                            $btnAluno = isset($ent['aluno']['id']) ? 
                            '<button type="button" class="btn btn-light" onclick="showAluno(' . "'" . $ent['aluno']['id'] . "'" . ')" 
                            title="Mais Detalhes"><i class="fa fa-search"></i></button>' : ''; ?>

                            <tr>
                                <td class="js-lists-values-login">
                                    <?php echo $btnAluno . $nomeAluno ?>
                                </td>

                                <?php foreach($ent['provas'] as $p): ?>
                                <td class="js-lists-values-email <?php echo $p['notaAluno']['classe'] ?? ""; ?>">
                                    <?php echo $p['notaAluno']['nota'] ?? "N/A"; ?>
                                </td>
                                <?php endforeach; ?>
                                
                                <td class="js-lists-values-email <?php echo $ent['classe']; ?>">
                                    <?php echo $ent['media']; ?>
                                </td>
                                <td>
                                    <?php echo $ent['nota_maxima']; ?>
                                </td>
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" 
                                        href="javascript:void(0);"
                                            data-href="<?php echo site_url('professor/aluno/aprovar/'.$ent['aluno']['id']); ?>"
                                            data-titulo="<i class='fa fa-check'></i> Aprovar Aluno"
                                            data-texto="Deseja realmente aprovar o aluno <b><?= $ent['aluno']['nome'] ?></b> no curso <b><?= $curso[0]['nome'] ?></b>?"
                                            data-btn="Cancelar"
                                            data-btn-acao="Aprovar Aluno"
                                            data-toggle="aviso-modal"
                                            title="Aprovar Aluno"
                                        href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;Aprovar Aluno</a>

                                        <a class="dropdown-item" 
                                        href="javascript:void(0);"
                                            data-href="<?php echo site_url('professor/aluno/reprovar/'.$ent['aluno']['id']); ?>"
                                            data-titulo="<i class='fa fa-times'></i> Reprovar Aluno"
                                            data-texto="Deseja realmente reprovar o aluno <b><?= $ent['aluno']['nome'] ?></b> no curso <b><?= $curso[0]['nome'] ?></b>?"
                                            data-btn="Cancelar"
                                            data-btn-acao="Reprovar Aluno"
                                            data-toggle="aviso-modal"
                                            title="Reprovar Aluno"
                                        href="javascript:void(0);"><i class="fa fa-times"></i>&nbsp;Reprovar Aluno</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                    <?php  }
                     } else {
                        echo '<tr>
                            <td colspan="6" class="text-center">Nenhuma nota encontrada</td>
                        </tr>';
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>