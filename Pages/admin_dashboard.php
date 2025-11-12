<?php
session_start();


if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    
    header("Location: /IAP-GROUP-PROJECT/index.php?form=login&error=auth");
    exit();
}


require_once __DIR__ . '/../ClassAutoLoad.php';
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ . '/../Components/components.php'; 

if (!isset($conf)) { die("Config error"); }
$db = new Database($conf);
$db->connect(); 

$components = new Components();


$components->admin_header();

$view = $_GET['view'] ?? 'users'; 
?>

<div class="container mt-4" style="min-height: 80vh;"> 
    <?php
    if ($view === 'users') {
        echo "<h1>User Management</h1>";
        include_once __DIR__ . '/../admin_user_component.php';
    } elseif ($view === 'listings') {
        echo "<h1>Listing Management</h1>";
        echo "<p>Listing management component will go here.</p>";
    }
    elseif ($view === 'reports') {
        echo "<h1>Site Reports</h1>";
        include_once __DIR__ . '/../admin_reports_component.php';
    }
    ?>
</div>

<?php

?>
<footer style="background-color: #333; color: white; text-align: center; padding: 40px 20px; margin-top: 60px;">
    <div class="footer">
        <div class="row">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
        </div>

        <div class="row">
            <h2 style="font-size: 2rem; margin-bottom: 15px;">StrathMart</h2>
            <p style="font-size: 1rem; max-width: 600px; margin: 0 auto; line-height: 1.6; color: #ccc;">
                The trusted Marketplace for all Stratizens to quickly and conveniently buy and sell products within campus
            </p>
            <ul>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>
    </div>
</footer>

</body> 
</html>