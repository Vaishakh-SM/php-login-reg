<?php

$host = 'db:3306';  //the name of the mysql service inside the docker file.
$user = 'root';
$password = 'root';
$db = 'Employee';

$conn = new mysqli($host,$user,$password,$db);

if($conn->connect_error){
echo 'connection failed'. $conn->connect_error;
}


function getUser($userID){
    global $conn;

    $query = mysqli_prepare($conn, "SELECT * FROM Employee WHERE empID = ?");
    mysqli_stmt_bind_param($query, "s", $userID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    if($result->num_rows === 0 ){
        echo "User does not exist";
    }
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    return $row;
}

function doesIDExist($userID){
    global $conn;

    $query = mysqli_prepare($conn, "SELECT * FROM Employee WHERE empID = ?");
    mysqli_stmt_bind_param($query, "s", $userID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    if($result->num_rows === 0 ){
        return false;
    } 
    return true;
}

function addNewUser($empID,$passwd,$empName,$DoJ,$salary,$department,$mobileNo,$email){
    global $conn;

    $query = mysqli_prepare($conn, "INSERT INTO Employee VALUES (?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($query, "ssssdsss", $empID,$passwd,$empName,$DoJ,$salary,$department,$mobileNo,$email);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    print_r($result);
}

function updateEmail($empID,$email){
    global $conn;

    $query = mysqli_prepare($conn, "UPDATE Employee SET email = ? WHERE empID = ?");
    mysqli_stmt_bind_param($query, "ss", $email, $empID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    print_r($result);
}

function updateMobile($empID,$mobileNo){
    global $conn;

    $query = mysqli_prepare($conn, "UPDATE Employee SET mobileNo = ? WHERE empID = ?");
    mysqli_stmt_bind_param($query, "ss",$mobileNo,$empID);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    print_r($result);
}

?>