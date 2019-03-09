<?php
    include '../../Core/config.php';
    require_once ROOT . 'Core/Controller.php';
    require_once ROOT . 'Core/Database.php';
    require_once ROOT . 'App/Models/PostModel.php';

    class TabPostApi extends Controller
    {
        public function __construct()
        {
            $subject_id = isset($_GET['subjectid']) ? $_GET['subjectid'] : '';
            $data = $this->searchTabPost($subject_id);
            echo $data;
        }

        public function searchTabPost($subject_id)
        {
            $model = $this->loadModel('Post');
            $data = $model->searchTabPost($subject_id, 6);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new TabPostApi();
