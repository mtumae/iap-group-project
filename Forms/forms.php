<?php 
require_once 'plugins/PHPMailer/mail.php';


class Forms{

    public function signup(){
        ?>
        <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name='password' placeholder="Password">
        </div>

        <div class="form-group">
            <label for="password-confirmation">Password confirmation</label>
            <input type="password" class="form-control" id="password-confirmation" name='password-confirmation' placeholder="Password confirmation">
        </div>
       
        <button name='signup-form' type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php
        if(isset($_POST['signup-form'])){
        $errors = [];

        //check if all fields are filled
        if (empty($_POST['email']) && empty($_POST['password']) && empty($_POST['password-confirmation'])) {
            $errors[] = "Please ensure all fields are filled!";
        }

        //check if email is valid
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address!";
        }

        //check if password is at least 8 characters long
        if (strlen($_POST['password']) < 8) {
            $errors[] = "Invalid password! Must be at least 8 characters long.";
        }

        //check if passwords match
        if ($_POST['password'] !== $_POST['password-confirmation']) {
            $errors[] = "Passwords do not match!";
        }

        if (empty($errors)) {
            $mail = new Mail();
            $code = rand(100000, 999999);
            echo "<p style='color: green;'>Form submitted successfully!</p>";
            echo $code;
            $mail->verifyAccount($_POST['email'], $code);
            $this->twofactorauth($code);
        } else {
            // Display errors to the user and re-display the form
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
        }
    }

    }


    public function twofactorauth($code){
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="verification-code">Verification Code</label>
                <input type="text" class="form-control" id="verification-code" name='verification-code' aria-describedby="codeHelp" placeholder="Enter verification code">
                <small id="codeHelp" class="form-text text-muted">Please enter the 6-digit code sent to your email.</small>
            </div>
        <button name='2fa-form' type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php

    }
