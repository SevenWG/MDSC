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
require_once __DIR__.'/../../commons/MappingTables/EX.php';
class EXDomain
{
    private $cdashTable;
    private $odmTable;
    private $domainName;
    private $isGetFromFile;

    public function  __construct()
    {
        $this->domainName = "EX";
        $this->getMappingTable();
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function getMappingTable()
    {
        $fileName = "../../mapfiles/"."EX_MAP.csv";
        $ex = new EX();

        if(!file_exists($fileName)) {

            $this->cdashTable = $ex->getCdashTable();
            $this->odmTable = $ex->getOdmTable();
            $this->isGetFromFile = false;
        }
        else {
            $mapFile = fopen($fileName,"r");
            $dataArr = array();
            $odmArr = array();
            while(!feof($mapFile)) {
                $tempArr = fgetcsv($mapFile);
                $odmArr[$tempArr[1]] = $tempArr[3];
                $dataArr[$tempArr[2]] = $tempArr[3];
            }
            $this->cdashTable = $dataArr;
            $this->odmTable = $odmArr;
            $this->isGetFromFile = true;
        }
    }
}