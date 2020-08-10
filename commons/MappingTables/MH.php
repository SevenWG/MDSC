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

class MH
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "MH_1_2011-10-24" => "",
            "MH_2_2011-10-24" => "MHSPID",
            "MH_3_2011-10-24" => "MHCAT",
            "MH_4_2011-10-24" => "MHSCAT",
            "MH_5_2011-10-24" => "MHTERM",
            "MH_6_2011-10-24" => "MHENRF or MHENRTPT",
            "MH_7_2011-10-24" => "",
            "MH_8_2011-10-24" => "MHOCCUR",
            "MH_9_2011-10-24" => "MHSTDTC",
            "MH_10_2011-10-24" => "MHENDTC",
            "MH_11_2011-10-24" => "MHDTC",
            "MH_12_2011-10-24" => "MHOCCUR",
            "MH_13_2011-10-24" => "MHSTDTC",
            "MH_14_2011-10-24" => "MHENDTC",
            "MH_15_2011-10-24" => "MHENRF",
            "MH_16_2011-10-24" => "MHOCCUR",
            "MH_17_2011-10-24" => "MHSTDTC"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "MHYN" => "",
            "MHSPID" => "MHSPID",
            "MHCAT" => "MHCAT",
            "MHSCAT" => "MHSCAT",
            "MHTERM" => "MHTERM",
            "MHONGO" => "MHENRF or MHENRTPT",
            "MHCTRL" => "",
            "MHOCCUR" => "MHOCCUR",
            "MHSTDAT" => "MHSTDTC",
            "MHENDAT" => "MHENDTC",
            "MHDAT" => "MHDTC",
            "HBP.MHOCCUR" => "MHOCCUR",
            "HBP.MHSTDAT" => "MHSTDTC",
            "HBP.MHENDAT" => "MHENDTC",
            "HBP.MHONGO" => "MHENRF",
            "APPENDECTOMY.MHOOCUR" => "MHOCCUR",
            "APPENDECTOMY.MHSTDAT" => "MHSTDTC"
        );

        return $cdashTable;
    }
}