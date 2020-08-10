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

class EX
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "EX_1_2011-10-24" => "EXOCCUR",
            "EX_2_2011-10-24" => "EXSTDTC",
            "EX_3_2011-10-24" => "EXSTDTC",
            "EX_4_2011-10-24" => "EXSTDTC",
            "EX_5_2011-10-24" => "EXREFID",
            "EX_6_2011-10-24" => "EXENDTC",
            "EX_7_2011-10-24" => "EXENDTC",
            "EX_8_2011-10-24" => "EXENDTC",
            "EX_9_2011-10-24" => "EXDOST or EXDOSTXT",
            "EX_12_2011-10-24" => "EXLOT",
            "EX_13_2011-10-24" => "",
            "EX_14_2011-10-24" => "EXTRT",
            "EX_15_2011-10-24" => "",
            "EX_16_2011-10-24" => "EXADJ",
            "EX_17_2011-10-24" => "EXDOSFRQ",
            "EX_18_2011-10-24" => "EXROUTE",
            "EX_19_2011-10-24" => "EXDOSFRM",
            "EX_20_2011-10-24" => "",
            "EX_22_2011-10-24" => "EXLOC",
            "EX_23_2011-10-24" => "",
            "EX_25_2011-10-24" => "",
            "EX_27_2011-10-24" => "EXTPT",
            "EX_28_2011-10-24" => "",
            "EX_29_2011-10-24" => ""
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.

        $cdashTable = array(
            "EXYN" => "EXOCCUR",
            "EXSTDAT" => "EXSTDTC",
            "EXSTTIM" => "EXSTDTC",
            "EXSTDTC" => "EXSTDTC",
            "EXREFID" => "EXREFID",
            "EXENDAT" => "EXENDTC",
            "EXENTIM" => "EXENDTC",
            "EXENDTC" => "EXENDTC",
            "EXDSTXT" => "EXDOST or EXDOSTXT",
            "EXLOT" => "EXLOT",
            "EXKIT" => "",
            "EXTRT" => "EXTRT",
            "EXDOSADJ" => "",
            "EXADJ" => "EXADJ",
            "EXDOSFRQ" => "EXDOSFRQ",
            "EXROUTE" => "EXROUTE",
            "EXDOSFRM" => "EXDOSFRM",
            "EXINTRP" => "",
            "EXLOC" => "EXLOC",
            "EXVAMT" => "",
            "EXFLRT" => "",
            "EXTPT" => "EXTPT",
            "EXMEDCMP" => "",
            "EXPDOSE" => ""
        );

        return $cdashTable;
    }
}