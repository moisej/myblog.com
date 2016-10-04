<?php

//including database connection
require_once 'core/connect_db.php';

//Calling the Router - start of the programme
liw\application\core\Route::start($conn);

