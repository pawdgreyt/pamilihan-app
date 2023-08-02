<br>
<div class="row">
    <h2><?= $title?></h2>
</div>


<script>
// Update item quantity
function updateCartItem(obj, rowid){
    $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th width="10%">Quantity</th>
                        <th style="text-align: right;">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){    ?>
                    <tr>
                        <td>
                            <?php $imageURL = base_url('assets/images/products/'.$item["image"]); ?>
                            <img src="<?php echo $imageURL; ?>" width="50"/>
                        </td>
                        <td><?php echo $item["name"]; ?></td>
                        <td><?php echo 'Php '.number_format($item["price"], 2); ?></td>
                        <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                        <td  style="text-align: right;"><?php echo 'Php '.number_format($item["subtotal"], 2); ?></td>
                        <td  style="text-align: right;"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure to delete item?')?window.location.href='<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>':false;"><i class="bi bi-trash"></i> </button> </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="6" style="text-align:center;"><p>Your Cart is Empty.</p></td>
                    <?php } ?>
                    <?php if($this->cart->total_items() > 0){ ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Cart Total</strong></td>
                        <td  style="text-align: right;"><strong><?php echo 'Php '.number_format($this->cart->total(), 2); ?></strong></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <?php if($this->cart->total_items() > 0) { ?>
        <button class="btn btn-outline-dark mt-5 float-end">
            <span style="font-weight:550;">PROCEED TO CHECKOUT</span> <i class="bi bi-cart-check-fill"></i>
        </button>
        <?php } ?>
    </div>
</div>