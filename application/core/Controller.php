<?php

namespace liw\application\core;

use liw\application\core\View as View;

class Controller {

    public $model;
    public $view;

    /**
     * Controller constructor.
     * @param $conn - Database connection
     */
    public function __construct($conn)
    {
        $this->view = new View();
    }

}

