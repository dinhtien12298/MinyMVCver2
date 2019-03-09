<?php
    include '../../Core/config.php';
    require_once ROOT . 'Core/Controller.php';
    require_once ROOT . 'Core/Database.php';
    require_once ROOT . 'App/Models/PostModel.php';

    class DeletePostApi extends Controller
    {
        public function __construct()
        {
            $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';
            $delete_status = $this->deletePost($post_id);
            echo $delete_status;
        }

        public function deletePost($post_id)
        {
            $delete = $this->loadModel('Post')->deletePost($post_id);
            if (!$delete) {
                return "Xóa bài viết không thành công!";
            }
            return "Xóa bài viết thành công!";
        }
    }
    new DeletePostApi();
