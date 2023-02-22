<div class="row g-2">
<?php foreach ($products as $product) { ?>
    <div class="card col-3 bg-dark p-0">
        <a href="/products/show/<?=$product['id']?>">
        <?php $images = json_decode($product['images']);
        if ($images != null) {
            foreach ($images as $image) {
                if ($image->is_main == 1) { ?>
                    <img src="<?= base_url($image->path) ?>" alt="" height="150px" class="card-img-top">
            <?php }
            }
        } else { ?>
            <img src="<?= base_url('assets/images/no_image.png') ?>" alt="" height="150px" class="card-img-top">
        <?php } ?>
        </a>
        <div class="card-body p-2">
            <p class="card-text m-0 fw-bold text-light"><?= $product['name'] ?></p>
            <p class="card-text m-0 float-end text-light font-monospace">PHP <?= $product['price'] ?></p>
        </div>
    </div>
<?php } ?>
</div>
