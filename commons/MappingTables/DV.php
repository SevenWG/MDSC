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

class DV
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "DV_1_2011-10-24" => "",
            "DV_2_2011-10-24" => "DVDECOD",
            "DV_3_2011-10-24" => "DVTERM",
            "DV_4_2011-10-24" => "DVSTDTC",
            "DV_5_2011-10-24" => "DVSTDTC",
            "DV_6_2011-10-24" => "DVSTDTC",
            "DV_7_2011-10-24" => "DVENDTC",
            "DV_8_2011-10-24" => "DVENDTC",
            "DV_9_2011-10-24" => "DVENDTC",
            "DV_10_2011-10-24" => "DVSPID"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.

        $cdashTable = array(
            "DVYN" => "",
            "DVDECOD" => "DVDECOD",
            "DVTERM" => "DVTERM",
            "DVSTDAT" => "DVSTDTC",
            "DVSTTIM" => "DVSTDTC",
            "DVSTDTC" => "DVSTDTC",
            "DVENDTC" => "DVENDTC",
            "DVENDAT" => "DVENDTC",
            "DVENTIM" => "DVENDTC",
            "DVSPID" => "DVSPID"
        );

        return $cdashTable;
    }
}