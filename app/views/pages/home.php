<?php

use App\models\Categories;
use Core\helpers\TimeFormat;
use Core\helpers\StringFormat;

$categories = Categories::findAllWithArticles();

?>

<?php $this->start('content') ?>
    <?= $this->partial('includes/header'); ?>

    <!-- Home -->
    <section class="home" id="home">
        <div class="home-text container">
            <!-- <h2 class="home-title">The Buzz Vibez</h2> -->
            <!-- <span class="home-subtitle">Electrifying Buzz of a vibe. ✨ </span> -->
            <span class="home-subtitle">✨ </span>
        </div>
    </section>
    
    <!-- Post Filter -->
    <div class="post-filter container">
        <span class="filter-item active-filter" data-filter="all">All</span>
        <?php foreach($categories as $category): ?>
        <span class="filter-item" data-filter="<?= StringFormat::StrToLower($category->category) ?>"><?= $category->category ?></span>
        <?php endforeach; ?>
    </div>
    
    <!-- Posts -->
    <?php if($articles): ?>
    <section class="post container">
        <?php foreach($articles as $article): ?>
        <!-- Post Box 1 -->
        <div class="post-box <?= StringFormat::StrToLower($article->category) ?>">
            <img src="<?= get_image($article->thumbnail) ?>" alt="" class="post-img">
            <h2 class="category"><?= $article->category ?></h2>
            <a href="<?= ROOT ?>blog/read/<?= $article->slug ?>" class="post-title">
                <?= $article->title ?>
            </a>
            <span class="post-date"><?= TimeFormat::DateTwo($article->created_at) ?></span>
            <p class="post-description"><?= StringFormat::Excerpt($article->content, 90) ?></p>
            <div class="profile">
                <img src="<?= get_image($article->img, 'user') ?>" alt="" class="profile-img">
                <span class="profile-name"><?= $article->username ?></span>
            </div>
        </div>
        <?php endforeach; ?>
        
    </section>
    <?php endif; ?>

    <?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>