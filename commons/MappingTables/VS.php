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

class VS
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "VS_1_2011-10-24" => "",
            "VS_2_2011-10-24" => "VSSTDTC",
            "VS_3_2011-10-24" => "VSSTDTC",
            "VS_4_2011-10-24" => "VSDTC",
            "VS_5_2011-10-24" => "VSSPID",
            "VS_6_2011-10-24" => "VSTPT",
            "VS_7_2011-10-24" => "VSTEST",
            "VS_8_2011-10-24" => "VSORRES",
            "VS_9_2011-10-24" => "VSORRESU",
            "VS_10_2011-10-24" => "SUPPVS.QNAM",
            "VS_11_2011-10-24" => "VSLOC",
            "VS_12_2011-10-24" => "VSPOS",
            "VS_13_2011-10-24" => "",
            "VS_14_2011-10-24" => "VSORRES+VSORRESU",
            "VS_15_2011-10-24" => "SUPPVS.QNAM",
            "VS_16_2011-10-24" => "",
            "VS_17_2011-10-24" => "VSORRES+VSORRESU",
            "VS_18_2011-10-24" => "SUPPVS.QNAM",
            "VS_19_2011-10-24" => "",
            "VS_20_2011-10-24" => "VSORRES+VSORRESU",
            "VS_21_2011-10-24" => "VSORRES+VSORRESU",
            "VS_22_2011-10-24" => "VSLOC",
            "VS_23_2011-10-24" => "VSPOS",
            "VS_24_2011-10-24" => "SUPPVS.QNAM",
            "VS_25_2011-10-24" => "VSSTDTC",
            "VS_26_2011-10-24" => "",
            "VS_27_2011-10-24" => "VSORRES+VSORRESU",
            "VS_28_2011-10-24" => "VSLOC",
            "VS_29_2011-10-24" => "VSPOS",
            "VS_30_2011-10-24" => "SUPPVS.QNAM",
            "VS_31_2011-10-24" => "",
            "VS_32_2011-10-24" => "VSORRES+VSORRESU",
            "VS_33_2011-10-24" => "VSLOC",
            "VS_34_2011-10-24" => "SUPPVS.QNAM",
            "VS_35_2011-10-24" => "",
            "VS_36_2011-10-24" => "VSORRES+VSORRESU",
            "" => "VSTESTCD"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "VSPERF" => "",
            "VSDAT" => "VSSTDTC",
            "VSTIM" => "VSSTDTC",
            "VSDTC" => "VSDTC",
            "VSSPID" => "VSSPID",
            "VSTPT" => "VSTPT",
            "VSTEST" => "VSTEST",
            "VSORRES" => "VSORRES",
            "VSORRESU" => "VSORRESU",
            "VSCLSIG" => "SUPPVS.QNAM",
            "VSLOC" => "VSLOC",
            "VSPOS" => "VSPOS",
            "HEIGHT.VSPERF" => "",
            "HEIGHT.VSORRES" => "VSORRES+VSORRESU",
            "HEIGHT.VSCLSIG" => "SUPPVS.QNAM",
            "WEIGHT.VSPERF" => "",
            "WEIGHT.VSORRES" => "VSORRES+VSORRESU",
            "WEIGHT.VSCLSIG" => "SUPPVS.QNAM",
            "BP.VSPERF" => "",
            "BP.SYSBP.VSORRES" => "VSORRES+VSORRESU",
            "BP.DIABP.VSORRES" => "VSORRES+VSORRESU",
            "BP.VSLOC" => "VSLOC",
            "BP.VSPOS" => "VSPOS",
            "BP.VSCLSIG" => "SUPPVS.QNAM",
            "BP.VSTIM" => "VSSTDTC",
            "PULSE.VSPERF" => "",
            "PULSE.VSORRES" => "VSORRES+VSORRESU",
            "PULSE.VSLOC" => "VSLOC",
            "PULSE.VSPOS" => "VSPOS",
            "PULSE.VSCLSIG" => "SUPPVS.QNAM",
            "TEMP.VSPERF" => "",
            "TEMP.VSORRES" => "VSORRES+VSORRESU",
            "TEMP.VSLOC" => "VSLOC",
            "TEMP.VSCLSIG" => "SUPPVS.QNAM",
            "FRMSIZE.VSPERF" => "",
            "FRMSIZE.VSORRES" => "VSORRES+VSORRESU",
            "VSTESTCD" => "VSTESTCD"
        );

        return $cdashTable;
    }
}