<?php

namespace Controllers;

use Core\Controller;

/**
 * Example of default controller
 */
class Home extends Controller
{
    /**
     * Override index method to display welcome message.
     * @return void     Nothing to return
     */
    public function index()
    {
        $this->render('welcome');
    }
}
