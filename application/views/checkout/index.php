<br>
<div class="row">
    <h2>Checkout</h2>
</div>
<br>
<div class="checkout">
    <div class="row">
        <?php if(!empty($error_msg)){ ?>
        <div class="col-md-12">
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        </div>
        <?php } ?>
		
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Cart</span>
                <span class="badge badge-secondary badge-pill"><?php echo $this->cart->total_items(); ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){ ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <?php $imageURL = base_url('assets/images/products/'.$item['image']); ?>
                        <img src="<?php echo $imageURL; ?>" width="75"/>
                        <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                        <small class="text-muted"><?php echo 'Php '.number_format($item["price"],2); ?>(<?php echo $item["qty"]; ?>)</small>
                    </div>
                    <span class="text-muted"><?php echo 'Php '.number_format($item["subtotal"],2); ?></span>
                </li>
				            <?php } }else{ ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <p>No items in your cart...</p>
                </li>
                <?php } ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (Php)</span>
                    <strong><?php echo 'Php '.number_format($this->cart->total(), 2); ?></strong>
                </li>
            </ul>
            <center>
                <a href="<?php echo base_url('products/'); ?>" class="btn btn-block btn-outline-dark"><i class="bi bi-cart-plus-fill"></i> Add Items</a>
            </center>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Contact Details</h4>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="<?= $this->session->userdata("name") ?>" readonly>
                <?php echo form_error('name','<p class="help-block error">','</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $this->session->userdata("email") ?>" readonly>
                <?php echo form_error('email','<p class="help-block error">','</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?= $this->session->userdata("phone") ?>" readonly>
                <?php echo form_error('phone','<p class="help-block error">','</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" value="<?= $this->session->userdata("address") ?>" readonly>
                <?php echo form_error('address','<p class="help-block error">','</p>'); ?>
            </div>
            <?php echo form_open('checkout/index'); ?>
                <br>
                <input type="hidden" name="placeOrder" value="Place Order">
                <center>
                    <button class="btn btn-outline-dark btn-lg btn-block" type="submit"><i class="bi bi-cart-check-fill"></i> Place Order</button>
                </center>
            </form>
        </div>
    </div>
</div>