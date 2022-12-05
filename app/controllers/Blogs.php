<?php

declare(strict_types=1);

namespace App\controllers;

use Core\Controller;


defined('ROOT_PATH') or exit('Access Denied!');

class Blogs extends Controller
{
    public function index()
    {
        $view = [
            'name' => 'Celio natti'
        ];
        $this->view->render('pages/blogs', $view);
    }
}