<?php
/**
 * Created by PhpStorm.
 * User: amzad
 * Date: 04/11/13
 * Time: 15:08
 */

function grabAllImageHtmlContent($string){
    $preg = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
    preg_match_all($preg, $string, $ContentImages);
    // /<img.+src=[\'"]([^\'"]+)[\'"].*>/i
//DO NOT DELTE    echo $strFirstImage = $ContentImages[1] [0]; // To grab the first image
    return $ContentImages;
}

function grabAllHrefHtmlContent($string){
    preg_match_all("<a href=\x22(.+?)\x22>", $string, $matches);
    return $matches;
}

function getSummary($article){
    $readMore =  strpos($article, '<!--more-->');
    $summary = substr($article, 0 , $readMore) ;
    $summary  = str_replace('<strong>', '', $summary );
    $data[0]  = str_replace('</strong>', '', $summary );
    $data[1]  = substr($article, $readMore ) ;
    return $data;
}

function getImgLink($string){

    $preg = "/<!--more-->/U";
    $string =  preg_replace($preg, '', $string);
//    echo '<f>'.$string.'</f>';
    $begain =  strpos($string, '<a');
    //$remainingArticle = substr($string, $begain  ) ;
    $end =  strpos($string, 'a>')+2;
    $aLink = substr($string, $begain , $end) ;
    $imgArray = grabAllImageHtmlContent($string);

    print_r($imgArray);
//    $string = substr($string, $end) ;
    return $imgArray[1][0];
}

function getImgLink2($article){
    $imgArray = grabAllImageHtmlContent($article);
//    print_r($imgArray);
    return $imgArray[1][0];
}

?>