<?php

function geraToken($length = 20, $uppercase=false, $specialChar=false){
    $rt['letters'] = ['q','w','e','r','t','y','u','i','o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'c', 'v','b','n','m'];
    $rt['capital'] = [];
    $rt['special'] = ['%', '#', '!', '@','¨', '^', '~', '´' , '`', '[', ']', '(', ')', '*', ".", ',', '/', '?', '+', '-', '_', '='];
    if ($uppercase){
        foreach($rt['letters'] as $char){
            $rt['capital'][] = strtoupper($char);
        }
    }
    $token = '';
    for ($i=0; $i<$length; $i++){
        $randomizer1 = 1;
        $maxrandomizer1 = 1;
        if ($uppercase){
            $maxrandomizer1++;
        }
        if ($specialChar){
            $maxrandomizer1++;
        }
        $getfrom = ['letters', 'capital', 'special'];
        $fromval = 0;
        if ($randomizer1 != $maxrandomizer1){
            $fromval = rand(0, $maxrandomizer1 - 1);
        }
        $pos = rand(0, count($rt[$getfrom[$fromval]]) - 1);
        $token .= $rt[$getfrom[$fromval]][$pos];
    }
    return $token;
}


function geraTokenTable($table, $length = 20, $row='codigo', $uppercase=false, $specialChar=false){
    $CI = &get_instance();
    $rt['letters'] = ['q','w','e','r','t','y','u','i','o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'c', 'v','b','n','m'];
    $rt['capital'] = [];
    $rt['special'] = ['%', '#', '!', '@','¨', '^', '~', '´' , '`', '[', ']', '(', ')', '*', ".", ',', '/', '?', '+', '-', '_', '='];
    if ($uppercase){
        foreach($rt['letters'] as $char){
            $rt['capital'][] = strtoupper($char);
        }
    }
    $achou = true;
    $token = '';
    $maxI = 3000;
    $i = 0;
    while($achou){
        $token = '';
        for ($i=0; $i<$length; $i++){
            $randomizer1 = 1;
            $maxrandomizer1 = 1;
            if ($uppercase){
                $maxrandomizer1++;
            }
            if ($specialChar){
                $maxrandomizer1++;
            }
            $getfrom = ['letters', 'capital', 'special'];
            $fromval = 0;
            if ($randomizer1 != $maxrandomizer1){
                $fromval = rand(0, $maxrandomizer1 - 1);
            }
            $pos = rand(0, count($rt[$getfrom[$fromval]]) - 1);
            $token .= $rt[$getfrom[$fromval]][$pos];
        }
        $busca = $CI->model->setTable($table)->where($row, $token)->fetch();
        if (!$busca) $achou = false;

        $i++;
        if ($i > $maxI){
            break;
        }
    }
    return $token;
}