<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?= $profile['name'] ?></h5>
                        <p class="text-muted mb-1"><?= $profile['username']?></p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0"><?= $profile['email'] ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0"><?= $profile['phone'] ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0"><?= $profile['address'] ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="<?= base_url()?>update_profile" class="btn btn-dark btn-block mt-2" style="float:right;"><i class="bi bi-pencil-fill"></i> Update Profile</a>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>