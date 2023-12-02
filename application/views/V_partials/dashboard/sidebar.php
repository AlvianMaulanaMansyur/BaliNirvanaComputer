<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a style="<?php echo ($active_tab == 'admin') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?= base_url('dashboard/admin'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Data Customer
                </a>
                <a style="<?php echo ($active_tab == 'getProduk') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/getproduk') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Data Barang
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Report</div>
                <a style="<?php echo ($active_tab == 'monthlyReport') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/monthlyReport') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Monthly Report
                </a>
                <div class="sb-sidenav-menu-heading">Order List</div>
                <a style="<?php echo ($active_tab == 'OrderList') ? 'background-color: #3f3f3f; font-weight: bold;' : ''; ?>" class="nav-link" href="<?php echo base_url('dashboard/orders') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Daftar Pesanan
                </a>
            </div>
        </div>
    </nav>
</div>