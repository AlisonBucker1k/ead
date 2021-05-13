<!-- // END Page Content -->
<div class="modal fade" id="cadastrar_plano_rede" tabindex="-1" role="dialog" aria-labelledby="titulo-cadastrar_plano_rede" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-cadastrar_plano_rede">Novo Plano</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formcadastrar_plano_rede" action="<?php echo base_url('admin/planos/insere'); ?>" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="name">Nome: *</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome do plano" required />
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" name="ead" checked class="form-check-input" >
                        <label class="form-check-label" for="acessoEad">Acesso ao EAD: *</label>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Valor da assinatura: *</label>
                        <input name="valor" type="number" step="0.01" min="0" class="form-control" placeholder="Valor da assinatura do plano" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Serviços:</label>
                        <select onchange="addServico(this)" title="Selecione um serviço para adcionar..." class="form-control selectpicker" data-size="5" data-live-search="true">
                            <?php foreach ($servicos as $s) : ?>
                                <option value="<?= $s['id']; ?>"><?= $s['nome']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="entradas_servico">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Descrição: *</label>
                        <textarea name="descricao" class="form-control" rows="5" placeholder="Descrição do plano"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Cadastrar Plano</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php foreach ($planos as $p) {
    $checked = $p['ead'] ? 'checked' : '';
    $options = '';

    $adcionados = explode(',', $p['servicos']);

    $listAdc = "";
    foreach ($servicos as $s) :
        $options .= '<option value="' . $s['id'] . '">' . $s['nome'] . '</option>';
        foreach ($adcionados as $add) {
            if ($add == $s['id']) {
                $listAdc .= '<div class="row pb-4 servico-' . $s['id'] . '">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>' . $s['nome'] . '</h5>fornecedor: <b>' . $s['fornecedor']['nome'] . '</b>
                                    <button type="button" class="btn btn-accent float-right" onclick="removeServico('."'#formeditar_plano_rede" . $p['id'] . " .servico-" . $s['id'] . "'" .')"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <input type="hidden" name="servicos[]" value="' . $s['id'] . '">
                        </div>
                    </div>';
            }
        }
    endforeach;



    echo '<div class="modal fade" id="editar_plano_rede' . $p['id'] . '" tabindex="-1" role="dialog" aria-labelledby="titulo-editar_plano_rede' . $p['id'] . '" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-editar_plano_rede' . $p['id'] . '">Editar Plano</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formeditar_plano_rede' . $p['id'] . '" action="' . base_url('admin/planos/update/' . $p['id']) . '" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="name">Nome: *</label>
                            <input name="nome"  type="text" value="' . $p['nome'] . '" class="form-control" placeholder="Nome do plano" required />
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" name="ead" ' . $checked . ' class="form-check-input">
                            <label class="form-check-label" for="acessoEad">Acesso ao EAD: *</label>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Valor da assinatura: *</label>
                            <input name="valor" type="number" value="' . $p['valor'] . '" step="0.01" min="0" class="form-control" placeholder="Valor da assinatura do plano" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Serviços:</label>
                            <select onchange="addServico(this)" title="Selecione um serviço para adcionar..." class="form-control selectpicker" data-size="5" data-live-search="true" >
                            ' . $options . '
                            </select>
                        </div>
                        <div class="entradas_servico">
                        ' . $listAdc . '
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Descrição: *</label>
                            <textarea name="descricao"  class="form-control" rows="5" placeholder="Descrição do plano">' . $p['descricao'] . '</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Atualizar Plano</button>
                    </div>
                </form>
            </div>
        </div>
</div>';
}
?>

<!-- // END Page Content -->
<div class="modal fade" id="modalDetalhesServico" tabindex="-1" role="dialog" aria-labelledby="titulo-modalDetalhesServico" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo-modalDetalhesServico"><i class="fa fa-search mr-3"></i> Mais detalhes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 pl-4 pr-4">
                        <h5>Detalhes do serviço</h5>
                        <div class="card-body servico">
                            <p><b>Nome:</b> <span class="nome"></span></p>
                            <p><b>Descrição:</b> <span class="descricao"></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 pl-4 pr-4">
                        <h5>Detalhes do fornecedor</h5>
                        <div class="card-body fornecedor">
                            <p><b>Nome:</b> <span class="nome"></span></p>
                            <p><b>Dados:</b> <span class="dados"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function modalServico(s) {
        $('#modalDetalhesServico .servico .nome').text(s.nome);
        $('#modalDetalhesServico .servico .descricao').text(s.descricao);

        $('#modalDetalhesServico .fornecedor .nome').text(s.fornecedor.nome);
        $('#modalDetalhesServico .fornecedor .dados').text(s.fornecedor.dados);

        $('#modalDetalhesServico').modal('show');
    }

    function showServico(id) {
        servicos.map((s) => {
            if (s.id == id) {
                modalServico(s);
            }
        });
    }


    function setSv(s, obj) {
        var idform = $(obj).closest('form').prop('id');
        if (!$('#'+idform+' .servico-' + s.id).length) {
            
            var template = `
            <div class="row pb-4 servico-${s.id}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>${s.nome}</h5>fornecedor: <b>${s.fornecedor.nome}</b>
                            <button type="button" class="btn btn-accent float-right" onclick="removeServico('#${idform} .servico-${s.id}')"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="servicos[]" value="${s.id}">
                </div>
            </div>
            `;
            $('#'+idform+' .entradas_servico').append(template);
        }
    }

    function removeServico(id) {
        document.querySelector(id).remove();
    }

    <?php foreach ($servicos as &$s) {
        $s['descricao'] = nl2br($s['descricao']);
        $s['fornecedor']['dados'] = nl2br($s['fornecedor']['dados']);
    } ?>
    var servicos = <?php echo json_encode($servicos); ?>;

    function addServico(obj) {
        console.log(servicos);
        var sv = null;
        servicos.map((s) => {
            if (s.id == $(obj).val()) {
                setSv(s, obj);
            }
        });
        $(obj).val('');
        $(obj).selectpicker('refresh');
    }
</script>