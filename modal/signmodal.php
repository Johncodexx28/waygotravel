<!-- Signup Modal with Validation -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered auth-modal">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-7">
                        <div class="auth-form">
                            <div class="d-flex align-items-center mb-3">
                                <span style="font-size: 0.9rem;">Waygo Travel.</span>
                                <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            
                            <h1 class="headline">Create new account<span class="accent">.</span></h1>
                            <p class="text-muted mb-3" style="font-size: 0.85rem;">Already a member? <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Log in</a></p>
                            
                            <form id="signupForm" action="views/includes/process.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-2">
                                    <label for="fullName" class="form-label">Full name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Juan Dela Cruz" required>
                                    <div class="invalid-feedback">
                                        Please enter your full name.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label for="signupEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="juan.delacruz@gmail.com" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label for="phoneNumber" class="form-label">Phone number</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="+63 912 345 6789" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid phone number.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="123 Sampaguita St., Barangay Mabini" required>
                                    <div class="invalid-feedback">
                                        Please enter your address.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Quezon City" required>
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state" name="state" placeholder="Metro Manila" required>
                                        <div class="invalid-feedback">
                                            Please enter your state.
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zipCode" class="form-label">Zip code</label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="1000" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid zip code.
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="signupPassword" class="form-label">Password</label>
                                    <div class="password-container">
                                        <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="••••••••" required minlength="6">
                                        <div class="invalid-feedback">
                                            Password must be at least 6 characters long.
                                        </div>
                                        <div class="valid-feedback">
                                            Password looks good!
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary flex-grow-1" value="createAccount" name="createAccount">
                                            Create account
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-3 text-center">
                                    <small class="text-muted" style="font-size: 0.75rem;">By signing up, you agree to our <a href="#" class="text-decoration-none">Terms</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>.</small>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 d-none d-md-block">
                        <div class="auth-image h-100" style="background-image: url('https://plus.unsplash.com/premium_photo-1683134097803-30832f180513?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validation CSS (Can be added to your existing CSS) -->
<style>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get the signup form element
    const signupForm = document.getElementById('signupForm');
    if (!signupForm) return; // Exit if form not found
    
    // Get all required input elements
    const fullNameInput = document.getElementById('fullName');
    const emailInput = document.getElementById('signupEmail');
    const phoneInput = document.getElementById('phoneNumber');
    const addressInput = document.getElementById('address');
    const cityInput = document.getElementById('city');
    const stateInput = document.getElementById('state');
    const zipCodeInput = document.getElementById('zipCode');
    const passwordInput = document.getElementById('signupPassword');
    
    // Setup validation event listeners for all fields
    if (fullNameInput) {
        fullNameInput.addEventListener('input', function() {
            validateName(this);
        });
    }
    
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            validateEmail(this);
        });
    }
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            validatePhone(this);
        });
    }
    
    if (addressInput) {
        addressInput.addEventListener('input', function() {
            validateRequired(this, 'Please enter your address');
        });
    }
    
    if (cityInput) {
        cityInput.addEventListener('input', function() {
            validateRequired(this, 'Please enter your city');
        });
    }
    
    if (stateInput) {
        stateInput.addEventListener('input', function() {
            validateRequired(this, 'Please enter your state');
        });
    }
    
    if (zipCodeInput) {
        zipCodeInput.addEventListener('input', function() {
            validateZipCode(this);
        });
    }
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            validatePassword(this);
        });
    }
    
    // Form submission validation
    signupForm.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validate all fields
        if (fullNameInput) {
            if (!validateName(fullNameInput)) isValid = false;
        }
        
        if (emailInput) {
            if (!validateEmail(emailInput)) isValid = false;
        }
        
        if (phoneInput) {
            if (!validatePhone(phoneInput)) isValid = false;
        }
        
        if (addressInput) {
            if (!validateRequired(addressInput, 'Please enter your address')) isValid = false;
        }
        
        if (cityInput) {
            if (!validateRequired(cityInput, 'Please enter your city')) isValid = false;
        }
        
        if (stateInput) {
            if (!validateRequired(stateInput, 'Please enter your state')) isValid = false;
        }
        
        if (zipCodeInput) {
            if (!validateZipCode(zipCodeInput)) isValid = false;
        }
        
        if (passwordInput) {
            if (!validatePassword(passwordInput)) isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        signupForm.classList.add('was-validated');
    });
    
    // Validation functions
    function validateName(input) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        if (input.value.trim() === '') {
            setInvalid(input, 'Full name is required');
            return false;
        } else if (input.value.trim().length < 2) {
            setInvalid(input, 'Name must be at least 2 characters');
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    function validateEmail(input) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (input.value === '') {
            setInvalid(input, 'Email address is required');
            return false;
        } else if (!emailRegex.test(input.value)) {
            setInvalid(input, 'Please enter a valid email address');
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    function validatePhone(input) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        // Basic phone validation (can be customized for specific formats)
        const phoneRegex = /^[+]?[\s./0-9()-]{10,}$/;
        
        if (input.value === '') {
            setInvalid(input, 'Phone number is required');
            return false;
        } else if (!phoneRegex.test(input.value)) {
            setInvalid(input, 'Please enter a valid phone number');
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    function validateZipCode(input) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        // Basic ZIP code validation (can be customized for country-specific formats)
        const zipRegex = /^\d{4,6}$/;
        
        if (input.value === '') {
            setInvalid(input, 'ZIP code is required');
            return false;
        } else if (!zipRegex.test(input.value)) {
            setInvalid(input, 'Please enter a valid ZIP code (4-6 digits)');
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    function validatePassword(input) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        if (input.value === '') {
            setInvalid(input, 'Password is required');
            return false;
        } else if (input.value.length < 6) {
            setInvalid(input, 'Password must be at least 6 characters long');
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    function validateRequired(input, message) {
        // Reset both feedback elements first
        resetFeedback(input);
        
        if (input.value.trim() === '') {
            setInvalid(input, message);
            return false;
        } else {
            setValid(input);
            return true;
        }
    }
    
    // Helper function to reset both feedback elements
    function resetFeedback(input) {
        // Remove both valid and invalid classes if input is empty
        if (input.value.trim() === '') {
            input.classList.remove('is-valid', 'is-invalid');
            
            // Hide both feedback elements
            const invalidFeedback = input.nextElementSibling;
            if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
                invalidFeedback.style.display = 'none';
            }
            
            const validFeedback = input.nextElementSibling.nextElementSibling;
            if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
                validFeedback.style.display = 'none';
            }
        }
    }
    
    // Helper functions for setting validation states
    function setInvalid(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        // Find and show invalid feedback element
        const invalidFeedback = input.nextElementSibling;
        if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
            invalidFeedback.textContent = message;
            invalidFeedback.style.display = 'block';
        }
        
        // Hide valid feedback element
        const validFeedback = input.nextElementSibling.nextElementSibling;
        if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
            validFeedback.style.display = 'none';
        }
        
        return false;
    }
    
    function setValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        
        // Hide invalid feedback element
        const invalidFeedback = input.nextElementSibling;
        if (invalidFeedback && invalidFeedback.classList.contains('invalid-feedback')) {
            invalidFeedback.style.display = 'none';
        }
        
        // Show valid feedback element
        const validFeedback = input.nextElementSibling.nextElementSibling;
        if (validFeedback && validFeedback.classList.contains('valid-feedback')) {
            validFeedback.style.display = 'block';
        }
        
        return true;
    }
});
</script>