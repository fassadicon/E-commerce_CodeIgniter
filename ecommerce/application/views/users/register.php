<body>
    <div class="container">
        <h1>Register</h1>
        <?php echo form_open('users/store', 'class="form"'); ?>
        <label for="first_name">First name</label>
        <input type="text" name="first_name" class="form-control">
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" class="form-control">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
        <label for="repeat_password">Repeat Password</label>
        <input type="password" name="repeat_password" class="form-control">
        <input type="submit" class="btn btn-success mt-2" value="Create Account">
        </form>
        <a href="/users/login">Already have an account? Login</a>
    </div>
</body>

</html>