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

class CM
{
    public function getOdmTable()
    {
        $odmTable = array(
            "CM_1_2011-10-24" => "",
            "CM_2_2011-10-24" => "CMSPID",
            "CM_3_2011-10-24" => "CMTRT",
            "CM_4_2011-10-24" => "CMOCCUR",
            "CM_5_2011-10-24" => "",
            "CM_6_2011-10-24" => "CMINDC",
            "CM_7_2011-10-24" => "",
            "CM_8_2011-10-24" => "",
            "CM_9_2011-10-24" => "CMDOSE+CMDOSU",
            "CM_10_2011-10-24" => "CMDOSTXT",
            "CM_11_2011-10-24" => "CMDOSTRT",
            "CM_13_2011-10-24" => "CMDOSFRM",
            "CM_14_2011-10-24" => "CMDOSFRQ",
            "CM_15_2011-10-24" => "CMROUTE",
            "CM_16_2011-10-24" => "CMSTDTC",
            "CM_17_2011-10-24" => "CMSTDTC",
            "CM_18_2011-10-24" => "CMSTDTC",
            "CM_19_2011-10-24" => "CMSTRF",
            "CM_20_2011-10-24" => "CMENDTC",
            "CM_21_2011-10-24" => "CMENDTC",
            "CM_22_2011-10-24" => "CMENDTC",
            "CM_23_2011-10-24" => "CMENRF",
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        $cdashTable = array(
            "CMYN" => "",
            "CMSPID" => "CMSPID",
            "CMTRT" => "CMTRT",
            "CMOCCUR" => "CMOCCUR",
            "CMINGRD" => "",
            "CMINDC" => "CMINDC",
            "CMAENO" => "",
            "CMMHNO" => "",
            "CMDOSE" => "CMDOSE+CMDOSU",
            "CMDOSTXT" => "CMDOSTXT",
            "CMDOSTOT" => "CMDOSTRT",
            "CMDOSFRM" => "CMDOSFRM",
            "CMDOSFRQ" => "CMDOSFRQ",
            "CMROUTE" => "CMROUTE",
            "CMSTDTC" => "CMSTDTC",
            "CMSTDAT" => "CMSTDTC",
            "CMSTTIM" => "CMSTDTC",
            "CMPRIOR" => "CMSTRF",
            "CMENDTC" => "CMENDTC",
            "CMENDAT" => "CMENDTC",
            "CMENTIM" => "CMENDTC",
            "CMONGO" => "CMENRF",
        );
        return $cdashTable;
    }
}