<br>
<div class="row">
    <h2><?= $title; ?>: <?= $staff['name'] ?></h2>

    <span style="color:red">
    <?php 
        echo validation_errors();
    ?>
    </span>
</div>

<div class="col-lg-6">
<?php echo form_open('users/updatestaff'); ?>
    <input type="hidden" value="<?= $staff['id'] ?>" name="id">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label> <strong style="color:red">*</strong>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="<?= $staff['name'] ?>" autofocus>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label> <strong style="color:red">*</strong>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?= $staff['email'] ?>">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label> <strong style="color:red">*</strong>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" value="<?= $staff['username'] ?>">
    </div>
    <div class="mb-3">
        <label>Status <strong style="color:red">*</strong></label>
        <select name="status" class="form-control" required autocomplete="off">
            <option value="" selected disabled>Select Status</option>
            <option value="Active" <?= ("Active" == $staff['status']) ? 'selected' : '' ; ?>>Active</option>
            <option value="Inactive" <?= ("Inactive" == $staff['status']) ? 'selected' : '' ; ?>>Inactive</option>
        </select>
    </div>
    <center>
        <button type="submit" class="btn btn-outline-dark btn-block"><i class="bi bi-person-check-fill"></i> Update</button>
    </center>
    <?php echo form_close(); ?>
</div>