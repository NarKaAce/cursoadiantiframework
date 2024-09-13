<?php

namespace lib\traits;

trait UtilArray
{
    public function extrairVlsUnicosArray(array $array,string $coluna ):array
    {
        if(is_array($array)){
            $array = array_column($array, $coluna);
            $array = array_unique($array);
            $array = array_values($array);
        }
        return $array;
    }
    public function ordernarArray(array $array,$coluna,$ordenacao=4):array
    {
        array_multisort($array,array_column($array,$coluna),$ordenacao);
        return array_values($array);
    }

    //revisar
    public function ordernarArrayMulti(array $array,array $aColuna):array
    {
        /*
         * exemplo 1 campo aColuna -> array('nome_coluna'=> 'a','ordenacao'=>4);
         * */

        if(is_array($aColuna)){
            //var_dump($aColuna);
            foreach($aColuna as $coluna){
                $aParams[] =  array_column($array, $coluna['nome_coluna']);
                $aParams[] =  $coluna['ordenacao'];
            }
            $aParams[] = $array;
        }
        call_user_func('array_multisort',$aParams);
         return array_values($array);
    }
}
