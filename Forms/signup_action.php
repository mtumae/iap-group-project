<?php
    require_once '../Validator.php' ;
    require_once 'forms.php';
    require_once 'C:\Apache24\htdocs\IAP-GROUP-PROJECT\ClassAutoLoad.php';

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    //including the database operation for inserting a user into the db
    require_once 'C:\Apache24\htdocs\IAP-GROUP-PROJECT\ClassAutoLoad.php';

    $db = new database($conf);
    $conn = $db->getConnection();
    
    try{
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();
       
        header("Location: login.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
        