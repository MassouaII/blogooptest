<?php
require_once("includes/header.php");
$the_message= "";
//controle of iemand was ingelogd?
if ($session->is_signed_in()) { //wanneer dit true is
    //wil zeggen dat iemand is ingelogd
    header("Location:index.php");
}

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //check of the user bestaat in de database
    $user_found = User::verify_user($username, $password);

    if($user_found){
        $session->login($user_found);
        header("Location:index.php");
    }else{
       $the_message="your password or username FAILED!";
    }
}else{
    $username="";
    $password="";
}

// Include FacebookAuth class and config file
require_once 'includes/config.php';
require_once 'includes/FacebookAuth.php';
require_once 'includes/User.php';

//create Facebook object/ authentification instance
$facebookAuth = new FacebookAuth();

//Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to index.php if user is already logged in
    exit;
}
// Check if we received an authorization code
if (!isset($_GET['code'])) {
    // If not, redirect the user to the authorization URL
    $facebookLoginUrl = $facebookAuth->getAuthorizationUrl();
    header('Location: ' . $facebookLoginUrl);
    exit;
}
// Try to get an access token using the authorization code
try {
    $accessToken = $facebookAuth->getAccessToken($_GET['code']);

    // Fetch user details from Facebook
    $userDetails = $facebookAuth->getUserDetails($accessToken);

    // Check if the user exists in the database based on their email
    $user = User::findByEmail($userDetails['email']);

    if ($user) {
        // User exists, log them in
        $_SESSION['user_id'] = $user->id;
        header('Location: index.php');
        exit;
    } else {
        // User doesn't exist, handle as needed (e.g., add user to database)
        // For demonstration purposes, let's redirect to a registration page
        header('Location: register.php');
        exit;
    }
} catch (\Exception $e) {
    // Error occurred during OAuth login
    echo 'Error: ' . $e->getMessage();
    // You can handle the error appropriately (e.g., log it, display a message)
}

?>
<div class="container-fluid">
    <div class="row vh-100">
        <div class="col-lg-6 offset-lg-3 my-auto">
            <div class="auth-logo">
                <a href="index.html"><img src="../admin/assets/compiled/svg/logo.svg" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    <?php echo $the_message; ?>
                </div>
            </div>
            <form action="" method="POST">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>
                </div>
                <input type="submit" name="submit" value="Log in" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                        up</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
            </div>
            <h2 class="text-center mt-2"> -OR- </h2>
            <a href="<?php echo isset($facebookLoginUrl) ? $facebookLoginUrl : ''; ?>" class="btn btn-primary btn-block btn-lg shadow-lg mt-2"><h2 class="text-white text-center">Login with Facebook</h2></a>
        </div>
    </div>
</div>