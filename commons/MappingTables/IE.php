<?php
/**
 *
 *
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

class IE
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "IE_1_2011-10-24" => "",
            "IE_2_2011-10-24" => "IECAT",
            "IE_3_2011-10-24" => "IESTESTCD",
            "IE_4_2011-10-24" => "IETEST"

        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "IEYN" => "",
            "IECAT" => "IECAT",
            "IETESTCD" => "IETESTCD",
            "IETEST" => "IETEST"
        );
        return $cdashTable;
    }

}