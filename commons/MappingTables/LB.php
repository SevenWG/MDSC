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

class LB
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "LB_1_2011-10-24" => "LBSTAT",
            "LB_2_2011-10-24" => "LBDTC",
            "LB_3_2011-10-24" => "LBDTC",
            "LB_4_2011-10-24" => "LBDTC",
            "LB_5_2011-10-24" => "LBCAT",
            "LB_6_2011-10-24" => "LBSCAT",
            "LB_7_2011-10-24" => "LBTPT",
            "LB_8_2011-10-24" => "",
            "LB_9_2011-10-24" => "",
            "LB_10_2011-10-24" => "LBREFID",
            "LB_11_2011-10-24" => "LBSPCCND",
            "LB_12_2011-10-24" => "LBTEST",
            "LB_13_2011-10-24" => "LBORRES",
            "LB_14_2011-10-24" => "LBORRESU",
            "LB_15_2011-10-24" => "LBORRESU",
            "LB_16_2011-10-24" => "LBORRESU",
            "LB_17_2011-10-24" => "LBORRESU",
            "LB_18_2011-10-24" => "LBORRESU",
            "LB_19_2011-10-24" => "LBORRESU",
            "LB_20_2011-10-24" => "LBORRESU",
            "LB_21_2011-10-24" => "LBORRESU",
            "LB_22_2011-10-24" => "LBORNRLO",
            "LB_23_2011-10-24" => "LBORNRHI",
            "LB_24_2011-10-24" => "LBNRIND",
            "LB_25_2011-10-24" => "SUPPLB.QNAM",
            "LB_26_2011-10-24" => "LBNAM",
            "" => "LBTESTCD"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "LBPERF" => "LBSTAT",
            "LBDAT" => "LBDTC",
            "LBTIM" => "LBDTC",
            "LBDTC" => "LBDTC",
            "LBCAT" => "LBCAT",
            "LBSCAT" => "LBSCAT",
            "LBTPT" => "LBTPT",
            "LBCOND" => "",
            "FASTING.LBCOND" => "",
            "LBREFID" => "LBREFID",
            "LBSPCCND" => "LBSPCCND",
            "LBTEST" => "LBTEST",
            "LBORRES" => "LBORRES",
            "LBORRESU" => "LBORRESU",
            "LBORRESU.LB_UNIT_x10E9/L" => "LBORRESU",
            "LBORRESU.LB_UNIT_x10E12/L" => "LBORRESU",
            "LBORRESU.LB_UNIT_mmol/L" => "LBORRESU",
            "LBORRESU.LB_UNIT_fmol" => "LBORRESU",
            "LBORRESU.LB_UNIT_%" => "LBORRESU",
            "LBORRESU.LB_UNIT_fL" => "LBORRESU",
            "LBORRESU.LB_UNIT_nmol/L" => "LBORRESU",
            "LBORNRLO" => "LBORNRLO",
            "LBORNRHI" => "LBORNRHI",
            "LBNRIND" => "LBNRIND",
            "LBCLSIG" => "SUPPLB.QNAM",
            "LBNAM" => "LBNAM",
            "LBTESTCD" => "LBTESTCD"
        );

        return $cdashTable;
    }
}