<?php 

class Forms{
    public function signup(){
        ?>
        <form  action ="/Forms/signup_action.php" method="POST">
        <h1 style="text-align:center;">Sign up</h1>
            <div class="form-group">
                    <label  for="username">Full Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
               
            </div>
            <div class="form-group">
                <label  for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1"  name="password">
                
            </div>
            <!--  -->
            <div style="text-align:center;">
            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg> Sign up</button>
            <div id="login-redirect-container">
                    <a href="?form=login">Already have an account? Login</a>
            </div>
    </div>
        </form>
        <?php

    }

    public function login() {
        ?>
        <form method="POST" action="Forms/login_action.php">
            <h1 style="text-align:center;">Login</h1>
            <div class="form-group">
                <label for="loginEmail">Email address</label>
                <input type="email" class="form-control" id="loginEmail" name="email"  required>
            </div>
    
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password"  required>
            </div>
            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg> Login</button>
                <div id="create-account-container">
                    <a href="?form=signup">Don't have an account? Create one</a><br><br>
                </div>
            </div>
        </form>
        <?php
    }

    public function twofa(){
        ?>
        <div>
            <form style="padding:40px;text-align:center;" method="POST" action="Forms/twofactor.php">
                <h1>Two-Factor authentication</h1>
                <p>Enter the code below</p>
                    <input style="height:80px;color:white;text-align:center;background-color:#23262b;border:none;font-size:30px;width:100%;" type="text" id="verification_code" name="verification_code" maxlength="6" placeholder="000 - 000" required>
                <button class="btn btn-primary" type="submit">Verify</button>
            </form>
            <?php if (!empty($error)) : ?>
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            </div>
        <?php
    }
    
    }

