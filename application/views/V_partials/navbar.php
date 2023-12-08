<div class="navbar animate__animated animate__fadeInDown">
    <div class="logo"><a href="">Bali Nirvana <span>Computer</span></a></div>
    <ul class="links">
        <li><a href="<?php echo site_url('home') ?>">Home</a></li>
        <li><a href="<?php echo site_url('shop') ?>">Shop</a></li>
        <li><a href="<?php echo site_url('about') ?>">About Us</a></li>
        <li><a href="<?php echo site_url('contact') ?>">Contact Us</a></li>
    </ul>

    <form action="#" class="form-search col-5 col-sm-4 col-lg-3 ">
        <input type="search" class="search-data" placeholder="Search" required>
        <button type="submit" class="fas fa-search"></button>
    </form>

    <div class="icon">
        <div class="search-icon"><i class="fa-solid fa-search"></i></div>
        <li><a href="<?php echo base_url('cart') ?>"><i class="fa-solid fa-cart-shopping"></i></a></li>
        <li><a href="<?php echo base_url('orders') ?>"><i class="fa-regular fa-bell"></i></a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <?php if (!empty($this->session->userdata('customer_id'))) : ?>
                        <a class="dropdown-item" href="<?= base_url('AuthCustomer/logout'); ?>">Logout</a>
                    <?php else : ?>
                        <a class="dropdown-item" href="<?= base_url('AuthCustomer/login'); ?>">Login</a>
                    <?php endif; ?>
                </li>

            </ul>
        </li>

        <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
    </div>

    <div class="dropdown_menu">
        <li><a href="<?php echo site_url('home') ?>">Home</a></li>
        <li><a href="<?php echo site_url('shop') ?>">Shop</a></li>
        <li><a href="<?php echo site_url('about') ?>">About Us</a></li>
        <li><a href="<?php echo site_url('contact') ?>">Contact Us</a></li>
        <li><a href="#" class="action_btn">Account</a></li>
    </div>
</div>