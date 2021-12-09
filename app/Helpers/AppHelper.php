<?php
namespace App\Helpers;

class AppHelper
{
    public static function kmprice($value) {
        $finstr = '';
        if(strlen(trim($value))>6) {
            $ab = '$'.number_format($value/1000000, 2, '.', '');
            if(strstr($ab,'.')==00) {
                $ac = explode('.',$ab);
                $finstr .= $ac[0].'M';
            }
            else
                $finstr .= $ab.'M';
        }
        else if(strlen(trim($value))<=4) {
            $finstr .= '$'.trim($value);
        }
        else {
            $finstr .= '$'.round(trim($value)/1000).'K';
        }
        return $finstr;
    }
}
