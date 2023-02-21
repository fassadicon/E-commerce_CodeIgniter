<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <div class="row">
            <div class="col-6">
                <h2>Edit Information</h2>
                <?php echo form_open('update_info', 'class="form"'); ?>
                <input type="hidden" name="id" value="<?= $user_id ?>">
                <label for="email">Email address: </label>
                <input type="text" name="email" class="form-control">
                <label for="first_name">First name: </label>
                <input type="text" name="first_name" class="form-control">
                <label for="last_name">Last name: </label>
                <input type="text" name="last_name" class="form-control">
                <input type="submit" class="btn btn-success" value="Save">
                </form>
            </div>
            <div class="col-6">
                <h2>Change Password</h2>
                <?php echo form_open('update_password', 'class="form"'); ?>
                <input type="hidden" name="id" value="<?= $user_id ?>">
                <label for="old_password">Old Password:</label>
                <input type="text" name="old_password" class="form-control">
                <label for="new_password">New Password: </label>
                <input type="text" name="new_password" class="form-control">
                <label for="confirm_password">Confirm Password:</label>
                <input type="text" name="confirm_password" class="form-control">
                <input type="submit" class="btn btn-success" value="Save">
                </form>
            </div>
        </div>
    </div>
</body>
</html>