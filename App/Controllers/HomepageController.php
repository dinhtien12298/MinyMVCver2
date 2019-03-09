<?php
    class HomepageController extends Controller
    {
        protected $list_classes;
        public function __construct()
        {
            $this->list_classes = [
                'Mới nhất',
                'lớp 9',
                'lớp 8'
            ];
        }

        public function homepage()
        {
            $data = $this->dataComponents();
            $data['list_buttons'] = $this->getSubjectData();
            $data['data_content'] = $this->getPostData($data['list_buttons']);
            $data['page'] = 'homepage';
            $data['action'] = 'homepage';
            $data['list_classes'] = $this->list_classes;
            $this->loadView($data);
        }

        private function getSubjectData()
        {
            $model = $this->loadModel('Subject');
            $list_buttons = [];
            foreach ($this->list_classes as $class) {
                $index = array_search($class, $this->list_classes);
                $list_buttons[$index] = $model->findSubjectsForButton($class);
            }
            return $list_buttons;
        }

        private function getPostData($list_buttons)
        {
            $model = $this->loadModel('Post');
            $data_content = [];
            foreach ($this->list_classes as $class_name) {
                $index = array_search($class_name, $this->list_classes);
                $data_content[$index] = [];
                if ($class_name == "Mới nhất") {
                    $data_content[$index] = $model->findLatestPosts();
                } else {
                    $subject = $list_buttons[$index][0]->subject;
                    $data_content[$index] = $model->findPostsByClassAndSubject($class_name, $subject);
                }
            }
            return $data_content;
        }
    }