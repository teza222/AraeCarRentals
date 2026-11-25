
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <div class="display-6 text-danger fw-bold">
                            AREA
                        </div>

                        <h2 class="fw-bold">Create Your Account</h2>

                        <p class="text-muted">
                            Register to start renting with us.
                        </p>
                    </div>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/?page=register">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text"
                                       name="first_name"
                                       class="form-control form-control-lg"
                                       value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text"
                                       name="last_name"
                                       class="form-control form-control-lg"
                                       value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>"
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control form-control-lg"
                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   minlength="8"
                                   required>
                            <div class="form-text">
                                Password must be at least 8 characters.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="confirm_password"
                                   class="form-control form-control-lg"
                                   minlength="8"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-danger btn-lg w-100">
                            Create Account
                        </button>

                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        Already have an account?
                        <a href="/?page=login"
                           class="text-danger fw-semibold text-decoration-none">
                            Sign In
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
