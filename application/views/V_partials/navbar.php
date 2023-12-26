<div class="navbar animate__animated animate__fadeInDown">
    <div class="logo"><a href="<?php echo site_url('') ?>">Bali Nirvana <span>Computer</span></a></div>
    <div class="logo_singkat"><a href="<?php echo site_url('') ?>">BN<span>C</span></a></div>
    <ul class="links">
       
        <li class="<?php echo ($this->uri->segment(1) == 'home' || $this->uri->segment(1) == '') ? 'active' : ''; ?>"><a href="<?php echo site_url('home') ?>">Home</a></li>
        <li class="<?php echo ($this->uri->segment(1) == 'shop') ? 'active' : ''; ?>"><a href="<?php echo site_url('shop') ?>">Shop</a></li>
        <li class="<?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>"><a href="<?php echo site_url('about') ?>">About Us</a></li>
        <li class="<?php echo ($this->uri->segment(1) == 'contact') ? 'active' : ''; ?>"><a href="<?php echo site_url('contact') ?>">Contact Us</a></li>
    </ul>

    <form action="<?php echo site_url('search'); ?>" method="get" class="form-search col-5 col-sm-4 col-lg-3">
        <input type="search" name="search" class="search-data" placeholder="Search" id="search-form">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="icon">
        <!-- Untuk Keranjang -->
        <li>
            <a href="<?php echo base_url('cart') ?>">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count badge badge-light">0</span>
            </a>
        </li>

        <!-- Untuk Lonceng (Orders) -->
        <li>
            <a href="<?php echo base_url('orders') ?>">
                <i class="fa-regular fa-bell"></i>
                <span class="order-count badge badge-light">0</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                <li><a class="dropdown-item" href="">Profile</a></li>

                <li><a class="dropdown-item" href="<?php echo base_url('profil') ?>">Settings</a></li>

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

<script>
    $(document).ready(function() {
        updateCartAndOrderCount();

        // ... (code lainnya)

        // Fungsi untuk mengupdate jumlah produk dalam keranjang dan pesanan
        function updateCartAndOrderCount() {
            // Lakukan AJAX request untuk mengambil jumlah produk dari server
            $.ajax({
                url: '<?php echo base_url('LandingPage/getCartAndOrderCount'); ?>', // Ganti dengan URL yang sesuai
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Update jumlah produk dalam keranjang
                    $('.cart-count').text(response.cartCount);

                    // Update jumlah produk dalam pesanan
                    $('.order-count').text(response.orderCount);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
</script>