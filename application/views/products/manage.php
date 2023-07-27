<div class="row">
    <h2><?= $title?></h2>

    <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search Product">
        </div>
    </form> -->

    <a href="<?php echo base_url(); ?>products/create" class="btn btn-sm btn-primary" style="float:right;">
        <i class="fa fa-plus"></i> Create Product
    </a>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th></th>
                        <th>BRAND</th>
                        <th>DESCRIPTION</th>
                        <th>QTY</th>
                        <th><center>ACTION</center></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product) : ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><a href="<?php echo base_url(); ?>products/view/<?= $product['id'] ?>"><?= $product['product_name'] ?></a></td>
                            <td><img src="<?php echo base_url(); ?>assets/images/products/<?= $product['product_image']?>" width="50px;" alt=""></td>
                            <td><?= $product['product_brand'] ?></td>
                            <td><?= word_limiter($product['product_description'], 10) ?></td>
                            <td><?= $product['product_qty'] ?></td>
                            <td>
                                <center>
                                    <a href="<?php echo base_url(); ?>products/edit/<?= $product['id'] ?>" type="button" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
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