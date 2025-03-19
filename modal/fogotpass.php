 <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" aria-hidden="true" aria-labelledby="forgotPasswordModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="forgotPasswordModalLabel">Reset Your Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                    <form>
                        <div class="mb-3">
                            <label for="resetEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="resetEmail" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Back to Login</button>
                </div>
            </div>
        </div>