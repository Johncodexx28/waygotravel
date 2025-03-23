<div class="modal fade" id="editproductModal<?php echo $row['product_id'];?>" aria-hidden="true" aria-labelledby="editproductModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editproductModalLabel">Update Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../admin/adminprocess.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Product ID (Hidden) -->
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $row['product_id']; ?>">
                    <!-- Product Image Section -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <div class="rounded-circle overflow-hidden" style="width: 150px; height: 150px; margin: 0 auto; border: 3px solid #ddd;">
                                <!-- Product Image Preview -->
                                <img src="../<?php echo htmlspecialchars($row['image']); ?>" width="150" height="150" id="modalImagePreview<?php echo $row['product_id'];?>">
                            </div>

                            <!-- Overlay for edit icon -->
                            <label for="new_image_<?php echo $row['product_id'];?>" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 cursor-pointer" 
                                style="cursor: pointer;" title="Change image">
                                <i class="bi bi-pencil-fill"></i>
                            </label>
                            
                            <!-- Hidden file input -->
                            <input type="file" class="d-none" id="new_image_<?php echo $row['product_id'];?>" name="image" accept="image/*">
                        </div>
                        <small class="text-muted d-block mt-2">Click the edit icon to change image</small>
                    </div>

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" style="resize: none;"><?php echo htmlspecialchars(trim($row['description'])); ?></textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success" id="edit_product" name="edit_product">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[id^=new_image_]").forEach(fileInput => {
        fileInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            const productId = event.target.id.split("_")[2]; // Extract product ID from "new_image_{product_id}"
            const imagePreview = document.getElementById("modalImagePreview" + productId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
});


</script>