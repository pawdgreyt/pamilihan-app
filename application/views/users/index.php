<style>
    .active {
        color: #00b100;
    }

    .inactive {
        color: #ce181e;
    }
</style>
<br>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
    <div class="col-lg-6">
        <a href="<?php echo base_url(); ?>staff/create" class="btn btn-sm btn-outline-dark" style="float:right;">
            <i class="bi-person-plus-fill"></i> Create Staff
        </a>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th><center>ACTION</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($staffs as $staff) : ?>
                        <tr>
                            <td><?= $staff['name'] ?></td>
                            <td><?= $staff['email'] ?></td>
                            <td><?= $staff['username'] ?></td>
                            <td class="<?= ($staff['status'] == "Active") ? 'active' : 'inactive' ; ?>"><span >●</span> <?= $staff['status'] ?></td>
                            <td>
                                <center>
                                    <a href="<?php echo base_url(); ?>users/update_staff/<?= $staff['id'] ?>" type="button" class="btn btn-sm btn-outline-dark">
                                        <i class="bi-pencil-fill"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination-links">
    <center>
    <?php echo $this->pagination->create_links(); ?>
    </center>
</div>