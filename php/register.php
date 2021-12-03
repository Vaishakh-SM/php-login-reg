<?php
include('database.php');

// readfile("./static/register.html");
$empID = $_POST['empID'];
$email = $_POST['email'];
$mobileNo = $_POST['mobileNo'];
$password = $_POST['password1'];
$confirm_password = $_POST['password2'];
$empName = $_POST['empName'];
$DoJ = $_POST['DoJ'];
$department = $_POST['department'];
$salary = $_POST['salary'];

$errors = array();

// Check if any fields are empty
if(
    empty($email)|| empty($empID) || empty($mobileNo) || empty($password) 
    || empty($confirm_password) || empty($empName)
    || empty($DoJ) || empty($department)
  )
  {
      array_push($errors, "One or more fields are empty");
  }

// Check if entered passwords are same
if($password !== $confirm_password){
    array_push($errors, "Passwords are not equal");
}

// Validate mobile number

if(preg_match('/^[0-9]{10}+$/', $mobileNo) == false){
    array_push($errors, "Mobile number invalid");
}

// Validate email

if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
    array_push($errors, "Email invalid");
}

// Check if salary is a number


if(is_numeric($salary) === false){
    array_push($errors, "Salary is not an integer");
}

// Check if salary is too big
if(strlen($salary)>8){
    array_push($errors, "Salary is too big to be an integer"); 
}

// Check if date is valid
if(DateTime::createFromFormat('Y-m-d',$DoJ) == false){
    array_push($errors, "Date is invalid"); 
}

// Check if user ID already exists
if(doesIDExist($empID) == true){
    array_push($errors, "ID Already exists");
}

// Insert
if(empty($errors)){

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    addNewUser($empID,$hashed_password,$empName,$DoJ,$salary,$department,$mobileNo,$email);

    echo
        "<html>
            <head> 
                <link rel='stylesheet' href='/static/main.css'>
                <title> Registered </title>
            </head>
            <body>
                <div id='container-register'>
                    <div class='register-without-margin'>
                    Registered!
                    </div>
                    <div class='register-without-margin'>
                        <a href='/static/index.html'><button id='register-link'>Home</button></a>
                    </div>
        
                </div>
            </body>
        </html>
        ";
}
else{
    // Display errors
    print_r($errors);
}


?>

