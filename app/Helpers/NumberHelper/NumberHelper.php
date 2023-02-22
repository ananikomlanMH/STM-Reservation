<?php
 namespace App\Helpers\NumberHelper;

 class NumberHelper{


     public static function CurrencyFormat($number):string{
         $number = floatval($number);
        return number_format(round($number ?: 0),0,'.',' ') . ' FCFA';
    }

     public static function CurrencyFormat2($number):string{
         $number = floatval($number);
         return number_format(round($number),0,'.',' ');
     }
 }
