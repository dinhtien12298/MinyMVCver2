<?php
    class UserHomeController extends Controller
    {
        protected $username;
        protected $user;
        protected $page;
        public function __construct()
        {
            if (!isset($_SESSION['username'])) {
                header('location: index.php?controller=login&action=getLogin');
            } else {
                $this->username = $_SESSION['username'];
                $this->user = $this->loadModel('User')->foundUser($this->username);
            }
            $this->page = 'userHome';
        }

        public function information()
        {
            $data = $this->dataComponents();

            $user_id = $this->user->id;
            $all_posts = $this->loadModel('Post')->findPostsByUser($user_id);
            $data['list_info'] = $this->getUserInfo($this->user, $all_posts);

            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'information';
            $this->loadView($data);
        }

        public function findTotalPostInfo($all_posts)
        {
            $view_number = 0;
            $like_number = 0;
            foreach ($all_posts as $post) {
                $view_number += $post->view_num;
                $like_number += $post->like_num;
            }
            return [$view_number, $like_number];
        }

        public function getUserInfo($user, $all_posts)
        {
            $list_info = [];
            $list_info['Tên tài khoản'] = $user->username;
            $list_info['Mật khẩu'] = '**********';
            $list_info['Tên đầy đủ'] = $user->fullname;
            $list_info['Tổng số bài viết'] = sizeof($all_posts);
            $list_info['Tổng lượt xem'] = $this->findTotalPostInfo($all_posts)[0];
            $list_info['Tổng lượt thích'] = $this->findTotalPostInfo($all_posts)[1];
            $list_info['Số điện thoại'] = $user->phone;
            $list_info['Email'] = $user->email;
            $list_info['Ngày sinh'] = $user->birth;
            $list_info['Cơ quan/Trường học'] = $user->working;
            return $list_info;
        }

        public function getUpdateInfo()
        {
            $data = $this->dataComponents();
            $data['user'] = $this->user;

            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'updateInfo';
            $this->loadView($data);
        }

        public function postUpdateInfo()
        {
            if (isset($_POST['submit'])) {
                $data = $this->dataComponents();
                $data['user'] = $this->user;
                $data['page'] = $this->page;
                $data['action'] = 'userHome';
                $data['userTemplate'] = 'updateInfo';

                $username = $this->username;
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $working = isset($_POST['working']) ? $_POST['working'] : '';

                $model = $this->loadModel('User');
                if (!$model->updateInfo($username, $password, $phone, $email, $working)) {
                    $data['error'] = 'Cập nhật thông tin thất bại!';
                    $this->loadView($data);
                } else {
                    header('location: index.php?controller=userHome&action=getUpdateInfo');
                }
            }
        }

        public function postManagement()
        {
            $data = $this->dataComponents();

            $user_id = $this->user->id;
            $data['all_posts'] = $this->loadModel('Post')->findPostsByUser($user_id);

            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'postManagement';
            $this->loadView($data);
        }

        public function getPostUpdate()
        {
            $data = $this->dataComponents();

            $post_id = isset($_GET['postId']) ? $_GET['postId'] : '';
            $data['post_detail'] = $this->loadModel('Post')->findPostDetail($post_id);
            $data['all_classes'] = $this->loadModel('Class')->findAllClasses();

            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'postUpdate';
            $this->loadView($data);
        }

        public function postPostUpdate()
        {
            if (isset($_POST['submit'])) {
                $data = $this->dataComponents();

                $post_id = isset($_GET['postId']) ? $_GET['postId'] : '';
                $data['post_detail'] = $this->loadModel('Post')->findPostDetail($post_id);
                $data['all_classes'] = $this->loadModel('Class')->findAllClasses();

                $data['page'] = $this->page;
                $data['action'] = 'userHome';
                $data['userTemplate'] = 'postUpdate';

                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
                $class = isset($_POST['class']) ? $_POST['class'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';

                $subject_id = $this->loadModel('subject')->searchSubjectIdByClassAndSubject($class, $subject)->id;

                $model = $this->loadModel('Post');
                if ($title == '') {
                    $data['error'] = 'Bạn chưa nhập tiêu đề!';
                    $this->loadView($data);
                } elseif ($content == '') {
                    $data['error'] == 'Bạn chưa có nội dung!';
                    $this->loadView($data);
                } elseif (!$model->updatePost($post_id, $title, $subject_id, $content)) {
                    $data['error'] = 'Cập nhật bài viết thất bại!';
                    $this->loadView($data);
                } else {
                    header('location: index.php?controller=userHome&action=postManagement');
                }
            }
        }

        public function getPostCreate()
        {
            $data = $this->dataComponents();
            $data['all_classes'] = $this->loadModel('Class')->findAllClasses();
            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'postCreate';
            $this->loadView($data);
        }

        public function postPostCreate()
        {
            $data = $this->dataComponents();
            $data['all_classes'] = $this->loadModel('Class')->findAllClasses();
            $data['page'] = $this->page;
            $data['action'] = 'userHome';
            $data['userTemplate'] = 'postCreate';

            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
            $class = isset($_POST['class']) ? $_POST['class'] : '';
            $content = isset($_POST['content']) ? $_POST['content'] : '';
            $user_id = $this->user->id;

            $subject_id = $this->loadModel('subject')->searchSubjectIdByClassAndSubject($class, $subject)->id;

            $model = $this->loadModel('Post');
            if ($title == '') {
                $data['error'] = 'Bạn chưa nhập tiêu đề!';
                $this->loadView($data);
            } elseif ($content == '') {
                $data['error'] == 'Bạn chưa có nội dung!';
                $this->loadView($data);
            } elseif (!$model->createPost($title, $user_id, $subject_id, $content)) {
                $data['error'] = 'Đăng bài viết thất bại!';
                $this->loadView($data);
            } else {
                header('location: index.php?controller=userHome&action=postManagement');
            }
        }
    }