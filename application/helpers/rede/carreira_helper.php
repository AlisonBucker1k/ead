<?php

/* VERIFICA SE O USUÁRIO ESTÁ EM ALGUM PLANO DE CARREIRA */
function getCarreira($id_aluno){
    $CI = &get_instance();
    $rulesCarreira = $CI->model->selecionaBusca('regras_carreira', "");
    $pctR = verifyCond($rulesCarreira, $id_aluno);
    $retornoCarreira = null;
    if ($pctR > 0){
        $carreiras = $CI->model->selecionaBusca('plano_carreira', " ORDER BY ativos ASC");
        
        foreach($carreiras as $car){
            $actives = searchActives($id_aluno, $car['nivel']);
            if (count($actives) >= $car['ativos']){
                //usuário possui este plano carreira
                $retornoCarreira = $car;
            } else {
                $retornoCarreira['ativos'] = $car['ativos'] - count($actives);
                $retornoCarreira['nivel'] = $car['nivel'];
                //caso o usuário não possua 1 plano abaixo, é impossível ele possuir qualquer um acima
                break;
            }
        }
    } else {
        $retornoCarreira['indicados'] = $rulesCarreira[0]['n_ativos'];
    }
    return $retornoCarreira;
}
