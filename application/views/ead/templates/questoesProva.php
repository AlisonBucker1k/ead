<div class="card mb-32pt mb-lg-64pt">
    <ul class="accordion accordion--boxed js-accordion mb-0" id="<?php echo 'toc-'.$item['id']; ?>" data-domfactory-upgraded="accordion">
        <li class="accordion__item open">
            <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $item['id']; ?>" href="#toc-content-<?php echo $item['id']; ?>">
                <span class="flex"><?php echo $item['questao']; ?></span>
                <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
            </a>
            <div class="accordion__menu">
                <ul class="list-unstyled collapse show" id="toc-content-<?php echo $item['id']; ?>">
                    <?php 
                    $i=0;
                    $showDescricao = false;
                    $acerto = false;
                    foreach($item['escolhas'] as $e):
                    $className = '';
                    foreach($tarAln as $taln){
                        if ($taln['pos'] == $item['id']){
                            $showDescricao = true;
                            if ($taln['letra'] == $e['letra']){
                                $className = "text-primary";
                                if ($e['correta']){
                                    $acerto = true;
                                    $className = "text-success";
                                } else {
                                    $className = "text-accent";
                                }
                            }
                        }
                    }
                    ?>
                    <a class="flex" href="javascript:void(0)" 
                        <?php if (!$showDescricao): ?>
                        onclick="selecionaQuestao(`<?php echo $tarefa[0]['id']; ?>`, 
                        `<?php echo $item['id']; ?>`, 
                        `<?php echo $item['questao']; ?>`,
                        `<?php echo $e['letra']; ?>`, 
                        `<?php echo parseHtml($e['resposta']); ?>`)" <?php endif; ?> >
                        <li class="accordion__menu-link <?php echo $className; ?>">
                            <span class="text-muted"><?php echo $e['letra']; ?></span>
                            
                                &nbsp;<?php echo parseHtml($e['resposta']); ?>
                        </li>
                        
                    </a>
                    <?php $i++; endforeach; ?>
                    <?php if ($showDescricao){ $nota = $acerto ? $item['val_nota'] : 0; ?>
                            <?php echo '<div class="pl-4 pr-4 text-right text-muted" >'.$nota.' de '.$item['val_nota'].' pts</div>'; ?>
                    <?php } ?>
                </ul>
            </div>
        </li>
    </ul>
</div>

<script>
    function selecionaQuestao(id, i, questao, letra, resposta){
        var texto = `
            <p>Responder:<br/><b>${questao}</b><br/>com:<br/><b>${letra}</b> ${resposta}</p>
            <input type="hidden" name="id" value="${id}" />
            <input type="hidden" name="pos" value="${i}" />
            <input type="hidden" name="letra" value="${letra}" />
        `;
        showModal('<?php echo site_url('ead/provas/'.$tarefa[0]['id'].'-'.rawurlencode($tarefa[0]['nome'])); ?>', '', texto, 'Cancelar', 'Prosseguir');
    }
</script>