<div class="modal fade" id="add_exercicio" tabindex="-1" role="dialog" aria-labelledby="titulo-add_exercicio" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo-add_exercicio">Adcionar Exercício</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="tipo-id-prova" value="" >
                    <div class="form-group">
                        <label class="form-label" for="name">Questão: *</label>
                        <div id="questao-provas" style="height: 150px;" class="mb-0" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Valor da Nota: *</label>
                        <input id="val-nota-provas" class="form-control" type="number" step="0.01" />
                    </div>
                    <hr>
                    <h5>Escolhas</h5>
                    <div class="card mb-4">
                        <div id="escolhas-provas" class="card-body">
                            <button type="button" class="btn btn-secondary btn-block mb-4" onclick="addEscolha()"><i class="fa fa-plus"></i>&nbsp;&nbsp;Adcionar</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Explicação:</label>
                        <div id="explica-provas" style="height: 150px;" class="mb-0">
                        </div>
                        <small>Deixe em branco caso não haja explicação</small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                <button id="AddExercicioBtn" type="button" onclick="insereExercicio();" class="btn btn-success">Adcionar Exercício</button>
            </div>
        </div>
    </div>
</div>

<script>
    function removeEscolha(obj) {
        if (obj.includes('#')){
            $(obj).remove();
        } else {
            $('#'+obj).remove();
        }
    }

    function htmlEscolha(id, value="", correta=false) {
        var checked = correta ? 'checked' : '';
        var newEscolha = `<div id="${id}" class="form-row escolhas">
            <div class="col-8">
                <div class="form-group">
                    <label class="form-label">Resposta: </label>
                    <input id="resposta${id}" type="text" class="form-control" value="${value}" placeholder="Digite a resposta..." />
                </div>
            </div>
            <div class="col-2">
                <div class="form-group pt-4">
                    <div class="custom-control custom-checkbox" style="height: 37.5px;display: flex;align-items: center;justify-content: center;">
                        <input id="checkCorreta${id}" type="checkbox" onchange="checkOnlyOne(this, '.corretaschk')" ${checked} name="correta" class="custom-control-input corretaschk">
                        <label for="checkCorreta${id}" class="custom-control-label">Correta?</label>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group pt-4">
                    <button class="btn btn-danger" onclick="removeEscolha('${id}');" style="height: 37.5px;"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>`;
        return newEscolha;
    }

    function checkOnlyOne(obj, all){
        if ($(obj).prop('checked')){
            $(all).prop('checked', false);
            $(obj).prop('checked', true);
        }
    }

    var totalNotas = 0;

    function validaCampos(){
        var text1 = esctar.getText();

        var retorno = true;
        if (text1.replace(/\s/g,"") == ""){
            $('#questao-provas').after(`<div class="label-erro text-danger">Preencha a questão!</div>`);
            retorno = false;
        }

        if (!$('#add_exercicio input[name="correta"]:checked').length){
            $('#escolhas-provas').append(`<div class="label-erro text-danger">Selecione uma escolha correta!</div>`);
            retorno = false;
        }

        var notaAtual = parseFloat($('#val-nota-provas').val());
        if (notaAtual + totalNotas > parseInt($('#nota_maxima').val())){
            $('#val-nota-provas').after(`<div class="label-erro text-danger">A soma das notas dos exercícios superam a nota máxima!</div>`);
            retorno = false;
        }
        return retorno;
    }

    function getIndiceF(indice){
        var letras = ['A)', 'B)', 'C)', 'D)', 'E)', 'F)', 'G)', 'H)', 'I)', 'J)', 'K)', 'L)', 'M)', 'N)', 'O)', 'P)', 'Q)', 'R)', 'S)', 'T)', 'U)', 'W)', 'Y)', 'V)', 'X)', 'Z)'];
        var sobra = parseInt(parseFloat(indice) / 25);
        if (sobra <= 0){
            return letras[indice];
        }
        var index = indice - (25 * sobra);
        var ret = indice - index;
        return '' + ret + letras[index];
    }

    function templateprovaAdmin(id, num, questao, respostas, explicacao, notaAtual, inputs=false, edit=false){
        var respostas_html = '';
        

        var indice = 0;
        var ipthtml = '';
        respostas.map((resp) => {
            var classAt = resp.correta ? "text-success" : "text-danger";
            
            var checker = getIndiceF(indice);
            respostas_html += `<li class="accordion__menu-link">
                <span class="text-muted">${checker}</span>
                <a class="flex ${classAt}" href="javascript:void(0)">${resp.escolha}</a>
            </li>`;
            if (inputs){
                var iptresposta = resp.escolha.replace(/'/g, '`');
                iptresposta = iptresposta.replace(/"/g, '``');

                ipthtml += '<input type="hidden" class="respostasAt" name="respostas_'+id+'[]" value="'+iptresposta+'" />';
                if (resp.correta){
                    ipthtml += '<input type="hidden" class="resposta_corretaAt" name="resp_correta_'+id+'" value="'+indice+'" />';
                }
            }
            indice++;
        });

        var n_respostas = respostas.length;

        
        if (inputs){
            var iptquestao = questao.replace(/'/g, '`');
            iptquestao = iptquestao.replace(/"/g, '``');

            var iptexplic = explicacao.replace(/'/g, '`');
            iptexplic = iptexplic.replace(/"/g, '``');

            ipthtml += '<input type="hidden" name="id_questoes[]" value="'+id+'" />';
            ipthtml += '<input type="hidden" class="questaoAt" id="questao_'+id+'" name="questao_'+id+'" value="'+iptquestao+'" />';
            ipthtml += '<input type="hidden" class="explicacaoAt" id="explicacao_'+id+'" name="explicacao_'+id+'" value="'+iptexplic+'" />';
            ipthtml += '<input type="hidden" class="notaAt" id="val_nota_'+id+'" name="val_nota_'+id+'" value="'+notaAtual+'" />';
        }

        var ulcima = (edit) ? '' : `<ul class="questoes exercicios" id="questao-${id}">`;
        var ulbaixo = (edit) ? '' : `</ul>`;
        var ulTemplate = `${ulcima}
                ${ipthtml}
                <li class="list-group-item d-flex">
                    <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                    <div class="flex d-flex flex-column">
                        <div class="card-title mb-4pt">Questão ${num}</div>
                        <div class="card-subtitle text-70 paragraph-max mb-16pt">${questao}</div>
                        <ul class="accordion accordion--boxed js-accordion mb-0" id="respostas-${id}" data-domfactory-upgraded="accordion">
                            <li class="accordion__item">
                                <a class="accordion__toggle" data-toggle="collapse" data-parent="#respostas-${id}" href="#respostas-conteudo-${id}" aria-expanded="true">
                                    <span class="flex">${n_respostas} Opções</span>
                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                </a>
                                <div class="accordion__menu">
                                    <ul class="list-unstyled collapse show" id="respostas-conteudo-${id}" style="">
                                        ${respostas_html}
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <span class="text-muted mx-12pt">${notaAtual} pts</span>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_horiz</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:editarQuestao('#questao-${id}')" class="dropdown-item">Editar Questão</a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:removeEscolha('#questao-${id}')" class="dropdown-item text-danger">Deletar Questão</a>
                        </div>
                    </div>
                </li>
            ${ulbaixo}`;
            
        return ulTemplate;
    }

    function addQuestao(id, questao, escolhas, explicacao, idd, notaAtual){
        if (idd != ''){
            var sendnum = $(idd + ' .card-title').html().replace('Questão ', '');
            var senderId = idd.replace('#questao-', '');
            var template = templateprovaAdmin(senderId, sendnum, questao, escolhas, explicacao, notaAtual, true, true);
            $(idd).html(template);
        } else {
            var num = $('.questoes').length + 1;
            var template = templateprovaAdmin(id, num, questao, escolhas, explicacao, notaAtual, true, false);
            $('#exercicios').append(template);
        }
    }

    function limpaCamposExercicio(){
        $('#add_exercicio .escolhas').remove();
        esctar.setText('');
        exptar.setText('');
    }

    function editarQuestao(id){
        openExercicio(id);
    }

    function openExercicio(id = ""){
        if (id != ""){
            var questao = $(id+' .questaoAt').val();
            var explicacao = $(id+' .explicacaoAt').val();
            var delta = esctar.clipboard.convert(questao);
            esctar.setContents(delta, 'silent');

            var delta2 = exptar.clipboard.convert(explicacao);
            exptar.setContents(delta2, 'silent');


            $(id+' .respostasAt').each(function (i, ele) {
                var ielebsc = $(id+ ' .resposta_corretaAt').val();
                var sendcor = false;
                if (ielebsc == i){
                    sendcor = true;
                }
                addEscolha($(ele).val(), sendcor);
            });
            $('#tipo-id-prova').val(id);
            $('#AddExercicioBtn').html('ATUALIZAR EXERCÍCIO');
        } else {
            $('#tipo-id-prova').val('');
            $('#AddExercicioBtn').html('ADCIONAR EXERCÍCIO');
        }
        
        $('#add_exercicio').modal('show');
    }

    function resetExercicio(){
        $('#add_exercicio').on('hidden.bs.modal', function () {
            limpaCamposExercicio();
        });
        $('#add_exercicio').modal('hide');
        
    }

    function insereExercicio(){
        var questao = esctar.container.firstChild.innerHTML;
        var explicacao = exptar.container.firstChild.innerHTML;
        var text1 = esctar.getText();
        var text2 = exptar.getText();


        var escolhas = [];
        $('.escolhas').each(function () {
            var idat = $(this).attr('id');
            var resposta = $('#resposta'+idat).val();
            var correta = document.getElementById('checkCorreta'+idat).checked;
            escolhas[escolhas.length] = {
                'escolha' : resposta,
                'correta' : correta
            };
        });
        var idd = $('#tipo-id-prova').val();
        var notaAtual = $('#val-nota-provas').val();

        $('#add_exercicio .label-erro').remove();

        if (idd != ''){
            var busca = idd.replace('questao-', '');
            busca = busca.replace('#questao-', '');
            totalNotas -= parseFloat($('#val_nota_'+busca).val());
        }
        if (validaCampos()){
            if (text2.replace(/\s/g,"") == ""){ explicacao = ""; }
            
            var idsender = Date.now();
            if (idd != ''){
                idsender = idd.replace('questao-', '');
            }
            
            totalNotas += parseFloat(notaAtual);
            addQuestao(idsender, questao, escolhas, explicacao, idd, notaAtual);
            resetExercicio();
        }
    }

    var esctar = null;
    var exptar = null;
    function initializeQuill(){
        esctar = new Quill('#questao-provas', {
            placeholder: 'Digite a questão do exercício...',
            modules: {
                toolbar: [["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]
            },
            theme: 'snow'
        });

        exptar = new Quill('#explica-provas', {
            placeholder: 'Digite a explicação da resposta desta questão...',
            modules: {
                toolbar: [["bold", "italic"], ["link", "blockquote", "code", "image"], [{"list": "ordered"}, {"list": "bullet"}]]
            },
            theme: 'snow'
        });
        
    }

    var numEsc = 0;
    function addEscolha(value="", correta=false) {
        var id = Date.now() + '-esc-' + numEsc;
        $('#add_exercicio .label-erro').remove();
        numEsc++;
        $('#escolhas-provas').append(htmlEscolha(id, value, correta));
    }
</script>