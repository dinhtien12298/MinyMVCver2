<?php
    class PostModel extends Database
    {
        // Banner
        public function classAndSubjectOfPost($post_id)
        {
            $data = $this->fetchARecord("
                SELECT title, subjects.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }

        // Sidebar
        public function findSubjectIdOfPost($post_id)
        {
            $data = $this->fetchARecord("SELECT subject_id FROM posts WHERE id = $post_id");
            return $data;
        }

        public function findPostRelated($post_id, $subject_id)
        {
            $data = $this->fetchAllRecords("
                SELECT id, title 
                FROM posts 
                WHERE subject_id = $subject_id AND
                id != $post_id
                LIMIT 8
            ");
            return $data;
        }

        // Homepage
        public function findLatestPosts()
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LIMIT 6
            ");
            return $data;
        }

        public function findPostsByClassAndSubject($class, $subject)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, subjects.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                WHERE subjects.class = '$class' AND 
                subjects.subject = '$subject'
                LIMIT 6
            ");
            return $data;
        }

        // Category
        public function findTabPost($subject_id, $limit)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, subjects.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN users ON posts.user_id = users.id
                WHERE subjects.id = $subject_id
                LIMIT $limit
            ");
            return $data;
        }

        public function findLastedPostForPage($start_number)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LIMIT $start_number, 9
            ");
            return $data;
        }

        public function findPostsForPage($start_number, $subject_id)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                WHERE subject_id = $subject_id
                LIMIT $start_number, 9
            ");
            return $data;
        }

        public function countPosts($start_number, $subject_id)
        {
            if ($subject_id == 0) {
                $query = "SELECT id FROM posts LIMIT $start_number, 28";
            } else {
                $query = "SELECT id FROM posts WHERE subject_id = $subject_id LIMIT $start_number, 28";
            }
            return $this->countRecords($query);
        }

        // Detail
        public function findPostDetail($post_id)
        {
            $data = $this->fetchARecord("
                SELECT posts.id, title, view_num, like_num, content, fullname, subjects.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }

        public function findTabPostByClass($post_id, $class)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, subjects.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                WHERE subjects.class = '$class' AND
                posts.id != $post_id
                LIMIT 6
            ");
            return $data;
        }

        // User
        public function findPostsByUser($user_id)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, subjects.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                WHERE posts.user_id = $user_id
            ");
            return $data;
        }

        // API
        public function searchPostByKeyword($keyword)
        {
            $data = $this->fetchAllRecords("SELECT id, title FROM posts WHERE title like '%$keyword%'");
            return $data;
        }

        public function searchTabPost($subject_id, $limit)
        {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, subjects.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN users ON posts.user_id = users.id
                WHERE subjects.id = $subject_id
                LIMIT $limit
            ");
            return $data;
        }

        public function deletePost($post_id)
        {
            $delete = $this->execute("DELETE FROM posts WHERE id = $post_id");
            return $delete;
        }

        public function createPost($title, $user_id, $subject_id, $content)
        {
            $create = $this->execute("
                INSERT INTO posts(title, user_id, subject_id, content)
                VALUES ('$title', $user_id, $subject_id, '$content')
            ");
            return $create;
        }

        public function updatePost($post_id, $title, $subject_id, $content)
        {
            $update = $this->execute("
                UPDATE posts SET title = '$title', subject_id = $subject_id, content = '$content'
                WHERE id = $post_id
            ");
            return $update;
        }
    }