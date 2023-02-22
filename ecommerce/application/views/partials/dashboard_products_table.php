<table class="table table-bordered">
    <thead>
        <th>Picture</th>
        <th>ID</th>
        <th>Name</th>
        <th>Inventory Count</th>
        <th>Quantity Sold</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <?php $images = json_decode($product['images']);
                if ($images != null) {
                    foreach ($images as $image) {
                        if ($image->is_main == 1) { ?>
                            <td><img src="<?= base_url($image->path) ?>" alt="" height="50px" class="mx-auto d-block"></td>
                    <?php }
                    }
                } else { ?>
                    <td>No Image</td>
                <?php } ?>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['stock'] ?></td>
                <td><?= $product['sold'] ?></td>
                <td>
                    <a href="/dashboard/products/edit/<?= $product['id'] ?>" class="btn btn-success">Edit</a>
                    <a href="/dashboard/products/delete/<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>