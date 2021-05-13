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
                                
                                <td class="js-lists-values-email text-accent">
                                    <?php echo $ent['media_final']; ?>
                                </td>
                                <td class="text-accent">
                                    <?php echo strtoupper($ent['resultado']); ?>
                                </td>
                            </tr>
                    <?php  }
                     } else {
                        echo '<tr>
                            <td colspan="4" class="text-center">Nenhuma reprovação encontrada</td>
                        </tr>';
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>