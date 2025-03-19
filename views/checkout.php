<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php"?>
<body>

<div class="container my-5">
    <div class="row">
        <!-- Order Summary (Left Side) -->
        <div class="col-lg-5">
            <!-- Back Button -->
            <button onclick="history.back()" class="btn btn-outline-dark mb-3">
                ← Back
            </button>

            <h2 class="mb-4">Order Summary</h2>

            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded" alt="Backpack">
                    <span>Backpack</span>
                    <span>$45.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded" alt="Hiking Boots">
                    <span>Hiking Boots</span>
                    <span>$120.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded" alt="Travel Jacket">
                    <span>Travel Jacket</span>
                    <span>$75.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span>$240.00</span>
                </li>
            </ul>

            <img src="https://via.placeholder.com/400x200?text=Secure+Payment" class="img-fluid" alt="Secure Payment">
        </div>

        <!-- Dark Themed Checkout Section (Right Side) -->
        <div class="col-lg-7">
            <div class="p-4 rounded" style="background-color: #343a40; color: white;">
                <h2 class="mb-4" style="color: white;">Checkout</h2>
2
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="lastName" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" id="address" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="zip" required>
                        </div>
                    </div>

                    <hr class="my-4 border-light">

                    <h4>Payment Method</h4>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                        <label class="form-check-label" for="creditCard">
                            Credit/Debit Card
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                        <label class="form-check-label" for="paypal">
                            PayPal
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cod">
                        <label class="form-check-label" for="cod">
                            Cash on Delivery (COD)
                        </label>
                    </div>

                    <hr class="my-4 border-light">

                    <button type="submit" class="btn btn-light w-100">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
