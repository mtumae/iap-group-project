<?php 

class Forms{

    public function signup(){
        ?>
        <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
        <form method="post" action="login.php">
        <div class="form-group">
        <label for="loginemail">Email address</label>
        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">LOGIN</button>
        </form>
        <?php
    }
<<<<<<< Updated upstream

=======

>>>>>>> Stashed changes
