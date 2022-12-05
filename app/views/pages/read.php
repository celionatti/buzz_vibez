<?php

use Core\Helpers;


?>

<?php $this->start('content'); ?>
<?= $this->partial('includes/header'); ?>

<!-- Post Content -->
<section class="post-header">
    <div class="header-content post-container">
        <!-- Back To Home -->
        <a href="<?= ROOT ?>" class="back-home btn btn-primary text-white"><i class="bi bi-house-door"></i> Back To Home</a>
        <!-- Title -->
        <h2 class="header-title text-capitalize"><?= $article->title ?></h2>
        <!-- Post Image -->
        <div class="img-container">
            <img src="<?= get_image($article->thumbnail) ?>" alt="" class="header-img">
        </div>
    </div>
</section>

<!-- Posts -->
<section class="post-content post-container">
    <div class="post-text"><?= $article->content ?></div>
</section>

<!-- Share -->
<div class="share post-container">
    <span class="share-title">Share this article</span>
    <div class="social">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-linkedin"></i></a>
    </div>
</div>

<!-- Comment section -->
<section class="post-container">
    <h2>Comments</h2>

    <hr class="my-2">
    <!-- Add Comment -->
    <div class="card">
        <div class="card-body">
            <div class="text-danger" id="error_status"></div>
            <div class="main-comment">
                <input type="hidden" class="slug" value="<?= $article->slug ?>">
                <textarea class="comment_textbox form-control" rows="2"></textarea>
                <button type="submit" class="btn btn-primary add_comment_btn my-2">Add Comment</button>

                <hr class="my-2">
                <!-- List all comments -->
                <div class="comment-container">
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= ROOT ?>assets/js/comment.js"></script>
<?php $this->end(); ?>