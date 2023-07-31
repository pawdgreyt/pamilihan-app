<br>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo base_url(); ?>assets/images/razer_banner.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="<?php echo base_url(); ?>products" class="btn btn-outline-light" style="width:200px"><b>SHOP NOW!</b></a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url(); ?>assets/images/razer_banner2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url(); ?>assets/images/razer_banner3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section style="background-color: #eee;">
    <div class="text-center container py-5">
        <h4 class="text-center mb-5"><strong>Product listing</strong></h4>
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-lg-3 col-md-4 mb-4">
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
                                
                                <?php echo form_open_multipart('cart/add'); ?>
                                  <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                  <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                  <a href="<?php echo base_url('products/addToCart/'.$product['id']); ?>" class="btn btn-outline-dark" type="submit"><i class="bi-cart-plus-fill"></i> Add to Cart</a>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="pagination-links">
    <center>
    <?php echo $this->pagination->create_links(); ?>
    </center>
</div>