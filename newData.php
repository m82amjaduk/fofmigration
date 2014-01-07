<?
require 'config/dbCon.php';
require 'config/dbFunc.php';
require 'config/Func.php';
?>
    <style>
        .article{
            margin: 10px 5px;
            border: 2px #000;
            width: 600px;
        }
        .articleBody{
        }

        .articleImg{
            padding:10px;
        }
        .clear{
            height: 3px;
            margin: 5px 0;
            clear: both;
        }
    </style>

<style>
    .image-link {
        cursor: -webkit-zoom-in;
        cursor: -moz-zoom-in;
        cursor: zoom-in;
    }


    /* This block of CSS adds opacity transition to background */
    .mfp-with-zoom .mfp-container,
    .mfp-with-zoom.mfp-bg {
        opacity: 0;
        -webkit-backface-visibility: hidden;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
    }

    .mfp-with-zoom.mfp-ready .mfp-container {
        opacity: 1;
    }
    .mfp-with-zoom.mfp-ready.mfp-bg {
        opacity: 0.8;
    }

    .mfp-with-zoom.mfp-removing .mfp-container,
    .mfp-with-zoom.mfp-removing.mfp-bg {
        opacity: 0;
    }



    /* padding-bottom and top for image */
    .mfp-no-margins img.mfp-img {
        padding: 0;
    }
    /* position of shadow behind the image */
    .mfp-no-margins .mfp-figure:after {
        top: 0;
        bottom: 0;
    }
    /* padding for main container */
    .mfp-no-margins .mfp-container {
        padding: 0;
    }



    /* aligns caption to center */
    .mfp-title {
        text-align: center;
        padding: 6px 0;
    }
    .image-source-link {
        color: #DDD;
    }


    body { -webkit-backface-visibility: hidden; padding: 10px 30px;
        font-family: "Calibri", "Trebuchet MS", "Helvetica", sans-serif;
    }
</style>

<?
$data = getData ('news');
//$data = getDataWhere('news', '*',  'active=1', 1000 );
 echo '<pre>';
 print_r($data[0]);

echo sizeof($data);
foreach ($data as $row){
?>


<div class='article'>
    <h1> <?=$row['id'].'/'.$row['title']?></h1>
    <h3> <?=$row['summary']?></h3>
    <? if ($row['imgViewPage']) { ?>
    <div class="articleImg">
        <a href="<?=$row['imgViewPage']?>" class="without-caption image-link">
            <img src="<?=$row['imgViewPage']?>"  width="<?=$row['imgViewPageWidth']?>" float="<?=$row['imgViewPageAlign']?>"/>
        </a>

    </div> <?}?>




    <div class="articleBody"><?=$row['body']?> </div>

</div>
<div class="clear"></div>

<?  }?>



<script>
    $('.without-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

$('.with-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		zoom: {
			enabled: true
		}
	});


</script>