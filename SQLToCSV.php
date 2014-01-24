<?
    /* Read from SQL database and write to a csv file
    Please modify config var as required.

    http://fofmigration.local/SQLToCSV.php
    */
require 'config/dbCon.php';
require 'config/dbFunc.php';
//require 'config/Func.php';

?>
Office Migration... <br />

<?
$table = 'news';


//$file = "source/office.csv" ;
$fileOutput="output/".$table."Output.csv";
$delimiter=' | ';
$endOfLine=" \r\n" ;

//$file = fopen($file,"r");
chmod($fileOutput, 0777);


if (file_exists($fileOutput))
    unlink($fileOutput);
$handle = fopen($fileOutput, "w+");



$officeData=getData($table);
echo count($officeData).'<br /><br /><br />';


foreach ($officeData as $data){ // echo '<pre>';  print_r($data);
    $line = NULL;
    $size=count($data);
    $i=0;
    foreach ($data as $row){
        $i++;
        $line .= "$row";
        $line .= ($i < $size ) ? $delimiter : NULL;
    }
    $line .= $endOfLine;
    fwrite($handle, $line);
    echo $line.'<br />';
}


fclose($handle);
//fclose($file);

chmod($fileOutput, 0777);
?>
