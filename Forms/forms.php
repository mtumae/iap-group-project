<?php 

class Forms{

    public function signup(){
        ?>
<form action = "signup_action.php" method="POST">
            <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <!--  -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <div id="login-redirect-container">
                <a href="/iap-group-project/Forms/login.php">Already have an account? Login</a>
        </div>
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
</form>
        <?php

    }

    public function login() {
        ?>
        <form method="post" action="/IAP-GROUP-PROJECT/Forms/login_action.php">
            <div class="form-group">
                <label for="loginEmail">Email address</label>
                <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter email" required>
            </div>
    
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
            </div>
    
            <button type="submit" class="btn btn-primary">LOGIN</button>
    
            <div id="create-account-container">
                <a href="/IAP-GROUP-PROJECT/Forms/signup.php">Don't have an account? Create one</a><br><br>
            </div>
    
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
                </div>
            </footer>
        </form>
        <?php
    }
    
    }

