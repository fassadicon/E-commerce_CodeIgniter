<table class="table table-bordered">
    <thead>
        <th>Order ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Billing Address</th>
        <th>Total</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) { ?>
            <tr>
                <td class="order_id" hidden><?= $order['id'] ?></td>
                <td><a href="/orders/show/<?= $order['id'] ?>"><?= $order['id'] ?></a></td>
                <td><?= $order['first_name'] . ' ' .  $order['last_name'] ?></td>
                <td><?= $order['created_at'] ?></td>
                <td><?= json_decode($order['billing'])->address ?></td>
                <td> <?= $order['total_amount'] ?></td>
                <td>
                    <select name="status" class="status">
                        <option value="Order in process" <?=$order['status'] == 'Order in process' ? 'selected' : ''?>>Order in process</option>
                        <option value="Shipped" <?=$order['status'] == 'Shipped' ? 'selected' : ''?>>Shipped</option>
                        <option value="Cancelled" <?=$order['status'] == 'Cancelled' ? 'selected' : ''?>>Cancelled</option>
                    </select>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>