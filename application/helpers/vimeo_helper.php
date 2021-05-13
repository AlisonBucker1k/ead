<?php

if (!function_exists('transforma_vimeo_url')){
    function transforma_vimeo_url($url){
        $inicio = 'https://player.vimeo.com/video';
        $str = str_replace("https://vimeo.com/", "", $url);

        $exp = explode('/', $str);

        $end = '';
        foreach($exp as $xp){
            $str2 = preg_replace('/[^0-9]/', '', $xp);
            if ($str2 == $xp){
                $end .= '/'.$xp;
            }
        }

        return $inicio.$end;
    }
}