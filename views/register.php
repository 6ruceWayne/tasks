<div class="container-lg w-25">
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="/register">
        <?php echo display_error(); ?>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username"
                value="<?php echo $username; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email"
                value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password_1">
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm password</label>
            <input type="password" class="form-control" name="password_2">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="register_btn">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</div>