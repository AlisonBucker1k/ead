<!-- TEM TAREFAS E / OU PROVAS -->
<div class="page-section">
    <?php if (count($tarefas) > 0) { ?>
        <!-- TAREFAS -->
        <div class="page-nav__content">
            <div class="page-separator">
                <div class="page-separator__text">Atividades</div>
            </div>
        </div>
        <nav class="nav page-nav__menu">
            <?php foreach ($tarefas as $tar) {
                $href = site_url('ead/tarefas/' . $tar['id'] . '-' . rawurlencode($tar['nome']));  ?>

                <a class="nav-link <?php if ($tar['first']) {
                                        echo 'active';
                                    } else if ($tar['feita']) {
                                        echo 'text-muted';
                                    } ?>" href="<?php echo $href; ?>">
                    <? echo $tar['nome']; ?>
                </a>
            <?php } ?>
        </nav>
    <?php }
    if (count($provas) > 0) { ?>
        <!-- PROVAS -->
        <div class="page-nav__content">
            <div class="page-separator">
                <div class="page-separator__text">Provas</div>
            </div>
            <!-- <h4 class="mb-16pt">Table of contents</h4> -->
        </div>
        <nav class="nav page-nav__menu">
            <?php foreach ($provas as $tar) {
                $href = site_url('ead/provas/' . $tar['id'] . '-' . rawurlencode($tar['nome']));
                if ($tar['feita']) {
                    $href = "javascript:aviso('danger', 'Proibido!', 'Você já fez essa prova!')";
                } else if (!$tar['first']){
                    $href = "javascript:aviso('danger', 'Proibido!', 'Você precisa fazer as provas anteriores primeiro')";
                } 
            ?>
                <a class="nav-link <?php if ($tar['first']) {
                                        echo 'active';
                                    } else if ($tar['feita']) {
                                        echo 'text-muted';
                                    } ?>" href="<?php echo $href; ?>">
                    <? echo $tar['nome']; if ($tar['feita']){ echo '<span class="pl-4">Nota: '.$tar['notaFinal'].'</span>'; } ?>
                </a>
            <?php } ?>
        </nav>
    <?php } ?>
</div>