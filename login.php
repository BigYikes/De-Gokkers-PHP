<?php require 'header.php'; ?>
<style>
    .login_page{
        text-align: center;
    }
</style>

<div class="container">
    <div class="login_page">
        <form action="loginController.php" method="post">
            <input type="hidden" name="type" value="login">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" id="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <input type="submit" value="login">
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
