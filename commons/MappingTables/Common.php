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

class Common
{
    public function getOdmTable()
    {
        $odmTable = array(
            "Common_1_2011-10-24" => "",
            "Common_2_2011-10-24" => "STUDYID",
            "Common_3_2011-10-24" => "SITEID",
            "Common_4_2011-10-24" => "SUBJID",
            "Common_5_2011-10-24" => "USUBJID",
            "Common_6_2011-10-24" => "INVID",
            "Common_7_2011-10-24" => "VISIT",
            "Common_8_2011-10-24" => "VISDTC",
            "Common_9_2011-10-24" => "VISDTC",
            "Common_10_2011-10-24" => "",
            "Common_11_2011-10-24" => "VISDTC"
        );

        return $odmTable;
    }

    public function getCdashTable()
    {
        $cdashTable = array(
            "SPONSOR" => "",
            'STUDYID' => "STUDYID",
            "SITEID" => "SITEID",
            "SUBJID" => "SUBJID",
            "USUBJID" => "USUBJID",
            "INVID" => "INVID",
            "VISIT" => "VISIT",
            "VISDTC" => "VISDTC",
            "VISDAT" => "VISDTC",
            "VISENDAT" => "",
            "VISTIM" => "VISDTC"
        );

        return $cdashTable;
    }
}