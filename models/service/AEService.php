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
require_once __DIR__.'/../entity/AEDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';
class AEService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr,$dataArr)
    {

        $aeDomain = new AEDomain();
        $aeTable = $aeDomain->cdashTable;
        if($aeDomain->isGetFromFile) {
            array_pop($aeTable);
        }

        $commonDomain = new CommonDomain();
        $commonTable = $commonDomain->cdashTable;
        if($commonDomain->isGetFromFile) {
            array_pop($commonTable);
        }

        $sdtmTable = array();
        $nonMapTable = array();
        $newDataTable = array();
        $nonMapTitles = array();
        $deleteDataTable = array();

        $specialSTVars = array("AESTDTC", "AESTDAT", "AESTTIM"); $StFlag = false;
        $specialENVars = array("AEENDTC", "AEENDAT", "AEENTIM"); $EnFlag = false;


        $this->TimeDataOperation($titleArr,$dataArr);
        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];
            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $aeTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable)) {
                if($aeTable[$cdashVal] != "") {
                    if(!in_array($cdashVal, $specialSTVars) && !in_array($cdashVal, $specialENVars)) {
                        array_push($sdtmTable, $aeTable[$cdashVal]);
                    }
                    else{
                        if(in_array($cdashVal, $specialSTVars) && $StFlag == false) {
                            $StFlag = true;
                            array_push($sdtmTable, $aeTable[$cdashVal]);
                        }

                        if(in_array($cdashVal, $specialENVars) && $EnFlag == false) {
                            $EnFlag = true;
                            array_push($sdtmTable, $aeTable[$cdashVal]);
                        }
                    }
                }
                else {
                    array_push($nonMapTable,$i);
                    array_push($nonMapTitles,$cdashVal);
                }
            }
        }

        array_push($sdtmTable, "AEDY");

        $sdtmStr = implode(",", $sdtmTable);
        $nonMapTitleStr = implode(",", $nonMapTitles);

        for ($i = 0; $i < count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];
            $deleteDataArr = array();
            for($j = 0; $j < count($nonMapTable); $j++) {
                $deleteVal = $nonMapTable[$j];

                array_push($deleteDataArr,$tempArr[$deleteVal]);

                unset($tempArr[$deleteVal]);
            }
            $tempArr = array_values($tempArr);

            $dataStr = implode(",", $tempArr);
            $deleteDataStr =implode(",",$deleteDataArr);

            array_push($newDataTable,$dataStr);
            array_push($deleteDataTable,$deleteDataStr);
        }

        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $stDtcLoc = array_search("AESTDTC",$this->titleArr);
        $stDatLoc = array_search("AESTDAT",$this->titleArr);
        $stTimLoc = array_search("AESTTIM",$this->titleArr);

        $enDtcLoc = array_search("AEENDTC",$this->titleArr);
        $enDatLoc = array_search("AEENDAT",$this->titleArr);
        $enTimLoc = array_search("AEENTIM",$this->titleArr);

        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];

            if($tempArr[$stDtcLoc] != "") {
                unset($tempArr[$stDatLoc]);
                unset($tempArr[$stTimLoc]);
                $stDtc = $tempArr[$stDtcLoc];
            }else {
                $tempArr[$stDatLoc] = $tempArr[$stDatLoc]." ".$tempArr[$stTimLoc];
                unset($tempArr[$stDtcLoc]);
                unset($tempArr[$stTimLoc]);
                $stDtc = $tempArr[$stDatLoc];
            }

            if($tempArr[$enDtcLoc] != "") {
                unset($tempArr[$enDatLoc]);
                unset($tempArr[$enTimLoc]);
                $enDtc = $tempArr[$enDtcLoc];
            }else {
                $tempArr[$enDatLoc] = $tempArr[$enDatLoc]." ".$tempArr[$enTimLoc];
                unset($tempArr[$enDtcLoc]);
                unset($tempArr[$enTimLoc]);
                $enDtc = $tempArr[$enDatLoc];
            }

            $days = $this->diffBetweenTwoDays($stDtc,$enDtc);
            array_push($tempArr,$days);
            $this->dataArr[$i] = $tempArr;
        }
    }

    function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);

        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        $uaccount = $_SESSION['uaccount'];
        $userid = $_SESSION['userid'];
        $time = date("Y-m-d-h-i-s");

        $op = "\r\n";
        $fileName = $uaccount."-".$time."-"."SDTM-AE(Submit Verison).csv";
        $path = "../../files1/".$uaccount;

        if(!file_exists($path)) {
            mkdir($path);
        }

        $path = "../../files1/".$uaccount."/".$fileName;
        $file = fopen($path, "w");

        fwrite($file, $sdtmStr);
        fwrite($file, $op);
        foreach ($newDataTable as $item) {
            fwrite($file, $item);
            fwrite($file, $op);
        }

        $newFile = fopen($path,"r");
        $content = file_get_contents($path);
        $userService = new userService();
        $userService->uploadSdtmFile($content,$fileName,$userid);
    }

    public function SaveFile1($sdtmStr, $newDataTable, $nonMapTitleStr, $deleteDataTable)
    {
        $uaccount = $_SESSION['uaccount'];
        $userid = $_SESSION['userid'];
        $time = date("Y-m-d-h-i-s");

        $op = "\r\n";
        $fileName = $uaccount."-".$time."-"."SDTM-AE(with deleted data).csv";
        $path = "../../files1/".$uaccount;

        if(!file_exists($path)) {
            mkdir($path);
        }

        $path = "../../files1/".$uaccount."/".$fileName;
        $file = fopen($path, "w");

        fwrite($file, $sdtmStr);
        fwrite($file, $op);
        foreach ($newDataTable as $item) {
            fwrite($file, $item);
            fwrite($file, $op);
        }
        fwrite($file,"Deleted Data:");
        fwrite($file, $op);
        fwrite($file, $nonMapTitleStr);
        fwrite($file, $op);
        foreach ($deleteDataTable as $i) {
            fwrite($file, $i);
            fwrite($file, $op);
        }

        $newFile = fopen($path,"r");
        $content = file_get_contents($path);

        $userService = new userService();
        $userService->uploadSdtmFile($content,$fileName,$userid);
    }
}