<?php

declare(strict_types=1);

namespace App\controllers;
use Core\Controller;
use App\models\Articles;


defined('ROOT_PATH') or exit('Access Denied!');

class Home extends Controller
{
    public function index()
    {
        $params = [
            'columns' => "articles.*, users.username, users.img, categories.category, categories.id as category_id",
            'conditions' => "articles.status = :status",
            'bind' => ['status' => 'published'],
            'joins' => [
                ['users', 'articles.user_id = users.uid'],
                ['categories', 'articles.category_id = categories.id', 'categories', 'LEFT']
            ],
            'order' => 'articles.id DESC'
        ];

        $params = Articles::mergeWithPagination($params);

        $view = [
            'articles' => Articles::find($params),
        ];
        $this->view->render('pages/home', $view);
    }
}