<div class="user-body-homepage">
    <div class="container">
        <ul id="user-menu" class="f-regular-25">
            <li onclick="directTo('index.php?controller=userHome&action=information')"><a href="index.php?controller=userHome&action=information">Thông tin cá nhân</a></li>
            <li onclick="directTo('index.php?controller=userHome&action=postManagement')"><a href="index.php?controller=userHome&action=postManagement">Quản lý bài viết</a></li>
            <li onclick="directTo('index.php?controller=userhome&action=getPostCreate')"><a href="index.php?controller=userhome&action=postCreate">Đăng bài</a></li>
        </ul>
        <div class="content-container f-regular-16">
            <?php require_once ROOT . "App/Views/UserTemplates/$userTemplate.php" ?>
        </div>
    </div>
</div>