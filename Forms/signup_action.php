<?php
    require_once 'forms.php';

    require_once 'C:\Apache24\htdocs\iap-group-project\ClassAutoLoad.php';

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    require_once 'C:\Apache24\htdocs\IAP-GROUP-PROJECT\ClassAutoLoad.php';

    $db = new database($conf);
    $conn = $db->getConnection();
    
    try{
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        $stmt->execute();
        $stmt->close();
       
        header("Location: /IAP-GROUP-PROJECT/index.php?form=login");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
        