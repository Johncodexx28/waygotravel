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
</style>
</head>




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
                            <p class="text-muted mb-4"  style="font-size: 0.85rem;" >Please enter your details to sign in.</p>
                            
                            <form action="<?= $form_action ?>" method="POST">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter your email">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <div class="password-container">
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="••••••••">
                                        <span class="password-toggle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="mb-3 form-check "  style="font-size: 0.75rem;">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                    <small  style="font-size: 0.75rem;"><a href="#" class="float-end text-decoration-none">Forgot password?</a></small>
                                </div>
                                
                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary" name="login" value="login">Log in</button>
                                </div>
                                
                                <div class="text-center text-muted">
                                    <small  style="font-size: 0.75rem;">Don't have an account? <a href="#" class="text-decoration-none " data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign up</a></small>
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
    // Toggle password visibility
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                </svg>`;
            } else {
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>`;
            }
        });
    });
</script>