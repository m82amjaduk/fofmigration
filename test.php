<?
require 'config/dbCon.php';
require 'config/dbFunc.php';
require 'config/Func.php';

echo date('n');
 $unix_time = 100;
$summerMonths = array (4,5,6,7,8,9,10);
if in_array($summerMonths, date('n') )
    $unix_time += 3600;
?>

<!DOCTYPE html>
<? $libDir = '/lib';
$sourceDir = '/source'
?>
<html>
<head>
<title>FOF | data migration ...... </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Add jQuery library -->
<script type="text/javascript" src="<?=$libDir?>/jquery-1.10.1.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?=$libDir?>/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?=$sourceDir?>/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=$sourceDir?>/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=$sourceDir?>/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?=$sourceDir?>/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=$sourceDir?>/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?=$sourceDir?>/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?=$sourceDir?>/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /*
         *  Simple image gallery. Uses default settings
         */

        $('.fancybox').fancybox();

        /*
         *  Different effects
         */

        // Change title type, overlay closing speed
        $(".fancybox-effects-a").fancybox({
            helpers: {
                title : {
                    type : 'outside'
                },
                overlay : {
                    speedOut : 0
                }
            }
        });

        // Disable opening and closing animations, change title type
        $(".fancybox-effects-b").fancybox({
            openEffect  : 'none',
            closeEffect	: 'none',

            helpers : {
                title : {
                    type : 'over'
                }
            }
        });

        // Set custom style, close if clicked, change title type and overlay color
        $(".fancybox-effects-c").fancybox({
            wrapCSS    : 'fancybox-custom',
            closeClick : true,

            openEffect : 'none',

            helpers : {
                title : {
                    type : 'inside'
                },
                overlay : {
                    css : {
                        'background' : 'rgba(238,238,238,0.85)'
                    }
                }
            }
        });

        // Remove padding, set opening and closing animations, close if clicked and disable overlay
        $(".fancybox-effects-d").fancybox({
            padding: 0,

            openEffect : 'elastic',
            openSpeed  : 150,

            closeEffect : 'elastic',
            closeSpeed  : 150,

            closeClick : true,

            helpers : {
                overlay : null
            }
        });

        /*
         *  Button helper. Disable animations, hide close button, change title type and content
         */

        $('.fancybox-buttons').fancybox({
            openEffect  : 'none',
            closeEffect : 'none',

            prevEffect : 'none',
            nextEffect : 'none',

            closeBtn  : false,

            helpers : {
                title : {
                    type : 'inside'
                },
                buttons	: {}
            },

            afterLoad : function() {
                this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
        });


        /*
         *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
         */

        $('.fancybox-thumbs').fancybox({
            prevEffect : 'none',
            nextEffect : 'none',

            closeBtn  : false,
            arrows    : false,
            nextClick : true,

            helpers : {
                thumbs : {
                    width  : 50,
                    height : 50
                }
            }
        });

        /*
         *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
         */
        $('.fancybox-media')
            .attr('rel', 'media-gallery')
            .fancybox({
                openEffect : 'none',
                closeEffect : 'none',
                prevEffect : 'none',
                nextEffect : 'none',

                arrows : false,
                helpers : {
                    media : {},
                    buttons : {}
                }
            });

        /*
         *  Open manually
         */

        $("#fancybox-manual-a").click(function() {
            $.fancybox.open('1_b.jpg');
        });

        $("#fancybox-manual-b").click(function() {
            $.fancybox.open({
                href : 'iframe.html',
                type : 'iframe',
                padding : 5
            });
        });

        $("#fancybox-manual-c").click(function() {
            $.fancybox.open([
                {
                    href : '1_b.jpg',
                    title : 'My title'
                }, {
                    href : '2_b.jpg',
                    title : '2nd title'
                }, {
                    href : '3_b.jpg'
                }
            ], {
                helpers : {
                    thumbs : {
                        width: 75,
                        height: 50
                    }
                }
            });
        });


    });
</script>
<style type="text/css">
    .fancybox-custom .fancybox-skin {
        box-shadow: 0 0 50px #222;
    }

    body {
        max-width: 700px;
        margin: 0 auto;
    }
</style>
</head>
<body>

<p>
    <? $images = array(
        'http://www.aceshowbiz.com/images/news/star-wars-episode-7-gets-rise-of-the-jedi-as-one-of-new-potential-titles.jpg',
        'http://www.wired.com/images_blogs/underwire/2013/02/intro-graphic.jpg',
        'http://www.ablog4guys.com/storage/2013/06-july/Star-Wars-the-Force-Unleashed.jpg?__SQUARESPACE_CACHEVERSION=1376241064290',
        'http://www.themovies.co.za/wp-content/uploads/2013/04/Star-Wars_alltrilogies.jpg',
        'http://starwarsblog.starwars.com/wp-content/uploads/2012/12/Ashley-and-James-Photo-II.jpg'
    );

    //    print_r($images);
    foreach($images as $image) {?>
        <a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?=$image?>">
            <img src="<?=$image?>" alt="" width="200" /></a>
    <?}?>
</p>

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
        <? if ($row['imgViewPage']) { ?>
            <div class="articleImg">
                <a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?=$row['imgViewPage']?>">
                    <img src="<?=$row['imgViewPage']?>" alt="" width="<?=$row['imgViewPageWidth']?>" float="<?=$row['imgViewPageAlign']?>" /></a>



            </div> <?}?>




        <div class="articleBody"><?=$row['body']?> </div>

    </div>
    <div class="clear"></div>

<?  }?>




</body>
</html>

