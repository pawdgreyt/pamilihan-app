<?php if(!empty($order)){ ?>
	<br>
    <div class="row">
        <h2>Order Info</h2>
    </div>
    <br>

    <!-- Order status & shipping info -->
    <div class="row col-lg-12 ord-addr-info">
        <p><b>Reference ID:</b> #<?php echo $order['id']; ?></p>
        <p><b>Total:</b> <?php echo 'Php'.number_format($order['grand_total'], 2); ?></p>
        <p><b>Placed On:</b> <?php echo date("F d, Y H:i:s", strtotime($order['created'])); ?></p>
        <p><b>Buyer Name:</b> <?php echo $order['name']; ?></p>
        <p><b>Email:</b> <?php echo $order['email']; ?></p>
        <p><b>Phone:</b> <?php echo $order['phone']; ?></p>
        <p><b>Address:</b> <?php echo $order['address']; ?></p>
    </div>
	
    <!-- Order items -->
    <div class="row col-lg-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($order['items'])){  
                    foreach($order['items'] as $item){ 
                ?>
                <tr style="vertical-align:middle">
                    <td>
                        <?php $imageURL = base_url('assets/images/products/'.$item['product_image']); ?>
                        <img src="<?php echo $imageURL; ?>" width="75"/>
                    </td>
                    <td><?php echo $item["product_name"]; ?></td>
                    <td><?php echo 'Php '.number_format($item["product_price"], 2); ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo 'Php '.number_format($item["sub_total"], 2); ?></td>
                </tr>
                <?php } 
                } ?>
            </tbody>
        </table>
    </div>
<?php }?>