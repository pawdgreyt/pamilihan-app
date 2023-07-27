<div class="col-md-12"><h2 style="margin-bottom:30px;"><?= $title ?></h2></div>
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
                <button class="btn btn-primary flex-shrink-0" type="button">
                    <i class="bi-cart-fill me-1"></i>
                    Add to cart
                </button>
            </div>
        </div>
    </div>
</div>