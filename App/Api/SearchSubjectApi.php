<?php
    include '../../Core/config.php';
    require_once ROOT . 'Core/Controller.php';
    require_once ROOT . 'Core/Database.php';
    require_once ROOT . 'App/Models/PostModel.php';

    class SearchSubjectApi extends Controller
    {
        public function __construct()
        {
            $class = isset($_GET['class']) ? $_GET['class'] : '';
            $data = $this->searchSubjects($class);
            echo $data;
        }

        public function searchSubjects($class)
        {
            $data = $this->loadModel('subject')->searchSubjectsOfClass($class);
            if ($data) {
                return json_encode($data);
            }
        }
    }
    new SearchSubjectApi();
