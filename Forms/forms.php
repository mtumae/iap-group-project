<?php 

class Forms{

    public function signup(){
        ?>
    <form action = "signup_action.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <!--  -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <div id="login-redirect-container">
                <a href="/IAP-GROUP-PROJECT/Forms/login.php">Already have an account? Login</a>
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

    public function login(){
        //error handling 
       $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        if (empty($email) || empty($password)) {
            $error = 'Please enter both email and password.';
        } elseif ($email !== $validEmail || $password !== $validPassword) {
            $error = 'Invalid email or password.';
        }
    }
    
    ?>
    <?php if ($error): ?>
        <div style="color: red; margin-bottom: 10px;"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="login_action.php">
        <div class="form-group">
        <label for="loginemail">Email address</label>
        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">LOGIN</button>
        <div id="create-account-container"><a href="/IAP-GROUP-PROJECT/Forms/signup.php">Don't have an account? Create one</a><br><br></div>

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
}