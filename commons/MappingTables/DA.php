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

class DA
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "DA_1_2011-10-24" => "DASTAT",
            "DA_2_2011-10-24" => "DACAT",
            "DA_3_2011-10-24" => "DASCAT",
            "DA_4_2011-10-24" => "DADTC",
            "DA_5_2011-10-24" => "DAREFID",
            "DA_6_2011-10-24" => "DATEST",
            "DA_7_2011-10-24" => "DAORRES+DAORRESU",
            "DA_8_2011-10-24" => "DADTC",
            "DA_9_2011-10-24" => "DCREFID",
            "DA_10_2011-10-24" => "DASTAT",
            "DA_11_2011-10-24" => "DAORRES+DAORRESU",
            "DA_12_2011-10-24" => "DAREFID",
            "DA_13_2011-10-24" => "DASTAT",
            "DA_14_2011-10-24" => "DAORRES+DAORRESU",
            "DA_15_2011-10-24" => "EXOCCUR"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "DAPERF" => "DASTAT",
            "DACAT" => "DACAT",
            "DASCAT" => "DASCAT",
            "DADAT" => "DADTC",
            "DAREFID" => "DAREFID",
            "DATEST" => "DATEST",
            "DAORRES" => "DAORRES+DAORRESU",
            "RETAMT.DADAT" => "DADTC",
            "RETAMT.DAREFID" => "DAREFID",
            "RETAMT.DAPERF" => "DASTAT",
            "RETAMT.DAORRES" => "DAORRES+DAORRESU",
            "DISPAMT.DADAT" => "DADTC",
            "DISPAMT.DAREFID" => "DAREFID",
            "DISPAMT.DAPERF" => "DASTAT",
            "DISPAMT.DAORRES" => "DAORRES+DAORRESU"
        );

        return $cdashTable;
    }
}