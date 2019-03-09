<?php
    include '../../Core/config.php';
    require_once ROOT . 'Core/Controller.php';
    require_once ROOT . 'Core/Database.php';
    require_once ROOT . 'App/Models/PostModel.php';

    class SearchPostApi extends Controller
    {
        public function __construct()
        {
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $data = $this->searchPosts($keyword);
            echo $data;
        }

        public function searchPosts($keyword)
        {
            $data = $this->loadModel('Post')->searchPostByKeyword($keyword);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchPostApi();