<br>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
    <?php if($this->session->userdata('role') != "customer") { ?>
        <div class="col-lg-6">
            <a href="<?php echo base_url(); ?>categories/create" class="btn btn-sm btn-outline-dark" style="float:right;">
                <i class="bi-bookmark-plus-fill"></i> Create Category
            </a>
        </div>
    <?php } ?>
</div>

<div class="row" style="margin-top:5px;">
    <ul class="list-group">
    <?php foreach($categories as $category) : ?>
        <li class="list-group-item">
            <a href="<?php echo base_url(); ?>products/index?product_category=<?= $category['id'] ?>" style="color:black"><span style="font-weight:550"><?= $category['category'] ?></span></a> (<?= $category['product_count'] ?> products)
        </li>
    <?php endforeach ?>
    </ul>
</div>
