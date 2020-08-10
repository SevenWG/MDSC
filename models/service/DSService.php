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

require_once __DIR__.'/../entity/DSDomain.php';
require_once __DIR__.'/../entity/CommonDomain.php';

class DSService
{
    private $titleArr;
    private $dataArr;

    public function Transform($titleArr,$dataArr)
    {

        $dsDomain = new DSDomain();
        $dsTable = $dsDomain->cdashTable;
        if($dsDomain->isGetFromFile) {
            array_pop($dsTable);
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

        $specialSTVars = array("DSSTDTC", "DSSTDAT", "DSSTTIM"); $StFlag = false;
        $specialENVars = array("ENDOFSTUDY.DSSTDAT", "ENDOFSTUDY.DSSTTIM"); $EnFlag = false;


        $this->TimeDataOperation($titleArr,$dataArr);

        foreach ($this->titleArr as $i => $val) {
            $cdashVal = $this->titleArr[$i];
            if($cdashVal == "DOMAIN") {
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $dsTable) && !key_exists($cdashVal, $commonTable)){
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }
            else if(!key_exists($cdashVal, $dsTable) && key_exists($cdashVal, $commonTable)) {
                if($commonTable[$cdashVal] != "") {
                    array_push($sdtmTable,$commonTable[$cdashVal]);
                }
                else {
                    array_push($nonMapTable,$i);
                }
            }
            else if(!key_exists($cdashVal, $commonTable) && key_exists($cdashVal, $dsTable)) {
                if($dsTable[$cdashVal] != "") {
                    if(!in_array($cdashVal, $specialSTVars) && !in_array($cdashVal, $specialENVars)) {
                        array_push($sdtmTable, $dsTable[$cdashVal]);
                    }
                    else{
                        if(in_array($cdashVal, $specialSTVars) && $StFlag == false) {
                            $StFlag = true;
                            array_push($sdtmTable, $dsTable[$cdashVal]);
                        }

                        if(in_array($cdashVal, $specialENVars) && $EnFlag == false) {
                            $EnFlag = true;
                            array_push($sdtmTable, $dsTable[$cdashVal]);
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
        $nonMapTitleStr = implode(",",$nonMapTitles);

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
            $nonMapTitleStr, $deleteDataTable, $dsDomain->domainName);
/*        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);*/
    }

    public function TimeDataOperation($titleArr,$dataArr)
    {
        $this->titleArr = $titleArr;
        $this->dataArr = $dataArr;

        $stDtcLoc = array_search("DSSTDTC",$this->titleArr);
        $stDatLoc = array_search("DSSTDAT",$this->titleArr);
        $stTimLoc = array_search("DSSTTIM",$this->titleArr);

        $enDatLoc = array_search("ENDOFSTUDY.DSSTDAT",$this->titleArr);
        $enTimLoc = array_search("ENDOFSTUDY.DSSTTIM",$this->titleArr);


        for ($i = 0; $i <count($this->dataArr)-1; $i++) {
            $tempArr = $this->dataArr[$i];

            if($tempArr[$stDtcLoc] != "") {
                unset($tempArr[$stDatLoc]);
                unset($tempArr[$stTimLoc]);
            }else {
                $tempArr[$stDatLoc] = $tempArr[$stDatLoc]." ".$tempArr[$stTimLoc];
                unset($tempArr[$stDtcLoc]);
                unset($tempArr[$stTimLoc]);
            }


            $tempArr[$enDatLoc] = $tempArr[$enDatLoc]." ".$tempArr[$enTimLoc];
            unset($tempArr[$enTimLoc]);

            $this->dataArr[$i] = $tempArr;
        }
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        session_start();
        $op = "\r\n";
        $fileName = "SDTM-DS(Submit Version).csv";
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
        $fileName = "SDTM-DS(with deleted data).csv";
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