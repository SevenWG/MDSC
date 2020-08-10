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
require_once __DIR__.'/../entity/CMDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';
class CMService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr,$dataArr)
    {

        $cmDomain = new CMDomain();
        $cmTable = $cmDomain->cdashTable;
        if($cmDomain->isGetFromFile) {
            array_pop($cmTable);
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

        $specialSTVars = array("CMSTDTC", "CMSTDAT", "CMSTTIM"); $StFlag = false;
        $specialENVars = array("CMENDTC", "CMENDAT", "CMENTIM"); $EnFlag = false;


        $this->TimeDataOperation($titleArr,$dataArr);

        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];
            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $cmTable) && !key_exists($cdashVal, $commonTable)) {
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }
            else if(!key_exists($cdashVal, $cmTable) && key_exists($cdashVal, $commonTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable) && key_exists($cdashVal, $cmTable)) {
                if($cmTable[$cdashVal] != "") {
                    if(!in_array($cdashVal, $specialSTVars) && !in_array($cdashVal, $specialENVars)) {
                        array_push($sdtmTable, $cmTable[$cdashVal]);
                    }
                    else{
                        if(in_array($cdashVal, $specialSTVars) && $StFlag == false) {
                            $StFlag = true;
                            array_push($sdtmTable, $cmTable[$cdashVal]);
                        }

                        if(in_array($cdashVal, $specialENVars) && $EnFlag == false) {
                            $EnFlag = true;
                            array_push($sdtmTable, $cmTable[$cdashVal]);
                        }
                    }
                }
                else {
                    array_push($nonMapTable,$i);
                    array_push($nonMapTitles,$cdashVal);
                }
            }
        }

        array_push($sdtmTable, "CMDY");


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

        $userService = new userService();
        $userService->RealSaveFunction($sdtmStr, $newDataTable, $nonMapTitleStr,
            $deleteDataTable, $cmDomain->domainName);
/*        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);*/
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $stDtcLoc = array_search("CMSTDTC",$this->titleArr);
        $stDatLoc = array_search("CMSTDAT",$this->titleArr);
        $stTimLoc = array_search("CMSTTIM",$this->titleArr);

        $enDtcLoc = array_search("CMENDTC",$this->titleArr);
        $enDatLoc = array_search("CMENDAT",$this->titleArr);
        $enTimLoc = array_search("CMENTIM",$this->titleArr);

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
            $tmp = $second2;$second2 = $second1;
            $second1 = $tmp;
        }
        return ($second1 - $second2) / 86400;
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-CM(Submit Version).csv";
        $path = "../../files1/".$fileName;

        $file = fopen($path, "w");

        fwrite($file, $sdtmStr);
        fwrite($file, $op);
        foreach ($newDataTable as $item) {
            fwrite($file, $item);
            fwrite($file, $op);
        }

        $newFile = fopen($path,"r");
        $content = file_get_contents($path);
        $userid = $_SESSION['userid'];
        $userService = new userService();
        $userService->uploadSdtmFile($content,$fileName,$userid);
    }

    public function SaveFile1($sdtmStr, $newDataTable, $nonMapTitleStr, $deleteDataTable)
    {
        $op = "\r\n";
        $fileName = "SDTM-CM(with deleted data).csv";
        $path = "../../files1/".$fileName;

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
        $userid = $_SESSION['userid'];
        $userService = new userService();
        $userService->uploadSdtmFile($content,$fileName,$userid);
    }
}