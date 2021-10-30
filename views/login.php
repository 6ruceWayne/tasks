<div class="container-lg w-25">
<form method="post" action="/login">
    <?php echo display_error(); ?>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary mb-2" name="login_btn">Submit</button>
    <p>
        Not yet a member? <a href="register">Sign up</a>
    </p>
</form>
</div>