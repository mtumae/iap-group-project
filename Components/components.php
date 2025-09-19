<?php


class Components{
    public function header(){
        ?>
        <header>
            <h1>Welcome!</h1>
        </header>
        <?php

    }
    public function form_content($conf, $form) {
        ?>
        <div id="page-content">
            <div id="form-section">
                <?php
               
                $current = $_SERVER['PHP_SELF'];

                if ($current === '/IAP-GROUP-PROJECT/Forms/signup.php') {
                    $form->signup();
                } elseif ($current === '/IAP-GROUP-PROJECT/Forms/login.php') {
                    $form->login();
                } else {
                    echo "<p>No form found for this page.</p>";
                }
                ?>
            </div>

            <div id="info-section">
                <h2>Extra Content</h2>
                <p>
                    This is an additional section where you can place text, 
                    images, or instructions for your users.  
                    Since this version doesn’t use Bootstrap, 
                    you can style <code>#info-section</code> and <code>#form-section</code> 
                    in your own CSS.
                </p>
                <button type="button">Example button</button>
            </div>
        </div>
        <?php
    }
    public function footer(){

    }


}