
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas_index" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header d-flex justify-content-between align-items-center border-bottom pb-3">
        <p class="offcanvas-title text-center flex-grow-1 fw-bold" id="cartOffcanvasLabel" style="font-size: 20px;">
            Shopping Cart
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div id="cart-items">
            <?php if (!empty($cart_items)) : ?>
                <?php foreach ($cart_items as $item) : ?>
                    <div class="cart-item mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center">
                            <img src="/WayGo-Travel-Website/<?php echo htmlspecialchars($item['image']); ?>" 
                                alt="<?php echo htmlspecialchars($item['product_name']); ?>" 
                                class="rounded me-3" 
                                style="width: 70px; height: 70px; object-fit: cover;">
                            
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                    Size: <?php echo htmlspecialchars($item['size']); ?> | 
                                    Color: <?php echo htmlspecialchars($item['color']); ?>
                                </p>
                                <p class="fw-semibold mb-2">₱<?php echo number_format($item['price'], 2); ?></p>
                                
                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <div class="quantity-control d-flex align-items-center border rounded">
                                        <a href="../cart/updatecart.php?cart_id=<?php echo $item['cart_id']; ?>&action=decrease" 
                                           class="btn btn-sm px-2 py-0 border-0" style="font-size: 14px;">-</a>
                                        <span class="px-2"><?php echo $item['quantity']; ?></span>
                                        <a href="../cart/updatecart.php?cart_id=<?php echo $item['cart_id']; ?>&action=increase" 
                                           class="btn btn-sm px-2 py-0 border-0" style="font-size: 14px;">+</a>
                                    </div>
                                    
                                    <a href="removecart.php?cart_id=<?php echo $item['cart_id']; ?>" 
                                       class="text-danger" 
                                       onclick="return confirm('Remove item from cart?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="cart-summary mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-bold">₱<?php echo number_format($total_price, 2); ?></span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span>Shipping:</span>
                        <span>Calculated at checkout</span>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="checkout.php" class="btn btn-dark py-2 fw-semibold">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <div class="text-center py-5">
                    <i class="bi bi-cart" style="font-size: 3rem;"></i>
                    <p id="empty-cart-text" class="text-muted mt-3">Your cart is empty.</p>
                    <a href="/WayGo-Travel-Website/views/newrelease.php" class="btn btn-outline-dark mt-3">
                        Start Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>