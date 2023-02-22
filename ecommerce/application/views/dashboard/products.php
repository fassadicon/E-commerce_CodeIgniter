<div class="container">
    <div class="row mb-2 ">
        <div class="col-6">
            <?php echo form_open('/dashboard/products/search', array('class' => 'form', 'id' => 'productSearch')); ?>
            <input type="text" name="name" class="form-control">
            </form>
        </div>
        <div class="col-6">
            <a href="" class="btn btn-primary float-end" id="addNewProductBtn">Add new product</a>
        </div>
    </div>
    <div id="table"></div>
</div>
<?php $this->load->view('modals/add_product'); ?>
</body>
<script>
    $(document).ready(function() {
        // Search and load table
        $(document).on('submit', '#productSearch', function() {
            $.post('/dashboard/products/search', $(this).serialize(), function(res) {
                $('#table').html(res);
            })
            return false;
        });
        $(document).on('keyup', '#productSearch input', function() {
            $(this).parent().submit();
        });
        $('#productSearch').submit();
        // Add Product Modal
        $('#addNewProductBtn').click(function() {
            $('#exampleModal').modal('show');
            return false;
        });
        $(document).on('submit', '#addProductForm', function() {
            $.ajax({
                url: "/dashboard/products/add",
                type: "POST",
                data: new FormData('form'),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(res);
                }
            });
            $('#productSearch').submit();
            return false;
        });
    });
</script>

</html>