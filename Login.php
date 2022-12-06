<?php
    $con = mysqli_connect("localhost", "pkm7628", "qkrrudals1!", "pkm7628");
    mysqli_query($con,'SET NAMES utf8mb4');

    $userID = isset($_POST["userID"]) ? $_POST["userID"] : "";
    $userPassword = isset($_POST["userPassword"]) ? $_POST["userPassword"] : "";
    
    $statement = mysqli_prepare($con, "SELECT * FROM USER WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "ss", $userID, $userPassword);
    mysqli_stmt_execute($statement);


    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userAge);

    $response = array();
    $response["success"] = false;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
        $response["userID"] = $userID;
        $response["userPassword"] = $userPassword;
        $response["userName"] = $userName;
        $response["userAge"] = $userAge;        
    }

    echo json_encode($response);



?>