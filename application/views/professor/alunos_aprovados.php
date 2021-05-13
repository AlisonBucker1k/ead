<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/professor/header.php'); ?>


<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Alunos aprovados do curso #<?=$curso[0]['id'].' - '.$curso[0]['nome']?> de <?php echo $data_inicio ?> à <?php echo $data_fim; ?><br/>
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
                        <th>Curso</th>
                        <th>Média</th>
                        <th>Resultado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list" id="search">
                    <?php if (count($aprovacoes) > 0){
                        foreach ($aprovacoes as $ent) {
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

                                <td class="js-lists-values-email">
                                    <?= $curso[0]['nome'] ?>
                                </td>
                                
                                <td class="js-lists-values-email text-primary">
                                    <?php echo $ent['media_final']; ?>
                                </td>
                                <td class="text-success">
                                    <?php echo strtoupper($ent['resultado']); ?>
                                </td>
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opções</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" 
                                        href="javascript:void(0);"
                                            data-href="<?php echo site_url('professor/aluno/enviarCertificado/'.$ent['aluno']['id']); ?>"
                                            data-titulo="<i class='fa fa-mail'></i> Reenviar Certificado Por Email"
                                            data-texto="Deseja realmente reenviar o certificado do aluno <b><?= $ent['aluno']['nome'] ?></b> para o curso <b><?= $curso[0]['nome'] ?></b>?"
                                            data-btn="Cancelar"
                                            data-btn-acao="Reenviar"
                                            data-toggle="aviso-modal"
                                            title="Reenviar Certificado Por Email"
                                        href="javascript:void(0);"><i class="fa fa-mail"></i>&nbsp;Reenviar certificado</a>

                                    </div>
                                </div>
                                </td>
                            </tr>
                    <?php  }
                     } else {
                        echo '<tr>
                            <td colspan="5" class="text-center">Nenhuma aprovação encontrada</td>
                        </tr>';
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>