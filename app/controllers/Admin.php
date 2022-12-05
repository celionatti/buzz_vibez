<?php

declare(strict_types=1);

namespace App\controllers;

use App\models\Image;
use Core\Router;
use Core\Session;
use Core\Controller;
use App\models\Users;
use App\models\Articles;
use App\models\Categories;
use App\models\Permission;
use Core\Helpers;
use Core\helpers\FileUpload;

defined('ROOT_PATH') or exit('Access Denied!');

class Admin extends Controller
{
    public $currentUser;

    public function onConstruct()
    {
        Permission::permRedirect(['admin', 'manager', 'author'], '');
        $this->view->setLayout('admin');
        $this->currentUser = Users::getCurrentUser();
    }

    public function index()
    {
        Router::redirect('admin/dashboard');
    }

    public function dashboard()
    {
        $view = [
        ];
        $this->view->render('admin/dashboard', $view);
    }

    /** ****** User Actions ******* */

    public function users()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'fname, lname'];
        $params = Users::mergeWithPagination($params);

        $view = [
            'users' => Users::find($params)
        ];
        $this->view->render('admin/users/users', $view);
    }

    public function user($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        if ($id == 'new') {
            $user = new Users();
        } else {
            $params = [
                'conditions' => "uid = :uid",
                'bind' => ['uid' => $id]
            ];
            $user = Users::findFirst($params);
        }

        if (!$user) {
            Session::msg("You do not have permission to edit this user");
            Router::redirect('admin/dashboard');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $fields = ['fname', 'lname', 'email', 'phone', 'acl', 'password', 'confirm_password'];
            foreach ($fields as $field) {
                $user->{$field} = $this->request->getReqBody($field);
            }
            $user->username = "@" . $user->fname . '_' . $user->lname;

            if ($id != 'new' && !empty($user->password)) {
                $user->resetPassword = false;
            }

            if ($user->save()) {
                Session::msg("Account Created Successfully!. Send details to user via Mail.", "success");
                Router::redirect('admin/users');
            }
        }

        $view = [
            'header' => $id == 'new' ? 'Create New User' : 'Edit User',
            'errors' => $user->getErrors(),
            'user' => $user,
            'acl_opts' => [
                '' => '',
                Users::AUTHOR_PERMISSION => 'Author',
                Users::MANAGER_PERMISSION => 'Manager',
                Users::ADMIN_PERMISSION => 'Admin',
            ]
        ];
        $this->view->render('admin/users/user', $view);
    }

    /**
     * Summary of toggleUserAction
     * Toggle User Blocked status. 0 or 1.
     * @param mixed $userId
     */
    public function toggleUser($userId)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = [
            'conditions' => "uid = :uid",
            'bind' => ['uid' => $userId]
        ];
        $user = Users::findFirst($params);
        $msg = 'User cannot be blocked';
        $type = "danger";
        if ($user && $user->uid !== $this->currentUser->uid) {
            $user->blocked = $user->blocked ? 0 : 1;
            $user->save();
            $msg = $user->blocked ? "User blocked." : "User unblocked.";
            $type = "success";
        }
        Session::msg($msg, $type);
        Router::redirect('admin/users');
    }

    /**
     * Summary of deleteUserAction
     * Delete User from the Database.
     * @param mixed $userId
     */
    public function deleteUser($userId)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');
        $params = [
            'conditions' => "uid = :uid",
            'bind' => ['uid' => $userId]
        ];
        $user = Users::findFirst($params);
        $msgType = 'danger';
        $msg = 'User cannot be deleted';
        if ($user && $user->uid !== $this->currentUser->uid) {
            $user->delete();
            $msgType = 'success';
            $msg = 'User deleted';
        }
        Session::msg($msg, $msgType);
        Router::redirect('admin/users');
    }

    /** ******* Articles Actions ******** */

    public function articles()
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        if($this->currentUser->acl === 'admin' || $this->currentUser->acl === 'manager') {
            $params = [
                'columns' => "articles.*, users.username",
                'joins' => [
                    ['users', 'articles.user_id = users.uid'],
                ],
                'order' => 'id DESC'
            ];
        } else {
            $params = [
                'columns' => "articles.*, users.username",
                'joins' => [
                    ['users', 'articles.user_id = users.uid'],
                ],
                'conditions' => "user_id = :user_id",
                'bind' => ['user_id' => $this->currentUser->uid],
                'order' => 'id DESC'
            ];
        }

        $params = Articles::mergeWithPagination($params);

        $view = [
            'articles' => Articles::find($params)
        ];
        $this->view->render('admin/articles/articles', $view);
    }

    public function article($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        $params = [
            'conditions' => "id = :id AND user_id = :user_id",
            'bind' => ['id' => $id, 'user_id' => $this->currentUser->uid]
        ];
        $article = $id == 'new' ? new Articles() : Articles::findFirst($params);
        if (!$article) {
            Session::msg("You do not have permission to edit this article");
            Router::redirect('admin/articles');
        }

        $categories = Categories::find(['order' => 'category']);
        $catOptions = [0 => ''];
        foreach ($categories as $category) {
            $catOptions[$category->id] = $category->category;
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $article->user_id = $this->currentUser->uid;
            $article->title = $this->request->getReqBody('title');
            $article->status = $this->request->getReqBody('status');
            $article->content = $this->request->getReqBody('content');
            $article->category_id = $this->request->getReqBody('category_id');
            $article->trending = $this->request->getReqBody('trending');
            $article->tags = $this->request->getReqBody('tags');
            /** Image Upload validation and Upload */
            $upload = new FileUpload('thumbnail');
            if ($id == 'new') {
                $upload->required = true;
            }

            $uploadErrors = $upload->validate();

            if (!empty($uploadErrors)) {
                foreach ($uploadErrors as $field => $error) {
                    $article->setError($field, $error);
                }
            }

            /** Set end one Image Upload validation and Upload */

            if (empty($article->getErrors())) {
                $upload->directory('uploads/articles');

                if ($article->save()) {
                    if (!empty($upload->tmp)) {

                        if ($upload->upload()) {
                            if ($id != 'new' && file_exists($article->thumbnail)) {
                                unlink($article->thumbnail);
                                $article->thumbnail = "";
                            }
                            $article->thumbnail = $upload->fc;
                            $image = new Image();
                            $image->resize($article->thumbnail);
                            $article->save();
                        }
                    }
                    Session::msg("{$article->title} saved.", 'success');
                    Router::redirect('admin/articles');
                }
            }

        }

        $view = [
            'errors' => $article->getErrors(),
            'article' => $article,
            'hasImage' => !empty($article->img),
            'statusOptions' => ['' => '', 'draft' => 'Draft', 'published' => 'Published'],
            'trendingOptions' => [0 => 'No', 1 => 'Yes'],
            'categoryOptions' => $catOptions,
            'heading' => $id === 'new' ? "Add New Article" : "Edit Article"
        ];
        $this->view->render('admin/articles/article', $view);
    }

    public function deleteArticle($id)
    {
        Permission::permRedirect(['admin', 'manager', 'author'], 'admin');

        if ($this->currentUser->acl === 'admin' || $this->currentUser->acl === 'manager') {
            $params = [
                'conditions' => "id = :id",
                'bind' => ['id' => $id]
            ];
        } else {
            $params = [
                'conditions' => "id = :id AND user_id = :user_id",
                'bind' => ['id' => $id, 'user_id' => $this->currentUser->uid]
            ];
        }

        $article = Articles::findFirst($params);
        if ($article) {
            Session::msg("Article Deleted.", 'success');
            if (!empty($article->thumbnail) && file_exists($article->thumbnail)) {
                unlink($article->thumbnail);
            }
            if (!empty($article->img_one) && file_exists($article->img_one)) {
                unlink($article->img_one);
            }
            if (!empty($article->img_two) && file_exists($article->img_two)) {
                unlink($article->img_two);
            }
            if (!empty($article->img_three) && file_exists($article->img_three)) {
                unlink($article->img_three);
            }
            $article->delete();
        } else {
            Session::msg("You do not have permission to delete that article");
        }
        Router::redirect('admin/articles');
    }

    /** ******* Categories Actions ******** */
    public function categories()
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $params = ['order' => 'category'];
        $params = Categories::mergeWithPagination($params);

        $view = [
            'categories' => Categories::find($params)
        ];
        $this->view->render('admin/categories/categories', $view);
    }

    public function category($id = 'new')
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');

        $category = $id == 'new' ? new Categories() : Categories::findById($id);

        if (!$category) {
            Session::msg("Category does not exist.");
            Router::redirect('admin/categories');
        }

        if ($this->request->isPost()) {
            Session::csrfCheck();
            $category->category = $this->request->getReqBody('category');
            $category->status = $this->request->getReqBody('status');

            if ($category->save()) {
                Session::msg('Category Saved!', 'success');
                Router::redirect('admin/categories');
            }
        }

        $view = [
            'errors' => $category->getErrors(),
            'category' => $category,
            'header' => $id == 'new' ? "Add Category" : "Edit Category",
            'category_status_opts' => [
                '' => '',
                Categories::ACTIVE_STATUS => "Active",
                Categories::DISABLED_STATUS => "Disabled",
            ]
        ];
        $this->view->render('admin/categories/category', $view);
    }

    public function deleteCategory($id)
    {
        Permission::permRedirect(['admin', 'manager'], 'admin');
        $category = Categories::findById($id);
        if (!$category) {
            Session::msg("That category does not exist");
            Router::redirect('admin/categories');
        } else {
            $category->delete();
            Session::msg("Category Deleted.", 'success');
            Router::redirect('admin/categories');
        }
    }
}