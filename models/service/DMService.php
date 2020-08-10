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
require_once __DIR__.'/../entity/DMDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';

class DMService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr,$dataArr)
    {

        $dmDomain = new DMDomain();
        $dmTable = $dmDomain->cdashTable;
        if($dmDomain->isGetFromFile) {
            array_pop($dmTable);
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

        $specialTimeVars = array("BRTHDTC", "BRTHDAT", "BRTHYR", "BRTHMO", "BRTHDY", "BRTHTIM"); $StFlag = false;
        $specialRaceVars = array("RACEOTH", "RACE.AMERICAN_INDIAN_OR_ALASKA_NATIVE",
            "RACE.BLACK_OR_AFRICAN_AMERICAN", "RACE.BLACK_OR_AFRICAN_AMERICAN",
            "RACE.NATIVE_HAWAIIAN_OR_OTHER_PACIFIC_ISLANDER", "RACE.WHITE", "RACE.ASIAN"); $EnFlag = false;


        $this->TimeDataOperation($titleArr,$dataArr);
        $this->RaceDataOperation();
        $this->DhdtcOperation();

        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];
            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $dmTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable)) {
                if($dmTable[$cdashVal] != "") {
                    if(!in_array($cdashVal, $specialTimeVars) && !in_array($cdashVal, $specialRaceVars)) {
                        array_push($sdtmTable, $dmTable[$cdashVal]);
                    }
                    else{
                        if(in_array($cdashVal, $specialTimeVars) && $StFlag == false) {
                            $StFlag = true;
                            array_push($sdtmTable, $dmTable[$cdashVal]);
                        }

                        if(in_array($cdashVal, $specialRaceVars) && $EnFlag == false) {
                            $EnFlag = true;
                            array_push($sdtmTable, $dmTable[$cdashVal]);
                        }
                    }
                }
                else {
                    array_push($nonMapTable,$i);
                    array_push($nonMapTitles,$cdashVal);
                }
            }
        }

        array_push($sdtmTable, "DTHFL");

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
            $deleteDataTable, $dmDomain->domainName);
/*        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);*/
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $DtcLoc = array_search("BRTHDTC",$this->titleArr);
        $DatLoc = array_search("BRTHDAT",$this->titleArr);
        $YrLoc = array_search("BRTHYR",$this->titleArr);
        $MoLoc = array_search("BRTHMO",$this->titleArr);
        $DyLoc = array_search("BRTHDY",$this->titleArr);
        $TimLoc = array_search("BRTHTIM",$this->titleArr);


        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];

            if($tempArr[$DtcLoc] != "") {
                unset($tempArr[$DatLoc]); unset($tempArr[$YrLoc]);
                unset($tempArr[$MoLoc]); unset($tempArr[$DyLoc]);
                unset($tempArr[$TimLoc]);
            }else if($tempArr[$DatLoc] != "") {
                $tempArr[$DatLoc] = $tempArr[$DatLoc]." ".$tempArr[$TimLoc];
                unset($tempArr[$DtcLoc]); unset($tempArr[$YrLoc]);
                unset($tempArr[$MoLoc]); unset($tempArr[$DyLoc]);
                unset($tempArr[$TimLoc]);
            }else {
                $tempArr[$YrLoc] = $tempArr[$YrLoc]."/".$tempArr[$MoLoc]."/".$tempArr[$DyLoc]." ".$tempArr[$TimLoc];
                unset($tempArr[$DtcLoc]); unset($tempArr[$DatLoc]);
                unset($tempArr[$MoLoc]); unset($tempArr[$DyLoc]);
                unset($tempArr[$TimLoc]);
            }

            $this->dataArr[$i] = $tempArr;
        }
    }

    public function RaceDataOperation()
    {

        $raceOth = array_search("RACEOTH",$this->titleArr);
        $raceAia = array_search("RACE.AMERICAN_INDIAN_OR_ALASKA_NATIVE",$this->titleArr);
        $raceBaa = array_search("RACE.BLACK_OR_AFRICAN_AMERICAN",$this->titleArr);
        $raceNp = array_search("RACE.NATIVE_HAWAIIAN_OR_OTHER_PACIFIC_ISLANDER",$this->titleArr);
        $raceW = array_search("RACE.WHITE",$this->titleArr);
        $raceA = array_search("RACE.ASIAN",$this->titleArr);

        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];

            if($tempArr[$raceOth] != "") {
                unset($tempArr[$raceAia]); unset($tempArr[$raceBaa]); unset($tempArr[$raceNp]);
                unset($tempArr[$raceW]); unset($tempArr[$raceA]);
            }
            else if($tempArr[$raceAia] != "") {
                unset($tempArr[$raceOth]); unset($tempArr[$raceBaa]); unset($tempArr[$raceNp]);
                unset($tempArr[$raceW]); unset($tempArr[$raceA]);
            }
            else if($tempArr[$raceBaa] != ""){
                unset($tempArr[$raceOth]); unset($tempArr[$raceAia]); unset($tempArr[$raceNp]);
                unset($tempArr[$raceW]); unset($tempArr[$raceA]);
            }
            else if($tempArr[$raceNp] != ""){
                unset($tempArr[$raceOth]); unset($tempArr[$raceAia]); unset($tempArr[$raceBaa]);
                unset($tempArr[$raceW]); unset($tempArr[$raceA]);
            }
            else if($tempArr[$raceW] != ""){
                unset($tempArr[$raceOth]); unset($tempArr[$raceAia]); unset($tempArr[$raceBaa]);
                unset($tempArr[$raceNp]); unset($tempArr[$raceA]);
            }
            else if($tempArr[$raceA] != ""){
                unset($tempArr[$raceOth]); unset($tempArr[$raceAia]); unset($tempArr[$raceBaa]);
                unset($tempArr[$raceW]); unset($tempArr[$raceNp]);
            }
            $this->dataArr[$i] = $tempArr;
        }
    }

    public function DhdtcOperation() {
        $dhDtc = array_search("DTHDTC",$this->titleArr);

        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];
            if($tempArr[$dhDtc] != "") {
                array_push($tempArr,"Y");
            }
            else {
                array_push($tempArr,"N");
            }
            $this->dataArr[$i] = $tempArr;
        }
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-DM(Submit Version).csv";
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
        $fileName = "SDTM-DM(with deleted data).csv";
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