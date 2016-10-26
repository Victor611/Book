<?php
namespace App;

class Sklonenie
{
    function __construct($number, $titles)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        $skl = $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
        echo $skl;
    }
}