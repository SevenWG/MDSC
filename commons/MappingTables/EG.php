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

class EG
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "EG_1_2011-10-24" => "EGSTAT",
            "EG_2_2011-10-24" => "EGREFID",
            "EG_3_2011-10-24" => "EGMETHOD",
            "EG_4_2011-10-24" => "EGPOS",
            "EG_5_2011-10-24" => "EGDTC",
            "EG_6_2011-10-24" => "EGTPT",
            "EG_7_2011-10-24" => "EGDTC",
            "EG_8_2011-10-24" => "EGDTC",
            "EG_9_2011-10-24" => "EGTEST",
            "EG_10_2011-10-24" => "EGORRES",
            "EG_12_2011-10-24" => "SUPPEG.QNAM",
            "EG_13_2011-10-24" => "EGORRES+EGORRESU",
            "EG_14_2011-10-24" => "SUPPEG.QNAM",
            "EG_15_2011-10-24" => "EGORRES+EGORRESU",
            "EG_16_2011-10-24" => "SUPPEG.QNAM",
            "EG_17_2011-10-24" => "EGORRES+EGORRESU",
            "EG_18_2011-10-24" => "SUPPEG.QNAM",
            "EG_19_2011-10-24" => "EGORRES+EGORRESU",
            "EG_20_2011-10-24" => "SUPPEG.QNAM",
            "EG_21_2011-10-24" => "EGORRES+EGORRESU",
            "EG_22_2011-10-24" => "SUPPEG.QNAM",
            "EG_23_2011-10-24" => "EGORRES+EGORRESU",
            "EG_24_2011-10-24" => "SUPPEG.QNAM"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "EGPERF" => "EGSTAT",
            "EGTESTCD" => "EGTESTCD",
            "EGREFID" => "EGREFID",
            "EGMETHOD" => "EGMETHOD",
            "EGPOS" => "EGPOS",
            "EGDAT" => "EGDTC",
            "EGTPT" => "EGTPT",
            "EGTIM" => "EGDTC",
            "EGDTC" => "EGDTC",
            "EGTEST" => "EGTEST",
            "EGORRES" => "EGORRES",
            "EGCLSIG" => "SUPPEG.QNAM",
            "EGORRES+EGORRESU" => "EGORRES+EGORRESU",
            "SUPPEG.QNAM" => "SUPPEG.QNAM",
            "VRMEAN.EGORRESE" => "EGORRES+EGORRESU",
            "VRMEAN.EGCLSIG" => "SUPPEG.QNAM",
            "PRMEAN.EGORRESE" => "EGORRES+EGORRESU",
            "PRMEAN.EGCLSIG" => "SUPPEG.QNAM",
            "QRSDUR.EGORRESE" => "EGORRES+EGORRESU",
            "QRSDUR.EGCLSIG" => "SUPPEG.QNAM",
            "QTMEAN.EGORRESE" => "EGORRES+EGORRESU",
            "QTMEAN.EGCLSIG" => "SUPPEG.QNAM",
            "QTCB.EGORRESE" => "EGORRES+EGORRESU",
            "QTCB.EGCLSIG" => "SUPPEG.QNAM",
            "INTRP.EGORRESE" => "EGORRES+EGORRESU",
            "INTRP.EGCLSIG" => "SUPPEG.QNAM",
        );

        return $cdashTable;
    }
}