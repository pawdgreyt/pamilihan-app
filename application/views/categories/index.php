
<div class="row">
    <h2><?= $title?></h2>

    <a href="<?php echo base_url(); ?>categories/create" class="btn btn-sm btn-primary" style="float:right;">
        <i class="fa fa-plus"></i> Create Category
    </a>
</div>

<div class="row" style="margin-top:5px;">
    <ul class="list-group">
    <?php foreach($categories as $category) : ?>
        <li class="list-group-item">
            <a href="<?php echo site_url('/categories/products/'.$category['id']) ?>"><?= $category['category'] ?></a>
        </li>
    <?php endforeach ?>
    </ul>
</div>
