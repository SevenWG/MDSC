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
require_once __DIR__.'/../entity/VSDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';
class VSService
{
    private $TestcdArr = ['PLUSE', 'HEIGHT', 'WEIGHT', 'DIABP', 'FRMSIZE', 'SYSBP', 'TEMP'];
    private $TestcdUnitArr = ['PLUSEU', 'HEIGHTU', 'WEIGHTU', 'DIABPU', 'FRMSIZEU', 'SYSBPU', 'TEMPU'];
    private $inputArr = ['VSTESTCD', 'VSTEST', 'VSORRES', 'VSORRESU'];
    private $speacilVarArr = [];
    private $titleArr;
    private $dataArr;
    private $newDataArr = array();
    private $beginLoc;
    private $endLoc;

    public function TitleOperation($titleArr)
    {
        $flag = 0;
        $this->titleArr = $titleArr;
        $deleteNums = array();
        foreach ($this->titleArr as $i =>$val) {
            if(in_array($this->titleArr[$i], $this->TestcdArr)||in_array($this->titleArr[$i], $this->TestcdUnitArr)) {
               if($flag == 0) {
                    $this->speacilVarArr[$i] = $this->titleArr[$i];
                    $flag = $i;
                    $this->beginLoc = $i;
                }
                else {
                    $this->speacilVarArr[$i] = $this->titleArr[$i];
                }
                array_push($deleteNums, $i);
            }

        }
        for($j = 0; $j < count($deleteNums); $j++) {
            $deleteNum = $deleteNums[$j];
            unset($this->titleArr[$deleteNum]);
        }
        array_splice($this->titleArr, $flag, 0, $this->inputArr);
    }

    public function dataOperation($dataArr)
    {
        $this->dataArr = $dataArr;
        $countFlag = 0;
        $keys = array_keys($this->speacilVarArr);
        $this->endLoc = $keys[count($this->speacilVarArr)-1];

        foreach ($this->dataArr as $temp) {

            $Loc = $this->beginLoc;

            if ($countFlag < count($this->dataArr)-1){
                for ($k = 0; $k < count($this->speacilVarArr); $k = $k+2) {
                    $tempVar = $k;
                    $newTemp = $temp;
                    $beginKey = $keys[$tempVar];
                    $endKey = $keys[$tempVar+1];
                    if ($beginKey == $this->beginLoc) {
                        array_splice($newTemp, $endKey+1, $this->endLoc-$endKey);
                    }
                    else if ($beginKey != $this->beginLoc) {
                        array_splice($newTemp, $this->beginLoc, $beginKey-$this->beginLoc);
                        array_splice($newTemp, $endKey+1-$k, $this->endLoc-$endKey);
                    }
                    else if ($endKey == $this->endLoc) {
                        array_splice($newTemp, $this->beginLoc, $beginKey-$this->beginLoc);
                    }
                    $arr = array($this->speacilVarArr[$Loc],$this->speacilVarArr[$Loc]);
                    $Loc = $Loc+2;
                    array_splice($newTemp, $this->beginLoc, 0, $arr);
                    array_push($this->newDataArr, $newTemp);
                }
            }

            $countFlag++;
        }
    }

    public function TimeDataOperation($titleArr, $dataArr)
    {
        $this->titleArr = $titleArr;
        $this->newDataArr = $dataArr;
        $DtcLoc = array_search("VSDTC",$this->titleArr);
        $DatLoc = array_search("VSDAT",$this->titleArr);
        $TimLoc = array_search("VSTIM",$this->titleArr);
        for ($i = 0; $i <count($this->newDataArr); $i++) {
            $tempArr = $this->newDataArr[$i];
            if($tempArr[$DtcLoc] != "") {
                unset($tempArr[$DatLoc]);
                unset($tempArr[$TimLoc]);
            }else {
                $tempArr[$DatLoc] = $tempArr[$DatLoc]." ".$tempArr[$TimLoc];
                unset($tempArr[$DtcLoc]);
                unset($tempArr[$TimLoc]);
            }
            array_values($tempArr);
            $this->newDataArr[$i] = $tempArr;
        }
    }

    public function Transform($titleArr, $dataArr)
    {
        $this->TitleOperation($titleArr);
        $this->dataOperation($dataArr);

        $vsDomain = new VSDomain();
        $vsTable = $vsDomain->cdashTable;
        if($vsDomain->isGetFromFile) {
            array_pop($vsTable);
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

        $specialVars = array("VSDTC", "VSDAT", "VSTIM"); $VSFlag = false;

        $this->TimeDataOperation($this->titleArr,$this->newDataArr);

        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];

            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $vsTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable)) {
                if($vsTable[$cdashVal] !="" ){
                    if(!in_array($cdashVal, $specialVars)) {
                        array_push($sdtmTable, $vsTable[$cdashVal]);
                    }
                    else {
                        if (in_array($cdashVal, $specialVars) && $VSFlag == false) {
                            $VSFlag = true;
                            array_push($sdtmTable, $vsTable[$cdashVal]);
                        }
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

        for ($i = 0; $i < count($this->newDataArr); $i++) {
            $tempArr = $this->newDataArr[$i];
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
            $nonMapTitleStr, $deleteDataTable, $vsDomain->domainName);

    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-VS(Submit Version).csv";
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
        $fileName = "SDTM-VS(with deleted data).csv";
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