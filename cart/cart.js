// Function to change main image
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
        if (thumb.src === src) {
            thumb.classList.add('active');
        }
    });
}

// Function to increment quantity
function incrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    let quantity = parseInt(quantityInput.value);
    if (!isNaN(quantity)) {
        quantityInput.value = quantity + 1;
    } else {
        quantityInput.value = 1;
    }
}

// Function to decrement quantity
function decrementQuantity() {
    const quantityInput = document.getElementById('quantity');
    let quantity = parseInt(quantityInput.value);
    if (!isNaN(quantity) && quantity > 1) {
        quantityInput.value = quantity - 1;
    } else {
        quantityInput.value = 1;
    }
}

// Prevent non-numeric input in quantity field
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('quantity').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value === '' || parseInt(this.value) < 1) {
            this.value = 1;
        }
    });
});

// Color option selection
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.color-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.color-option').forEach(opt => {
                opt.classList.remove('selected');
                opt.style.border = '2px solid #ddd';
            });

            this.classList.add('selected');
            this.style.border = '2px solid #000';

            const colorName = this.getAttribute('data-color');
            const colorDisplay = document.querySelector('.selected-color');
            if (colorDisplay) {
                colorDisplay.innerText = 'Color - ' + colorName;
            }

            // Update hidden input for color
            document.getElementById('selected_color_input').value = colorName;
        });
    });
});

// Add to Cart Function with Quantity and Color
function addToCart(userId, productId, price) {
    const quantity = document.getElementById('quantity').value;
    const color = document.getElementById('selected_color_input').value;

    // Basic validation
    if (quantity < 1) {
        alert('Please select a valid quantity.');
        return;
    }

    if (!color) {
        alert('Please select a color.');
        return;
    }

    // Create request payload
    let data = {
        user_id: userId,
        product_id: productId,
        quantity: quantity,
        color: color,
        price: price
    };

    // Send data to the backend via AJAX
    fetch('../cart/cartprocess.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert("Product added to cart!");
        } else {
            alert("Failed to add product.");
        }
    })
    .catch(error => console.error('Error:', error));
}

