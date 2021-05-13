<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/'.$tipo.'/header.php'); ?>
<style>
    .btn.btn-link:focus, .btn.btn-link:active{
        box-shadow: none!important;
        outline: 0!important;
    }
</style>

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Perguntas Frequentes
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">

        <div id="accordion">
            <?php foreach($faq as $f): ?>
            <div class="card">
                <div class="card-header" id="heading<?php echo $f['id']; ?>">
                    <h5 class="mb-0">
                    <span class="material-icons">help_outline</span>
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $f['id']; ?>">
                            <?php echo nl2br($f['pergunta']); ?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?php echo $f['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $f['id']; ?>" data-parent="#accordion">
                    <div class="card-body">
                        <div class="container ml-4 mr-4"><?php echo nl2br($f['resposta']); ?></div>
                        
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/'.$tipo.'/footer.php'); ?>