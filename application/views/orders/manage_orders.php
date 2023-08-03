<br>
<div class="row">
    <div class="col-lg-6">
        <h2><?= $title?></h2>
    </div>
</div>

<div class="row" style="margin-top: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th width="20%">NAME</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th width="30%">DATE</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order) : ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td><?= $order['name'] ?></td>
                            <td><?= $order['phone'] ?></td>
                            <td><?= $order['email'] ?></td>
                            <td>
                                <?= 
                                    date("F d, Y H:i:s", strtotime($order['created']))
                                ?>
                            </td>
                            <td><?= 'Php '.number_format($order['grand_total'], 2) ?></td>
                            <td>
                                <center>
                                    <a href="<?php echo base_url(); ?>view_order/<?= $order['id'] ?>" type="button" class="btn btn-sm btn-outline-dark">
                                        <i class="bi-eye-fill"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination-links">
    <center>
    <?php echo $this->pagination->create_links(); ?>
    </center>
</div>