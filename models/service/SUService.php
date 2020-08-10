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
require_once __DIR__.'/../entity/SUDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';
class SUService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr, $dataArr)
    {
        $suDomain = new SUDomain();
        $suTable = $suDomain->cdashTable;
        if($suDomain->isGetFromFile) {
            array_pop($suTable);
        }


        $commonDomain = new CommonDomain();
        $commonTable = $commonDomain->cdashTable;
        if($commonDomain->isGetFromFile) {
            array_pop($commonTable);
        }

        $sdtmTable = array();
        $nonMapTable = array();
        $nonMapTitles = array();
        $newDataTable = array();
        $deleteDataTable = array();

        $this->TimeDataOperation($titleArr, $dataArr);

        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];
            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if (!key_exists($cdashVal, $suTable) && !key_exists($cdashVal, $commonTable)) {
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }
            else if(!key_exists($cdashVal, $suTable) && key_exists($cdashVal, $commonTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable) && key_exists($cdashVal, $suTable)) {
                if($suTable[$cdashVal] != "") {
                    array_push($sdtmTable, $suTable[$cdashVal]);

                }
                else {
                    array_push($nonMapTable,$i);
                    array_push($nonMapTitles,$cdashVal);
                }
            }
        }
        array_push($sdtmTable, "SUDY");

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
        $userService->RealSaveFunction($sdtmStr, $newDataTable,
            $nonMapTitleStr, $deleteDataTable, $suDomain->domainName);
/*        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);*/
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $stDatLoc = array_search("SUSTDAT",$this->titleArr);
        $enDatLoc = array_search("SUENDAT",$this->titleArr);

        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];
            $stDtc = $tempArr[$stDatLoc];
            $enDtc = $tempArr[$enDatLoc];
            $suDays = $this->diffBetweenTwoDays($stDtc,$enDtc);
            array_push($tempArr, $suDays);

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
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-SU(Submit Version).csv";
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
        $fileName = "SDTM-SU(with deleted data).csv";
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