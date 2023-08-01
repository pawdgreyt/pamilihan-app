<br>
<div class="row">
    <h2><?= $title; ?></h2>

    <span style="color:red">
    <?php 
        echo validation_errors();
    ?>
    </span>
</div>

<div class="col-lg-6">
<?php echo form_open('users/create_staff'); ?>
    <div class="mb-3">
        <label for="name" class="form-label">Fullname</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" autofocus>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
    </div>
    <center>
        <button type="submit" class="btn btn-outline-dark btn-block"><i class="bi bi-person-check-fill"></i> Create</button>
    </center>
    <?php echo form_close(); ?>
</div>