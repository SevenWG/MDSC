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

class PE
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "PE_1_2011-10-24" => "",
            "PE_2_2011-10-24" => "PEDTC",
            "PE_3_2011-10-24" => "PEDTC",
            "PE_4_2011-10-24" => "PEDTC",
            "PE_5_2011-10-24" => "PESPID",
            "PE_6_2011-10-24" => "PETEST",
            "PE_7_2011-10-24" => "PEORRES",
            "PE_8_2011-10-24" => "PEORRES",
            "PE_9_2011-10-24" => "",
            "PE_10_2011-10-24" => "PEEVAL"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.

        $cdashTable = array(
            "PEPERF" => "",
            "PEDAT" => "PEDTC",
            "PETIM" => "PEDTC",
            "PEDTC" => "PEDTC",
            "PESPID" => "PESPID",
            "PETEST" => "PETEST",
            "PEDESC" => "PEORRES",
            "PERES" => "PEORRES",
            "PECLSIG" => "",
            "PEEVAL" => "PEEVAL"
        );

        return $cdashTable;
    }

}