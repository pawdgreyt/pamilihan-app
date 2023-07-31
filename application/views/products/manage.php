<style>
    .active {
        color: #00b100;
    }

    .phase-out {
        color: red;
    }
</style>
<br>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
    <div class="col-lg-6">
        <a href="<?php echo base_url(); ?>products/create" class="btn btn-sm btn-outline-dark" style="float:right;">
            <i class="bi-bag-plus-fill"></i> Create Product
        </a>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="20%">NAME</th>
                        <th></th>
                        <th>BRAND</th>
                        <th width="30%">DESCRIPTION</th>
                        <th>QTY</th>
                        <th>Status</th>
                        <th><center>ACTION</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) : ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><a href="<?php echo base_url(); ?>products/view/<?= $product['id'] ?>" style="text-decoration:none;color:black;font-weight:550"><?= $product['product_name'] ?></a></td>
                            <td><img src="<?php echo base_url(); ?>assets/images/products/<?= $product['product_image']?>" width="50px;" alt=""></td>
                            <td><?= $product['product_brand'] ?></td>
                            <td><?= word_limiter($product['product_description'], 10) ?></td>
                            <td><?= $product['product_qty'] ?></td>
                            <td class="<?= ($product['product_status'] == "Active") ? 'active' : 'phase-out' ; ?>"><span >●</span> <?= $product['product_status'] ?></td>
                            <td>
                                <center>
                                    <a href="<?php echo base_url(); ?>products/edit/<?= $product['id'] ?>" type="button" class="btn btn-sm btn-outline-dark">
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