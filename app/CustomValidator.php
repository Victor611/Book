<?php
namespace App;

use Illuminate\Validation\Validator;


class CustomValidator extends Validator
{

    public function validateAlphaNumRu($attribute, $value, $parameters)
    {
         
         //$atribute - это название поля, в нашем случае site
         //$value - значение поля
         //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
         //echo "1";
         //var_dump($value);
         //exit;
         return  preg_match('/^[(а-яА-Яa-zA-Z0-9)]+[^<>@]*$/', $value);
    }
    
    public function validateAlphaRu($attribute, $value, $parameters)
    {
        
         //echo "2";
         //var_dump($attribute,$value,$parameters);
         //exit;
         //$atribute - это название поля, в нашем случае site
         //$value - значение поля
         //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'])
         return  preg_match('/^[(а-яА-Яa-zA-Z)]+[^<>@0-9]*$/', $value);
    }
    
    public function validateTypeBook($attribute, $value, $parameters)
    {
        return  preg_match('/Бумажная|Электронная/', $value);
    }
    
    public function validateStatus($attribute, $value, $parameters)
    {
        return preg_match('/1|2|3/', $value);
    }
    
    public function validaterating($attribute, $value, $parameters)
    {
        return preg_match('/1|2|3|4|5/', $value);
    }
}