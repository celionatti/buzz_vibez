<?php 

use Core\Application;


/** @var mixed currentUser */

$currentUser = Application::$app->currentUser;


?>


<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="<?= ROOT ?>">Buzz<span>Vibez</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'home' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'blogs' || URL(0) === 'blog' ? 'active' : '' ?>" href="<?= ROOT ?>blogs">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'contact' ? 'active' : '' ?>" href="<?= ROOT ?>contact">Contact</a>
                    </li>
                    <?php if($currentUser): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-capitalize" style="cursor: pointer;" data-bs-toggle="dropdown"
                            aria-expanded="false"><?= $currentUser->displayName(); ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= ROOT ?>profile">Profile</a></li>
                            <?php if($currentUser->acl !== 'user'): ?>
                            <li><a class="dropdown-item" href="<?= ROOT ?>admin">Dashboard</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item bg-danger text-white" href="<?= ROOT ?>auth/logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= URL(1) === 'login' ? 'active' : '' ?>" href="<?= ROOT ?>auth/login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="search">
                    <button class="mx-lg-5 fs-5 btn" data-bs-toggle="modal"
                    data-bs-target="#searchModal"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Search Modal -->
<div class="modal fade mx-auto" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
            <div class="modal-header border-0">
                <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="search" class="form-control bg-transparent border-light p-3 text-white "
                            placeholder="Type search keyword" style="width: 600px;" />
                        <button class="btn btn-light px-4">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>