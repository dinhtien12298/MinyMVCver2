<div id="post-management">
    <table>
        <tr class="table-heading f-regular-15">
            <th>Tiêu đề</th>
            <th>Lớp</th>
            <th>Chủ đề</th>
            <th>Lượt xem</th>
            <th>Lượt thích</th>
            <th style="width: 30%">Nội dung</th>
            <th>Quản lý</th>
        </tr>
        <?php if (sizeof($all_posts) > 0) {
            foreach ($all_posts as $post) {
                $index = array_search($post, $all_posts);
                $post_id = "'$post->id'" ?>
                <tr class="f-regular-14">
                    <td><?php echo $post->title ?></td>
                    <td><?php echo $post->class ?></td>
                    <td><?php echo $post->subject ?></td>
                    <td><?php echo $post->view_num ?></td>
                    <td><?php echo $post->like_num ?></td>
                    <td class="content-column"><?php echo $post->content ?></td>
                    <td>
                        <a href="index.php?controller=post&action=detail&post=<?php echo $post->id ?>">Xem</a>
                        <a href="index.php?controller=userHome&action=getPostUpdate&postId=<?php echo $post_id ?>">Sửa</a>
                        <a onclick="deletePost(<?php echo $post_id ?>, <?php echo $index ?>)">Xóa</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr class="f-regular-14">
                <td></td>
                <td></td>
                <td>Bạn</td>
                <td>chưa</td>
                <td>có</td>
                <td>bài viết nào cả!</td>
                <td></td>
            </tr>
        <?php } ?>
    </table>
</div>