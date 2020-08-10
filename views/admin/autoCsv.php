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
    require_once __DIR__.'/../../commons/MappingTables/SU.php';
    require_once __DIR__.'/../../commons/MappingTables/VS.php';
    require_once __DIR__.'/../../commons/MappingTables/LB.php';
    require_once __DIR__.'/../../commons/MappingTables/EX.php';
    require_once __DIR__.'/../../commons/MappingTables/EG.php';

    $eg = new EG();

    $odmTable = $eg->getOdmTable();
    $cdashTable = $eg->getCdashTable();

    $odmKeys = array_keys($odmTable);
    $odmValues = array_values($odmTable);
    $cdashKeys = array_keys($cdashTable);
    $cdashValues = array_values($cdashTable);

    $dataArr = [];
    for($i = 0; $i < count($odmTable); $i++){
        $temp = array("EG", $odmKeys[$i], $cdashKeys[$i], $cdashValues[$i]);
        $dataArr[] = $temp;
    }

    var_dump($dataArr);
    $fp = fopen('EG_MAP.csv', 'w');

    foreach ($dataArr as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
