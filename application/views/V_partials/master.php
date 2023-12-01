    <?php $this->load->view($header) ?>
    <?php $this->load->view($navbar); ?>
    <div id="layoutSidenav">
        <?php $this->load->view($sidebar) ?>
        <div id="layoutSidenav_content">
            <?php $this->load->view($content); ?>
            <?php $this->load->view($footer); ?>
        </div>
    </div>
    <?php $this->load->view($js) ?>
    </body>

    </html>