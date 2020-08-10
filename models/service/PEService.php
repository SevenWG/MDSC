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
require_once __DIR__.'/../entity/PEDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';

class PEService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr,$dataArr)
    {
        $peDomain = new PEDomain();
        $peTable = $peDomain->cdashTable;
        if($peDomain->isGetFromFile) {
            array_pop($peTable);
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

        $specialVars = array("PEDAT", "PETIM", "PEDTC"); $peFlag = false;

        $this->TimeDataOperation($titleArr,$dataArr);

        foreach ($this->titleArr as $i => $val) {

            $cdashVal = $this->titleArr[$i];

            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }

            else if(!key_exists($cdashVal, $peTable) && !key_exists($cdashVal, $commonTable)) {
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }

            else if(!key_exists($cdashVal, $peTable) && key_exists($cdashVal, $commonTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }

            else if(!key_exists($cdashVal, $commonTable) && key_exists($cdashVal, $peTable)) {
                if($peTable[$cdashVal] != "") {
                    if(!in_array($cdashVal, $specialVars)) {
                        array_push($sdtmTable, $peTable[$cdashVal]);
                    }
                    else if(in_array($cdashVal, $specialVars) && $peFlag == false) {
                        $peFlag = true;
                        array_push($sdtmTable, $peTable[$cdashVal]);
                    }
                }
                else {
                    array_push($nonMapTable,$i);
                    array_push($nonMapTitles,$cdashVal);
                }
            }

        }
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

/*        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable, $nonMapTitleStr, $deleteDataTable);*/
        $userService = new userService();
        $userService->RealSaveFunction($sdtmStr, $newDataTable,
            $nonMapTitleStr, $deleteDataTable, $peDomain->domainName);
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $lbDtcLoc = array_search("PEDTC",$this->titleArr);
        $lbDatLoc = array_search("PEDAT",$this->titleArr);
        $lbTimLoc= array_search("PETIM",$this->titleArr);

        if($lbDtcLoc == false ) {
            for ($i = 0; $i <count($this->dataArr)-1; $i++) {
                $tempArr = $this->dataArr[$i];

                $lbDat = $tempArr[$lbDatLoc];
                $lbTim = $tempArr[$lbTimLoc];

                $tempArr[$lbDatLoc] = $lbDat." ".$lbTim;
                unset($tempArr[$lbTimLoc]);
                array_values($tempArr);
                $this->dataArr[$i] = $tempArr;
            }
        }
        else {
            if($lbDatLoc == false && $lbTimLoc == false) {
                //do noting
            }
            else if($lbDatLoc != false && $lbTimLoc != false) {

                for ($i = 0; $i <count($this->dataArr)-1; $i++) {

                    $tempArr = $this->dataArr[$i];

                    if($tempArr[$lbDtcLoc] == "") {
                        $lbDat = $tempArr[$lbDatLoc];
                        $lbTim = $tempArr[$lbTimLoc];
                        $tempArr[$lbDatLoc] = $lbDat." ".$lbTim;

                        unset($tempArr[$lbTimLoc]);
                        unset($tempArr[$lbDtcLoc]);

                        array_values($tempArr);
                        $this->dataArr[$i] = $tempArr;
                    }
                    else {
                        unset($tempArr[$lbTimLoc]);
                        unset($tempArr[$lbDatLoc]);

                        array_values($tempArr);
                        $this->dataArr[$i] = $tempArr;
                    }
                }
            }
        }
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-PE(Submit Version).csv";
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
        $fileName = "SDTM-PE(with deleted data).csv";
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