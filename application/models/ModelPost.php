<?php

namespace liw\application\models;

use liw\application\core\Model as Model;

class ModelPost extends Model
{
    private $conn;

    /**
     * ModelPost constructor.
     * @param $conn - Database connection
     */
    public function __construct($conn)
    {
        parent::__construct();
        $this->conn = $conn;
    }

    /**
     * Creating new post in database
     * @param $data - data, which need to be inserted into database (post information)
     * @return mixed - id of inserted row
     */
    public function createNewPost($data)
    {
        $title = $data[0];
        $text = $data[1];

        if($_FILES['image']['size']!=0) {
            $image = addslashes($_FILES['image']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);
        }

        $sql = "INSERT INTO posts (title, text, image) VALUES ('" . $title . "','" . $text ."','". $image ."')";
        $this->conn->query($sql);

        return $this->conn->insert_id;
    }

    /**
     * Getting post with determined id
     * @param $postId - id of the post
     * @return array - selected data from database
     */
    public function getPost($postId)
    {
        $data = array();
        if(is_numeric($postId))
        {
            $sql = "SELECT * FROM posts WHERE id = '". $postId ."'";
            $output = $this->conn->query($sql);

            if($output->num_rows > 0)
            {
                while($row = $output->fetch_assoc())
                {
                   array_push($data, $row);
                }

                return $data;
            }
            else
            {
                header("HTTP/1.0 404 Not found");
                echo 'Error: 404';
                die();
            }
        }
        else
        {
            header("HTTP/1.0 500 post_id not not numeric");
            echo 'Error: 500. Something went wrong';
            die();
        }
    }

    /**
     * Getting all posts
     * @return array - selected data from database
     */
    public function getAllPosts()
    {
        $data = array();
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $output = $this->conn->query($sql);

        if($output->num_rows > 0)
        {
            while($row = $output->fetch_assoc())
            {
                array_push($data, $row);
            }
            return $data;
        }
        else
        {
            //Nothing found page
        }
    }

    /**
     * Downloading more posts via AJAX
     * @param $pageNumber - "abstract" number of page to load
     */
    public function loadPosts($pageNumber)
    {
        //number of posts to load
        $itemsPerPage = 3;

        if(!is_numeric($pageNumber)){
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }

        //calculating position from which to select data from database
        $position = (($pageNumber-1) * $itemsPerPage);

        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT " . $position . "," . $itemsPerPage;
        $output = $this->conn->query($sql);

        //displaying results
        while($row = $output->fetch_assoc()){

            echo ' 
                <div class="panel panel-default">
                    <div class="panel-body"> ';

            if(!empty($row['image']))
            {
                echo '
                        <img id="post_image" src="data:image/jpeg;base64,'.$row['image'].'">';
            }
            echo '
                        <div id="post_location_text">
                            <h3>
                                <a href=/Post/Display/'.$row['id'].'>
                                    <div id="post_title">
                                        '. $row['title'] .'
                                    </div>
                                </a>
                            </h3>
                            <div id="post_text">'.substr($row['text'], 0, 450).'';

            if(strlen($row['text']) > 450){
                echo '
                                ..... <br><a href=/Post/Display/'.$row['id'].' style="text-decoration:none; font-size:25px;">Read more</a>';
            }
            echo '
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
}