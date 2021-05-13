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
                Listagem de assinaturas ativas do curso #<?=$curso[0]['id'].' - '.$curso[0]['nome']?><br/>
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
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">ID</a>
                        </th>

                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Aluno</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Email</a>
                        </th>
                        <th>
                            <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-nome">Iniciada</a>
                        </th>
                        <th></th>
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
                            title="Mais Detalhes"><i class="fa fa-search"></i></button>' : '';

                            $urlQuadro = isset($ent['aluno']['id']) ? site_url('professor/quadro_de_notas/aluno/'.$ent['aluno']['id'].'-'.rawurlencode($ent['aluno']['nome'])) : '#'; 
                            echo '<tr>
                            <td>' . $ent['id'] . '</td>
                            <td class="js-lists-values-login">
                                ' . $btnAluno . $nomeAluno . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . $emailAluno . '
                            </td>
                            <td class="js-lists-values-email">
                                ' . formataDataBL($ent['criado_em']) . '
                            </td>
                            <td>
                                <a href="' . $urlQuadro . '">
                                    <button class="btn btn-light" title="Quadro de notas"><i class="fas fa-list mr-2"></i> Quadro de notas</button>
                                </a>
                            </td>
                        </tr>';
                        }
                     } else {
                        echo '<tr>
                            <td colspan="6" class="text-center">Nenhuma assinatura encontrada</td>
                        </tr>';
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>