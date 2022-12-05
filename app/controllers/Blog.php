<?php

declare(strict_types=1);

namespace App\controllers;

use App\models\CommentReplies;
use App\models\Comments;
use Core\Router;
use Core\Controller;
use App\models\Users;
use App\models\Articles;


defined('ROOT_PATH') or exit('Access Denied!');

class Blog extends Controller
{
    public $currentUser;

    public function onConstruct()
    {
        $this->currentUser = Users::getCurrentUser();
    }

    public function read($id)
    {
        $params = [
            'conditions' => "slug = :slug AND status = :status",
            'bind' => ['status' => 'published', 'slug' => $id],
            'order' => 'id DESC'
        ];

        $article = Articles::findFirst($params);
        if (!$article)
            Router::redirect('errors/_404');

        $view = [
            'article' => $article,
        ];
        $this->view->render('pages/read', $view);
    }

    public function comment()
    {
        $comment = new Comments();

        if(isset($_POST['add_comment'])) {
            $comment->message = $this->request->getReqBody('msg');
            $comment->article_slug = $this->request->getReqBody('slug');
            $comment->user_id = $this->currentUser->uid ?? null;

            if($comment->save()) {
                $this->jsonResponse("Comment Added Successfully.");
            } else {
                $this->jsonResponse("Comment not added, Something went wrong.");
            }
        }
    }

    public function loadComment($id)
    {
        if(isset($_POST['comment_load_data'])) {
            $params = [
                'columns' => "comments.*, users.username",
                'conditions' => "comments.article_slug = :article_slug AND comments.status = :status",
                'bind' => ['article_slug' => $id, 'status' => 'active'],
                'joins' => [
                    ['users', 'comments.user_id = users.uid'],
                ],
                'order' => 'comments.created_at DESC'
            ];

            $comments = Comments::find($params);

            if($comments) {
                $this->jsonResponse($comments);
            } else {
                $this->jsonResponse("Give a Comment.");
            }

        }
    }

    public function addReplyComment()
    {
        $commentReplies = new CommentReplies();

        if(isset($_POST['add_reply'])) {
            $commentReplies->comment_id = $this->request->getReqBody('comment_id');
            $commentReplies->reply_msg = $this->request->getReqBody('reply_msg');
            $commentReplies->user_id = $this->currentUser->uid ?? null;

            if($commentReplies->save()) {
                $this->jsonResponse("Comment Replied Successfully.");
            } else {
                $this->jsonResponse("Comment not Replied, Something went wrong.");
            }
        }
    }

    public function viewCommentReplies()
    {
        if(isset($_POST['view_comment_data'])) {
            $comment_id = $this->request->getReqBody('comment_id');

            $params = [
                'columns' => "comment_replies.*, users.username",
                'conditions' => "comment_replies.comment_id = :comment_id AND comment_replies.status = :status",
                'bind' => ['comment_id' => $comment_id, 'status' => 'active'],
                'joins' => [
                    ['users', 'comment_replies.user_id = users.uid'],
                ],
                'order' => 'comment_replies.created_at DESC'
            ];

            $commentReplies = CommentReplies::find($params);

            if ($commentReplies) {
                $this->jsonResponse($commentReplies);
            } else {
                $this->jsonResponse("No comment replies yet.");
            }
        }
    }

    public function addSubReplies()
    {
        $commentReplies = new CommentReplies();

        if(isset($_POST['add_sub_replies'])) {
            $commentReplies->comment_id = $this->request->getReqBody('comment_id');
            $commentReplies->reply_msg = $this->request->getReqBody('reply_msg');
            $commentReplies->user_id = $this->currentUser->uid ?? null;

            if ($commentReplies->save()) {
                $this->jsonResponse("Comment Replied Successfully.");
            } else {
                $this->jsonResponse("Comment not Replied, Something went wrong.");
            }
        }
    }
}