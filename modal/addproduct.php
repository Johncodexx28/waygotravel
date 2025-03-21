<?php
    include '../views/includes/conn.php';
    

    if (!isset($_SESSION['account_name'])) {
        die("Error: No user is logged in.");
    }

  
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

   
    

?>



<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Travel Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../views/includes/process.php" method="POST" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName"  placeholder="Enter product name" required>
                    </div>
                    
                   <!-- Category -->
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="productCategory" required>
                            <option selected disabled>Select category</option>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row['category_id']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
                                }
                            } else {
                                echo '<option disabled>No categories available</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- Price -->
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price ($)</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price" step="0.01" min="0" required>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" placeholder="Enter product description"></textarea>
                    </div>
                    
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="productImage"  name="productImage" accept="image/*">
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_product" id="add_product" class="btn btn-success">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>