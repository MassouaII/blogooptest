<?php
//include: error op de pagina,php genereert een waarschuwing,
//maar: de pagina zal wel verder uitgevoerd worden.
//require: hetzelfde als include: php genereert een fatale fout
//en stop de pagina van uitvoering
//include_once
//require_once
    include("includes/header.php");
    if(!$session->is_signed_in()){
        header("location:login.php");
    }
    include("includes/sidebar.php");
    include("includes/content-top.php");
    include("includes/content.php");
    include("includes/footer.php");

//Facebook Login implementation
require_once 'includes/config.php';
require_once 'includes/FacebookAuth.php';
require_once 'includes/User.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the session or database (depending on your implementation)
$user = User::find_by_id($_SESSION['user_id']);

?>

<h1>Welcome, <?php echo $user->username; ?>!</h1>





