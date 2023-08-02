<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pamilihan - App</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/cart.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/icon.png" style="width:150px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <?php if($this->session->userdata('logged_in')) : ?>
                        <li class="nav-item"><a class="nav-link <?= ($url == 'http://pamilihan-app.test/') ? 'active' : '' ; ?>" aria-current="page" href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?= ($url == 'http://pamilihan-app.test/products') ? 'active' : '' ; ?>" href="<?php echo base_url(); ?>products">Products</a></li>
                        <li class="nav-item"><a class="nav-link <?= ($url == 'http://pamilihan-app.test/categories') ? 'active' : '' ; ?>" href="<?php echo base_url(); ?>categories">Categories</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-person-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if($this->session->userdata('logged_in')) : ?>
                                <?php if($this->session->userdata('role') != "customer") { ?>
                                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>"><i class="bi bi-basket"></i> Manage Orders</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>products/manage"><i class="bi bi-cart4"></i> Manage Products</a></li>
                                    <?php if($this->session->userdata('role') == "admin") { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url(); ?>manage/staff"><i class="bi bi-people"></i> Manage Staff</a></li>
                                    <?php } ?>
                                    <li><hr class="dropdown-divider" style="color:gray"/></li>
                                <?php } ?>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>"><i class="bi bi-bag-check"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>change_password"><i class="bi bi-unlock"></i> Change Password</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                            <?php elseif(!$this->session->userdata('logged_in')) : ?>
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>login"><i class="bi bi-box-arrow-right"></i> Login</a></li>
                            <!-- <li><a class="dropdown-item" href="<?php echo base_url(); ?>register"><i class="bi bi-person-check"></i> Signup</a></li> -->
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
                <a href="<?php echo base_url(); ?>cart/index" class="btn btn-outline-dark" style="margin-left:10px">
                    <i class="bi-cart-fill me-1"></i>
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?= count($this->cart->contents()); ?></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('user_loggedin')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('user_loggedout')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('user_registered')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('category_created')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('staff_created')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('staff_created').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('staff_updated')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('staff_updated').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('password_changed')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('password_changed').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('product_created')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('product_created').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('product_updated')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('product_updated').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('check_product_name_exists')): ?>
            <?php echo '<p class="alert alert-error">'.$this->session->flashdata('check_product_name_exists').'</p>' ?>
        <?php endif;?>