<?php
    include '../views/includes/conn.php';
    session_start();



     
    if (!isset($_SESSION['account_name'])) {
        header("Location: ../admin/login.php"); 
        exit(); 
    }

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Settings</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../admin/style.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid p-0">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-dark"><i class="bi bi-sliders2 me-2"></i>Settings</h2>
                    <button class="btn btn-light border mobile-toggle d-md-none" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <!-- Settings Content -->
                <div class="row g-4">
                    <!-- Settings Navigation -->
                    <div class="col-md-3">
                        <div class="card sticky-top" style="top: 20px">
                            <div class="list-group list-group-flush">
                                <a href="#account" class="list-group-item settings-tab active" data-bs-toggle="tab" data-bs-target="#account-tab">
                                    <i class="bi bi-person me-2"></i> Account
                                </a>
                                <a href="#security" class="list-group-item settings-tab" data-bs-toggle="tab" data-bs-target="#security-tab">
                                    <i class="bi bi-shield-lock me-2"></i> Security
                                </a>
                                <a href="#notifications" class="list-group-item settings-tab" data-bs-toggle="tab" data-bs-target="#notifications-tab">
                                    <i class="bi bi-bell me-2"></i> Notifications
                                </a>
                                <a href="#store" class="list-group-item settings-tab" data-bs-toggle="tab" data-bs-target="#store-tab">
                                    <i class="bi bi-shop me-2"></i> Store Settings
                                </a>
                                <a href="#integrations" class="list-group-item settings-tab" data-bs-toggle="tab" data-bs-target="#integrations-tab">
                                    <i class="bi bi-puzzle me-2"></i> Integrations
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Content -->
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- Account Settings -->
                            <div class="tab-pane fade show active" id="account-tab">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">Account Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="update_account.php" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="firstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $_SESSION['account_name']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName" name="lastName" value="User">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" value="admin@waygo.com">
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" value="555-123-4567">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" id="position" name="position" value="Administrator">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Profile Picture</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="me-3">
                                                <img src="img/profile.jpg" alt="Profile Picture" class="rounded-circle shadow-sm" width="80" height="80">
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Admin User</h6>
                                                <p class="text-muted mb-0">Administrator</p>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Settings -->
                            <div class="tab-pane fade" id="security-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="update_password.php" method="POST">
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                                <div class="form-text">Must include uppercase, number, special character (min. 8 chars)</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">Two-Factor Authentication</h5>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="enable2FA">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">Two-factor authentication adds an extra layer of security to your account.</p>
                                        <button type="button" class="btn btn-outline-primary" id="setup2FA">Set Up Two-Factor Authentication</button>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">Login History</h5>
                                        <span class="badge bg-primary">3 Sessions</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Chrome on Windows</h6>
                                                        <p class="text-muted mb-0 small">192.168.1.1 - New York, USA</p>
                                                    </div>
                                                    <span class="text-muted">Mar 19, 2025 10:42 AM</span>
                                                </div>
                                            </div>
                                            <div class="list-group-item py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Chrome on Windows</h6>
                                                        <p class="text-muted mb-0 small">192.168.1.1 - New York, USA</p>
                                                    </div>
                                                    <span class="text-muted">Mar 18, 2025 2:30 PM</span>
                                                </div>
                                            </div>
                                            <div class="list-group-item py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">Chrome on Windows</h6>
                                                        <p class="text-muted mb-0 small">192.168.1.1 - New York, USA</p>
                                                    </div>
                                                    <span class="text-muted">Mar 17, 2025 9:15 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notification Settings -->
                            <div class="tab-pane fade" id="notifications-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Notification Preferences</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="update_notifications.php" method="POST">
                                            <h6 class="mb-3 fw-bold">Email Notifications</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="orderNotifications" name="orderNotifications" checked>
                                                        <label class="form-check-label" for="orderNotifications">New Orders</label>
                                                        <div class="form-text text-muted small">Receive notifications for new orders</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="inventoryNotifications" name="inventoryNotifications" checked>
                                                        <label class="form-check-label" for="inventoryNotifications">Low Inventory Alerts</label>
                                                        <div class="form-text text-muted small">Be notified when stock is low</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="customerNotifications" name="customerNotifications" checked>
                                                        <label class="form-check-label" for="customerNotifications">New Registrations</label>
                                                        <div class="form-text text-muted small">Get alerts for new customers</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="returnNotifications" name="returnNotifications" checked>
                                                        <label class="form-check-label" for="returnNotifications">Returns and Refunds</label>
                                                        <div class="form-text text-muted small">Be notified about return requests</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <h6 class="mb-3 mt-4 fw-bold">System Notifications</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="systemUpdates" name="systemUpdates" checked>
                                                        <label class="form-check-label" for="systemUpdates">System Updates</label>
                                                        <div class="form-text text-muted small">Updates and maintenance notices</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="securityAlerts" name="securityAlerts" checked>
                                                        <label class="form-check-label" for="securityAlerts">Security Alerts</label>
                                                        <div class="form-text text-muted small">Security events and warnings</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary mt-2">Save Preferences</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Store Settings -->
                            <div class="tab-pane fade" id="store-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Store Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="update_store.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="storeName" class="form-label">Store Name</label>
                                                    <input type="text" class="form-control" id="storeName" name="storeName" value="WayGo Store">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="storeEmail" class="form-label">Store Email</label>
                                                    <input type="email" class="form-control" id="storeEmail" name="storeEmail" value="contact@waygo.com">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="storePhone" class="form-label">Store Phone</label>
                                                    <input type="tel" class="form-control" id="storePhone" name="storePhone" value="555-987-6543">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="currency" class="form-label">Currency</label>
                                                    <select class="form-select" id="currency" name="currency">
                                                        <option value="USD" selected>USD - US Dollar</option>
                                                        <option value="EUR">EUR - Euro</option>
                                                        <option value="GBP">GBP - British Pound</option>
                                                        <option value="CAD">CAD - Canadian Dollar</option>
                                                        <option value="AUD">AUD - Australian Dollar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="storeAddress" class="form-label">Store Address</label>
                                                <textarea class="form-control" id="storeAddress" name="storeAddress" rows="2">123 Main Street, Suite 100, New York, NY 10001</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="timezone" class="form-label">Timezone</label>
                                                <select class="form-select" id="timezone" name="timezone">
                                                    <option value="America/New_York" selected>Eastern Time (US & Canada)</option>
                                                    <option value="America/Chicago">Central Time (US & Canada)</option>
                                                    <option value="America/Denver">Mountain Time (US & Canada)</option>
                                                    <option value="America/Los_Angeles">Pacific Time (US & Canada)</option>
                                                    <option value="Europe/London">London</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Information</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Integrations -->
                            <div class="tab-pane fade" id="integrations-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Payment Integrations</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-credit-card fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Stripe</h6>
                                                    <p class="text-muted mb-0 small">Credit card payments</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="stripeEnabled" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-paypal fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">PayPal</h6>
                                                    <p class="text-muted mb-0 small">PayPal payments</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="paypalEnabled" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-bank fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Bank Transfer</h6>
                                                    <p class="text-muted mb-0 small">Direct bank transfers</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="bankEnabled">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Configure Payments</button>
                                    </div>
                                </div>
                                
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Shipping Integrations</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 mb-3">
                                                <div class="card h-100 border">
                                                    <div class="card-body">
                                                        <div class="form-check form-switch d-flex justify-content-between align-items-center mb-2">
                                                            <label class="form-check-label fw-bold" for="upsEnabled">UPS</label>
                                                            <input class="form-check-input" type="checkbox" id="upsEnabled" checked>
                                                        </div>
                                                        <p class="text-muted small mb-0">UPS shipping service</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 mb-3">
                                                <div class="card h-100 border">
                                                    <div class="card-body">
                                                        <div class="form-check form-switch d-flex justify-content-between align-items-center mb-2">
                                                            <label class="form-check-label fw-bold" for="fedexEnabled">FedEx</label>
                                                            <input class="form-check-input" type="checkbox" id="fedexEnabled">
                                                        </div>
                                                        <p class="text-muted small mb-0">FedEx shipping service</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 mb-3">
                                                <div class="card h-100 border">
                                                    <div class="card-body">
                                                        <div class="form-check form-switch d-flex justify-content-between align-items-center mb-2">
                                                            <label class="form-check-label fw-bold" for="uspsEnabled">USPS</label>
                                                            <input class="form-check-input" type="checkbox" id="uspsEnabled">
                                                            <input class="form-check-input" type="checkbox" id="uspsEnabled">
                                                        </div>
                                                        <p class="text-muted small mb-0">USPS shipping service</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Configure Shipping</button>
                                    </div>
                                </div>
                                
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Marketing Integrations</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-envelope fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Mailchimp</h6>
                                                    <p class="text-muted mb-0 small">Email marketing</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="mailchimpEnabled" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-google fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Google Analytics</h6>
                                                    <p class="text-muted mb-0 small">Website analytics</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="analyticsEnabled" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-3 integration-item">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light p-2 rounded me-3">
                                                    <i class="bi bi-facebook fs-3"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Facebook Pixel</h6>
                                                    <p class="text-muted mb-0 small">Social media tracking</p>
                                                </div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="facebookEnabled">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Configure Marketing</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            
            if(sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    if(sidebar.classList.contains('active')) {
                        content.style.marginLeft = 'var(--sidebar-width)';
                    } else {
                        content.style.marginLeft = '0';
                    }
                });
            }
            
            // Product submenu toggle
            const bsCollapse = new bootstrap.Collapse(document.getElementById('productsMenu'), {
                toggle: false
            });
            
            // Setup Two-Factor button
            const setup2FA = document.getElementById('setup2FA');
            const enable2FA = document.getElementById('enable2FA');
            
            if(setup2FA && enable2FA) {
                setup2FA.addEventListener('click', function() {
                    alert('Two-factor authentication setup wizard would open here.');
                    enable2FA.checked = true;
                });
            }
            
            // Password strength validation
            const newPassword = document.getElementById('newPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            
            if(newPassword && confirmPassword) {
                confirmPassword.addEventListener('input', function() {
                    if(newPassword.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity("Passwords don't match");
                    } else {
                        confirmPassword.setCustomValidity('');
                    }
                });
            }
        });
    </script>
</body>
</html>