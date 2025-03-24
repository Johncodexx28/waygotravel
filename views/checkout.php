<?php 

session_start();

include '../views/includes/conn.php';
include '../cart/fetchcart.php';

$delivery_fee = 50.00;

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: #333;
            background-color: #fff;
        }
        
        .checkout-container {
            max-width: 1100px;
            margin: 0 auto;
        }
        
        .order-timer {
            background-color: #fefadf;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 50px;
        }
        
        .progress-bar {
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #e5e5e5;
            z-index: 0;
        }
        
        .progress-completed {
            position: absolute;
            top: 15px;
            left: 0;
            width: 38%;
            height: 2px;
            background-color: #4caf50;
            z-index: 1;
        }
        
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 30px;
        }
        
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: white;
            font-weight: bold;
        }
        
        .step.active .step-circle {
            background-color: #4caf50;
        }
        
        .step.completed .step-circle {
            background-color: #4caf50;
        }
        
        .step-label {
            font-size: 13px;
            white-space: nowrap;
        }
        
        h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .form-control, .form-select {
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4caf50;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.15);
        }
        
        .required:after {
            content: " *";
            color: #d32f2f;
        }
        
        .btn-primary {
            background-color: #4caf50;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
        }
        
        .btn-primary:hover {
            background-color: #43a047;
        }
        
        .login-link {
            color: #4caf50;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link:hover {
            text-decoration: underline;
        }
        
        .order-summary {
            background-color: #f9f9f9;
            border-radius: 4px;
            padding: 20px;
        }
        
        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 4px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-info {
            flex-grow: 1;
        }
        
        .product-quantity {
            margin-left: 5px;
            color: #777;
        }
        
        .order-item-price {
            font-weight: 500;
        }
        
        .payment-option {
            margin-bottom: 15px;
        }
        
        .payment-icons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .payment-icon {
            width: 40px;
            height: 25px;
            background-color: #eee;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .testimonial {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        
        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #eee;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .testimonial-text {
            font-size: 14px;
            color: #555;
        }
        
        .form-check {
            margin-bottom: 10px;
        }
        
        .form-check-input:checked {
            background-color: #4caf50;
            border-color: #4caf50;
        }
        
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }
    </style>
</head>
<body>



<div class="container checkout-container my-4">
    <!-- Order Timer -->
    <div class="order-timer">
        Your order is reserved for: <span id="countdown">8 minutes 59 seconds</span>
    </div>
    
    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="progress-bar"></div>
        <div class="progress-completed"></div>
        
        <div class="step completed">
            <div class="step-circle">
                <i class="fas fa-check fa-xs"></i>
            </div>
            <div class="step-label">Shopping Cart</div>
        </div>
        
        <div class="step active">
            <div class="step-circle">2</div>
            <div class="step-label">Shipping and Checkout</div>
        </div>
        
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-label">Confirmation</div>
        </div>
    </div>
    
    <div>
        <p>Returning customer? <a href="#" class="login-link">Click here to login</a></p>
    </div>
    <div class="row">
    <!-- Billing Details -->
    <div class="col-md-7">
        <h2>Billing details</h2>
        <form action="../cart/billing_process.php" id="checkoutForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label required">First name</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label required">Last name</label>
                    <input type="text" class="form-control" id="lastName" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="companyName" class="form-label">Company name (optional)</label>
                <input type="text" class="form-control" id="companyName">
            </div>
            <div class="mb-3">
                <label for="country" class="form-label required">Country / Region</label>
                <select class="form-select" id="country" required>
                    <option value="US">United States (US)</option>
                    <option value="CA">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="AU">Australia</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="streetAddress" class="form-label required">Street address</label>
                <input type="text" class="form-control mb-2" id="streetAddress" placeholder="House number and street name" required>
                <input type="text" class="form-control" id="streetAddress2" placeholder="Apartment, suite, unit, etc. (optional)">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label required">Town / City</label>
                <input type="text" class="form-control" id="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label required">State</label>
                <select class="form-select" id="state" required>
                    <option value="NY">New York</option>
                    <option value="CA">California</option>
                    <option value="TX">Texas</option>
                    <option value="FL">Florida</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="zipCode" class="form-label required">ZIP Code</label>
                <input type="text" class="form-control" id="zipCode" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label required">Phone</label>
                <input type="tel" class="form-control" id="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label required">Email address</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="createAccount">
                <label class="form-check-label" for="createAccount">Create an account?</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="shipDifferent">
                <label class="form-check-label" for="shipDifferent">Ship to a different address?</label>
            </div>
            <div class="mb-3">
                <label for="orderNotes" class="form-label">Order notes (optional)</label>
                <textarea class="form-control" id="orderNotes" rows="4" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
            </div>
        </form>
    </div>
    <!-- Order Summary -->
    <div class="col-md-5">
        <div class="order-summary">
            <h2>Your order</h2>
            <form action="">
                <?php if (!empty($cart_items)) : ?>
                    <?php foreach ($cart_items as $item) : ?>
                        <div class="product-item">
                            <div class="product-image">
                                <img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                            <div class="product-info">
                                <?php echo htmlspecialchars($item['product_name']); ?>
                                <span class="product-quantity"><?php echo $item['quantity']; ?> x </span>
                            </div>
                            <div class="order-item-price">₱<?php echo number_format($item['price'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Subtotal</div>
                        <div>₱<?php echo number_format($total_price, 2); ?></div>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Shipping</div>
                        <div>₱<?php echo number_format($delivery_fee, 2); ?></div>
                    </div>
                    <div class="d-flex justify-content-between mb-3 fw-bold">
                        <div>Total</div>
                        <div>₱<?php echo number_format($total_price + $delivery_fee, 2); ?></div>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary w-100" form="checkoutForm">
                    <i class="fas fa-lock me-2"></i> Place order
                </button>
            </form>
        </div>
    </div>
</div>

</div>

<script>
    // Countdown Timer
    function startCountdown(duration, display) {
        let timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
            
            minutes = minutes < 10 ? minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            
            display.textContent = minutes + " minutes " + seconds + " seconds";
            
            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }
    
    window.onload = function () {
        const display = document.querySelector('#countdown');
        const duration = 60 * 8 + 59; // 8 minutes and 59 seconds in seconds
        startCountdown(duration, display);
    };
    
    // Form validation
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();
        if (this.checkValidity()) {
            alert('Order placed successfully!');
        } else {
            e.stopPropagation();
            this.classList.add('was-validated');
        }
    });
</script>

<script>
document.getElementById("checkoutForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = {
        firstName: document.getElementById("firstName").value,
        lastName: document.getElementById("lastName").value,
        companyName: document.getElementById("companyName").value,
        country: document.getElementById("country").value,
        streetAddress: document.getElementById("streetAddress").value,
        streetAddress2: document.getElementById("streetAddress2").value,
        city: document.getElementById("city").value,
        state: document.getElementById("state").value,
        zipCode: document.getElementById("zipCode").value,
        phone: document.getElementById("phone").value
    };

    fetch("../cart/billing_process.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Billing details saved successfully!");
            window.location.href = "confirmation_page.php"; // Redirect to confirmation
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>


</body>
</html>