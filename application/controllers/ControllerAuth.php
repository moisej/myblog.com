<?php

namespace liw\application\controllers;

use liw\application\core\Controller as Controller;
use liw\application\models\ModelAuth;

class ControllerAuth extends Controller
{
    private $conn;

    function __construct($conn)
    {
        parent::__construct($conn);
        $this->conn = $conn;
        $this->model =  new ModelAuth($conn);
    }

    public function actionDisplaySignForm()
    {
        $this->view->generate('view_sign_page.php', 'general_template.php');
    }

    public function actionDisplayLoginForm()
    {
        $this->view->generate('view_login_page.php', 'general_template.php');
    }

    public function actionSignIn()
    {
        $data = $this->getDataFromAuthorisationForm();
        $this->model->addNewUser($data);
    }

    public function actionLogin()
    {
        $data = $this->getDataFromAuthorisationForm();
        $this->model->loginIntoTheSystem($data);
    }

    private function getDataFromAuthorisationForm()
    {
        $data = array();

        $login = $_POST['login'];
        $password = strtolower($_POST['password']);

        array_push($data, $login);
        array_push($data, $password);

        return $data;
    }
}