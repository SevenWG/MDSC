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

class DM
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "DM_1_2011-10-24" => "BRTHDTC",
            "DM_2_2011-10-24" => "BRTHDTC",
            "DM_3_2011-10-24" => "BRTHDTC",
            "DM_4_2011-10-24" => "BRTHDTC",
            "DM_5_2011-10-24" => "BRTHDTC",
            "DM_6_2011-10-24" => "BRTHDTC",
            "DM_7_2011-10-24" => "AGE+AGEU",
            "DM_8_2011-10-24" => "AGE",
            "DM_9_2011-10-24" => "AGEU",
            "DM_10_2011-10-24" => "DMDTC",
            "DM_11_2011-10-24" => "SEX",
            "DM_12_2011-10-24" => "ETHNIC",
            "DM_13_2011-10-24" => "RACE",
            "DM_14_2011-10-24" => "SUPPDM.QNAM",
            "DM_15_2011-10-24" => "SUPPDM.QNAM",
            "DM_16_2011-10-24" => "SUPPDM.QNAM",
            "DM_17_2011-10-24" => "SUPPDM.QNAM",
            "DM_18_2011-10-24" => "SUPPDM.QNAM",
            "DM_19_2011-10-24" => "SUPPDM.QNAM"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "BRTHDTC" => "BRTHDTC",
            "BRTHDAT" => "BRTHDTC",
            "BRTHYR" => "BRTHDTC",
            "BRTHMO" => "BRTHDTC",
            "BRTHDY" => "BRTHDTC",
            "BRTHTIM" => "BRTHDTC",
            "AGE" => "AGE+AGEU",
            "AGE-AGEU" => "AGE",
            "AGEU" => "AGEU",
            "DMDAT" => "DMDTC",
            "SEX" => "SEX",
            "ETHNIC" => "ETHNIC",
            "RACE" => "RACE",
            "RACEOTH" => "SUPPDM.QNAM",
            "RACE.AMERICAN_INDIAN_OR_ALASKA_NATIVE" => "SUPPDM.QNAM",
            "RACE.ASIAN" => "SUPPDM.QNAM",
            "RACE.BLACK_OR_AFRICAN_AMERICAN" => "SUPPDM.QNAM",
            "RACE.NATIVE_HAWAIIAN_OR_OTHER_PACIFIC_ISLANDER" => "SUPPDM.QNAM",
            "RACE.WHITE" => "SUPPDM.QNAM",
            "DTHDTC" => "DTHDTC"
        );

        return $cdashTable;
    }
}