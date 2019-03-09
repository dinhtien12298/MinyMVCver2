<?php
    class UserActionController extends Controller
    {
        public function __construct()
        {
            if (isset($_SESSION['username'])) {
                header('location: index.php?controller=userHome&action=information');
            }
        }

        public function getLogin()
        {
            $data['action'] = 'login';
            $this->loadView($data);
        }

        public function postLogin()
        {
            if (isset($_POST['submit'])) {
                $model = $this->loadModel('User');
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $check = $model->checkUser($username, $password);
                if (!$check) {
                    $check_username = $model->checkUsername($username);
                    if (!$check_username) {
                        $data['action'] = 'login';
                        $data['error'] = 'Tên tài khoản chưa tồn tại!';
                        $this->loadView($data);
                    } else {
                        $data['action'] = 'login';
                        $data['error'] = 'Sai mật khẩu!';
                        $this->loadView($data);
                    }
                } else {
                    $_SESSION['username'] = $username;
                    header('location: index.php?controller=userHome&action=information');
                }
            } else {
                header('location: index.php?controller=userAction&action=getLogin');
            }
        }

        public function getSignup()
        {
            $data['action'] = 'signup';
            $this->loadView($data);
        }

        public function postSignup()
        {
            if (isset($_POST['submit'])) {
                $model = $this->loadModel('User');
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
                $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
                $birth = isset($_POST['birth']) ? $_POST['birth'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $working = isset($_POST['working']) ? $_POST['working'] : '';

                $data['username'] = $username;
                $data['password'] = $password;
                $data['fullname'] = $fullname;
                $data['birth'] = $birth;
                $data['phone'] = $phone;
                $data['email'] = $email;
                $data['working'] = $working;

                if ($password != $confirm_password) {
                    $data['action'] = 'signup';
                    $data['error'] = 'Mật khẩu không trùng nhau!';
                    $this->loadView($data);
                } elseif ($model->checkUsername($username)) {
                    $data['action'] = 'signup';
                    $data['error'] = 'Tên tài khoản đã tồn tại!';
                    $this->loadView($data);
                } elseif ($model->checkPhone($phone)) {
                    $data['action'] = 'signup';
                    $data['error'] = 'Số điện thoại đã tồn tại! Vui lòng dùng số khác!';
                    $this->loadView($data);
                } elseif ($model->checkEmail($email)) {
                    $data['action'] = 'signup';
                    $data['error'] = 'Email đã tồn tại! Vui lòng dùng tài khoản khác!';
                    $this->loadView($data);
                } elseif (!$model->signup($data)) {
                    $data['action'] = 'signup';
                    $data['error'] = 'Đăng ký tất bại!';
                    $this->loadView($data);
                } else {
                    $_SESSION['username'] = $username;
                    header('location: index.php?controller=userHome&action=information');
                }
            } else {
                header('location: index.php?controller=userAction$action=getSignup');
            }
        }

        public function checkUsername($username)
        {
            $model = $this->loadModel('User');
            $check = $model->checkUsername($username);
            return $check;
        }

        public function checkEmail($email)
        {
            $check = $this->model->checkEmail($email);
            return $check;
        }

        public function checkPhone($phone)
        {
            $check = $this->model->checkPhone($phone);
            return $check;
        }

        public function logout()
        {
            session_destroy();
            header('location: index.php?controller=userAction&action=getLogin');
        }
    }