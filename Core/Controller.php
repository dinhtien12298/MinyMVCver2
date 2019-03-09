<?php
    abstract class Controller
    {
        public function loadModel($model)
        {
            $model_name = ucfirst($model) . "Model";
            require_once ROOT . "App/Models/$model_name.php";
            $model = new $model_name();
            return $model;
        }

        public function loadView($data)
        {
            extract($data);
            require_once ROOT . "App/Views/Templates/screen.php";
        }

        public function dataComponents()
        {
            $data['all_classes'] = $this->getMenu()['all_classes'];
            $data['data_menu'] = $this->getMenu()['data_menu'];
            $data['class_images'] = $this->getMenu()['class_images'];
            $data['banner_title'] = $this->getBanner()['banner_title'];
            $data['breadcrumb'] = $this->getBanner()['breadcrumb'];
            $data['all_ads'] = $this->getSideBar()['all_ads'];
            if (isset($this->getSideBar()['data_related'])) { $data['data_related'] = $this->getSideBar()['data_related']; }
            $data['data_footer'] = $this->getFooter();
            return $data;
        }

        public function getMenu()
        {
            $all_classes = $this->loadModel('Class')->findAllClasses();
            $subject_model = $this->loadModel('Subject');
            foreach ($all_classes as $class) {
                $index = array_search($class, $all_classes);
                $class_name = $class->class;
                $data_menu[$index] = $subject_model->searchSubjectsOfClass($class_name);
                $class_images[$index] = explode(" ", $class_name);
            }
            $data['all_classes'] = $all_classes;
            $data['data_menu'] = $data_menu;
            $data['class_images'] = $class_images;
            return $data;
        }

        public function getBanner()
        {
            $class_name = isset($_GET['class']) ? $_GET['class'] : '';
            $post_id = isset($_GET['post']) ? $_GET['post'] : '';
            $post = isset($_GET['post']) ? $this->loadModel('Post')->classAndSubjectOfPost($post_id) : '';
            $subject = isset($_GET['post']) ? $post->subject : '';
            $title = isset($_GET['post']) ? $post->title : '';
            $banner_title = isset($_GET['post']) ? "$subject - $title" : "$class_name - GIẢI BÀI TẬP $class_name";
            $data['breadcrumb'] = $this->breadcrumb($post);
            $data['banner_title'] = $banner_title;

            return $data;
        }

        public function getSideBar()
        {
            $all_ads = $this->loadModel('Advertiment')->findAllAdvertiments();
            if (isset($_GET['post'])) {
                $post_model = $this->loadModel('Post');
                $post_id = $_GET['post'];
                $subject_id = $post_model->findSubjectIdOfPost($post_id)->subject_id;
                $data_related = $post_model->findPostRelated($post_id, $subject_id);
                $data['all_ads'] = $all_ads;
                $data['data_related'] = $data_related;
                return $data;
            }
            $data['all_ads'] = $all_ads;
            return $data;
        }

        public function getFooter()
        {
            $all_subjects = $this->loadModel('Subject')->fetchAllSubjects();
            $data_footer = [];
            $data_check_name = [];
            foreach ($all_subjects as $subject) {
                if (!in_array($subject->subject, $data_check_name)) {
                    array_push($data_footer, $subject);
                    array_push($data_check_name, $subject->subject);
                }
                if (sizeof($data_footer) >= 8) {
                    break;
                }
            }
            return $data_footer;
        }

        public function breadcrumb($post)
        {
            $breadcrumb = ['trang chủ'];
            if (isset($_GET['class'])) {
                array_push($breadcrumb, $_GET['class']);
            }
            if (isset($_GET['subject']) && $_GET['class'] != 'Mới nhất') {
                array_push($breadcrumb, $_GET['subject']);
            }
            if (isset($_GET['post'])) {
                if (!in_array($post->class, $breadcrumb)) {
                    array_push($breadcrumb, $post->class);
                }
                if (!in_array($post->subject, $breadcrumb)) {
                    array_push($breadcrumb, $post->subject);
                }
                array_push($breadcrumb, $post->title);
            }
            return $breadcrumb;
        }
    }