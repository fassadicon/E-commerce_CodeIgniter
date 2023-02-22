<div class="container">
    <h1><?= $product['name'] ?></h1>
    <div class="row">
        <div class="col-4">
            <?php $images = json_decode($product['images']);
            if ($images != null) {
                foreach ($images as $image) {
                    if ($image->is_main == 1) { ?>
                        <img src="<?= base_url($image->path) ?>" alt="" height="350px" class="card-img-top">
                    <?php } else { ?>
                        <img src="<?= base_url($image->path) ?>" alt="" height="100px" class="">
                <?php }
                }
            } else { ?>
                <img src="<?= base_url('assets/images/no_image.png') ?>" alt="" height="150px" class="card-img-top">
            <?php } ?>
        </div>
        <div class="col-8">
            <pre>
            <p><?= $product['description'] ?></p>
            </pre>
            <form action="/products/buy" method="post">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <input type="submit" value="Buy" class="btn btn-primary">
                <select name="quantity" id="">
                    <option value="1">1 (PHP <?= $product['price'] * 1 ?>)</option>
                    <option value="2">2 (PHP <?= $product['price'] * 2 ?>)</option>
                    <option value="3">3 (PHP <?= $product['price'] * 3 ?>)</option>
                </select>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $.post($(this).attr('action'), $(this).serialize(), function(res) {
                // $('#products').html(res);
            });
            return false;
        })
    });
</script>

</html>