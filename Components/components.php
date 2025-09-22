<?php

require_once __DIR__ . '/../ClassAutoLoad.php';
$form = new Forms();

class Components{
    public function header(){
        ?>
        <header>
            <h1>Welcome!</h1>
        </header>
        <?php

    }
    public function form_content() {
        global $form;
        ?>
        <div id="page-content">
            <div id="form-section">
                <?php
               
                $current = $_SERVER['PHP_SELF'];

                if ($current === '/IAP-GROUP-PROJECT/Forms/signup.php') {
                    $form->signup();
                } elseif ($current === '/IAP-GROUP-PROJECT/Forms/login.php') {
                    $form->signup();
                } else {
                    $form->login();
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
     <footer>
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
    <li><a href="#">Our Services</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Terms & Conditions</a></li>
    <li><a href="#">Career</a></li>
    </ul>
    </div>

    <!--  -->
    </div>
    </footer>
        <?php
    }


}