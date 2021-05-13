<?php include_once(ROOT_PATH.'/assets/includes/ead/header.php'); ?>
    <div class="page-section">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Meus Cursos</div>
            </div>
            <div class="row card-group-row">
                <?php if (count($courses) > 0){ 
                    foreach($courses as $item):?>
                    <?php include(ROOT_PATH.'/application/views/ead/listCourses.php'); ?>
                <?php endforeach;
                } else {
                    echo '<div class="container"><h5>Você ainda não se inscreveu em nenhum curso.</h5><br/><br/>
                    Veja os nossos cursos cadastrados <a href="'.site_url('ead/cursos').'">AQUI!</a></div>';
                } ?>
            </div>
        </div>
    </div>
<?php include_once(ROOT_PATH.'/assets/includes/ead/footer.php'); ?>
