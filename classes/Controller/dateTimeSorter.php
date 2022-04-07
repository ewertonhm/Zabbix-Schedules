<?php

namespace controller;

class DateTimeSorter
{
    public static function SortArray($array, $sortfield = 'logtime'){
        $ord = array();
        foreach ($array as $key => $value){
            $ord[] = strtotime($value[$sortfield]);
        }
        array_multisort($ord, SORT_DESC, $array);
        return $array;
    }
}

?>