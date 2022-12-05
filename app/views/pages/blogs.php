<?php 
use Core\Pagination;

$pagination = new Pagination();


?>

<?php $this->start('content') ?>
<?= $this->partial('includes/header'); ?>

<hr class="mt-5">

    <!-- Post Filter -->
    <div class="post-filter container">
        <span class="filter-item active-filter" data-filter="all">All</span>
        <span class="filter-item" data-filter="design">Design</span>
        <span class="filter-item" data-filter="tech">Tech</span>
        <span class="filter-item" data-filter="mobile">Mobile</span>
    </div>

    <!-- Posts -->
    <section class="post container">
        <!-- Post Box 1 -->
        <div class="post-box mobile">
            <img src="<?= ROOT ?>assets/img/post-1.jpg" alt="" class="post-img">
            <h2 class="category">Mobile</h2>
            <a href="<?= ROOT ?>blog/read/2" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-1.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 2 -->
        <div class="post-box tech">
            <img src="<?= ROOT ?>assets/img/post-2.jpg" alt="" class="post-img">
            <h2 class="category">Tech</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-2.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 3 -->
        <div class="post-box mobile">
            <img src="<?= ROOT ?>assets/img/post-3.jpg" alt="" class="post-img">
            <h2 class="category">Mobile</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-3.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 4 -->
        <div class="post-box design">
            <img src="<?= ROOT ?>assets/img/post-4.jpg" alt="" class="post-img">
            <h2 class="category">Design</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-1.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 5 -->
        <div class="post-box tech">
            <img src="<?= ROOT ?>assets/img/post-5.jpg" alt="" class="post-img">
            <h2 class="category">Tech</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-2.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 6 -->
        <div class="post-box mobile">
            <img src="<?= ROOT ?>assets/img/post-6.jpg" alt="" class="post-img">
            <h2 class="category">Mobile</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-3.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 7 -->
        <div class="post-box design">
            <img src="<?= ROOT ?>assets/img/post-7.jpg" alt="" class="post-img">
            <h2 class="category">Design</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-3.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 8 -->
        <div class="post-box tech">
            <img src="<?= ROOT ?>assets/img/post-8.jpg" alt="" class="post-img">
            <h2 class="category">Tech</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-3.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
        <!-- Post Box 9 -->
        <div class="post-box design">
            <img src="<?= ROOT ?>assets/img/post-9.jpg" alt="" class="post-img">
            <h2 class="category">Design</h2>
            <a href="post-page.html" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum veritatis
                aliquid,
                veniam nisi corporis aperiam enim tenetur repellendus facere rerum. Excepturi corrupti incidunt animi
                eum?
            </p>
            <div class="profile">
                <img src="<?= ROOT ?>assets/img/profile-3.jpg" alt="" class="profile-img">
                <span class="profile-name">Celio Natti</span>
            </div>
        </div>
    </section>

    <?= $pagination->display(); ?>

    <?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>