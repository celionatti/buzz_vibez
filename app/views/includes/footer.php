<?php 




?>

<!-- Footer -->
<div class="container">
    <footer class="pt-5 text-center">
        <div class="row g-3">
            <div class="col-6 col-md-2 mb-3">
                <h5>Useful Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="<?= ROOT ?>" class="nav-link p-0 text-muted">Home</a></li>
                    <li class="nav-item mb-2"><a href="<?= ROOT ?>contact" class="nav-link p-0 text-muted">Contacts</a>
                    </li>
                    <li class="nav-item mb-2"><a href="<?= ROOT ?>faqs" class="nav-link p-0 text-muted">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="<?= ROOT ?>terms" class="nav-link p-0 text-muted">Terms &
                            conditions</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Corporate Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Report a story</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Advertisement</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Private Policy</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Content Policy</a></li>
                </ul>
            </div>

            <div class="col-md-5 offset-md-2 mb-3">
                <form>
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of what's new and exciting from us.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center py-4 my-2 border-top">
            <p>&copy; <?= date('Y') ?>
                    <?= $this->getSiteTitle(); ?>, Inc. All Rights Reserved.</p>
            <div class="social">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>
</div>