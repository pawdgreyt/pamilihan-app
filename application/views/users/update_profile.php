<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <?php echo validation_errors(); ?>
                <?php echo form_open('users/updateprofile'); ?>
                    <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <input type="text" class="form-control my-3" name="name" value="<?= $profile['name'] ?>">
                        <input type="text" class="form-control mb-1" name="username" value="<?= $profile['username'] ?>">
                    </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <input type="text" class="form-control mb-0" name="email" value="<?= $profile['email'] ?>">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <input type="text" class="form-control mb-0" name="phone" value="<?= $profile['phone'] ?>">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <textarea name="address" class="form-control mb-0l" cols="30" rows="5"><?= $profile['address'] ?></textarea>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <button class="btn btn-dark btn-block mt-2" type="submit" style="float:right;"><i class="bi bi-cloud-check-fill"></i> Save</button>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>