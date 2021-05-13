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
                Atualização de provas do curso <?= $cur[0]['id'] . ' - ' . $cur[0]['nome'] ?>
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-12 mb-24pt mb-md-0">
                <form id="formprovas" action="<?php echo base_url(); ?>professor/provas/update/<?php echo $prova[0]['id'] ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input name="ativo" id="customCheck00" type="checkbox" <?php if ($prova[0]['ativo'] == 1){ echo 'checked'; } ?> class="custom-control-input">
                            <label for="customCheck00" class="custom-control-label">Ativa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: * (Apenas para identificação)</label>
                        <input id="nome" type="text" class="form-control" placeholder="Nome da prova para identificação" 
                        value="<?php echo $prova[0]['nome']; ?>" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Nota Máxima: * (Nota máxima da prova)</label>
                        <input id="nota_maxima" type="number" class="form-control" placeholder="nota máxima da prova" 
                        value="<?php echo $prova[0]['nota_maxima']; ?>" step="0.01" name="nota_maxima" required>
                    </div>
                    <br>
                    <hr>
                    <h5>Exercícios</h5>
                    <div class="card mb-4">
                        <div id="exercicios" class="card-body">
                            <button type="button" class="btn btn-secondary btn-block" onclick="openExercicio('')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adcionar</button>
                            <hr>
                            <?php for($i=0; $i<count($prova[0]['exercicios']); $i++){
                                $inputs = '';
                                $exat = $prova[0]['exercicios'][$i];
                                $inputs .= '<input type="hidden" name="id_questoes[]" value="'.$exat['id'].'" />';
                                $inputs .= '<input type="hidden" class="questaoAt" name="questao_'.$exat['id'].'" value='."'".parseHtml($exat['questao'])."'".' />';
                                $inputs .= '<input type="hidden" class="notaAt" id="val_nota_'.$exat['id'].'" name="val_nota_'.$exat['id'].'" value='."'".$exat['val_nota']."'".' />';
                                $ind = 0;
                                $respostashtml = '';
                                foreach($exat['escolhas'] as $esc){
                                    $inputs .= '<input type="hidden" class="respostasAt" name="respostas_'.$exat['id'].'[]" value="'.$esc['resposta'].'" />';

                                    $classAt = "text-danger";
                                    
                                    if ($esc['correta']){
                                        $inputs .= '<input type="hidden" class="resposta_corretaAt" name="resp_correta_'.$exat['id'].'" value="'.$ind.'" />';
                                        $classAt = "text-success";
                                    }
                                    $respostashtml .= '<li class="accordion__menu-link">
                                        <span class="text-muted">'.$esc['letra'].'</span>
                                        <a class="flex '.$classAt.'" href="javascript:void(0);">&nbsp;'.parseHtml($esc['resposta']).'</a>
                                    </li>';
                                    $ind++;
                                }

                                $num = $i + 1;
                                $nrespostas = $ind;
                                echo '<ul class="questoes exercicios" id="questao-'.$exat['id'].'">
                                '.$inputs.'
                                <li class="list-group-item d-flex">
                                    <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                                    <div class="flex d-flex flex-column">
                                        <div class="card-title mb-4pt">Questão '.$num.'</div>
                                        <div class="card-subtitle text-70 paragraph-max mb-16pt">'.parseHtml($exat['questao']).'</div>
                                        <ul class="accordion accordion--boxed js-accordion mb-0" id="respostas-'.$exat['id'].'" data-domfactory-upgraded="accordion">
                                            <li class="accordion__item">
                                                <a class="accordion__toggle" data-toggle="collapse" data-parent="#respostas-'.$exat['id'].'" href="#respostas-conteudo-'.$exat['id'].'" aria-expanded="true">
                                                    <span class="flex">'.$nrespostas.' Opções</span>
                                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                                </a>
                                                <div class="accordion__menu">
                                                    <ul class="list-unstyled collapse show" id="respostas-conteudo-'.$exat['id'].'" style="">
                                                        '.$respostashtml.'
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="text-muted mx-12pt">'.$exat['val_nota'].' pts</span>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_horiz</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:editarQuestao('."'#questao-".$exat['id']."'".')" class="dropdown-item">Editar Questão</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:removeEscolha('."'#questao-".$exat['id']."'".')" class="dropdown-item text-danger">Deletar Questão</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>';
                            } ?>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Atualizar prova</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/professor/footer.php'); ?>
<script>

    $('#formprovas').on('submit', function(e) {
        if (!$('.questoes').length) {
            e.preventDefault();
            aviso('erro', 'Erro!', 'Você precisa adcionar pelo menos um exercício para cadastrar uma prova!');
        } else {
            var ntmax = parseFloat($('#nota_maxima').val());
            if (parseFloat(totalNotas) != ntmax){
                e.preventDefault();
                aviso('erro', 'Erro!', 'A soma das notas dos exercícios não bate com a nota máxima da prova!');
            }
        }
    });
</script>