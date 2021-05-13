<!-- // END Page Content -->
<div class="modal fade" id="addRegraFidelidade" tabindex="-1" role="dialog" aria-labelledby="titulo-addRegraFidelidade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-addRegraFidelidade">Nova Regra de Fidelidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRegraFidelidade" action="<?php echo base_url('admin/residual/cadastro_regra'); ?>" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nº de diretos requeridos: *</label>
                            <input name="n_ativos" id="n_ativos"  type="number" step="1" min="0" class="form-control" placeholder="Nº de diretos requeridos" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ganho em porcentagem do residual: *</label>
                            <input name="ganho_pct" id="ganho_pct"  type="number" step="1" min="0" max="100" class="form-control" placeholder="Ganho em % do residual" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar Regra</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<?php foreach($regras_fidelidade as $regra){
    echo '<div class="modal fade" id="editar_regra'.$regra['id'].'" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_regra'.$regra['id'].'" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-editar_regra'.$regra['id'].'">Editar Regra de Fidelidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRegraFidelidade'.$regra['id'].'" action="'.base_url('admin/residual/update_regra/'.$regra['id']).'" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nº de diretos requeridos: *</label>
                            <input name="n_ativos" id="n_ativos" value="'.$regra['n_ativos'].'" type="number" step="1" min="0" class="form-control" placeholder="Nº de diretos requeridos" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ganho em porcentagem do residual: *</label>
                            <input name="ganho_pct" id="ganho_pct" value="'.$regra['ganho_pct'].'" type="number" step="1" min="0" max="100" class="form-control" placeholder="Ganho em % do residual" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Regra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
} ?>


<!-- // END Page Content -->
<div class="modal fade" id="addRegraCarreira" tabindex="-1" role="dialog" aria-labelledby="titulo-addRegraCarreira" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-addRegraCarreira">Nova Regra de Fidelidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formaddRegraCarreira" action="<?php echo base_url('admin/plano_carreira/cadastro_regra'); ?>" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nº de diretos requeridos: *</label>
                            <input name="n_ativos" id="n_ativos"  type="number" step="1" min="0" class="form-control" placeholder="Nº de diretos requeridos" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ganho em porcentagem do residual: *</label>
                            <input name="ganho_pct" id="ganho_pct"  type="number" step="1" min="0" max="100" class="form-control" placeholder="Ganho em % do residual" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar Regra</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<?php foreach($regras_carreira as $regra){
    echo '<div class="modal fade" id="editar_regra_carreira'.$regra['id'].'" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_regra_carreira'.$regra['id'].'" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-editar_regra_carreira'.$regra['id'].'">Editar Regra de Fidelidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formeditar_regra_carreira'.$regra['id'].'" action="'.base_url('admin/plano_carreira/update_regra/'.$regra['id']).'" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nº de diretos requeridos: *</label>
                            <input name="n_ativos" id="n_ativos" value="'.$regra['n_ativos'].'" type="number" step="1" min="0" class="form-control" placeholder="Nº de diretos requeridos" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Ganho em porcentagem do plano de carreira: *</label>
                            <input name="ganho_pct" id="ganho_pct" value="'.$regra['ganho_pct'].'" type="number" step="1" min="0" max="100" class="form-control" placeholder="Ganho em % do residual" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Regra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';
} ?>


<!-- // END Page Content -->
<div class="modal fade" id="addPlanoCarreira" tabindex="-1" role="dialog" aria-labelledby="titulo-addPlanoCarreira" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-addPlanoCarreira">Novo Plano de Carreira</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formaddPlanoCarreira" action="<?php echo base_url('admin/plano_carreira/cadastro'); ?>" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Valor do ganho do plano de carreira em R$: *</label>
                            <input name="ganho" id="ganho"  type="number" step="0.01" min="0" class="form-control" placeholder="R$: " required />
                        </div>
                        <div class="form-row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nº de ativos requeridos: *</label>
                                    <input name="ativos" id="ativos"  type="number" step="1" min="0" class="form-control" placeholder="Nº de ativos requeridos" required />
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="name">Até o nível? *</label>
                                    <input name="nivel" id="nivel"  type="number" step="1" min="2" class="form-control" placeholder="Nível" required />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cadastrar plano de Carreira</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<?php foreach($carreira as $c){
    echo '<div class="modal fade" id="editar_carreira'.$c['id'].'" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_carreira" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-editar_carreira">Novo Plano de Carreira</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formeditar_carreira" action="'.base_url('admin/plano_carreira/update/'.$c['id']).'" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="name">Valor do ganho do plano de carreira em R$: *</label>
                        <input name="ganho" id="ganho"  type="number" value="'.$c['ganho'].'" step="0.01" min="0" class="form-control" placeholder="R$: " required />
                    </div>
                    <div class="form-row">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-label" for="name">Nº de ativos requeridos: *</label>
                                <input name="ativos" id="ativos"  type="number" value="'.$c['ativos'].'" step="1" min="0" class="form-control" placeholder="Nº de ativos requeridos" required />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Até o nível? *</label>
                                <input name="nivel" id="nivel"  type="number" step="1" value="'.$c['nivel'].'" min="2" class="form-control" placeholder="Nível" required />
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Atualizar plano de Carreira</button>
                </div>
            </form>
        </div>
    </div>
</div>';
} ?>