<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Import Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Link CSS -->
    <link rel="stylesheet" href="Public/Css/common.css">
    <?php if (file_exists(ROOT . "Public/Css/$page.css")) { ?>
        <link rel="stylesheet" href="Public/Css/<?php echo $page ?>.css">
    <?php } ?>
    <!-- Import CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
    <!-- Import WebLogo -->
    <link rel="icon" href="Public/Images/all/logo-web.png">
    <title>Miny</title>
</head>
<body>
    <?php if (!isset($page)) {
        require_once ROOT . "App/Views/$action.php";
    } else { ?>
        <!-- LAYER OPACITY -->
        <div id="layer-opacity"></div>

        <!-- SCROLL TO TOP -->
        <button id="scroll-top" onclick="scrollToTop(150, 5)"><i class="fas fa-angle-up"></i></button>

        <!-- START MOBILE HEADER -->
        <div id="mobile-header" class="mobile-header d-none">
            <div id="icon-nav" onclick="isDisplay()"><i class="fas fa-bars"></i></div>
            <div class="search-container">
                <i class="icon fas fa-search"></i>
                <input class="f-regular-12" type="text" placeholder="Tìm kiếm câu hỏi">
            </div>
        </div>
        <!-- END MOBILE HEADER -->

        <?php
        require_once ROOT . "App/Views/Templates/menu.php";
        require_once ROOT . "App/Views/Templates/banner.php";
        require_once ROOT . "App/Views/$action.php";
        require_once ROOT . "App/Views/Templates/footer.php";
    } ?>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="Public/Js/common.js"></script>
    <div id="fb-root"></div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php if (file_exists("Public/Js/$page.js")) { ?>
        <script src="Public/Js/<?php echo $page ?>.js"></script>
    <?php } ?>
</body>
</html>
