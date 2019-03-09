<?php
    class CategoryController extends Controller
    {
        public $class;
        public $subject;
        public function __construct()
        {
            $this->class = isset($_GET['class']) ? $_GET['class'] : '';
            $this->subject = isset($_GET['subject']) ? $_GET['subject'] : '';
        }

        public function basic()
        {
            if ($_GET['class'] == 'Mới nhất') {
                $this->detail();
            } else {
                $data = $this->dataComponents();
                $all_subjects = $this->getSubjectBasicData();
                $data['data_content'] = $this->getPostBasicData($all_subjects);
                $data['page'] = 'category';
                $data['action'] = 'basicCategory';
                $this->loadView($data);
            }
        }

        public function detail()
        {
            $data = $this->dataComponents();
            if (isset($_GET['subject']) || $this->class == 'Mới nhất') {
                $page = ($_GET['page']);
                $tab_title = ($this->class == 'Mới nhất') ? $this->class : $this->subject;
                $data['tab_title'] = $tab_title;
                $data['data_content'] = $this->getPostDetailData($page)['data_content'];
                $data['page_button'] = $this->getPostDetailData($page)['page_button'];
                $data['continue'] = $this->getPostDetailData($page)['continue'];
                $data['page'] = 'category';
                $data['action'] = 'detailCategory';
                $this->loadView($data);
            }
        }

        private function getSubjectBasicData()
        {
            $class = $this->class;
            $model = $this->loadModel('Subject');
            $all_subjects = $model->searchSubjectsOfClass($class);
            return $all_subjects;
        }

        private function getPostBasicData($all_subjects)
        {
            $model = $this->loadModel('Post');
            $data_content = [];
            foreach ($all_subjects as $subject) {
                $index = array_search($subject, $all_subjects);
                $data_content[$index] = $model->findTabPost($subject->id, 3);
            }
            return $data_content;
        }

        private function getPostDetailData($page)
        {
            $post_model = $this->loadModel('Post');
            $subject_model = $this->loadModel('Subject');
            $start_number = 9 * ($page - 1);
            if ($this->class == 'Mới nhất') {
                $subject_id = 0;
                $data_content = $post_model->findLastedPostForPage($start_number);
            } else {
                $subject_id = $subject_model->searchSubjectIdByClassAndSubject($this->class, $this->subject)->id;
                $data_content = $post_model->findPostsForPage($start_number, $subject_id);
            }
            $number_of_records = $post_model->countPosts($start_number, $subject_id);
            $data['page_button'] = $this->calculatePageNumber($page, $number_of_records)['page_number'];
            $data['data_content'] = $data_content;
            $data['continue'] = $this->calculatePageNumber($page, $number_of_records)['continue'];
            return $data;
        }

        public function calculatePageNumber($page, $number_of_records)
        {
            $continue = false;
            if ($number_of_records <= 9) {
                $page_number = $page;
            } elseif ($number_of_records <= 18) {
                $page_number = $page + 1;
            } else {
                $page_number = $page + 2;
            }
            if ($number_of_records > 27) {
                $continue = true;
            }
            $data['continue'] = $continue;
            $data['page_number'] = $page_number;
            return $data;
        }
    }