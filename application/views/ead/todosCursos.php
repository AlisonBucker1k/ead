<?php include_once(ROOT_PATH.'/assets/includes/ead/header.php'); ?>
    <div class="page-section">
        <div class="container page__container">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-24pt" style="white-space: nowrap;">
            <small class="flex text-muted text-headings text-uppercase mr-3 mb-2 mb-sm-0">Todos os cursos</small>
            <!-- <div class="w-auto ml-sm-auto table d-flex align-items-center mb-2 mb-sm-0">
                <small class="text-muted text-headings text-uppercase mr-3 d-none d-sm-block">Sort by</small>

                <a href="#" class="sort desc small text-headings text-uppercase">Newest</a>

                <a href="#" class="sort small text-headings text-uppercase ml-2">Popularity</a>

            </div>

            <a href="#" data-target="#library-drawer" data-toggle="sidebar" class="btn btn-sm btn-white ml-sm-16pt">
                <i class="material-icons icon--left">tune</i> Filters
            </a> -->

        </div>
        
       
        <?php foreach($modalidades as $item):?>
            <div class="page-separator">
                <div class="page-separator__text"><?php echo $item['nome'];?></div>
            </div>
            <div class="row card-group-row">
                <?php foreach($item['courses']as $item2):?>
                    <?php include(ROOT_PATH.'/application/views/ead/listCourses2.php'); ?><br>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
        
    </div>
</div>
<?php include_once(ROOT_PATH.'/assets/includes/ead/footer.php'); ?>
