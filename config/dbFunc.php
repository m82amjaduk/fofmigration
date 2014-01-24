<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amjad
 * Date: 21/10/13
 * Time: 12:19
 * To change this template use File | Settings | File Templates.
 */

function getData($tableName, $col='*' ){
    $query = "Select $col FROM $tableName";
    $query_result = mysql_query($query);
//  echo mysql_num_rows($query_result);
    while($row = mysql_fetch_assoc($query_result)) {
        $data[] = $row;
    }
    return $data;
}

function getDataWhere($tableName, $col='*', $wr='id=1', $limit=2000 ){
    $query = "Select $col FROM $tableName WHERE $wr  LIMIT $limit";
    $query_result = mysql_query($query);
//  echo mysql_num_rows($query_result);
    while($row = mysql_fetch_assoc($query_result)) {
        $data[] = $row;
    }
    return $data;
}

function getRow($tableName, $col='*', $where='id=1'){
    $query = "Select $col FROM $tableName WHERE $where";
    $query_result = mysql_query($query);
    $data = mysql_fetch_assoc($query_result);
    return $data;
}




?>