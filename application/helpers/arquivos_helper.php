<?php

function upload_files($nome, $path, $rootpath, $field='arquivos')
{   
    $CI = &get_instance();
    $config = array(
        'upload_path'   => $path
    );
    $config['allowed_types'] = 'gif|jpg|png|jpeg|xls|txt|doc|docx|bmp|ppt|psd|zip|rar';

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);
    $retorno = array();

    if (isset($_FILES[$field])) {

        if (!is_dir($rootpath)) {
            mkdir($rootpath, 0777, TRUE);
        }

        $files = $_FILES;
        $cpt = count($_FILES [$field] ['name']);

        for ($i = 0; $i < $cpt; $i ++) {

            $name = time().$files [$field] ['name'] [$i];
            $_FILES [$field] ['name'] = $name;
            $_FILES [$field] ['type'] = $files [$field] ['type'] [$i];
            $_FILES [$field] ['tmp_name'] = $files [$field] ['tmp_name'] [$i];
            $_FILES [$field] ['error'] = $files [$field] ['error'] [$i];
            $_FILES [$field] ['size'] = $files [$field] ['size'] [$i];

            if(!($CI->upload->do_upload($field)) || $files [$field] ['error'] [$i] !=0)
            {
                return array();
                
            }
            else
            {
                $retorno[] = $name;
            }
        }
    } else {
        return false;
    }
    
    return $retorno;
}