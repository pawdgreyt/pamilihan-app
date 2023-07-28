<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4"><?= $title; ?></h1>
                    <?php echo form_open('users/login'); ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>