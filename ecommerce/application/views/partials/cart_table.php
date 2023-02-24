<table class="table table-bordered table-striped table-dark">
    <thead>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td>
                    <?= $item['quantity'] ?>
                    <a href="" class="btn btn-success">Update</a>
                    <a href="/carts/remove_in_cart/<?=$item['id']?>" class="btn btn-danger">Delete</a>
                </td>
                <td>PHP <?= $item['quantity'] * $item['price'];?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

