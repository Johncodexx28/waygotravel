<?php
    include '../views/includes/conn.php';
    
    if (!isset($_SESSION['account_name'])) {
        die("Error: No user is logged in.");
    }
  
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
?>

<style>
    /* Modern Form Styles */
    .modal-body {
        padding: 24px;
    }
    
    .form-section {
        margin-bottom: 24px;
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 10px 12px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-control:focus {
        border-color: #4a7bff;
        box-shadow: 0 0 0 0.25rem rgba(74, 123, 255, 0.25);
    }
    
    .form-select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 10px 12px;
        height: auto;
    }
    
    /* Color Picker Styles */
    .color-input-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 8px 10px;
    }

    .color-picker {
        height: 40px;
        width: 40px;
        padding: 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .color-code {
        font-family: monospace;
        font-size: 14px;
        color: #495057;
        flex-grow: 1;
    }
    
    .add-color-btn {
        background-color: #4a7bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .add-color-btn:hover {
        background-color: #3a6aee;
    }
    
    .color-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    .color-item {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 12px;
    }
    
    .color-preview {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        margin-right: 8px;
    }
    
    .remove-btn {
        background: none;
        border: none;
        color: #777;
        margin-left: 8px;
        cursor: pointer;
        font-size: 14px;
    }
    
    .remove-btn:hover {
        color: #dc3545;
    }
    
    .empty-message {
        color: #6c757d;
        font-style: italic;
        padding: 8px 0;
    }
    
    /* Form for PHP integration */
    .hidden-inputs {
        display: none;
    }
    
    /* Modal Footer */
    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #dee2e6;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    .btn-success {
        background-color: #198754;
        border-color: #198754;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }
    
    .file-upload {
        position: relative;
    }
    
    .file-upload .form-control {
        padding: 12px;
    }
    
    /* Dimension fields */
    .dimensions-container {
        display: flex;
        gap: 10px;
    }
    
    .dimension-input {
        flex: 1;
    }
    
    .dimension-separator {
        display: flex;
        align-items: center;
        color: #6c757d;
        padding-top: 32px;
    }
    
    /* Section title */
    .section-title {
        font-weight: 600;
        color: #212529;
        margin: 20px 0 15px 0;
        padding-bottom: 8px;
        border-bottom: 1px solid #e9ecef;
    }
</style>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Travel Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../admin/adminprocess.php" method="POST" enctype="multipart/form-data">
                    <!-- Basic Information -->
                    <h6 class="section-title">Basic Information</h6>
                    
                    <!-- Product Name & Category (Side by Side) -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                        </div>
                        
                        <div class="col-md-6">
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
                    </div>
                    
                    <!-- Price & Colors (Side by Side) -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter price" step="0.01" min="0" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="colorPicker" class="form-label">Product Colors</label>
                            <div class="color-input-container">
                                <input type="color" id="colorPicker" class="color-picker" value="#ff0000">
                                <span id="colorCode" class="color-code">#ff0000</span>
                                <button type="button" class="add-color-btn" id="addColorBtn">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Color list -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div id="colorList" class="color-list">
                                <p class="empty-message" id="emptyMessage">No colors added yet</p>
                            </div>
                            <div class="hidden-inputs" id="colorInputsContainer">
                                <!-- Dynamic color inputs will be added here -->
                            </div>
                        </div>
                    </div>

                    <!-- Discount and Stock (Side by Side) -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="discount" class="form-label fw-semibold">Discount (%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="discount" name="discount" 
                                    value="0" 
                                    min="0" max="100">
                                <span class="input-group-text bg-light">%</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-semibold">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="0" min="0" required>
                        </div>
                    </div>
                    
                    <!-- Physical Specifications -->
                    <h6 class="section-title">Physical Specifications</h6>
                    
                    <!-- Dimensions -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Dimensions</label>
                            <div class="dimensions-container">
                                <div class="dimension-input">
                                    <input type="text" class="form-control" id="dimensionLength" name="dimensionLength" placeholder="Length" >
                                </div>
                                <div class="dimension-separator">×</div>
                                <div class="dimension-input">
                                    <input type="text" class="form-control" id="dimensionWidth" name="dimensionWidth" placeholder="Width" >
                                </div>
                                <div class="dimension-separator">×</div>
                                <div class="dimension-input">
                                    <input type="text" class="form-control" id="dimensionHeight" name="dimensionHeight" placeholder="Height" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Weight & Materials & Capacity (Side by Side) -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="productWeight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="productWeight" name="productWeight" placeholder="e.g., 2.1 lbs (0.95 kg)" >
                        </div>
                        
                        <div class="col-md-4">
                            <label for="productMaterials" class="form-label">Materials</label>
                            <input type="text" class="form-control" id="productMaterials" name="productMaterials" placeholder="e.g., Nylon, polyester lining" >
                        </div>
                        
                        <div class="col-md-4">
                            <label for="productCapacity" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="productCapacity" name="productCapacity" placeholder="e.g., 24L" >
                        </div>
                    </div>
                    
                    <!-- Description & Details -->
                    <h6 class="section-title">Description & Media</h6>
                    
                    <!-- Description & Image Upload -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="productDescription" maxlength="700" name="productDescription" rows="5" placeholder="Enter product description" style="resize: none;"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="productImage" class="form-label">Upload Image</label>
                            <div class="file-upload">
                                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*">
                            </div>
                        </div>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorPicker = document.getElementById('colorPicker');
        const colorCode = document.getElementById('colorCode');
        const addColorBtn = document.getElementById('addColorBtn');
        const colorList = document.getElementById('colorList');
        const emptyMessage = document.getElementById('emptyMessage');
        const colorInputsContainer = document.getElementById('colorInputsContainer');
        
        // Store colors
        let colors = [];
        
        // Update color code display when color picker changes
        colorPicker.addEventListener('input', function() {
            colorCode.textContent = this.value;
        });
        
        // Add a color to the list
        addColorBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission
            
            const selectedColor = colorPicker.value;
            
            // Check if color already exists
            if (colors.includes(selectedColor)) {
                alert('This color is already added');
                return;
            }
            
            // Add color to array
            colors.push(selectedColor);
            
            // Hide empty message
            emptyMessage.style.display = 'none';
            
            // Create color item
            const colorItem = document.createElement('div');
            colorItem.className = 'color-item';
            
            // Create color preview
            const colorPreview = document.createElement('div');
            colorPreview.className = 'color-preview';
            colorPreview.style.backgroundColor = selectedColor;
            
            // Create color code text
            const colorText = document.createElement('span');
            colorText.textContent = selectedColor;
            
            // Create remove button
            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-btn';
            removeBtn.innerHTML = '&times;';
            removeBtn.addEventListener('click', function() {
                // Remove from array
                const index = colors.indexOf(selectedColor);
                if (index > -1) {
                    colors.splice(index, 1);
                }
                
                // Remove from DOM
                colorItem.remove();
                
                // Remove hidden input
                const hiddenInput = document.getElementById(`color-input-${index}`);
                if (hiddenInput) {
                    hiddenInput.remove();
                }
                
                // Show empty message if no colors left
                if (colors.length === 0) {
                    emptyMessage.style.display = 'block';
                }
                
                // Update hidden inputs
                updateHiddenInputs();
            });
            
            // Add elements to color item
            colorItem.appendChild(colorPreview);
            colorItem.appendChild(colorText);
            colorItem.appendChild(removeBtn);
            
            // Add color item to list
            colorList.appendChild(colorItem);
            
            // Update hidden inputs for form submission
            updateHiddenInputs();
        });
        
        // Update hidden inputs for form submission
        function updateHiddenInputs() {
            // Clear existing inputs
            colorInputsContainer.innerHTML = '';
            
            // Create a hidden input for each color
            colors.forEach((color, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `product_colors[]`;
                input.value = color;
                input.id = `color-input-${index}`;
                colorInputsContainer.appendChild(input);
            });
        }
    });
</script>   