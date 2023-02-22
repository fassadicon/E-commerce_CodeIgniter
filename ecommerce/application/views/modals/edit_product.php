<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/products/add" enctype="multipart/form-data" method="POST" class='form' id='addProductForm' >
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control form-control-lg">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" class="form-control">
                    <label for="category" class="form-label">Categories</label>
                    <select name="category" class="form-select">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?=$category['name']?>"><?=$category['name']?></option>
                    <?php } ?>
                    </select>
                    <label for="new_category" class="form-label">or add new category</label>
                    <input type="text" name="new_category" id="new_category" class="form-control">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" multiple="multiple" class="form-control" >
                    <input type="submit" class="btn btn-primary mt-2 float-end" value="Add">
                </form>
            </div>
        </div>
    </div>
</div>