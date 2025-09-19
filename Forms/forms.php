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
        ?>
       <form>
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
}