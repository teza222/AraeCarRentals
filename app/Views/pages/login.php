
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Welcome Back</h2>

                        <p class="text-muted">
                            Sign in to your AREA Car Rentals account.
                        </p>
                    </div>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($success) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p class="mb-0">
                                    <?= htmlspecialchars($error) ?>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/?page=login">

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-danger btn-lg w-100">
                            Sign In
                        </button>

                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        Don't have an account?
                        <a href="/?page=register"
                           class="text-danger fw-semibold text-decoration-none">
                            Register
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
