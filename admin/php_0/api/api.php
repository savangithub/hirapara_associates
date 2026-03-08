<?php
require_once('../../config.php');

$action = $_POST['action'];

if(function_exists($action)){
    $action($conn);
}else{
    echo json_encode([
        "status"=>"error",
        "message"=>"Invalid API"
    ]);
}

/* ---------- LOGIN FUNCTION ---------- */

function login($conn){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password'
            AND status=1
            AND deleted_at IS NULL";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['user']=$email;

        echo json_encode([
            "status"=>"success",
            "message"=>"Login Successful"
        ]);

    }else{

        echo json_encode([
            "status"=>"error",
            "message"=>"Invalid Email or Password"
        ]);

    }

}


/* ---------- LOGOUT FUNCTION ---------- */

function logout($conn){

    session_destroy();

    echo json_encode([
        "status"=>"success",
        "message"=>"Logout Successful"
    ]);

}

?>
