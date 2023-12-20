

<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "Login";
include 'head.php';
?>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container login-container" style="width: 450px;">
        <h1>Login</h1>
        <form action="./backend/login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="btn-group" role="group">
                <button type="submit" class="btn">Login</button>
                <a href="register.php" class="btn">Register</a>
            </div>
        </form>
    </div>
</body>

</html>
