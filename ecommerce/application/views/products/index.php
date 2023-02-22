<div class="container">
    <div class="row">
        <div class="col-3 category">
            <?php echo form_open('/products/search_and_sort', array('class' => 'form', 'id' => 'productSearch')); ?>
            <input type="hidden" name="category_id" value="<?= $pagination['category_id'] ?>">
            <input type="text" name="name" class="form-control">
            <input type="text" name="sort_by" class="form-control" value="Price">
            </form>
            <p>Categories</p>
            <ul>
                <?php foreach ($categories as $category) { ?>
                    <li><a href="/products/category/<?= $category['id'] ?>/1"><?= $category['name'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-9" id="products">
            <?php $this->load->view('partials/product_cards'); ?>
            <?php $this->load->view('partials/pagination'); ?>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        // $.get('/products/category/1', function(res) {
        //     $('#products').html(res);
        // });

        $(document).on('keyup', 'form input', function() {
            $.post($('#productSearch').attr('action'), $('#productSearch').serialize(), function(res) {
                $('#products').html(res);
            });
            return false;
        });

        // Search and load table
        // $(document).on('submit', '#productSearch', function() {
        //     $.post('/dashboard/products/search', $(this).serialize(), function(res) {
        //         $('#products').html(res);
        //     })
        //     return false;
        // });
        // $(document).on('keyup', '#productSearch input', function() {
        //     $(this).parent().submit();
        // });
        // $('#productSearch').submit();
    });
</script>

</html>