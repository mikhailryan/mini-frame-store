<?php
ob_start();  // Start output buffering

include 'helpers/functions.php';
template('header.php');

use Aries\MiniFrameworkStore\Models\User;

$user = new User();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $user_info = $user->login([
        'email' => $_POST['email'],
    ]);

    // Check if password matches the stored hash
    if ($user_info && password_verify($_POST['password'], $user_info['password'])) {
        $_SESSION['user'] = $user_info;
        header('Location: my-account.php');
        exit;
    } else {
        $message = 'Invalid username or password';
    }
}

// Redirect if the user is already logged in
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: my-account.php');
    exit;
}

?>

<div class="container">
    <div class="row align-items-center">
        <div class="col mt-5 mb-5">
            <h1 class="text-center">Login</h1>
            <h3 class="text-center text-danger"><?php echo isset($message) ? $message : ''; ?></h3>
            <form style="width: 400px; margin: auto;" action="login.php" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>

<?php ob_end_flush();  // End output buffering and send the output ?>
