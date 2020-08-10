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

class AE
{
    public function getOdmTable()
    {
        $odmTable = array(
            "AE_1_2011-10-24" => "",
            "AE_2_2011-10-24" => "AESPID",
            "AE_3_2011-10-24" => "AETERM",
            "AE_4_2011-10-24" => "",
            "AE_5_2011-10-24" => "AESTDTC",
            "AE_6_2011-10-24" => "AESTDTC",
            "AE_7_2011-10-24" => "AESTDTC",
            "AE_8_2011-10-24" => "AEENDTC",
            "AE_9_2011-10-24" => "AEENDTC",
            "AE_10_2011-10-24" => "AEENDTC",
            "AE_11_2011-10-24" => "AEENRF",
            "AE_12_2011-10-24" => "AESEV",
            "AE_13_2011-10-24" => "AETOXGR",
            "AE_14_2011-10-24" => "AESER",
            "AE_15_2011-10-24" => "AESCONG",
            "AE_16_2011-10-24" => "AESDISAB",
            "AE_17_2011-10-24" => "AESDTH",
            "AE_18_2011-10-24" => "AESHOSP",
            "AE_19_2011-10-24" => "AESLIFE",
            "AE_20_2011-10-24" => "AESMIE",
            "AE_21_2011-10-24" => "AEREL",
            "AE_22_2011-10-24" => "AEACN",
            "AE_23_2011-10-24" => "AEACNOTH",
            "AE_24_2011-10-24" => "AEOUT",
            "AE_25_2011-10-24" => "",
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        $cdashTable = array(
            "AEYN" => "",
            "AESPID" => "AESPID",
            "AETERM" => "AETERM",
            "AEOCCUR" => "",
            "AESTDTC" => "AESTDTC",
            "AESTDAT" => "AESTDTC",
            "AESTTIM" => "AESTDTC",
            "AEENDTC" => "AEENDTC",
            "AEENDAT" => "AEENDTC",
            "AEENTIM" => "AEENDTC",
            "AEONGO" => "AEENRF",
            "AESEV" => "AESEV",
            "AETOXGR" => "AETOXGR",
            "AESER" => "AESER",
            "AESCONG" => "AESCONG",
            "AESDISAB" => "AESDISAB",
            "AESDTH" => "AESDTH",
            "AESHOSP" => "AESHOSP",
            "AESLIFE" => "AESLIFE",
            "AESMIE" => "AESMIE",
            "AEREL" => "AEREL",
            "AEACN" => "AEACN",
            "AEACNOTH" => "AEACNOTH",
            "AEOUT" => "AEOUT",
            "AEDIS" => "",
        );

        return $cdashTable;
    }
}