<?php if (!empty($order)) { ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">Your order has been placed successfully.</div>
                <h2 class="mb-3">Checkout</h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-light">
                <div class="hdr">Order Info</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><b>Reference ID:</b> #<?php echo $order['id']; ?></p>
                        <p><b>Total Price:</b> <?php echo 'Php ' . number_format($order['grand_total'], 2); ?></p>
                        <p><b>Placed On:</b> <?php echo date("F d, Y H:i:s", strtotime($order['created'])); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Buyer Name:</b> <?php echo $order['name']; ?></p>
                        <p><b>Email:</b> <?php echo $order['email']; ?></p>
                        <p><b>Phone:</b> <?php echo $order['phone']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header bg-light">
                <div class="hdr">Order Items</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                            <?php if (!empty($order['items'])) {
                                foreach ($order['items'] as $item) { ?>
                                    <tr style="vertical-align:middle">
                                        <td>
                                            <?php $imageURL = base_url('assets/images/products/' . $item['product_image']); ?>
                                            <img src="<?php echo $imageURL; ?>" width="75" alt="Product Image" />
                                        </td>
                                        <td><?php echo $item["product_name"]; ?></td>
                                        <td><?php echo 'Php ' . number_format($item["product_price"], 2); ?></td>
                                        <td><?php echo $item["quantity"]; ?></td>
                                        <td><?php echo 'Php ' . number_format($item["sub_total"], 2); ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container mt-4">
        <div class="col-md-12">
            <div class="alert alert-danger">Your order submission failed.</div>
        </div>
    </div>
<?php } ?>