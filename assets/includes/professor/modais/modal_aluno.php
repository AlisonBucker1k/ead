<div class="modal fade" id="alunoModal" tabindex="-1" role="dialog" aria-labelledby="titulo-alunoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-alunoModal">Detalhes do aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="imgAluno d-flex flex-row justify-content-center">
                    
                </div>
                <div class="conteudoAluno d-flex flex-column justify-content-center align-items-center">
                    <i class="fa fa-spinner fa-spin" style="font-size:2rem;"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="alunos_aprovados" tabindex="-1" role="dialog" aria-labelledby="titulo-alunos_aprovados" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-alunos_aprovados">Alunos aprovados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRelBalanco" action="<?php echo base_url(); ?>professor/aluno/aprovados" method="GET">
                <div class="modal-body">
                    Buscar alunos aprovados de...
                    <div class="form-group">
                        <label class="form-label" for="name">Data inicial: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_inicial" onkeyup="MascaraData(this)" required>
                    </div>
                    à...
                    <div class="form-group">
                        <label class="form-label" for="name">Data final: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_final" value="<?php echo date('d/m/Y'); ?>" onkeyup="MascaraData(this)" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Buscar Alunos</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="alunos_reprovados" tabindex="-1" role="dialog" aria-labelledby="titulo-alunos_reprovados" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-alunos_reprovados">Alunos reprovados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRelBalanco" action="<?php echo base_url(); ?>professor/aluno/reprovados" method="GET">
                <div class="modal-body">
                    Buscar alunos reprovados de...
                    <div class="form-group">
                        <label class="form-label" for="name">Data inicial: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_inicial" onkeyup="MascaraData(this)" required>
                    </div>
                    à...
                    <div class="form-group">
                        <label class="form-label" for="name">Data final: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_final" value="<?php echo date('d/m/Y'); ?>" onkeyup="MascaraData(this)" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Buscar Alunos</button>
                </div>
            </form>
        </div>
    </div>
</div>