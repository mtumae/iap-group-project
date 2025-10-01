<?php

require_once __DIR__ . '/../ClassAutoLoad.php';
$form = new Forms();
$forms = new Forms();
class Components{
    public function header(){
        ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student Marketplace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                <a class="nav-link" href="#">Marketplace</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <?php

    }
    public function form_content() {
        global $forms;
        $formType = $_GET['form'] ?? 'login';
        ?>
        <div style="margin-top:50px;" id="page-content">
            <div id="form-section">
                <?php
               
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
                default:
                    echo "Unknown form type.";
               }
                ?>
            </div>
            <!-- <div id="info-section">
                <h2>Extra Content</h2>
                <p>
                    This is an additional section where you can place text, 
                    images, or instructions for your users.  
                    Since this version doesn’t use Bootstrap, 
                    you can style <code>#info-section</code> and <code>#form-section</code> 
                    in your own CSS.
                </p>
                <button type="button">Example button</button>
            </div> -->
        </div>
        <?php
    }
    public function footer(){

        ?>
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

            <!--  -->
            </div>
        </footer>
        <?php
    }


}