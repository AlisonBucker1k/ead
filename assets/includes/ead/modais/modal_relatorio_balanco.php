<div class="modal fade" id="modal_relatorio_balanco" tabindex="-1" role="dialog" aria-labelledby="titulo-modal_relatorio_balanco" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal_relatorio_balanco">Relatório de balanço por datas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRelBalanco" action="<?php echo base_url(); ?>rede/financeiro/relatorio_por_datas" method="GET">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label" for="name">Data inicial: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_inicial" onkeyup="MascaraData(this)" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Data final: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_final" onkeyup="MascaraData(this)" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_relatorio_saques" tabindex="-1" role="dialog" aria-labelledby="titulo-modal_relatorio_saques" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal_relatorio_saques">Relatório de saques por datas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRelSaques" action="<?php echo base_url(); ?>rede/saques/relatorio_por_datas" method="GET">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label" for="name">Data inicial: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_inicial" onkeyup="MascaraData(this)" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Data final: *</label>
                        <input type="data" class="form-control" placeholder="dd/mm/YYYY" name="data_final" onkeyup="MascaraData(this)" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>