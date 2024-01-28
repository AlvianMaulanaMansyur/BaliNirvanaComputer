<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Order List</div>
                <a style="<?php echo ($active_tab == 'OrderList') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/orders') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                    Daftar Pesanan
                </a>
                <div class="sb-sidenav-menu-heading">Core</div>
                <a style="<?php echo ($active_tab == 'admin') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?= base_url('dashboard/admin'); ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                    Data Customer
                </a>
                <a style="<?php echo ($active_tab == 'getProduk') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/produk') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                    Data Barang
                </a>

                <a style="<?php echo ($active_tab == 'category') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/category') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-filter"></i></div>
                    Data Kategori
                </a>

                <a style="<?php echo ($active_tab == 'kota') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/kota') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                    Data Kota
                </a>
                <a style="<?php echo ($active_tab == 'kecamatan') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/kecamatan') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                    Data Kecamatan
                </a>

                <div class="sb-sidenav-menu-heading">Report</div>
                <a style="<?php echo ($active_tab == 'monthlyReport') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/monthlyReport') ?>">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-column"></i></div>
                    Monthly Report
                </a>
            </div>
        </div>
    </nav>
</div>