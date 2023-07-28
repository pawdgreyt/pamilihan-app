<br>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
    <div class="col-lg-6">
        <a href="<?php echo base_url(); ?>categories/create" class="btn btn-sm btn-outline-dark" style="float:right;">
            <i class="bi-bookmark-plus-fill"></i> Create Category
        </a>
    </div>
</div>

<div class="row" style="margin-top:5px;">
    <ul class="list-group">
    <?php foreach($categories as $category) : ?>
        <li class="list-group-item">
            <a href="<?php echo site_url('/categories/products/'.$category['id']) ?>" style="text-decoration:none;color:black;font-weight:550"><?= $category['category'] ?></a> (9 products)
        </li>
    <?php endforeach ?>
    </ul>
</div>
