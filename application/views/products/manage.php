<div class="row">
    <h2><?= $title?></h2>

    <a href="<?php echo base_url(); ?>products/create" class="btn btn-sm btn-primary" style="float:right;">
        <i class="fa fa-plus"></i> Create Product
    </a>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>IMAGE</th>
                    <th>BRAND</th>
                    <th>DESCRIPTION</th>
                    <th>CATEGORY</th>
                    <th>QTY</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['product_brand'] ?></td>
                        <td><?= $product['product_description'] ?></td>
                        <td><?= $product['product_category'] ?></td>
                        <td><?= $product['product_qty'] ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-links">
    <center>
    <?php echo $this->pagination->create_links(); ?>
    </center>
</div>