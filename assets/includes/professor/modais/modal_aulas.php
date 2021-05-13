<div class="modal fade" id="modal_aulas" tabindex="-1" role="dialog" aria-labelledby="titulo-modal_aulas" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal_aulas">Cadastrar Aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAula" action="<?php echo base_url(); ?>professor/cursos/inserir_aulaAjax" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id_curso" value="<?php echo isset($course_id) ? $course_id : ''; ?>" />
                    <div class="form-group">
                        <input type="checkbox" name="ativo" checked />
                        <label class="form-label" for="name">Ativa</label>
                        
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input type="text" class="form-control" placeholder="Nome da aula" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Thumbnail: *</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumb" type="file" class="form-control" placeholder="Nome">
                            <label class="custom-file-label" for="thumb">Escolher arquivo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Url do vídeo (sem iframe):</label>
                        <input type="text" class="form-control" placeholder="https://video" name="url_video">
                        <small class="text-primary" style="font-size:90%">Para inserir uma aula sem vídeo, deixe este campo em branco</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Descrição: *</label>
                        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição da aula"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Arquivos Complementares:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="arquivos[]" type="file" class="form-control" multiple placeholder="Nome">
                            <label class="custom-file-label" for="thumb">Escolher arquivos</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="insereAjax('#formAula', realocaAulas);" class="btn btn-success">Cadastrar Aula</button>
            </div>
        </div>
    </div>
</div>