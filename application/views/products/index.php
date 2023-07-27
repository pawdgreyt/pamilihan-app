<div class="row">
    <h2><?= $title?></h2>
</div>
<div class="row">
    <section style="background-color: #fbfbfb; height:100%; border-radius: .5rem">
        <div class="text-center container">
            <h4 class="mt-4"></h4>
            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light">
                                <div class="image-container">
                                    <img src="<?php echo base_url(); ?>assets/images/products/<?= $product['product_image']?>"
                                class="w-100" />
                                </div>
                            <a href="#!">
                                <div class="hover-overlay">
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="" class="text-reset">
                            <h5 class="card-title mb-3"><?= $product['product_name']?></h5>
                            </a>
                            <a href="" class="text-reset">
                            <p><?= $product['product_brand']?></p>
                            </a>
                            <h6 class="mb-3">Php <?= number_format($product['product_price'], 2)?></h6>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
<div class="pagination-links">
    <center>
    <?php echo $this->pagination->create_links(); ?>
    </center>
</div>