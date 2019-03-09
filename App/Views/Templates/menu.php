<!-- START HEADER -->
<header id="header" class="search">
    <div class="container">
        <!-- Logo + Menu -->
        <div class="header-container-1">
            <div class="logo">
                <a href="/index.php"><img src="Public/Images/all/logo.png" alt=""></a>
            </div>
            <div class="user f-regular-16">
                <?php if (!isset($_SESSION['username'])) {?>
                    <button class="login-button" onclick="directTo('/index.php?controller=userAction&action=getSignup')">
                        Đăng ký
                    </button>
                    <button class="login-button" onclick="directTo('/index.php?controller=userAction&action=getLogin')">
                        Đăng nhập
                    </button>
                <?php } else { ?>
                    <button id="user-homepage" onclick="directTo('/index.php?controller=userHome&action=information')">
                        Trang cá nhân
                    </button>
                    <button id="logout-button" onclick="logOut()">
                        Đăng xuất
                    </button>
                <?php } ?>
            </div>
        </div>
        <!-- Search -->
        <div class="header-container-2">
            <div class="search-container">
                <i class="icon fas fa-search"></i>
                <input class="f-regular-14" type="text" id="search" placeholder="Tìm kiếm câu hỏi">
                <div class="search-content f-regular-14">

                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->

<!-- START NAVIGATION -->
<nav id="nav">
    <div class="nav-mobile-container">
        <div class="logo">
            <a class="d-none" href=""><img src="Public/Images/all/logo.png" alt=""></a>
            <i id="close-nav-mobile" class="d-none fas fa-arrow-left" onclick="isHidden()"></i>
        </div>
        <div class="d-none menu-name">
            <p>Danh mục</p>
        </div>
        <div class="container d-flex f-medium-15">
            <?php foreach(array_reverse($all_classes) as $class) {
                $index = array_search($class, $all_classes); ?>
                <div class="sub-menu" onmousemove="menuAppear()" onmouseout="menuDisappear()">
                    <div class="sub-title">
                        <a href="/index.php?controller=category&action=basic&class=<?php echo $class->class ?>"><?php echo "$class->class"; ?></a>
                        <i class="icon-down icon-plus d-none fas fa-plus"></i>
                        <i class="icon-down icon-minus d-none fas fa-minus"></i>
                    </div>
                    <?php if ( !empty($data_menu[$index]) && sizeof($data_menu[$index]) != 0 ) { ?>
                        <div class="subject f-regular-13">
                            <div class="subject-column1">
                                <?php for ($i = 0; $i < sizeof($data_menu[$index]) - intval(sizeof($data_menu[$index]) / 2); $i++) { ?>
                                    <div class="menu-item" onclick="directTo('/index.php?controller=category&action=detail&class=<?php echo $class->class ?>&subject=<?php echo $data_menu[$index][$i]->subject ?>&page=1')"><a href="/index.php?controller=category&action=detail&class=<?php echo $class->class ?>&subject=<?php echo $data_menu[$index][$i]->subject ?>&page=1"><?php echo $data_menu[$index][$i]->subject; ?></a></div>
                                <?php } ?>
                            </div>
                            <div class="subject-column2">
                                <?php for ($i = intval(sizeof($data_menu[$index]) / 2) + 1; $i < sizeof($data_menu[$index]); $i++) { ?>
                                    <div class="menu-item" onclick="directTo('/index.php?controller=category&action=detail&class=<?php echo $class->class ?>&subject=<?php echo $data_menu[$index][$i]->subject ?>&page=1')"><a href="/index.php?controller=category&action=detail&class=<?php echo $class->class ?>&subject=<?php echo $data_menu[$index][$i]->subject ?>&page=1"><?php echo $data_menu[$index][$i]->subject; ?></a></div>
                                <?php } ?>
                            </div>
                            <div class="subject-column3">
                                <img src="Public/Images/all/<?php echo $class_images[$index][1]; ?>.png" alt="menu<?php echo $class_images[$index][1]; ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>
<!-- END NAVIGATION -->
