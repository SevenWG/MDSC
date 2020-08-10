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
require_once __DIR__.'/../../models/service/CommonService.php';
require_once __DIR__.'/../../models/service/AEService.php';
require_once __DIR__.'/../../models/service/CMService.php';
require_once __DIR__.'/../../models/service/DSService.php';
require_once __DIR__.'/../../models/service/DVService.php';
require_once __DIR__.'/../../models/service/DAService.php';
require_once __DIR__.'/../../models/service/DMService.php';
require_once __DIR__.'/../../models/service/MHService.php';
require_once __DIR__.'/../../models/service/EXService.php';
require_once __DIR__.'/../../models/service/SUService.php';
require_once __DIR__.'/../../models/service/VSService.php';
require_once __DIR__.'/../../models/service/IEService.php';
require_once __DIR__.'/../../models/service/EGService.php';
require_once __DIR__.'/../../models/service/LBService.php';
require_once __DIR__.'/../../models/service/PEService.php';
require_once __DIR__.'/../../models/service/userService.php';

    session_start();

    $uaccount = $_SESSION['uaccount'];
    $fileName = "../../files/".$uaccount."/".$_GET['filename'];

    if(!file_exists($fileName)) {
        echo "<script language='JavaScript'>alert('找不到文件!');
               self.location='../../views/user/CDASHFileList.php'</script> ";
    }
    else {

        $cdashFile = fopen($fileName,"r");

        $userService = new userService();
        $commonService = new CommonService();
        $aeService = new AEService();
        $dsService = new DSService();
        $daService = new DAService();
        $mhService = new MHService();
        $dvService = new DVService();
        $dmService = new DMService();
        $cmService = new CMService();
        $exService = new EXService();
        $suService = new SUService();
        $vsService = new VSService();
        $ieService = new IEService();
        $egService = new EGService();
        $lbService = new LBService();
        $peService = new PEService();

        $titleArr = array();
        $dataArr =array();
        $i = 0;
        while(!feof($cdashFile)) {
            if($i == 0){
                $titleArr = fgetcsv($cdashFile);
            }
            else {
                $tempArr = fgetcsv($cdashFile);
                array_push($dataArr,$tempArr);
            }
            $i++;
        }

        $domainLoc = array_search("DOMAIN",$titleArr);
        $tempDataArr = $dataArr[0];
        $domainName = $tempDataArr[$domainLoc];
        if($domainName == "AE") {
            $aeService->Transform($titleArr,$dataArr);
        }

        if($domainName == "Common") {
            $aeService = new AEService();
            $commonService->Transform($titleArr,$dataArr);
        }
        if($domainName == "DS") {
            $dsService->Transform($titleArr,$dataArr);
        }
        if($domainName == "DA") {
            $daService->Transform($titleArr,$dataArr);
        }
        if($domainName == "MH") {
            $mhService->Transform($titleArr,$dataArr);
        }
        if($domainName == "DV") {
            $dvService->Transform($titleArr,$dataArr);
        }
        if($domainName == "DM") {
            $dmService->Transform($titleArr,$dataArr);
        }
        if($domainName == "CM") {
            $cmService->Transform($titleArr,$dataArr);
        }
        if($domainName == "EX") {
            $exService->Transform($titleArr,$dataArr);
        }
        if($domainName == "SU") {
            $suService->Transform($titleArr,$dataArr);
        }
        if($domainName == "VS") {
            $vsService->Transform($titleArr,$dataArr);
        }
        if($domainName == "IE") {
            $ieService->Transform($titleArr,$dataArr);
        }
        if($domainName == "EG") {
            $egService->Transform($titleArr,$dataArr);
        }
        if($domainName == "LB") {
            $lbService->Transform($titleArr,$dataArr);
        }
        if($domainName == "PE") {
            $peService->Transform($titleArr,$dataArr);
        }

        echo "<script language='JavaScript'>alert('转换成功！');
        self.location='../../views/user/CDASHFileList.php'</script> ";
    }