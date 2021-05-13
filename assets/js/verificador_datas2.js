function MascaraDataHora(obj) {
    var i = 0;
    var v = obj.value;
    v = v.replace(/\D/g, "");
    v = v.length > 12 ? v.substring(0, 12) : v;
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{4})(\d)/, "$1 $2");
    v = v.replace(/(\d{2})(\d)/, "$1:$2");
    obj.value = v;
}

function MascaraData(obj) {
    var i = 0;
    var v = obj.value;
    v = v.replace(/\D/g, "");
    v = v.length > 8 ? v.substring(0, 8) : v;
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    obj.value = v;
}