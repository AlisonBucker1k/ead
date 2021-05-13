<div class="row">
                <div class="col-lg-7">
                    <div class="border-left-2 page-section pl-32pt">

                        <div class="d-flex align-items-center page-num-container">
                            <div class="page-num">1</div>
                            <h4><?php echo isset($curso[0]['nome']) ? $curso[0]['nome'] : $course[0]['nome'];?></h4>
                        </div>

                        <div class="card mb-32pt mb-lg-64pt">
                            <ul class="accordion accordion--boxed js-accordion mb-0"
                                id="toc-1">
                                <li class="accordion__item open">
                                    <a class="accordion__toggle"
                                        data-toggle="collapse"
                                        data-parent="#toc-1"
                                        href="#toc-content-1">
                                        <span class="flex">Aulas</span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu">
                                        <ul class="list-unstyled collapse show"
                                            id="toc-content-1">
                                            <?php foreach($aulasCurso as $item):?>
                                                <li class="accordion__menu-link">
                                                    <span class="material-icons icon-16pt icon--left text-body">play_circle_outline<!--check_circle--></span>
                                                    <a class="flex <?php if ($item['id'] == $aula[0]['id']){ echo "text-primary"; } ?>"
                                                        href="<?php echo base_url('ead/aula/'.$item['id_curso'].'/'.$item['id'].'-'.rawurlencode($item['nome']));?>"><?php echo $item['nome']?></a>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5 page-nav">
                    <?php include(ROOT_PATH.'/application/views/ead/templates/provasTarefas.php'); ?>
                </div>
            </div>