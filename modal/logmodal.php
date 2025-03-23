<?php
$current_file = basename($_SERVER['PHP_SELF']); // Get the current file name
$form_action = ($current_file === 'index.php') ? 'views/includes/process.php' : 'includes/process.php';
?>


<style>
    body {
        background-color: #f8f9fa;
    }
    
    .auth-modal .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .auth-form {
        padding: 1.5rem;
    }
    
    .auth-image {
        background-size: cover;
        background-position: center;
        min-height: 100%;
    }
    
    .headline {
        font-size: 1.8rem; /* Smaller headline */
        font-weight: 700;
        margin-bottom: 0.8rem;
    }
    
    .headline .accent {
        color: #4285F4;
    }
    
    .form-control {
        padding: 0.5rem 0.7rem; /* Even smaller input fields */
        border-radius: 6px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        font-size: 0.85rem; /* Smaller text */
        height: auto; /* Override Bootstrap default height */
    }
    
    .btn-primary {
        background-color: #4285F4;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 0.7rem;
        font-size: 0.9rem;
    }
    
    .btn-light {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 0.5rem 0.7rem;
    }
    
    .password-container {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }

    .modal-close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: transparent;
        color: white;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        z-index: 10;
        opacity: 0.7;
    }

    .modal-close-btn:hover {
        opacity: 1;
    }

    .bi-x{
        font-size: 24px;
    }
    
    /* Smaller form spacing */
    .form-label {
        margin-bottom: 0.25rem;
        font-size: 0.85rem;
    }
    
    .mb-3 {
        margin-bottom: 0.75rem !important;
    }
    
    /* Reduce modal size */
    .modal-xl {
        max-width: 900px; /* Smaller than default modal-xl */
    }
    
    /* Validation styles */
    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    
    .form-control.is-valid {
        border-color: #198754;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: #dc3545;
    }
    
    .valid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.75rem;
        color: #198754;
    }
</style>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered auth-modal">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-7">
                        <div class="auth-form">
                            <div class="d-flex align-items-center mb-4">
                                <span>Waygo Travel.</span>
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            
                            <h1 class="headline">Welcome back<span class="accent">.</span></h1>
                            <p class="text-muted mb-4" style="font-size: 0.85rem;">Please enter your details to sign in.</p>
                            
                            <form id="loginForm" action="<?= $form_action ?>" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <div class="password-container">
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="••••••••" required minlength="6">
                                        <div class="invalid-feedback">
                                            Password must be at least 6 characters long.
                                        </div>
                                        <div class="valid-feedback">
                                            Password looks good!
                                        </div>
                                       
                                    </div>
                                </div>
                                
                                <div class="mb-3 form-check" style="font-size: 0.75rem;">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                    <small style="font-size: 0.75rem;"><a href="#" class="float-end text-decoration-none">Forgot password?</a></small>
                                </div>
                                
                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary" name="login" value="login">Log in</button>
                                </div>
                                
                                <div class="text-center text-muted">
                                    <small style="font-size: 0.75rem;">Don't have an account? <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign up</a></small>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 d-none d-md-block">
                        <div class="auth-image h-100" style="background-image: url('https://images.unsplash.com/photo-1502301197179-65228ab57f78?q=80&w=1970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   
    // Real-time form validation
    document.addEventListener('DOMContentLoaded', function() {
        // Get the login form element
        const loginForm = document.getElementById('loginForm');
        
        // Setup validation for email input
        const emailInput = document.getElementById('loginEmail');
        emailInput.addEventListener('input', function() {
            validateEmail(this);
        });
        
        // Setup validation for password input
        const passwordInput = document.getElementById('loginPassword');
        passwordInput.addEventListener('input', function() {
            validatePassword(this);
        });
        
        // Form submission validation
        loginForm.addEventListener('submit', function(event) {
            if (!loginForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            // Validate all inputs
            validateEmail(emailInput);
            validatePassword(passwordInput);
            
            loginForm.classList.add('was-validated');
        });
        
        // Email validation function
        function validateEmail(input) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailRegex.test(input.value);
            
            if (input.value === '') {
                resetValidation(input);
            } else if (!isValid) {
                setInvalid(input, 'Please enter a valid email address');
            } else {
                setValid(input);
            }
        }
        
        // Password validation function
        function validatePassword(input) {
            if (input.value === '') {
                resetValidation(input);
            } else if (input.value.length < 6) {
                setInvalid(input, 'Password must be at least 6 characters long');
            } else {
                setValid(input);
            }
        }
        
        // Helper functions for setting validation states
        function resetValidation(input) {
            input.classList.remove('is-invalid');
            input.classList.remove('is-valid');
            
            // Hide both feedback elements
            const invalidFeedback = input.nextElementSibling;
            const validFeedback = invalidFeedback.nextElementSibling;
            
            if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                invalidFeedback.style.display = 'none';
            }
            
            if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
                validFeedback.style.display = 'none';
            }
        }
        
        function setInvalid(input, message) {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            
            // Find the feedback elements
            const invalidFeedback = input.nextElementSibling;
            const validFeedback = invalidFeedback.nextElementSibling;
            
            if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                invalidFeedback.textContent = message;
                invalidFeedback.style.display = 'block';
            }
            
            if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
                validFeedback.style.display = 'none';
            }
        }
        
        function setValid(input) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            
            // Find the feedback elements
            const invalidFeedback = input.nextElementSibling;
            const validFeedback = invalidFeedback.nextElementSibling;
            
            if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                invalidFeedback.style.display = 'none';
            }
            
            if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
                validFeedback.style.display = 'block';
            }
        }
    });
</script>