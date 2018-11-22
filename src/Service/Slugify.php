<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 22/11/18
 * Time: 13:02
 */

namespace App\Service;


class Slugify
{
    public function generate(string $input):string
    {
        $result=trim(strtolower($input));
        $result=str_replace( "!", "", $result );
        $result=trim($result);
        $result=str_replace( " ", "-", $result );
        $result=str_replace( "à", "a", $result );
        $result=str_replace( "ç", "c", $result );
        $result=str_replace( ",", "", $result );
        $result=str_replace( "é", "e", $result );
        $result=str_replace( "'", "", $result );
        return $result;
    }
}