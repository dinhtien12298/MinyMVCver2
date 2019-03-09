<div id="post-create">
    <form method="post" action="index.php?controller=userHome&action=postPostCreate">
        <div class="post-banner">
            <h1 class="f-regular-25">Đăng bài viết</h1>
            <hr>
            <h6 class="f-regular-15">Đóng góp cho cộng đồng những bài viết bổ ích</h6>
        </div>
        <div class="form-element">
            <label for="title">Tiêu đề</label>
            <input class="title-input" type="text" name="title" placeholder="Tiêu đề" required>
        </div>
        <div class="form-element double-element">
            <div>
                <label for="class">Lớp</label>
                <select class="class-input" name="class" required>
                    <?php foreach ($all_classes as $class) {?>
                        <option value="<?php echo $class->class ?>"><?php echo $class->class ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="subject">Chủ đề</label>
                <select class="subject-input" name="subject" required>

                </select>
            </div>
        </div>
        <div class="form-element">
            <label for="content">Nội dung</label>
            <textarea class="content-input" name="content" placeholder="Nội dung" required></textarea>
            <script>CKEDITOR.replace( 'content' )</script>
        </div>
        <button name="submit" type="submit">Đăng bài</button>
    </form>
</div>