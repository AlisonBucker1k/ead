<?php 
function addDataDias($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('P'.$t.'D'))->format($formato);
}

function addDataMeses($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('P'.$t.'M'))->format($formato);
}

function addDataAnos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('P'.$t.'Y'))->format($formato);
}

function addDataHoras($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('PT'.$t.'H'))->format($formato);
}

function addDataMinutos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('PT'.$t.'M'))->format($formato);
}

function addDataSegundos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->add(new DateInterval('PT'.$t.'S'))->format($formato);
}

function subDataDias($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('P'.$t.'D'))->format($formato);
}

function subDataMeses($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('P'.$t.'M'))->format($formato);
}

function subDataAnos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('P'.$t.'Y'))->format($formato);
}

function subDataHoras($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('PT'.$t.'H'))->format($formato);
}

function subDataMinutos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('PT'.$t.'M'))->format($formato);
}

function subDataSegundos($t, $ini="NOW", $formato='Y-m-d H:i:s'){
    return (new DateTime($ini))->sub(new DateInterval('PT'.$t.'S'))->format($formato);
}

function retornaMesFormatado($mes){
    $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
    return $meses[$mes - 1];
}

function retornaDataArray($data, $hora=true, $mesbr = false){
    $exp = explode(' ', $data);
    if (!isset($exp[0])) return '';

    $parte1 = explode('-', $exp[0]);

    $arr = [
        'dia' => $parte1[2],
        'mes' => $mesbr ? retornaMesFormatado($parte1[1]) : $parte1[1],
        'ano' => $parte1[0]
    ];

    if ($hora){
        if (!isset($exp[1])) return $arr;

        $parte2 = explode(':', $exp[1]);

        $arr['hh'] = $parte2[0];
        $arr['mm'] = $parte2[1];
        $arr['ss'] = $parte2[2];
    }

    return $arr;
}

function formataSql($data, $hhmmii=true, $op='/'){
    $exp = explode(' ', $data);

    $exploder = isset($exp[0]) ? $exp[0] : $data;
    $hhm = isset($exp[1]) ? $exp[1] : '00:00:00';

    $pt1 = explode($op, $exploder);

    if (!isset($pt1[0]) || !isset($pt1[1]) || !isset($pt1[2])) return false;

    return ($hhmmii) ? $pt1[2].'-'.$pt1[1].'-'.$pt1[0].' '.$hhm : $pt1[2].'-'.$pt1[1].'-'.$pt1[0];
}

function getIdade($ano){
    $nascimento = formataSql($ano, false);
    $date = new DateTime($nascimento);
    $interval = $date->diff( new DateTime( date('Y-m-d') ) );
    return $interval->format( '%Y' );
}