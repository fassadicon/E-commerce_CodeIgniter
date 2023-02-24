<div class="container">
    <div class="row">
        <div class="col-5 border border-dark border-2 p-2">
            <h5 class="fw-bold">Order ID: <?= $order['id'] ?></h5>
            <p class="mt-3 fw-bold">Customer Shipping Info:</p>
            <p class="m-0">Name: <?= $order['first_name'] ?></p>
            <p class="m-0">Address: <?= json_decode($order['shipping'])->address1 . ' ' . json_decode($order['shipping'])->address2 ?></p>
            <p class="m-0">City: <?= json_decode($order['shipping'])->city ?></p>
            <p class="m-0">State: <?= json_decode($order['shipping'])->state ?></p>
            <p class="m-0">Zipcode: <?= json_decode($order['shipping'])->zipcode ?></p>
            <p class="mt-3 fw-bold">Customer Billing Info:</p>
            <p class="m-0">Name: <?= $order['first_name'] ?></p>
            <p class="m-0">Address: <?= json_decode($order['billing'])->address1 . ' ' . json_decode($order['billing'])->address2 ?></p>
            <p class="m-0">City: <?= json_decode($order['billing'])->city ?></p>
            <p class="m-0">State: <?= json_decode($order['billing'])->state ?></p>
            <p class="m-0">Zipcode: <?= json_decode($order['billing'])->zipcode ?></p>
        </div>
        <div class="col-7">
            <table class="table table-bordered table-dark">
                <thead>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php $subTotal = 0;
                    foreach (json_decode($order['items']) as $item) { ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->price ?></td>
                            <td><?= $item->quantity ?></td>
                            <td><?= $item->total ?></td>
                        </tr>
                    <?php $subTotal += $item->total;
                    } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <?php if ($order['status'] == "Shipped") { ?>
                        <p class="bg-success p-2 border border-dark border-2 fw-bold">Status: <?= $order['status'] ?></p>
                    <?php } else if ($order['status'] == "Order in process") { ?>
                        <p class="bg-primary p-2 border border-dark border-2 fw-bold">Status: <?= $order['status'] ?></p>
                    <?php } else if ($order['status'] == "Cancelled") { ?>
                        <p class="bg-danger p-2 border border-dark border-2 fw-bold">Status: <?= $order['status'] ?></p>
                    <?php } ?>
                </div>
                <div class="col-6 border border-dark border-2 p-2">
                    <p class="fw-bold">Sub total: PHP <?= $subTotal ?></p>
                    <p class="fw-bold">Shipping: PHP 50</p>
                    <p class="fw-bold">Total Price: <?= $order['total_amount'] ?></p>
                </div>
            </div>


        </div>
    </div>
</div>
</body>

</html>