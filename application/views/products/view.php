<br>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="<?php echo site_url();?>assets/images/products/<?= $product['product_image'] ?>" style="width:100%; border-radius: 3px;">
        </div>
        <div class="col-md-6">
            <h1 class="display-5 fw-bolder"><?= $product['product_name'] ?></h1>
            <div class="small mb-1"><?= $product['product_brand'] ?></div>
            <div class="fs-5 mb-5">
                <span>Php <?= $product['product_price'] ?></span>
            </div>
            <p class="lead"><?= $product['product_description'] ?></p>
            <div class="d-flex">
                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 6rem">
                <button class="btn btn-outline-dark flex-shrink-0" type="button">
                    <i class="bi-cart-fill me-1"></i>
                    Add to cart
                </button>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top:30px;">
        <h3>Similar Products</h3>
        <?php foreach ($similar_products as $product) : ?>
            <div class="col-lg-3 col-md-4 mb-4 text-center">
                <div class="card">
                    <a href="<?php echo base_url(); ?>products/view/<?= $product['id'] ?>">
                        <div class="bg-image">
                            <div class="image-container">
                                <img src="<?php echo base_url(); ?>assets/images/products/<?= $product['product_image']?>" class="w-100" />
                            </div>
                            <div class="hover-overlay"></div>
                        </div>
                    </a>
                    <div class="card-body">
                        <a href="<?php echo base_url(); ?>products/view/<?= $product['id'] ?>" class="text-reset" style="text-decoration:none;">
                            <h5 class="card-title mb-1"><?= $product['product_name']?></h5>
                        </a>
                        <p style="margin-bottom:1px !important"><?= $product['product_brand']?></p>
                        <h6 class="mb-3">Php <?= number_format($product['product_price'], 2)?></h6>
                        <a href="<?php echo base_url(); ?>cart/add/<?= $product['id'] ?>" class="btn btn-outline-dark"><i class="bi-cart-plus-fill"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>