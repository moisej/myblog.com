<?php

namespace liw\application\controllers;

use liw\application\core\Controller as Controller;
use liw\application\models\ModelPost as ModelPost;

class ControllerPost extends Controller
{
    private $conn;

    /**
     * ControllerPost constructor.
     * @param $conn - Database connection
     */
    function __construct($conn)
    {
        parent::__construct();
        $this->conn = $conn;
        $this->model = new ModelPost($this->conn);
    }

    /**
     * Displaying the page of creating new post
     */
    function actionCreate()
    {
        $this->view->generate('view_post_create.php', 'general_template.php');
    }

    /**
     * Method of creating new post
     */
    function actionAdd()
    {
        //array for saving of the entered data, which will be delivered to the model and inserted into the database
        $data = array();

        if(($_POST['title']=="" || $_POST['postText']==""))
        {
            $data['error'] = "Please fill in all fields";
            echo $data['error'];
        }
        else
        {
            $postText = nl2br($_POST["postText"]);

            echo $postText;
            array_push($data, $_POST['title']);
            array_push($data, $postText);

            //creating post in the database
            $postId = $this->model->createNewPost($data);

            //redirecting on the page of created post
            header("Location: /Post/Display/$postId");
        }
    }

    /**
     * Display post with certain id
     * @param $postId - id of the post
     */
    function actionDisplay($postId)
    {
        //getting post with determined id
        $data = $this->model->getPost($postId);
        $this->view->generate('view_post_page.php', 'general_template.php', $data);
    }

    /**
     * Display all posts on main (default) page
     */
    function actionDisplayAllPosts()
    {
        //getting all posts from database
        $data = $this->model->getAllPosts();
        $this->view->generate('view_home_page.php', 'general_template.php', $data);
    }

    /**
     * Downloading more posts via AJAX
     */
    function actionLoadPosts()
    {
        $pageNumber = $_POST["page"];
        if (is_numeric($pageNumber)) {
            $this->model->loadPosts($pageNumber);
        }
        else
        {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }
    }

    /**
     * Downloading post as a CSV-file
     * @param $post_id - id of the post
     */
    function actionDownloadCsv($postId)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Id', 'Title', 'Text', 'Image (base64)'));
        $data = $this->model->getPost($postId);
        foreach($data as $row)
        {
            fputcsv($output, $row);
        }
    }
}
