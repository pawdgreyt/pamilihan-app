<?php if (!empty($order)) { ?>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-light">
                <h2 class="mb-0">Order Information</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Reference ID:</strong> #<?php echo $order['id']; ?></p>
                        <p><strong>Total Price:</strong> <?php echo 'Php ' . number_format($order['grand_total'], 2); ?></p>
                        <p><strong>Order Status:</strong> <?= ($order['status'] == 0) ? 'On Process' : 'Order Completed' ; ?></p>
                        <p><strong>Placed On:</strong> <?php echo date("F d, Y H:i:s", strtotime($order['created'])); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Buyer Name:</strong> <?php echo $order['name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
                        <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header bg-light">
                <h3 class="mb-0">Order Items</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($order['items'])) {
                                foreach ($order['items'] as $item) { ?>
                                    <tr>
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
<?php } ?>