<div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">

        <a href="<?php echo site_url('ead/cursos/' . $item2['dataCourse'][0]['id'] . '-' . rawurlencode($item2['dataCourse'][0]['nome'])); ?>" class="card-img-top js-image" data-position="" data-height="140">
            <img src="<?php echo get_url($item2['dataCourse'][0]['id'], $item2['dataCourse'][0]['nome'], $item2['dataCourse'][0]['capa']); ?>" alt="course">
            <span class="overlay__content">
                <span class="overlay__action d-flex flex-column text-center">
                    <i class="material-icons icon-32pt">play_circle_outline</i>
                    <span class="card-title text-white">Visualizar</span>
                </span>
            </span>
        </a>

        <div class="card-body flex">
            <div class="d-flex">
                <div class="flex">
                    <a class="card-title" href="<?php echo site_url('ead/cursos/' . $item2['dataCourse'][0]['id'] . '-' . rawurlencode($item2['dataCourse'][0]['nome'])); ?>">
                        <?php echo $item2['dataCourse'][0]['nome']; ?>
                    </a>
                    <a href="javascript:showProfessor('<?php echo $item2['professor'][0]['id']; ?>');">
                        <small class="text-50 font-weight-bold mb-4pt"><?php echo $item2['professor'][0]['nome'] ?></small>
                    </a>
                </div>
                <!-- <a href="student-course.html"
                    data-toggle="tooltip"
                    data-title="Add Favorite"
                    data-placement="top"
                    data-boundary="window"
                    class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a> -->
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-auto d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo writeTimer($item2['dataCourse'][0]); ?></small></p>
                </div>

                <div class="col-auto d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo $item2['qtAulas'] ?> aulas</small></p>
                </div>
            </div>
        </div>
    </div>
    <div class="popoverContainer d-none">
        <div class="media">
            <div class="media-left mr-12pt">

                <img src="<?php echo get_url($item2['dataCourse'][0]['id'], $item2['dataCourse'][0]['nome'], $item2['dataCourse'][0]['capa']); ?>" width="40" height="40" alt="<?php echo $item2['dataCourse'][0]['nome'] ?>" class="rounded">
            </div>
            <div class="media-body">
                <div class="card-title mb-0"><?php echo $item2['dataCourse'][0]['nome']; ?></div>
                <p class="lh-1 mb-0">
                    <span class="text-50 small">Com</span>
                    <span class="text-50 small font-weight-bold">
                        <?php echo $item2['professor'][0]['nome']; ?>
                    </span>
                </p>
            </div>
        </div>

        <p class="my-16pt text-70"><?php echo $item2['dataCourse'][0]['descricao']; ?></p>

        <div class="mb-16pt">

            <?php $learn = explode(';', $item2['dataCourse'][0]['vai_aprender']); ?>
            <?php for ($q = 0; $q < count($learn); $q++) : ?>
                <div class="d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo $learn[$q]; ?></small></p>
                </div>
            <?php endfor; ?>

        </div>

        <div class="row align-items-center">
            <div class="col-auto">
                <div class="d-flex align-items-center mb-4pt">
                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo writeTimer($item2['dataCourse'][0]); ?></small></p>
                </div>
                <div class="d-flex align-items-center mb-4pt">
                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo $item2['qtAulas'] ?> Aulas</small></p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                    <p class="flex text-50 lh-1 mb-0"><small><?php echo $item2['modalidade'][0]['nome'] ?></small></p>
                </div>
            </div>
            <div class="col text-right">
                <a href="<?php echo site_url('ead/cursos/' . $item2['dataCourse'][0]['id'] . '-' . rawurlencode($item2['dataCourse'][0]['nome'])); ?>" class="btn btn-primary">
                    <?php if ($item2['inscrito']){ echo "Continuar"; } else { echo "Acompanhar"; } ?>
                </a>
            </div>
        </div>

    </div>

</div>