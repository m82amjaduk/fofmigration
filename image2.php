<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <title>JS Bin</title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        article, aside, figure, footer, header, hgroup,
        menu, nav, section { display: block; }

        body {
            color: #555;
            background: #eee;
        }

        h1 {
            font-family: sans-serif;
            font-size: 2em;
            margin: 20px 0 0 0;
            text-align: center;
        }

        h2 {
            font-family: sans-serif;
            font-size: 1.2em;
            text-align: center;
        }

        p {
            padding: 10px 0 0;
            color: #222;
            font-family: sans-serif;
            font-weight: bold;
            text-align: center;
        }

        .wrap {
            position: relative;
            height: 100%;
        }

        .clip {
            position: absolute;
            -webkit-transition: all 1s ease;
            z-index: 1;
        }

        .c1 {
            top: 100px;
            left: 0;
            clip: rect(140px, 300px, 200px, 250px);
        }

        .c2 {
            top: 100px;
            left: 0px;
            clip: rect(80px, 210px, 160px, 100px);
        }

        .c3 {
            top: 100px;
            left: 0px;
            clip: rect(110px, 160px, 170px, 60px);
        }

        .c4 {
            top: 100px;
            left: 0px;
            clip: rect(160px, 130px, 220px, 60px);
        }

        .c5 {
            top: 100px;
            left: 0px;
            clip: rect(60px, 250px, 130px, 180px);
        }

        .c6 {
            top: 100px;
            left: 0px;
            clip: rect(80px, 160px, 160px, 70px);
        }

        .clip:hover {
            clip: rect(0, 400px, 260px, 0);
            cursor: pointer;
            z-index: 999;
        }
    </style>
</head>
<body>



<div class="wrap">
    <figure class="clip c1">
        <img src="http://www.aceshowbiz.com/images/news/star-wars-episode-7-gets-rise-of-the-jedi-as-one-of-new-potential-titles.jpg" alt="" width="400" height="260">
    </figure>

    <figure class="clip c2">
        <img src="http://www.wired.com/images_blogs/underwire/2013/02/intro-graphic.jpg" alt="" width="400" height="260">
    </figure>

    <figure class="clip c3">
        <img src="http://www.ablog4guys.com/storage/2013/06-july/Star-Wars-the-Force-Unleashed.jpg?__SQUARESPACE_CACHEVERSION=1376241064290" alt="" width="400" height="260">
    </figure>

    <figure class="clip c4">
        <img src="http://www.themovies.co.za/wp-content/uploads/2013/04/Star-Wars_alltrilogies.jpg" alt="" width="400" height="260">
    </figure>

    <figure class="clip c5">
        <img src="http://starwarsblog.starwars.com/wp-content/uploads/2012/12/Ashley-and-James-Photo-II.jpg" alt="" width="400" height="260">
    </figure>

    <figure class="clip c6">
        <img src="http://www.wired.com/images_blogs/underwire/2013/02/intro-graphic.jpg" alt="" width="400" height="260">
    </figure>

</div>

</body>
</html>