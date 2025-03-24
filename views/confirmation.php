<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: #333;
            background-color: #fff;
        }
        
        .confirmation-container {
            max-width: 1100px;
            margin: 0 auto;
        }
        
        .success-banner {
            background-color: #edf7ed;
            border-left: 4px solid #4caf50;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 30px;
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
            width: 100%;
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
        
        .step.completed .step-circle {
            background-color: #4caf50;
        }
        
        .step-label {
            font-size: 13px;
            white-space: nowrap;
        }
        
        h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .order-details-card {
            background-color: #f9f9f9;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .order-details-card h3 {
            margin-bottom: 15px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .details-section {
            margin-bottom: 20px;
        }
        
        .details-section h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #555;
        }
        
        .details-section p {
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .product-table {
            width: 100%;
            margin-bottom: 30px;
        }
        
        .product-table th {
            text-align: left;
            padding: 10px;
            background-color: #f1f1f1;
            font-weight: 600;
            font-size: 14px;
        }
        
        .product-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-name {
            font-weight: 500;
        }
        
        .order-total-row td {
            font-weight: 600;
            padding-top: 20px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .btn-primary {
            background-color: #4caf50;
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 15px;
        }
        
        .btn-primary:hover {
            background-color: #43a047;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid #ddd;
            color: #555;
            padding: 12px 20px;
            font-weight: 500;
            font-size: 15px;
        }
        
        .btn-outline:hover {
            background-color: #f5f5f5;
            color: #333;
        }
        
        .payment-status {
            display: inline-block;
            background-color: #ffebee;
            color: #d32f2f;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .payment-status.completed {
            background-color: #edf7ed;
            color: #43a047;
        }
        
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }
        
        .info-icon {
            color: #4caf50;
            margin-right: 5px;
        }
        
        .tracking-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin-top: 15px;
        }
        
        .tracking-label {
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .tracking-number {
            font-family: monospace;
            letter-spacing: 0.5px;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .steps-container {
            background-color: #f9f9f9;
            border-radius: 4px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .next-steps {
            margin-top: 30px;
        }
        
        .next-steps h3 {
            margin-bottom: 20px;
        }
        
        .next-step-card {
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .next-step-icon {
            margin-right: 15px;
            width: 40px;
            height: 40px;
            background-color: #edf7ed;
            color: #4caf50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .next-step-content {
            flex-grow: 1;
        }
        
        .next-step-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .next-step-desc {
            font-size: 14px;
            color: #666;
        }
        
        .customer-service {
            background-color: #f5f5f5;
            border-radius: 4px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
        }
        
        .customer-service-title {
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .customer-service-desc {
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
        }
        
        .payment-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .payment-icon {
            width: 40px;
            height: 40px;
            background-color: #f5f5f5;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .ewallet-instructions {
            margin-top: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 15px;
            border-left: 3px solid #4caf50;
        }
        
        .ewallet-name {
            font-weight: 600;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container confirmation-container my-4">
    <!-- Success Banner -->
    <div class="success-banner">
        <h2 class="m-0">
            <i class="fas fa-check-circle info-icon"></i> Thank you. Your order has been received.
        </h2>
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
        
        <div class="step completed">
            <div class="step-circle">
                <i class="fas fa-check fa-xs"></i>
            </div>
            <div class="step-label">Shipping and Checkout</div>
        </div>
        
        <div class="step completed">
            <div class="step-circle">
                <i class="fas fa-check fa-xs"></i>
            </div>
            <div class="step-label">Confirmation</div>
        </div>
    </div>
    
    <!-- Order Information Summary -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="details-section">
                <h4>Order Number</h4>
                <p>#ORD-2587</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="details-section">
                <h4>Date</h4>
                <p>March 24, 2025</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="details-section">
                <h4>Total</h4>
                <p>$44.99</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="details-section">
                <h4>Payment Method</h4>
                <p>Bank Transfer or E-Wallet</p>
            </div>
        </div>
    </div>
    
    <!-- Payment Status -->
    <div class="mb-4">
        <span class="payment-status">Payment pending</span>
        <p class="mt-2 mb-0 small text-muted">
            Please make your payment via bank transfer or e-wallet. Use your Order ID as the payment reference.
        </p>
        
        <div class="ewallet-instructions mt-3">
            <h5 class="mb-3">Payment Options:</h5>
            
            <div class="mb-3">
                <p class="mb-1"><strong>Bank Transfer</strong></p>
                <p class="mb-0 small">Make your payment directly to our bank account. Please use your Order ID #ORD-2587 as the payment reference.</p>
            </div>
            
            <div>
                <p class="mb-1"><strong>E-Wallet Options</strong></p>
                <p class="mb-0 small">You can also pay using any of these e-wallet services. Please use your Order ID #ORD-2587 as the reference.</p>
                
                <div class="payment-icons mt-2">
                    <div class="payment-icon" title="PayPal">
                        <i class="fab fa-paypal"></i>
                    </div>
                    <div class="payment-icon" title="GCash">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="payment-icon" title="PayMaya">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="payment-icon" title="Other E-Wallets">
                        <i class="fas fa-credit-card"></i>
                    </div>
                </div>
                
                <div class="mt-3">
                    <span class="ewallet-name">PayPal:</span> payments@yourstore.com
                </div>
                <div>
                    <span class="ewallet-name">GCash:</span> 09123456789
                </div>
                <div>
                    <span class="ewallet-name">PayMaya:</span> 09123456789
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Details -->
    <div class="order-details-card">
        <h3>Order Details</h3>
        
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image me-3">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <span class="product-name">Jogging Top</span>
                        </div>
                    </td>
                    <td>1</td>
                    <td class="text-right">$15.00</td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image me-3">
                                <i class="fas fa-flask"></i>
                            </div>
                            <span class="product-name">Eco Water Bottle</span>
                        </div>
                    </td>
                    <td>1</td>
                    <td class="text-right">$10.00</td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-image me-3">
                                <i class="fas fa-hat-cowboy"></i>
                            </div>
                            <span class="product-name">Beanie Hat</span>
                        </div>
                    </td>
                    <td>1</td>
                    <td class="text-right">$15.00</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Subtotal</td>
                    <td class="text-right">$40.00</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Shipping</td>
                    <td class="text-right">$4.99</td>
                </tr>
                <tr class="order-total-row">
                    <td colspan="2" class="text-right">Total</td>
                    <td class="text-right">$44.99</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Shipping and Billing Details -->
    <div class="details-grid">
        <div class="details-section">
            <h4>Shipping Address</h4>
            <p>John Doe</p>
            <p>123 Main Street</p>
            <p>Apt 4B</p>
            <p>New York, NY 10001</p>
            <p>United States</p>
        </div>
        
        <div class="details-section">
            <h4>Billing Address</h4>
            <p>John Doe</p>
            <p>123 Main Street</p>
            <p>Apt 4B</p>
            <p>New York, NY 10001</p>
            <p>United States</p>
        </div>
    </div>
    
    <div class="divider"></div>
    
    <!-- Shipping Information -->
    <div>
        <h3>Shipping Information</h3>
        <p>Your order will be packed and shipped once payment is confirmed.</p>
        
        <div class="tracking-box">
            <p class="tracking-label">Estimated Delivery Date</p>
            <p class="fw-bold mb-3">March 28 - March 30, 2025</p>
            
            <p class="tracking-label">Shipping Method</p>
            <p class="fw-bold">Standard Shipping (3-5 business days)</p>
        </div>
    </div>
    
    <!-- Next Steps -->
    <div class="next-steps">
        <h3>What's Next?</h3>
        
        <div class="next-step-card">
            <div class="next-step-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="next-step-content">
                <div class="next-step-title">Complete Your Payment</div>
                <div class="next-step-desc">Please make your payment via bank transfer or e-wallet using the order number as reference.</div>
            </div>
        </div>
        
        <div class="next-step-card">
            <div class="next-step-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="next-step-content">
                <div class="next-step-title">Order Processing</div>
                <div class="next-step-desc">We'll begin preparing your order once payment is confirmed.</div>
            </div>
        </div>
        
        <div class="next-step-card">
            <div class="next-step-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <div class="next-step-content">
                <div class="next-step-title">Shipping</div>
                <div class="next-step-desc">Your order will be shipped within 1-2 business days after payment confirmation.</div>
            </div>
        </div>
        
        <div class="next-step-card">
            <div class="next-step-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="next-step-content">
                <div class="next-step-title">Updates via Email</div>
                <div class="next-step-desc">We'll send you shipping confirmation and tracking details via email.</div>
            </div>
        </div>
    </div>
    
    <!-- Customer Service -->
    <div class="customer-service">
        <h4 class="customer-service-title">Need Help?</h4>
        <p class="customer-service-desc">If you have any questions about your order or payment options, please contact our customer service team.</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-primary">
                <i class="fas fa-envelope me-2"></i> Email Us
            </button>
            <button class="btn btn-outline">
                <i class="fas fa-phone me-2"></i> Call Support
            </button>
        </div>
    </div>
    
    <!-- Call to Action -->
    <div class="text-center mt-5 mb-5">
        <a href="#" class="btn btn-primary me-2">Track Your Order</a>
        <a href="#" class="btn btn-outline">Continue Shopping</a>
    </div>
</div>

</body>
</html>