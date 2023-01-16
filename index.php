<?php
$pagename = 'Login';
require_once 'include/header.php';
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = strtolower(trim($_POST['username']));
    $password = $_POST['password'];
    $newpassword = md5($password.$username);
    $users = new Users($conn);
    $user = $users -> getUser($username, $newpassword);
    
}

?>
<div class="container-fluid h-100">
    <div class="container">
        <h2 class="h3 text-center"><?php echo $pagename?></h2>
        <br>
        <div class="row justify-content-center">
            <div class="col-lg-6 bg-light rounded">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Email</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <br>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    if (!$user) {
                        echo '<div class="alert alert-danger">Username or password is incorrect! Please try again.</div>';
                    } else {
                        $_SESSION['username'] = $username;
                        $_SESSION['userid'] = $user['user_id'];
                        header("Location: dashboard.php");
                    }
                }?>
                <a class="text-decoration-none" href="forgot_password.php">Forgot password</a>
            </div>
        </div>
    </div>
</div>




