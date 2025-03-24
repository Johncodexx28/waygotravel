<!-- View Order Details Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewOrderModalLabel">Order #<span id="order-id">ORD-2782</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-4">
          <!-- Order Status -->
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted">Order Status</h6>
                <div class="d-flex align-items-center mb-3">
                  <div class="me-3">
                    <span id="order-status-badge" class="badge bg-success">Delivered</span>
                  </div>
                  <div>
                    <select class="form-select form-select-sm" id="update-status">
                      <option value="pending">Pending</option>
                      <option value="processing">Processing</option>
                      <option value="shipped">Shipped</option>
                      <option value="delivered" selected>Delivered</option>
                      <option value="cancelled">Cancelled</option>
                    </select>
                  </div>
                  <div class="ms-2">
                    <button class="btn btn-sm btn-primary">Update</button>
                  </div>
                </div>
                <p class="text-muted small mb-0">Last updated: Mar 15, 2025, 10:23 AM</p>
              </div>
            </div>
          </div>
          
          <!-- Payment Info -->
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted">Payment Information</h6>
                <table class="table table-sm table-borderless mb-0">
                  <tr>
                    <td class="text-muted">Status:</td>
                    <td><span id="payment-status" class="badge bg-success">Paid</span></td>
                  </tr>
                  <tr>
                    <td class="text-muted">Method:</td>
                    <td id="payment-method">Credit Card (Visa ****4578)</td>
                  </tr>
                  <tr>
                    <td class="text-muted">Transaction ID:</td>
                    <td id="transaction-id">ch_3MVYsLK38aIUDfSI0rJbFKvb</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mb-4">
          <!-- Customer Information -->
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted">Customer Information</h6>
                <table class="table table-sm table-borderless mb-0">
                  <tr>
                    <td class="text-muted">Name:</td>
                    <td id="customer-name">John Doe</td>
                  </tr>
                  <tr>
                    <td class="text-muted">Email:</td>
                    <td id="customer-email">john.doe@example.com</td>
                  </tr>
                  <tr>
                    <td class="text-muted">Phone:</td>
                    <td id="customer-phone">(555) 123-4567</td>
                  </tr>
                  <tr>
                    <td class="text-muted">Account:</td>
                    <td><a href="#" id="customer-account-link">View Account</a></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          
          <!-- Shipping Address -->
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted">Shipping Address</h6>
                <address id="shipping-address" class="mb-0">
                  John Doe<br>
                  123 Main Street<br>
                  Apt 4B<br>
                  New York, NY 10001<br>
                  United States
                </address>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Order Items -->
        <div class="card mb-4">
          <div class="card-body">
            <h6 class="card-subtitle mb-3 text-muted">Order Items</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                  </tr>
                </thead>
                <tbody id="order-items">
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/images/products/default.png" class="me-2" width="40" height="40">
                        <div>Premium Leather Bag</div>
                      </div>
                    </td>
                    <td>BAG-001</td>
                    <td class="text-center">1</td>
                    <td class="text-end">$79.99</td>
                    <td class="text-end">$79.99</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="../assets/images/products/default.png" class="me-2" width="40" height="40">
                        <div>Designer Wallet</div>
                      </div>
                    </td>
                    <td>WAL-102</td>
                    <td class="text-center">1</td>
                    <td class="text-end">$45.00</td>
                    <td class="text-end">$45.00</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" class="text-end">Subtotal:</td>
                    <td class="text-end">$124.99</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-end">Shipping:</td>
                    <td class="text-end">$5.00</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-end">Tax:</td>
                    <td class="text-end">$6.25</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td class="text-end"><strong>$136.24</strong></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        
        <!-- Order Notes -->
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle mb-3 text-muted">Order Notes & History</h6>
            <div class="mb-3">
              <textarea class="form-control" rows="2" placeholder="Add a note to this order..."></textarea>
              <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-sm btn-primary">Add Note</button>
              </div>
            </div>
            <hr>
            <div class="order-history">
              <div class="d-flex mb-3">
                <div class="me-3">
                  <div class="avatar avatar-sm">AD</div>
                </div>
                <div>
                  <div class="d-flex align-items-center mb-1">
                    <strong>Admin User</strong>
                    <span class="badge bg-light text-dark ms-2">Staff</span>
                    <small class="text-muted ms-auto">Mar 15, 2025, 10:23 AM</small>
                  </div>
                  <p class="mb-0">Status changed from <span class="badge bg-info">Shipped</span> to <span class="badge bg-success">Delivered</span></p>
                </div>
              </div>
              <div class="d-flex mb-3">
                <div class="me-3">
                  <div class="avatar avatar-sm">SY</div>
                </div>
                <div>
                  <div class="d-flex align-items-center mb-1">
                    <strong>System</strong>
                    <small class="text-muted ms-auto">Mar 14, 2025, 9:15 AM</small>
                  </div>
                  <p class="mb-0">Tracking information updated: USPS #92748999784321584321597</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="me-3">
                  <div class="avatar avatar-sm">SY</div>
                </div>
                <div>
                  <div class="d-flex align-items-center mb-1">
                    <strong>System</strong>
                    <small class="text-muted ms-auto">Mar 13, 2025, 3:47 PM</small>
                  </div>
                  <p class="mb-0">Order created and payment received via Credit Card (Visa ****4578)</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <div class="dropdown d-inline-block">
          <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Actions
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editOrderModal"><i class="bi bi-pencil me-2"></i>Edit Order</a></li>
            <li><a class="dropdown-item" href="#" onclick="printInvoice()"><i class="bi bi-printer me-2"></i>Print Invoice</a></li>
            <li><a class="dropdown-item" href="#" onclick="emailInvoice()"><i class="bi bi-envelope me-2"></i>Email Invoice</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i>Cancel Order</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOrderModalLabel">Edit Order #ORD-2782</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editOrderForm">
          <!-- Order Status & Details -->
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit-status" class="form-label">Order Status</label>
                <select class="form-select" id="edit-status" name="status">
                  <option value="pending">Pending</option>
                  <option value="processing">Processing</option>
                  <option value="shipped">Shipped</option>
                  <option value="delivered" selected>Delivered</option>
                  <option value="cancelled">Cancelled</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit-date" class="form-label">Order Date</label>
                <input type="date" class="form-control" id="edit-date" name="order_date" value="2025-03-15">
              </div>
            </div>
          </div>
          
          <!-- Customer Information -->
          <h6 class="fw-bold mb-3">Customer Information</h6>
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit-customer-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="edit-customer-name" name="customer_name" value="John Doe">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit-customer-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit-customer-email" name="customer_email" value="john.doe@example.com">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit-customer-phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="edit-customer-phone" name="customer_phone" value="(555) 123-4567">
              </div>
            </div>
          </div>
          
          <!-- Shipping Address -->
          <h6 class="fw-bold mb-3">Shipping Address</h6>
          <div class="row mb-4">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="edit-shipping-address-1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" id="edit-shipping-address-1" name="shipping_address_1" value="123 Main Street">
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="edit-shipping-address-2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" id="edit-shipping-address-2" name="shipping_address_2" value="Apt 4B">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="edit-shipping-city" class="form-label">City</label>
                <input type="text" class="form-control" id="edit-shipping-city" name="shipping_city" value="New York">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="edit-shipping-state" class="form-label">State</label>
                <input type="text" class="form-control" id="edit-shipping-state" name="shipping_state" value="NY">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="edit-shipping-zip" class="form-label">ZIP Code</label>
                <input type="text" class="form-control" id="edit-shipping-zip" name="shipping_zip" value="10001">
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label for="edit-shipping-country" class="form-label">Country</label>
                <select class="form-select" id="edit-shipping-country" name="shipping_country">
                  <option value="US" selected>United States</option>
                  <option value="CA">Canada</option>
                  <option value="UK">United Kingdom</option>
                  <option value="AU">Australia</option>
                </select>
              </div>
            </div>
          </div>
          
          <!-- Order Items -->
          <h6 class="fw-bold mb-3">Order Items</h6>
          <div class="table-responsive mb-3">
            <table class="table table-sm table-bordered" id="editOrderItemsTable">
              <thead class="table-light">
                <tr>
                  <th>Product</th>
                  <th width="90">Quantity</th>
                  <th width="120">Price</th>
                  <th width="120">Total</th>
                  <th width="40"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select class="form-select form-select-sm" name="product_id[]">
                      <option value="1" selected>Premium Leather Bag</option>
                      <option value="2">Designer Wallet</option>
                      <option value="3">Travel Backpack</option>
                      <option value="4">Crossbody Purse</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm item-quantity" name="quantity[]" value="1" min="1">
                  </td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm item-price" name="price[]" value="79.99" step="0.01" min="0">
                    </div>
                  </td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm item-total" value="79.99" readonly>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <select class="form-select form-select-sm" name="product_id[]">
                      <option value="1">Premium Leather Bag</option>
                      <option value="2" selected>Designer Wallet</option>
                      <option value="3">Travel Backpack</option>
                      <option value="4">Crossbody Purse</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="form-control form-control-sm item-quantity" name="quantity[]" value="1" min="1">
                  </td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm item-price" name="price[]" value="45.00" step="0.01" min="0">
                    </div>
                  </td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm item-total" value="45.00" readonly>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addItemBtn">
                      <i class="bi bi-plus-circle me-2"></i>Add Item
                    </button>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end">Subtotal:</td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm" id="edit-subtotal" value="124.99" readonly>
                    </div>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end">Shipping:</td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm" id="edit-shipping" name="shipping_cost" value="5.00" step="0.01" min="0">
                    </div>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end">Tax:</td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm" id="edit-tax" name="tax" value="6.25" step="0.01" min="0">
                    </div>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end"><strong>Total:</strong></td>
                  <td>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control form-control-sm" id="edit-total" value="136.24" readonly>
                    </div>
                  </td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <!-- Order Notes -->
          <div class="mb-3">
            <label for="edit-notes" class="form-label">Order Notes</label>
            <textarea class="form-control" id="edit-notes" name="notes" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveOrderChanges">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Invoice Template (Hidden for printing) -->
<div id="invoiceTemplate" style="display: none;">
  <div class="invoice-container" style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
      <div>
        <h2 style="margin: 0; color: #333;">WayGo</h2>
        <p style="margin: 5px 0; color: #666;">123 Business Street</p>
        <p style="margin: 5px 0; color: #666;">New York, NY 10001</p>
        <p style="margin: 5px 0; color: #666;">Phone: (555) 987-6543</p>
        <p style="margin: 5px 0; color: #666;">Email: sales@waygo.com</p>
      </div>
      <div style="text-align: right;">
        <h1 style="margin: 0; color: #333;">INVOICE</h1>
        <p style="margin: 5px 0; color: #666;"><strong>Invoice #:</strong> INV-2782</p>
        <p style="margin: 5px 0; color: #666;"><strong>Order #:</strong> ORD-2782</p>
        <p style="margin: 5px 0; color: #666;"><strong>Date:</strong> March 15, 2025</p>
        <p style="margin: 5px 0; color: #666;"><strong>Payment Status:</strong> Paid</p>
      </div>
    </div>
    
    <hr style="border: 1px solid #eee; margin: 20px 0;">
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
      <div>
        <h3 style="margin: 0 0 10px 0; color: #333;">Bill To:</h3>
        <p style="margin: 5px 0; color: #666;">John Doe</p>
        <p style="margin: 5px 0; color: #666;">john.doe@example.com</p>
        <p style="margin: 5px 0; color: #666;">(555) 123-4567</p>
      </div>
      <div>
        <h3 style="margin: 0 0 10px 0; color: #333;">Ship To:</h3>
        <p style="margin: 5px 0; color: #666;">John Doe</p>
        <p style="margin: 5px 0; color: #666;">123 Main Street, Apt 4B</p>
        <p style="margin: 5px 0; color: #666;">New York, NY 10001</p>
        <p style="margin: 5px 0; color: #666;">United States</p>
      </div>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
      <thead>
        <tr style="background-color: #f8f9fa;">
          <th style="padding: 10px; text-align: left; border-bottom: 2px solid #dee2e6;">Item</th>
          <th style="padding: 10px; text-align: center; border-bottom: 2px solid #dee2e6;">Quantity</th>
          <th style="padding: 10px; text-align: right; border-bottom: 2px solid #dee2e6;">Price</th>
          <th style="padding: 10px; text-align: right; border-bottom: 2px solid #dee2e6;">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 10px; border-bottom: 1px solid #dee2e6;">
            <p style="margin: 0; font-weight: bold;">Premium Leather Bag</p>
            <p style="margin: 5px 0 0 0; color: #666; font-size: 12px;">SKU: BAG-001</p>
          </td>
          <td style="padding: 10px; text-align: center; border-bottom: 1px solid #dee2e6;">1</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$79.99</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$79.99</td>
        </tr>
        <tr>
          <td style="padding: 10px; border-bottom: 1px solid #dee2e6;">
            <p style="margin: 0; font-weight: bold;">Designer Wallet</p>
            <p style="margin: 5px 0 0 0; color: #666; font-size: 12px;">SKU: WAL-102</p>
          </td>
          <td style="padding: 10px; text-align: center; border-bottom: 1px solid #dee2e6;">1</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$45.00</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$45.00</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">Subtotal:</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$124.99</td>
        </tr>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">Shipping:</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$5.00</td>
        </tr>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">Tax:</td>
          <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dee2e6;">$6.25</td>
        </tr>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: right; font-weight: bold;">Total:</td>
          <td style="padding: 10px; text-align: right; font-weight: bold;">$136.24</td>
        </tr>
      </tfoot>
    </table>
    
    <div style="margin-bottom: 20px;">
      <h3 style="margin: 0 0 10px 0; color: #333;">Payment Information</h3>
      <p style="margin: 5px 0; color: #666;"><strong>Method:</strong> Credit Card (Visa ****4578)</p>
      <p style="margin: 5px 0; color: #666;"><strong>Transaction ID:</strong> ch_3MVYsLK38aIUDfSI0rJbFKvb</p>
      <p style="margin: 5px 0; color: #666;"><strong>Date:</strong> March 15, 2025</p>
    </div>
    
    <hr style="border: 1px solid #eee; margin: 20px 0;">
    
    <<div style="text-align: center; color: #666; font-size: 12px;">
        <p style="margin: 5px 0;">Thank you for your business!</p>
        <p style="margin: 5px 0;">If you have any questions about this invoice, please contact our customer service at support@waygo.com</p>
        <p style="margin: 5px 0;">© 2025 WayGo Inc. All rights reserved.</p>
    </div>
            