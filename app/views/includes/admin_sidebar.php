<?php

use Core\Application;

/** @var mixed currentUser */

$currentUser = Application::$app->currentUser;


?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= URL(1) == 'dashboard' ? 'active' : '' ?>" aria-current="dashboard" href="<?= ROOT ?>admin/dashboard">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>
        <?php if($currentUser->acl === 'admin' || $currentUser->acl === 'manager'): ?>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'users' || URL(1) == 'user' ? 'active' : '' ?>" aria-current="users"
                    href="<?= ROOT ?>admin/users">
                    <i class="bi bi-person"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'categories' || URL(1) == 'category' ? 'active' : '' ?>" aria-current="categories"
                    href="<?= ROOT ?>admin/categories">
                    <i class="bi bi-tags"></i>
                    Categories
                </a>
            </li>
        <?php endif; ?>
        
        <li class="nav-item">
            <a class="nav-link <?= URL(1) == 'articles' || URL(1) == 'article' ? 'active' : '' ?>" aria-current="articles" href="<?= ROOT ?>admin/articles">
                <i class="bi bi-file-richtext"></i>
                Articles
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link <?= URL(1) == 'comments' ? 'active' : '' ?>" aria-current="comments" href="<?= ROOT ?>admin/comments">
                <i class="bi bi-chat-dots"></i>
                Comments
            </a>
        </li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Others</span>
            <a class="link-secondary" href="#" aria-label="Others">
                <span class="bi bi-1-circle align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link <?= URL(0) == 'home' ? 'active' : '' ?>" aria-current="home" href="<?= ROOT ?>">
                    <i class="bi bi-house"></i>
                    View Site
                </a>
            </li>
                <li class="nav-item my-5">
                    <a class="nav-link bg-dark" href="<?= ROOT ?>account/profile">
                        <img src="<?= get_image('', 'user') ?>" alt="mdo" width="45" height="45"
                            class="rounded-circle shadow" style="object-fit: cover;">
                        <span class="mx-2 text-light">
                            <?= $currentUser->username ?>
                        </span>
                    </a>
                </li>
        </ul>
    </div>
</nav>