<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pamilihan - App</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/cart.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container" style="box-shadow: 0 4px 2px -2px gray;">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#CollapseNavBar" id="CollapseNavBarToggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/icon.png" style="width:150px;margin-top:-17px;"></a>
            </div>
            <div class="collapse navbar-collapse" id="CollapseNavBar">
                <ul class="nav navbar-nav">
                    <?php if($this->session->userdata('logged_in')) : ?>
                        <li><a href="<?php echo base_url(); ?>products">Products</a></li>
                        <li><a href="<?php echo base_url(); ?>categories">Categories</a></li>
                    <?php endif; ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if ($this->session->userdata('logged_in')) : ?>
                        <li><a>Hi Welcome <?php echo $this->session->userdata('name'); ?>!</a></li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdowntoggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php if($this->session->userdata('logged_in')) : ?>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>products/manage">Manage Products</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
                            <?php elseif(!$this->session->userdata('logged_in')) : ?>
                            <li><a class="dropdown-item" href="<?php echo base_url(); ?>login">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
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

        <?php if($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>' ?>
        <?php endif;?>

        <?php if($this->session->flashdata('category_created')): ?>
            <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>' ?>
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