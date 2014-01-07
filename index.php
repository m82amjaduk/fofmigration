<?
require 'config/dbCon.php';
require 'config/dbFunc.php';
require 'config/Func.php';
?>



<?
 $string = "Chocolate Giant 'Cadbury's' Lease London Office Space. To read the full news story, more industry news and to find offices, visit FreeOfficeFinder.com";
 echo $string = mysql_real_escape_string($string);
 //exit;
//$where='WHERE post_status ="publish"';


//SELECT * FROM wp_posts where post_status ="publish" ORDER BY length(`post_title`) asc;


$where = 'post_status ="publish"';
$allId =  getDataWhere('wp_posts', $col='ID', $where );
echo sizeof($allId);
//echo '<pre>'; print_r($allId);
//die('iamhere');

$where = 'post_status ="publish"';
$col = ' post_date,  post_content, post_title,  post_meta_description, post_modified, ID, post_status, post_name ';


?>


<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <style>
        .article{
            width:1700px;
            border-bottom: 5px #fff solid;
            padding: 0 0 20px 0;
            background: #ffffaf;
        }
        .article p {
            background: #F6CED8;
        }
    </style>
</head>

<body>
<?

$i=0;
foreach ($allId as $row){
   $id=$row['ID'];
$where = "ID = $id";
$sqlData = getRow('wp_posts', $col, $where );

        $articleOri= $sqlData['post_content'];

        $summaryData =  getSummary($articleOri);
        $articleNoSum = $summaryData[1];
        $summary=$summaryData[0];

        $caption = "/\[caption(.*)caption\]/U";
        $summary =  preg_replace($caption, '',$summary);
        $summary = mysql_real_escape_string($summary);
        $articleNoCaption =  preg_replace($caption, '', $articleNoSum);
        $more = "/<!--more-->/U";
        $body =  preg_replace($more, '', $articleNoCaption);
        $body = mysql_real_escape_string($body);

        $img = grabAllImageHtmlContent($articleOri);


        $title = $sqlData['post_title'];
        $title = mysql_real_escape_string ($title);
        $publishTime = ($sqlData['post_date'])? $sqlData['post_date'] : 'now';
        $publishTimeInt = strtotime($publishTime);
        $imgListPage = $imgListPage = $img[1][0];
        $imgViewPage = $imgListPage;
        $imgViewPageWidth = 300;
        $metaTitle = $title;
        $metaDescription = mysql_real_escape_string ($sqlData['post_meta_description']);
        $metaKeyWords = '####';
        $lastUpdated = ($sqlData['post_modified'])? $sqlData['post_modified'] : $publishTime ;

     $query = "INSERT INTO
        news (title, summary, body, imgListPage, imgListPageBegins, imgViewPage, imgViewPageWidth, imgViewPageAlign, publishTime,
        hitCount, metaTitle, metaDescription, metaKeyWords, lastUpdated, active )
        VALUES ('$title', '$summary', '$body', '$imgListPage', 0, '$imgViewPage', '$imgViewPageWidth', 'left', '$publishTime',
        200, '$metaTitle', '$metaDescription',  '$metaKeyWords', '$lastUpdated', 1 )";

//    if(!empty($title)) $query_result = mysql_query($query);
//    else echo 'empty TITLE'.$id;
//    echo ($query_result)  ? ''  : '<br><br>** '.$id.$query;
//    $idSQL = mysql_insert_id();

/*
$i++;
    if($i == 1300) exit;*/
    if(!empty($title)) {          ?>


    <h1> <?=$id.'>>'.$title?></h1>


<? } }?>
</body>

</html>




<?
$article = '<strong>Two leading real estate advisory firms, Jones Lang LaSalle have combined European operations.</strong>

<!--more-->

<a href="http://www.freeofficefinder.com/officemarketnews/wp-content/uploads/2011/05/Shard.jpg"><img class="alignright size-medium wp-image-2239" title="Shard" src="http://www.freeofficefinder.com/officemarketnews/wp-content/uploads/2011/05/Shard-300x246.jpg" alt="" width="300" height="246" /></a>

Global commercial real estate firm Jones Lang LaSalle has confirmed today that they will be merging with international property consultancy King Sturge. The combined firm will now emerge as the clear leader for <a href="http://www.freeofficefinder.com/uk/officespace-and-servicedoffices-Covent-Garden-WC2.php">commercial space the UK</a> and also in continental Europe, with improved strength and depth of service capabilities over the region that will directly benefit the clients of both companies.
The operation is expected to close on 31 May 2011, with Jones Lang LaSalle to pay consideration of £197m to the partners of King Sturge, with £98m in cash at closing and the remaining balance paid out in cash over five years.
43 King Sturge offices and businesses across Europe, including 24 <a href="http://www.freeofficefinder.com/uk/officespace-and-servicedoffices-Great-Portland-Street-W1.php">UK offices</a>, will become part of Jones Lang LaSalle and will operate under the Jones Lang LaSalle brand. The amalgamation of business lines and teams and the full rebranding of all business activities will begin immediately.
<a href="http://www.youtube.com/watch?v=JRuIE9xnLQQ">Christian Ulbrich</a>, Jones Lang LaSalle Chief Executive Officer for EMEA commented: “The obvious strategic and cultural fit between Jones Lang LaSalle and King Sturge makes this a logical and very attractive proposition for both firms. It gives us a scale and depth of expertise that will make our client service delivery capabilities second to none in both the UK and continental Europe.”
Richard Batten, Joint Senior Partner, King Sturge said: “This is a coming together of two great companies who are culturally aligned, with fantastic business synergies, to create the best firm of property advisers in Europe. We truly believe that we will be better together. The ability to operate on a global platform, and the opportunities that this will provide, is great news for all our staff and clients.”

The merged business operates in 70 EMEA markets across 30 countries employing 5,300 people providing integrated real estate services worldwide to investor, owner and occupier clients. The UK business will now have 2,700 employees across 34 UK office locations.';

?>























