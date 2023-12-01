<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('V_partials/header');?>

<body>

    <div class="container">
            <?php $this->load->view($content); ?>
    </div>

</body>
<?php $this->load->view('V_partials/script');
 ?>

</html>