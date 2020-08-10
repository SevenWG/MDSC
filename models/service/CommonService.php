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

require_once __DIR__.'/../entity/CommonDomain.php';
class CommonService
{
    public function Transform($titleArr,$dataArr)
    {
        $commonDomain = new CommonDomain();
        $cdashTable = $commonDomain->cdashTable;
        if($commonDomain->isGetFromFile) {
            array_pop($cdashTable);
        }

        $sdtmTable = array();
        $nonMapTable = array();
        $newDataTable = array();
        $nonMapTitles = array();
        $deleteDataTable = array();

        foreach ($titleArr as $i => $val) {
            $cdashVal = $titleArr[$i];

            if($cdashVal == "DOMAIN"){
                array_push($sdtmTable,$cdashVal);
            }
            else if(!key_exists($cdashVal, $cdashTable)){
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }
            else if($cdashTable[$cdashVal] != "") {
                array_push($sdtmTable,$cdashTable[$cdashVal]);
            }
            else {
                array_push($nonMapTable,$i);
                array_push($nonMapTitles,$cdashVal);
            }
        }

        for ($i = 0; $i < count($dataArr)-1; $i++) {
            $tempArr = $dataArr[$i];
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


        $sdtmStr = implode(",", $sdtmTable);
        $nonMapTitleStr = implode(",", $nonMapTitles);

        $this->SaveFile($sdtmStr, $newDataTable);
        $this->SaveFile1($sdtmStr, $newDataTable,$nonMapTitleStr,$deleteDataTable);
    }

    public function SaveFile($sdtmStr, $newDataTable)
    {
        $uaccount = $_SESSION['uaccount'];
        $userid = $_SESSION['userid'];
        $time = date("Y-m-d-h-i-s");

        $op = "\r\n";
        $fileName = $uaccount."-".$time."-"."SDTM-Common(Submit Verison).csv";
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
        $fileName = $uaccount."-".$time."-"."SDTM-Common(with deleted data).csv";
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