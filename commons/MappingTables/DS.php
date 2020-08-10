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

class DS
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "DS_1_2011-10-24" => "EPOCH",
            "DS_2_2011-10-24" => "DSDEDCOD",
            "DS_3_2011-10-24" => "DSTERM",
            "DS_4_2011-10-24" => "DSSTDTC",
            "DS_5_2011-10-24" => "DSSTDTC",
            "DS_6_2011-10-24" => "DSSTDTC",
            "DS_7_2011-10-24" => "",
            "DS_8_2011-10-24" => "",
            "DS_9_2011-10-24" => "",
            "DS_10_2011-10-24" => "DSSTDTC",
            "DS_11_2011-10-24" => "DSSTDTC",
            "DS_12_2011-10-24" => "DSDECOD",
            "DS_13_2011-10-24" => "DSTERM"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "EPOCH" => "EPOCH",
            "DSDECOD" => "DSDEDCOD",
            "DSTERM" => "DSTERM",
            "DSSTDAT" => "DSSTDTC",
            "DSSTTIM" => "DSSTDTC",
            "DSSTDTC" => "DSSTDTC",
            "DSUNBLND" => "",
            "DSCONT" => "",
            "DSNEXT" => "",
            "ENDOFSTUDY.DSSTDAT" => "DSSTDTC",
            "ENDOFSTUDY.DSSTTIM" => "DSSTDTC",
            "ENDOFSTUDY.DSDECODE" => "DSDECOD",
            "ENDOFSTUDY.DSTERM" => "DSTERM"
        );

        return $cdashTable;
    }
}