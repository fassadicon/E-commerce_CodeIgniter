<body>
    <div class="container">
        <h1>Login</h1>
        <?php echo form_open('users/login', 'class="form"'); ?>
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
        <input type="submit" class="btn btn-primary mt-2" value="Login">
        </form>
        <a href="users/register">Don't have an account? Register</a>
    </div>
</body>
</html>