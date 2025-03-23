<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Color Selector</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        .color-input {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .color-picker {
            height: 40px;
            width: 40px;
            padding: 0;
            border: none;
            cursor: pointer;
        }
        .add-btn {
            background-color: #4a7bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .add-btn:hover {
            background-color: #3a6aee;
        }
        .color-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .color-item {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            border-radius: 6px;
            padding: 6px 10px;
        }
        .color-preview {
            width: 24px;
            height: 24px;
            border-radius: 50%;
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
            color: #ff3b30;
        }
        .empty-message {
            color: #888;
            font-style: italic;
        }
        
        /* Form for PHP integration */
        .hidden-inputs {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Color Manager</h2>
        
        <div class="color-input">
            <label for="colorPicker">Select a color:</label>
            <input type="color" id="colorPicker" class="color-picker" value="#ff0000">
            <span id="colorCode">#ff0000</span>
            <button class="add-btn" id="addColorBtn">+</button>
        </div>
        
        <div>
            <h3>Colors:</h3>
            <div id="colorList" class="color-list">
                <p class="empty-message" id="emptyMessage">No colors added yet</p>
            </div>
        </div>
        
        <!-- Hidden form for PHP integration -->
        <form id="productForm" method="post" action="your-php-endpoint.php">
            <div class="hidden-inputs" id="colorInputsContainer">
                <!-- Dynamic color inputs will be added here -->
            </div>
        </form>
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
            addColorBtn.addEventListener('click', function() {
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
</body>
</html>