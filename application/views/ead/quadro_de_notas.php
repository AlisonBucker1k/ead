<!-- Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/ead/header.php'); ?>
<style>
    tr td:nth-child(3){
        max-width:250px!important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

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
                Meu quadro de notas<br/>
            </span>
        </div>
    </div>
</div>
<div class="page-section container page__container">
    <div class="col-lg-12 p-0 mx-auto">
        <?php foreach($quadro as &$item) {
            include(__DIR__.'/templates/quadroCurso.php');
        } ?>
    </div>
</div>

<?php include_once(ROOT_PATH . '/assets/includes/ead/footer.php'); ?>