<div class="modal fade" id="editproductModal<?php echo $row['product_id'];?>" aria-hidden="true" aria-labelledby="editproductModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h1 class="modal-title fs-5" id="editproductModalLabel">
                    <i class="bi bi-box-seam me-2"></i>Update Product
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../admin/adminprocess.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Product ID (Hidden) -->
                    <input type="hidden" name="update_id" id="update_id" value="<?php echo $row['product_id']; ?>">
                    
                    <div class="row">
                        <!-- Left Column for Image -->
                        <div class="col-md-4 text-center mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <div class="position-relative d-inline-block mb-3">
                                        <div class="rounded-circle overflow-hidden bg-light shadow-sm" style="width: 170px; height: 170px; margin: 0 auto; border: 2px solid #eee;">
                                            <!-- Product Image Preview -->
                                            <img src="../<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" id="modalImagePreview<?php echo $row['product_id'];?>" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>

                                        <!-- Overlay for edit icon -->
                                        <label for="new_image_<?php echo $row['product_id'];?>" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm" 
                                            style="cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;" title="Change image">
                                            <i class="bi bi-camera-fill"></i>
                                        </label>
                                        
                                        <!-- Hidden file input -->
                                        <input type="file" class="d-none" id="new_image_<?php echo $row['product_id'];?>" name="image" accept="image/*">
                                    </div>
                                    <small class="text-muted d-block">Click the camera icon to change image</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column for Form Fields -->
                        <div class="col-md-8">
                            <div class="row">
                                <!-- Product Name -->
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label fw-semibold">Product Name</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                                </div>

                                <!-- Price and Discount in same row -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label fw-semibold">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">$</span>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                            value="<?php echo htmlspecialchars($row['price']); ?>" required>
                                    </div>
                                </div>

                                <!-- Discount Field (New) -->
                                <div class="col-md-6 mb-3">
                                    <label for="discount" class="form-label fw-semibold">Discount (%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="discount" name="discount" 
                                            value="<?php echo isset($row['discount']) ? htmlspecialchars($row['discount']) : '0'; ?>" 
                                            min="0" max="100">
                                        <span class="input-group-text bg-light">%</span>
                                    </div>
                                </div>

                                
                                <div class="col-md-12 mb-3">
                                    <label for="stock" class="form-label fw-semibold">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo isset($row['stock']) ? htmlspecialchars($row['stock']) : '0'; ?>" min="0" required>
                                </div>

                                <!-- Product Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" style="resize: none;"><?php echo htmlspecialchars(trim($row['description'])); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="edit_product" name="edit_product">
                            <i class="bi bi-check-circle me-1"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Image preview functionality
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

    // Form validation for price
    document.querySelectorAll('input[name="price"]').forEach(input => {
        input.addEventListener('input', function() {
            let value = this.value;
            // Only allow numbers and decimal point
            this.value = value.replace(/[^\d.]/g, '');
            
            // Ensure only one decimal point
            const decimalPoints = value.match(/\./g);
            if (decimalPoints && decimalPoints.length > 1) {
                this.value = value.substring(0, value.lastIndexOf('.'));
            }
        });
    });
});
</script>