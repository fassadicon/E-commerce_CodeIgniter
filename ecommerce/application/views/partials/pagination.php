<nav>
    <ul class="pagination">
        <?php for ($pagination['page'] = 1; $pagination['page'] <= $pagination['number_of_page']; $pagination['page']++) { ?>
            <li class="page-item">
                <a href="/products/category/<?= $pagination['category_id'] ?>/<?= $pagination['page'] ?>" class="page-link">
                    <?= $pagination['page'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>