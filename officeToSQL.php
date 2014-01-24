<?
require 'config/dbCon.php';
require 'config/dbFunc.php';
//require 'config/Func.php';

?>
Office Migration... <br />

<?
$file = "source/office.csv" ;
$file = fopen($file,"r");


$fileOutput="output/officeOutput.csv";
if (file_exists($fileOutput))
    unlink($fileOutput);
$handle = fopen($fileOutput, "a");

mysql_query("SET FOREIGN_KEY_CHECKS=0");
mysql_query("TRUNCATE TABLE office");

$i=0;

while(! feof($file)) {
    $line = fgetcsv($file, "\r\n");   //  echo '<pre>';  print_r($line);
    $processedArray=getArray($line);  //  echo '<pre>';  print_r($processedArray);

    processCSV($processedArray, $handle);
//    $i++; if ($i > 1000)  exit;
//    $error_id=array(74050, 72664 );
//    if(in_array($processedArray['id'], $error_id) ){ echo '<pre>';print_r($processedArray);}
}

fclose($file);
fclose($handle);
########################################################################


/*
 * Validate all data and write to CSV line by line.
 * @author Amjad Mojumder amzad.fof@gmail.com
 */
function processCSV($processedArray, $handle){
    $id = $processedArray['id'];
    $error = NULL;

    $error .= validateInt($processedArray, 'id', TRUE);
    $error .= validateInt($processedArray, 'country_id', TRUE);
    $error .= validateInt($processedArray, 'company_id',  TRUE);
    $error .= validateInt($processedArray, 'contract_attachment_id',  FALSE);
    $error .= validateInt($processedArray, 'quality_id',  TRUE);

    $error .= validateString($processedArray, 'name',  TRUE, 'text' );
    $error .= validateInt($processedArray, 'is_searchable_on_fmo',  FALSE);
    $error .= validateString($processedArray, 'availability',  FALSE, 'text');
    $error .= validateString($processedArray, 'postcode',  TRUE, 15 );
    $error .= validateInt($processedArray, 'latitude',  TRUE);
    $error .= validateInt($processedArray, 'longitude',  TRUE);
    $error .= validateString($processedArray, 'area',  TRUE, 255 );
    $error .= validateString($processedArray, 'address_number',  TRUE, 128 );
    $error .= validateString($processedArray, 'street',  TRUE, 255 );
    $error .= validateString($processedArray, 'part_of_country',  TRUE, 255 );

    $error .= validateString($processedArray, 'send_address', FALSE, 255 );
    $error .= validateString($processedArray, 'incentive',  FALSE, 255 );
    $error .= validateString($processedArray, 'incentive_expires_at',  FALSE, 255);
    $error .= validateString($processedArray, 'priority',  FALSE, 16 );
    $error .= validateString($processedArray, 'frontend_display_address',  FALSE, 255);
    $error .= validateString($processedArray, 'incoming_lead_email',  FALSE, 255);
    $error .= validateString($processedArray, 'incoming_lead_email',  FALSE, 255);
    $error .= validateInt($processedArray, 'capacity_minimum_people',  FALSE);
    $error .= validateInt($processedArray, 'capacity_maximum_people',  FALSE);

    $error .= validateString($processedArray, 'created_at',  TRUE, 255);
    $error .= validateString($processedArray, 'updated_at',  TRUE, 255);
    $error .= validateString($processedArray, 'deleted_at',  FALSE, 255);
    $error .= validateInt($processedArray, 'is_viewable_on_web', TRUE);
    $error .= validateInt($processedArray, 'off_market_popup', TRUE);
    $error .= validateString($processedArray, 'frontend_title_tag',  FALSE, 150 );
    $error .= validateString($processedArray, 'frontend_meta_description',  FALSE, 450 );
    $error .= validateString($processedArray, 'frontend_h1_tag',  FALSE, 450 );


    $error .= insertData($processedArray).' | '; //    echo "$id  Not inserting Data into  DB". '<br>';



    $error2 = str_replace('|', '', $error);
    $error2 = str_replace(' ', '', $error2);

    if($error2){
        $line = "$id $error \r\n";
        echo $line, '<br />';
        fwrite($handle, $line);
    }

}
#######################################################################


/*
 * Read an array and creates a SQL query.
 * @returns SQL String
 * @author Amjad Mojumder amzad.fof@gmail.com
 */

function  insertQueryFromArray($processedArray, $table ){
    $sql = "INSERT INTO ".$table. " SET ";

    $arraySize = sizeof($processedArray);
    $i=0;
    foreach($processedArray as $key => $value){
        $i++;
        $sql .= "$key = $value";

        //Add , after each entry except last element.
        if($i < $arraySize) $sql .= ', ';
    }
    return $sql;
}


/*
 * Insert data in to table,
 * @returns error message if applicable
 * @author Amjad Mojumder amzad.fof@gmail.com
 */

function  insertData($processedArray){
    $sql = insertQueryFromArray($processedArray, 'office' );

    $result=mysql_query( $sql);
    if(!$result){
        return mysql_error();
    }else return;
}



/*Validate integer value, returns error message if applicable
 * @author Amjad Mojumder amzad.fof@gmail.com
 */
function validateInt($processedArray, $field, $notNull){
    $data=str_replace('"', '', $processedArray[$field]);
    if(!notNull($data) && $notNull)
            return "| $field -> is NULL";
    if(!is_numeric($data) && notNull($data))
        return "| $field -> is Invalid ($data)";

    return ' | ';
}

/*
 * Validate String value,
 * @returns error message if applicable
 * @author Amjad Mojumder amzad.fof@gmail.com
 */
function validateString($processedArray, $field, $notNull, $length){
    $data = str_replace('"', '', $processedArray[$field]);
    if(!notNull($data) && $notNull)
        return "| $field -> is NULL";
    if((strlen($data) > $length) && ($length != 'text') && notNull($data))
        return "| $field -> is more the $length Char.  ($data)";

    return ' | ';
}

/*
 * Validate if it is Null, returns
 * @returns FALSE if NULL, TRUE if NOT NULL.
 *  @author Amjad Mojumder amzad.fof@gmail.com
 */
function notNull( $string ){
    return ($string == NULL || $string=='' || $string=='NULL') ?  FALSE : TRUE ;
}

/*
 * Get raw Line from CSV,
 * Makes it one String
 * Explode into an array
 * Create a new array with database fields
 *
 * @return Array of data according to database fields.
 * @author Amjad Mojumder amzad.fof@gmail.com
 */
function getArray($line){
    $data='';
    foreach($line as $row){
        $data .= $row;
    }
    echo $data;
    $data = explode("|", $data);  //
    echo '<pre>'; print_r($data);

    $contract_attachment_id = (notNull($data[3])) ? $data[3] : 1;

    $data2 = array(
        'id' => $data[0],
        'country_id' => 273,
        'company_id' => $data[2],
        'contract_attachment_id' => $contract_attachment_id,
        'quality_id' => $data[4],

        'name' =>  $data[5],
        'is_searchable_on_fmo' => $data[6],
        'availability' => $data[7],
        'postcode' => $data[9],
        'latitude' => $data[10],
        'longitude' => $data[11],
        'area' =>  $data[12],
        'street' => $data[13],
        'part_of_country' => $data[14],
        'send_address' => $data[15],

        'incentive' => $data[16],
        'incentive_expires_at' => $data[17],
        'priority' => $data[18],
        'frontend_display_address' => $data[19],
        'incoming_lead_email' => $data[20],
        'capacity_minimum_people' => $data[21],
        'capacity_maximum_people' => $data[22],

        'created_at' => $data[23],
        'updated_at' => $data[24],
        'deleted_at' => $data[25],
        'address_number' => $data[26],
        'is_viewable_on_web' => $data[27],
        'off_market_popup' => $data[28],
        'frontend_title_tag' => $data[29],
        'frontend_meta_description' => $data[30],
        'frontend_h1_tag' => $data[31]
    );
    return $data2;

}

?>
