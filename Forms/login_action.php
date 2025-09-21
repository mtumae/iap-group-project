
<?php
require_once '../ClassAutoLoad.php';

$email = $_POST['email'] ?? ''; 
$password = $_POST['password'] ?? '';

$db = new Database($config);
$conn = $db->connect();

// try{
//     $statement = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
//     $statement->bind_param("s", $email);
//     $statement->execute();

//     $result = $statement->get_result();

//     if($result->num_rows === 1){
//         $user = $result->fetch_assoc();

//         if(password_verify($password, $user['password'])){

//         }
//     }
// }