<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <h1 class="text-center mb-4"><?= $title; ?></h1>
                <?php echo validation_errors(); ?>
                <?php echo form_open('users/change_password'); ?>
                    <div class="mb-3">
                        <label for="password" class="form-label">Old Password</label>
                        <input type="password" name="oldpassword" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirm Password</label>
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
                    </div>
                    <center>
                        <button type="submit" class="btn btn-outline-dark btn-block"><i class="bi bi-person-check-fill"></i> Submit</button>
                    </center>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>