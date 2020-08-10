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

class SC extends MappingTable
{
    public function getOdmTable()
    {
        // TODO: Implement getOdmTable() method.
        // TODO: Implement getOdmTable() method.
        $odmTable = array(
            "SC_1_2011-10-24" => "",
            "SC_2_2011-10-24" => "SCTEST",
            "SC_3_2011-10-24" => "SCORRES",
            "SC_4_2011-10-24" => "SCORRES+SCORRESU",
            "SC_5_2011-10-24" => "SCORRES",
            "SC_6_2011-10-24" => "SCORRES",
            "SC_7_2011-10-24" => "SCORRES",
            "SC_8_2011-10-24" => "SCORRES"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        // TODO: Implement getCdashTable() method.
        $cdashTable = array(
            "SCPERF" => "",
            "SCTEST" => "SCTEST",
            "SCORRES" => "SCORRES",
            "GESTAGEB.SCORRES" => "SCORRES+SCORRESU",
            "CHBEARP.SCORRES" => "SCORRES",
            "EDLEVEL.SCORRES" => "SCORRES",
            "SKINCLAS.SCORRES" => "SCORRES",
            "MARISTAT.SCORRES" => "SCORRES"
        );
        return $cdashTable;
    }
}