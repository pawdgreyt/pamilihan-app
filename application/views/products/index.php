<br>
<div class="row">
<div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
    <div class="col-lg-3"></div>
    <div class="col-lg-3">
        <form id="filterForm" action="<?= base_url('products/index') ?>" method="GET">
            <select name="product_category" class="form-control" required autocomplete="off" style="font-weight:550;">
                <option value="All" <?= ($this->input->get('product_category') == 'All' || !$this->input->get('product_category')) ? 'selected' : '' ?>>Filter By Category: All</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($this->input->get('product_category') == $category['id']) ? 'selected' : '' ?>>Filter By Category: <?= $category['category'] ?></option>
                <?php endforeach ?>
            </select>
        </form>
    </div>
</div>
<div class="row">
    <section style="background-color: #fbfbfb; height:100%; border-radius: .5rem">
        <div class="text-center container">
            <h4 class="mt-4"></h4>
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
                                <a href="<?php echo base_url('products/addToCart/'.$product['id']); ?>" class="btn btn-outline-dark"><i class="bi-cart-plus-fill"></i> Add to Cart</a>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element by its ID
        const form = document.getElementById("filterForm");

        // Get the select element
        const select = form.querySelector("select[name='product_category']");

        // Add an onchange event listener to the select element
        select.addEventListener("change", function() {
            // Submit the form when the select value changes
            form.submit();
        });
    });
</script>
