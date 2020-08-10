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

class SU
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "SU_1_2011-10-24" => "SUTRT",
            "SU_2_2011-10-24" => "",
            "SU_3_2011-10-24" => "SUCAT",
            "SU_4_2011-10-24" => "SUDOSTXT or SUDOSE",
            "SU_5_2011-10-24" => "SUDOSU",
            "SU_6_2011-10-24" => "SUDOSFRQ",
            "SU_7_2011-10-24" => "SUSTDTC",
            "SU_8_2011-10-24" => "SUENDTC",
            "SU_9_2011-10-24" => "SUDUR",
            "SU_10_2011-10-24" => "",
            "SU_11_2011-10-24" => "SUDOSTXT",
            "SU_12_2011-10-24" => "SUSTDTC",
            "SU_13_2011-10-24" => "SUENDTC",
            "SU_14_2011-10-24" => "SUDUR",
            "SU_15_2011-10-24" => "",
            "SU_16_2011-10-24" => "SUDOSTXT",
            "SU_17_2011-10-24" => "SUSTDTC",
            "SU_18_2011-10-24" => "SUENDTC",
            "SU_19_2011-10-24" => "SUDUR",
            "SU_20_2011-10-24" => "",
            "SU_21_2011-10-24" => "SUDOSTXT",
            "SU_22_2011-10-24" => "SUDOSFRQ",
            "SU_23_2011-10-24" => "SUDOSTXT",
            "SU_24_2011-10-24" => "SUDOSFRQ",
            "SU_25_2011-10-24" => "SUDOSTXT",
            "SU_26_2011-10-24" => "SUDOSFRQ",
            "SU_27_2011-10-24" => "SUSTDTC",
            "SU_28_2011-10-24" => "SUENDTC",
            "SU_29_2011-10-24" => "SUDUR"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "SUTRT" => "SUTRT",
            "SUNCF" => "",
            "SUCAT" => "SUCAT",
            "SUDSTXT" => "SUDOSTXT or SUDOSE",
            "SUDOSU" => "SUDOSU",
            "SUDOSFRQ" => "SUDOSFRQ",
            "SUSTDAT" => "SUSTDTC",
            "SUENDAT" => "SUENDTC",
            "SUCDUR+SUCDURU" => "SUDUR",
            "TOBACCO.CIGARETTES.SUNCF" => "",
            "TOBACCO.CIGARETTES.SUDSTXT" => "SUDOSTXT",
            "TOBACCO.CIGARETTES.SUSTDAT" => "SUSTDTC",
            "TOBACCO.CIGARETTES.SUENDAT" => "SUENDTC",
            "TOBACCO.CIGARETTES.SUCDUR" => "SUDUR",
            "TOBACCO.CIGARS.SUNCF" => "",
            "TOBACCO.CIGARS.SUDSTXT" => "SUDOSTXT",
            "TOBACCO.CIGARS.SUSTDAT" => "SUSTDTC",
            "TOBACCO.CIGARS.SUENDAT" => "SUENDTC",
            "TOBACCO.CIGARS.SUCDUR" => "SUDUR",
            "ALCOHOL.SUNCF" => "",
            "ALCOHOL.BEER.SUDSTXT" => "SUDOSTXT",
            "ALCOHOL.BEER.SUDOSFRQ" => "SUDOSFRQ",
            "ALCOHOL.WINE.SUDSTXT" => "SUDOSTXT",
            "ALCOHOL.WINE.SUDOSFRQ" => "SUDOSFRQ",
            "ALCOHOL.SPIRITS.SUDSTXT" => "SUDOSTXT",
            "ALCOHOL.SPIRITS.SUDOSFRQ" => "SUDOSFRQ",
            "ALCOHOL.SUSTDAT" => "SUSTDTC",
            "ALCOHOL.SUENDAT" => "SUENDTC",
            "ALCOHOL.SUCDUR" => "SUDUR"
        );

        return $cdashTable;
    }
}