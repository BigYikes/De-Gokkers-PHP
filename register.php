<?php require 'header.php'; ?>
<style>
    .register{
        text-align: center;
    }
</style>

<div class="container">
    <div class="register">
        <img src="hond.png" alt="" width="200" height="100">
        <h1>De Gokkers</h1>

        <form action="loginController.php" method="post">
            <input type="hidden" name="type" value="register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" name="password_confirm" id="password_confirm">
            </div>
    </div>

    <input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the <a href="terms.php">Terms and Conditions</a>
    <input type="submit" value="Register">
    <p>Already a member? <a href="login.php">Sign in</a></p>
    </form>

    <div class="requirements">
        <h3>Requirements</h3>
        <p>Password should be atleast 7 characters and max 16 characters it must contain at least one capital letter
            and should contain at least one small letter.</p>
    </div>
</div>

<?php require 'footer.php'; ?>

