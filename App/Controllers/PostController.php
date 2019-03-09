<?php
    class PostController extends Controller
    {
        public $post_id;
        public function __construct()
        {
            $this->post_id = isset($_GET['post']) ? $_GET['post'] : '';
        }

        public function detail()
        {
            $data = $this->dataComponents();
            $model = $this->loadModel('Post');
            $data['post'] = $model->findPostDetail($this->post_id);
            $data['data_more_post'] = $model->findTabPostByClass($this->post_id, $data['post']->class);
            $data['page'] = 'detail';
            $data['action'] = 'detail';
            $this->loadView($data);
        }
    }