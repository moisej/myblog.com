<?php


namespace liw\application\models;

use liw\application\core\Model as Model;

class ModelAuth extends Model
{
    private $conn;

    /**
     * ModelAuth constructor.
     * @param $conn - Database connection
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param null $data - array of data about user to insert into database
     */
    public function addNewUser($data = null)
    {
        if (count($data) != 0) {
            $login = $data[0];
            $password = $data[1];

            $sql = "INSERT INTO users (login, password) VALUES ('" . $login . "','" . md5($password) . "')";

            if ($this->conn->query($sql) == true) {
                echo "New user was added <br> You will be redirected on mane page in 2 seconds";
                header("refresh: 2; url=/");
            } else {
                echo "Sorry, something went wrong";
            }
        }
    }


    public function loginIntoTheSystem($data = null)
    {
        if (count($data) != 0) {
            $login = $data[0];
            $password = $data[1];

            $sql = "SELECT * FROM users WHERE login = '" . $login . "' AND password = '" . md5($password) . "'";

            if ($this->conn->query($sql) > 0) {
                echo "Loged in! <br> You will be redirected on mane page in 2 seconds";
                $_SESSION['authStatus'] = true;
                header("refresh: 2; url=/");
            } else {
                echo "Sorry, something went wrong";
            }
        }
    }

}