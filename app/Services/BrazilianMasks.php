<?php
/**
 * Created by PhpStorm.
 * User: gregorygregio
 * Date: 15/11/18
 * Time: 18:07
 */

namespace App\Services;


class BrazilianMasks
{
    const CPF_MASK = "###.###.###-##";
    const CEP_MASK = "#####-###";
    const PHONE_MASK = "(##) ####-####";
    const CELL_PHONE_MASK = "(##) #####-####";

    public static function applyCPFMask($cpf){
        return self::mask($cpf, self::CPF_MASK);
    }

    public static function applyCEPMask($cep){
        return self::mask($cep, self::CEP_MASK);
    }

    public static function applyPhoneMask($phone){
        return self::mask($phone, self::PHONE_MASK);
    }

    public static function applyCellPhoneMask($cellPhone){
        return self::mask($cellPhone, self::CELL_PHONE_MASK);
    }




    private static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

}