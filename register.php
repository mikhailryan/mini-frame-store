<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\User;
use Carbon\Carbon;

$user = new User();

if (isset($_POST['submit'])) {
    $registered = $user->register([
        'name' => $_POST['full-name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'], 
        'birthdate' => $_POST['birthdate'],
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now('Asia/Manila')
    ]);
}

// Redirect to dashboard if the user is already logged in
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<div class="container">
    <div class="row align-items-center">
        <div class="col mt-5 mb-5">
            <h1 class="text-center">Register</h1>
            <h3 class="text-center">
                <?php echo isset($registered) ? 'You have successfully registered! You may now <a href="login.php">login</a>' : ''; ?>
            </h3>
            <form style="width: 400px; margin: auto;" action="register.php" method="POST">
                <div class="mb-3">
                    <label for="full-name" class="form-label">Full Name</label>
                    <input name="full-name" type="text" class="form-control" id="full-name" required>
                    <div id="full-name" class="form-text">Please enter your full name.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" required>
                    <div id="emailHelp" class="form-text">Please provide a valid email address.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input name="address" type="text" class="form-control" id="address" required>
                    <div id="address" class="form-text">Please enter your address.</div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input name="phone" type="text" class="form-control" id="phone" required>
                    <div id="phone" class="form-text">Please enter your phone number.</div>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input name="birthdate" type="date" class="form-control" id="birthdate" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>
