<div class="content">
    <div class="container">
        <div class="d-flex">
            <!-- START MAIN CONTENT -->
            <div class="content-post">
                <?php foreach ($data_content as $list_posts) {
                    if (sizeof($list_posts) > 0) {?>
                        <div class="list-post basic">
                            <div class="tab-heading">
                                <div class="tab-title f-regular-30">
                                    <?php echo $list_posts[0]->subject ?>
                                </div>
                                <div class="view-all">
                                    <a class="f-regular-13" href="/index.php?controller=category&action=detail&class=<?php echo $list_posts[0]->class ?>&subject=<?php echo $list_posts[0]->subject ?>&page=1">
                                        Xem tất cả
                                        <i class="fas fa-caret-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="line-orange"></div>
                            <div class="tab-post">
                                <?php for ($i = 0; $i < sizeof($list_posts); $i++) {?>
                                    <div class="post-model" onclick="directTo('/index.php?controller=post&action=detail&post=<?php echo $list_posts[$i]->id ?>')">
                                        <div class="post-title">
                                            <a href="/index.php?controller=post&action=detail&post=<?php echo $list_posts[$i]->id ?>" class="f-medium-17"><?php echo $list_posts[$i]->title ?></a>
                                        </div>
                                        <div class="post-heading d-flex">
                                            <div class="post-author f-medium-12">
                                                <?php echo $list_posts[$i]->fullname ?>
                                            </div>
                                            <div class="post-info f-regular-13">
                                                <div><img src="Public/Images/homepage/icon-view.png" alt="icon-view"><?php echo $list_posts[$i]->view_num ?></div>
                                                <div><img src="Public/Images/homepage/icon-heart.png" alt="icon-like"><?php echo $list_posts[$i]->like_num ?></div>
                                            </div>
                                        </div>
                                        <div class="post-content f-regular-13">
                                            <?php echo $list_posts[$i]->content ?>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="view-more">
                                <a href="/index.php?controller=category&action=detail&class=<?php echo $list_posts[0]->class ?>&subject=<?php echo $list_posts[0]->subject ?>&page=1"><button class="f-regular-13">Xem thêm</button></a>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
            <!-- END MAIN CONTENT -->

            <!-- START SIDEBAR -->
            <?php require_once ROOT . 'App/Views/Templates/sidebar.php'; ?>
            <!-- END SIDEBAR -->
        </div>
    </div>
</div>
