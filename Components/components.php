<?php
// session_start();
require_once __DIR__ . '/../ClassAutoLoad.php';
// $form = new Forms(); // This was a duplicate
$forms = new Forms();

class Components {

    public function header() {
        // Use Heredoc to echo all your HTML
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en" data-bs-theme="auto">
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        </head>
        <nav class="navbar navbar-expand-lg " style="background-color:#0F172A">
        <div class="container-fluid" style="background-color:#0F172A">
            <a class="navbar-brand" href="#"><span style="color: #ffffff">Strath</span><span style="color:#3B82F6">Mart</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <style>
              a.nav-link {
                color: #9C9C9C;
                text-decoration: none;
              }

              a.nav-link:hover {
                color: white;
              }
            </style>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                <a class="nav-link"  href="/iap-group-project/Pages/Home.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link"  href="#">Buy</a>
                </li>
HTML;

        // This PHP logic needs to be separate from the Heredoc
        $sellLink = isset($_SESSION['user_id'])
            ? '/iap-group-project/Pages/my_listings.php'
            : '/iap-group-project/Pages/sell.php';
        
        // We continue the echo
        echo <<<HTML
                <li>
                     <a class="nav-link" href="$sellLink">Sell</a>
                </li>
               
            </ul>
            <span class="navbar-text">
                <a href="?form=login"><button class="btn btn-primary" type="button">Browse</button></a>
                <a href="?form=signup"><button class="btn btn-primary" type="button" style="background-color:black">Sell Now</button></a>
            </span>
        </div>
        </div>
        </nav>
HTML;
    }

    public function form_content() {
        global $forms;
        $formType = $_GET['form'] ?? 'login';
        
        // Start Heredoc
        echo <<<HTML
        <div style="display:grid; gap:20px; justify-content: center; padding:15px;" id="page-content">
            <div id="form-section">
HTML;

        // This switch logic runs *inside* PHP
        switch ($formType) {
            case 'signup':
                $forms->signup();
                break;
            case 'login':
                $forms->login();
                break;
            case 'twofa':
                $forms->twofa();
                break;
            
            // START: NEW PASSWORD RESET CASES
            case 'forgot_password':
                $forms->forgotPassword();
                break;
            case 'resetcode':
                $forms->resetCodeForm();
                break;
            case 'newpassword':
                // Authorization check
                if (!isset($_SESSION['pending_reset_user_id'])) {
                    header("Location: index.php?form=login&error=UnauthorizedAccess");
                    exit();
                }
                $forms->newPasswordForm();
                break;
            // END: NEW PASSWORD RESET CASES

            default:
                echo "Unknown form type.";
        }
        
        // Continue Heredoc
        echo <<<HTML
            </div>    
        </div>
HTML;
    }

    public function footer() {
        // This is the footer code, now correctly formatted
        echo <<<HTML
        <footer style="width:98%;">
            <div class="footer">
            <div class="row">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            </div>

            <div class="row">
            <ul>
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            </ul>
            </div>

            </div>
        </footer>
HTML;
    }

} // End of Components class
?>