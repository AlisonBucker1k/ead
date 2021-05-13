function validadorCPF() {
    var obj = $("#cpf");
    var valor = obj.val();
    var cpfi = $("#cpfInvalido");
    if (valor != "" && !validaCPF(valor)) {
        if (!cpfi.length) {
            $("<label id='cpfInvalido' class='text-danger'>CPF Inválido!</label>").insertAfter(obj);
        }
        obj.val("");
    }
    if (cpfi.length) {
        cpfi.remove();
    }
}

function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}

function validaCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    console.log(cpf);
    if (cpf.length != 11) {
        return false;
    }
    if (cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;

    var digitos = cpf.substring(0, 9);
    var validador1 = cpf.substring(9, 10);
    var validador2 = cpf.substring(10, 11);
    var total = 0;
    var place = 0;
    for (i = 10; i > 1; i--) {
        total += (digitos[place] * i);
        place++;
    }
    var valida1 = total % 11;
    if (valida1 < 2)
        valida1 = 0;
    else
        valida1 = 11 - valida1;

    if (valida1 != validador1) {
        return false;
    }

    total = 0;
    place = 0;
    digitos = cpf.substring(0, 10);
    for (i = 11; i > 1; i--) {
        total += (digitos[place] * i);
        place++;
    }
    var valida2 = total % 11;
    if (valida2 < 2)
        valida2 = 0;
    else
        valida2 = 11 - valida2;
    if (valida2 != validador2) {
        return false;
    }
    return true;
}

function CPF(obj) {
    switch (obj.value.length) {
        case 3:
            obj.value = obj.value + ".";
            break;
        case 7:
            obj.value = obj.value + ".";
            break;
        case 11:
            obj.value = obj.value + "-";
            break;
    }
}

function MascaraTel(obj) {
    var i = 0;
    for (i; i < obj.value.length; i++) {
        if (obj.value[i] != '0' && obj.value[i] != '1' && obj.value[i] != '2' && obj.value[i] != '3' && obj.value[i] != '4' && obj.value[i] != '5' &&
            obj.value[i] != '6' && obj.value[i] != '7' && obj.value[i] != '8' && obj.value[i] != '9' && obj.value[i] != '(' && obj.value[i] != ')') {
            obj.value = "";
        }
    }
}
/* Máscaras ER */
function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}

function mtel(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}


function alteraData() {
    if (document.getElementById("nascimento").value == "Nascimento" || document.getElementById("nascimento").value == "") {
        var hoje = new Date();
        var dd = hoje.getDate();
        dd = ('0' + dd).slice(-2);
        var mm = hoje.getMonth() + 1;
        mm = ('0' + mm).slice(-2);
        var yyyy = hoje.getFullYear();
        document.getElementById("nascimento").value = dd + '/' + mm + '/' + yyyy;
    }
}

class validador {
    constructor(formulario) {
        this.form = formulario;
        this.inputs = [];
        this.selects = [];
        this.textareas = [];
        this.blurat = false;
        var classe = this;
        $(formulario).find('input').each(function(i, ele) {
            var attr = $(ele).attr('placeholder');
            var placeholder = typeof attr !== typeof undefined && attr !== false ? attr : '';
            var obj = {
                'placeholder': placeholder,
                'obj': $(ele)
            };
            classe.inputs.push(obj);
        });
        $(formulario).find('select').each(function(i, ele) {
            var attr = $(ele).attr('placeholder');
            var placeholder = typeof attr !== typeof undefined && attr !== false ? attr : '';
            var obj = {
                'placeholder': placeholder,
                'obj': $(ele)
            };
            classe.selects.push(obj);
        });
        $(formulario).find('textarea').each(function(i, ele) {
            var attr = $(ele).attr('placeholder');
            var placeholder = typeof attr !== typeof undefined && attr !== false ? attr : '';
            var obj = {
                'placeholder': placeholder,
                'obj': $(ele)
            };
            classe.textareas.push(obj);
        });

        this.init();
    }

    validaInputs() {
        var ref = this;
        var retorno = true;
        if (ref.inputs.length > 0) {
            ref.inputs.map(ipt => {
                var ent = ipt.obj;
                if (ent.prop('required') && ent.val() == "") {
                    ent.addClass('tem-erro');
                    if (!ref.blurat) {
                        ent.blur();
                        ref.blurat = true;
                    }
                    ref.showErro(ent, "Este campo é requerido!");
                    retorno = false;
                }
                var attr = ent.attr('igual');
                if (typeof attr !== typeof undefined && attr !== false) {
                    var igual = $(ref.form).find('input[name="' + attr + '"]');
                    if (igual.length) {
                        if (ent.val() != igual.val()) {
                            ent.addClass('tem-erro');
                            igual.addClass('tem-erro');
                            if (!ref.blurat) {
                                igual.blur();
                                ref.blurat = true;
                            }
                            ref.showErro(ent, "Os campos não coincidem!");
                            retorno = false;
                        }
                    }
                }
                attr = ent.attr('min');
                if (typeof attr !== typeof undefined && attr !== false) {
                    if (parseFloat(ent.val()) < parseFloat(attr)) {
                        ent.addClass('tem-erro');
                        igual.addClass('tem-erro');
                        if (!ref.blurat) {
                            igual.blur();
                            ref.blurat = true;
                        }
                        ref.showErro(ent, "Insira um valor maior que " + attr + "!");
                        retorno = false;
                    }
                }
                attr = ent.attr('max');
                if (typeof attr !== typeof undefined && attr !== false) {
                    if (parseFloat(ent.val()) > parseFloat(attr)) {
                        ent.addClass('tem-erro');
                        igual.addClass('tem-erro');
                        if (!ref.blurat) {
                            igual.blur();
                            ref.blurat = true;
                        }
                        ref.showErro(ent, "Insira um valor menor que " + attr + "!");
                        retorno = false;
                    }
                }
                attr = ent.attr('minlength');
                if (typeof attr !== typeof undefined && attr !== false) {
                    if (ent.val().length < parseInt(attr)) {
                        ent.addClass('tem-erro');
                        igual.addClass('tem-erro');
                        if (!ref.blurat) {
                            igual.blur();
                            ref.blurat = true;
                        }
                        ref.showErro(ent, "Por favor, digite no mínimo " + attr + " caracteres.");
                        retorno = false;
                    }
                }
                attr = ent.attr('maxlength');
                if (typeof attr !== typeof undefined && attr !== false) {
                    if (ent.val().length > parseInt(attr)) {
                        ent.addClass('tem-erro');
                        igual.addClass('tem-erro');
                        if (!ref.blurat) {
                            igual.blur();
                            ref.blurat = true;
                        }
                        ref.showErro(ent, "Por favor, digite no máximo " + attr + " caracteres.");
                        retorno = false;
                    }
                }
                attr = ent.attr('type');
                attr = typeof attr !== typeof undefined && attr !== false ? attr : 'text';
                if (attr == "email") {
                    var valorat = ent.val();
                    if (!valorat.includes('@') || !valorat.includes('.')) {
                        ent.addClass('tem-erro');
                        if (!ref.blurat) {
                            ent.blur();
                            ref.blurat = true;
                        }
                        ref.showErro(ent, "Insira um email válido!");
                        retorno = false;
                    }
                }
            });
        }
        return retorno;
    }

    validaSelects() {
        var ref = this;
        var retorno = true;
        if (ref.selects.length > 0) {
            ref.selects.map(ipt => {
                var ent = ipt.obj;
                if (ent.prop('required') && ent.val() == "") {
                    ent.addClass('tem-erro');
                    if (!ref.blurat) {
                        ent.blur();
                        ref.blurat = true;
                    }
                    ref.showErro(ent, "Selecione um valor!");
                    retorno = false;
                }
            });
        }
        return retorno;
    }

    validaTextAreas() {
        var ref = this;
        var retorno = true;
        if (ref.textareas.length > 0) {
            ref.textareas.map(ipt => {
                var ent = ipt.obj;
                if (ent.prop('required') && ent.val() == "") {
                    ent.addClass('tem-erro');
                    if (!ref.blurat) {
                        ent.blur();
                        ref.blurat = true;
                    }
                    ref.showErro(ent, "Este campo é requerido!");
                    retorno = false;
                }
            });
        }
        return retorno;
    }

    showErro(obj, texto) {
        var parente = obj.parent();
        if (parente.hasClass('form-group')) {
            $(parente).find('.erro-label').remove();
            obj.after('<small class="tem-erro erro-label">' + texto + '</small>');
        } else if (parente.hasClass('input-group')) {
            $(parente).next('.erro-label').remove();
            parente.after('<small class="tem-erro erro-label">' + texto + '</small>');
        } else {
            $(parente).find('.erro-label').remove();
            obj.after('<small class="tem-erro erro-label">' + texto + '</small>');
        }
    }

    init() {
        var ref = this;
        var botao = $(ref.form).find('button[type="submit"]');
        if (!botao.length) {
            $(ref.form).find('button').each(function(i, ele) {
                var attr = botao.attr('type');
                attr = typeof attr !== typeof undefined && attr !== false ? attr : 'submit';
                if (attr == "submit") {
                    botao = $(ele);
                    return false;
                }
            });
        }
        botao.attr('type', 'button');
        botao.on('click', function() {
            ref.blurat = false;
            $(ref.form).find('.erro-label').remove();
            if (ref.validaInputs() && ref.validaSelects() && ref.validaTextAreas()) {
                $(ref.form).submit();
            }
        });
        if (ref.inputs.length > 0) {
            ref.inputs.map(ipt => {
                ipt.obj.on('keyup change keypress keydown', function() {
                    if ($(this).hasClass('tem-erro')) {
                        $(this).removeClass('tem-erro');
                        var parente = $(this).parent();
                        if (parente.hasClass('form-group')) {
                            parente.find('.erro-label').remove();
                        } else if (parente.hasClass('input-group')) {
                            parente.parent().find('.erro-label').remove();
                        } else {
                            parente.find('.erro-label').remove();
                        }
                    }
                });
            });
        }
        if (ref.selects.length > 0) {
            ref.selects.map(ipt => {
                ipt.obj.on('keyup change keypress keydown', function() {
                    if ($(this).hasClass('tem-erro')) {
                        $(this).removeClass('tem-erro');
                        var parente = $(this).parent();
                        if (parente.hasClass('form-group')) {
                            parente.find('.erro-label').remove();
                        } else if (parente.hasClass('input-group')) {
                            parente.parent().find('.erro-label').remove();
                        } else {
                            parente.find('.erro-label').remove();
                        }
                    }
                });
            });
        }
        if (ref.textareas.length > 0) {
            ref.textareas.map(ipt => {
                ipt.obj.on('keyup change keypress keydown', function() {
                    if ($(this).hasClass('tem-erro')) {
                        $(this).removeClass('tem-erro');
                        var parente = $(this).parent();
                        if (parente.hasClass('form-group')) {
                            parente.find('.erro-label').remove();
                        } else if (parente.hasClass('input-group')) {
                            parente.parent().find('.erro-label').remove();
                        } else {
                            parente.find('.erro-label').remove();
                        }
                    }
                });
            });
        }
    }
}


$(document).ready(function() {
    if ($(".cnpj").length) {
        $(".cnpj").on("keyup", function(e) {
            $(this).val(
                $(this).val()
                .replace(/\D/g, '')
                .replace(/^(\d{2})(\d{3})?(\d{3})?(\d{4})?(\d{2})?/, "$1 $2 $3/$4-$5"));
        });

        $(".cnpj").on("blur", function(e) {
            $('.erro-span').remove();
            if (!validarCNPJ($(this).val())) {
                $(this).val('');
                $(this).after('<span class="erro-span text-danger">CNPJ Inválido!</span>');
            }
        });
    }
    $('.telefone').on('keypress focus blur', function() {
        mascara($(this)[0], mtel);
    });
    $('.celular').on('keypress focus blur', function() {
        mascara($(this)[0], mtel);
    });

    var forms = [];
    $('form').each(function(i, ele) {
        var newform = new validador(ele);
        forms.push(newform);
    });
    console.log('verificador loaded');
});