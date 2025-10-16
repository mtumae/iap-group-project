<?php
    require_once '../Validator.php' ;
    require_once 'forms.php';
    require_once '../config.php';

    require_once '../ClassAutoLoad.php';

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if (!Validator::isStrongPassword($password)) {
    // echo "<p style='color:red;'>Password must be at least 8 characters, include uppercase, lowercase, number, and special character.</p>";
    // exit(); // stop execution if password is weak
    // }
    //including the database operation for inserting a user into the db
    require_once 'C:\Apache24\htdocs\iap-group-project\ClassAutoLoad.php';

    $db = new database($conf);
    $conn = $db->getConnection();
    
    try{
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();

        header("Location: /iap-group-project/index.php?form=login");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
        