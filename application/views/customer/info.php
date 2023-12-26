<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0 animate__animated animate__fadeInUp" style="border-radius: 20px;">
                <div class="card-body" style="font-family: 'Poppins', sans-serif; ">
                    <!-- <?php var_dump($customer_data) ?> -->
                    <div class="mb-4 text-center" style="font-size: 1.2rem; font-weight: 500;">Selamat datang, <?php echo $customer_data['username']; ?></div>
                    <div class="" style="padding-bottom: 0.5rem;">
                        berikut kami tampilkan mengenai data personal info anda. <br>
                        <br>
                        jika anda ingin mengedit, silahkan klik tombol edit.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-5 animate__animated animate__fadeInUp" style="border-radius: 20px;">
                <div class="card-header" style="font-family: 'Poppins', sans-serif; font-size: 20px;">Profile Details</div>
                <div class="card-body" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 18px;">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-profile" value="<?php echo $customer_data['username']; ?>" disabled>
                        </div>
                        <!-- Form Row-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputName">Name</label>
                            <input class="form-profile" id="inputFirstName" type="text" placeholder="Enter your name" value="<?php echo $customer_data['nama_customer']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Email</label>
                            <input class="form-profile" id="inputUsername" type="email" placeholder="Enter your email" value="<?php echo $customer_data['email']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">No. Telepon</label>
                            <input class="form-profile" id="inputUsername" type="tel" placeholder="Enter your telepon" value="<?php echo $customer_data['telepon']; ?>" disabled>
                        </div>
                        <a href="#modal<?php echo $customer_data['id_customer']; ?>" class="btn btn-primary" data-bs-toggle="modal">Edit</a>
                        <!-- Save changes button-->
                        <!-- <button class="btn btn-primary mb-4 mt-4" type="button">save</button> -->
                        <!-- back button -->
                        <div class="d-flex justify-content-end">
                            <a href="home"><button class="btn btn-primary mb-4 " type="button" style="margin-top: -3.9rem;">back</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal<?php echo $customer_data['id_customer']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <?php echo form_open('user/editProfile/' . $customer_data['id_customer']); ?>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">Nama</label>
                    <input type="text" class="form-profile" name="nama_customer" value="<?php echo $customer_data['nama_customer']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">No. Telepon</label>
                    <input type="tel" class="form-profile" name="telepon" value="<?php echo $customer_data['telepon']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>