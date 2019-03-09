<?php
    class UserModel extends Database
    {
        // User
        public function foundUser($username)
        {
            $data = $this->fetchARecord("SELECT id, username, password, fullname, birth, phone, email, working FROM users WHERE username = '$username'");
            return $data;
        }

        // API
        public function updateInfo($username, $password, $phone, $email, $working)
        {
            $update = $this->execute("
                UPDATE users SET password = '$password', phone = $phone, email = '$email', working = '$working'
                WHERE username = '$username'
            ");

            return $update;
        }

        public function checkUser($username, $password)
        {
            $check = $this->checkExistRecord("
                SELECT id, username, password, fullname, birth, phone, email, working FROM users WHERE username = '$username' AND password = '$password'
            ");
            return $check;
        }

        public function checkUsername($username)
        {
            $check = $this->checkExistRecord("
                SELECT id, username, password, fullname, birth, phone, email, working FROM users WHERE username = '$username'
            ");
            return $check;
        }

        public function checkEmail($email)
        {
            $check = $this->checkExistRecord("
                SELECT id, username, password, fullname, birth, phone, email, working FROM users WHERE email = '$email'
            ");
            return $check;
        }

        public function checkPhone($phone)
        {
            $check = $this->checkExistRecord("
                SELECT id, username, password, fullname, birth, phone, email, working FROM users WHERE phone = '$phone'
            ");
            return $check;
        }

        public function signUp($data)
        {
            $username = $data['username'];
            $password = $data['password'];
            $fullname = $data['fullname'];
            $birth = $data['birth'];
            $phone = $data['phone'];
            $email = $data['email'];
            $working = $data['working'];
            $sign_up = $this->execute("
                INSERT INTO users(username, password, fullname, birth, phone, email, working)
                VALUES ('$username', '$password', '$fullname', '$birth', $phone, '$email', '$working')
            ");
            return $sign_up;
        }
    }