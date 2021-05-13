<?php

function generate_badge($ativo, $texto){
    if ($ativo == 1){
        return '<span class="badge badge-success">'.$texto.'</span>';
    } else {
        $texto = $texto == "Ativa" ? "Inativa" : $texto; 
        return '<span class="badge badge-danger">'.$texto.'</span>';
    }
}