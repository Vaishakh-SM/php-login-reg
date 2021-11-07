<?php
    include('database.php');
    $empID = $_POST['empID'];
    $passwd = $_POST['password'];

    $hashed_input = password_hash($passwd,PASSWORD_DEFAULT);

    $db_user = getUser($empID);
    if(doesIDExist($empID) == false){
        echo
        "<script>
        alert('The entered employee ID does not exist');
        window.location.href = '/static/login.html';
        </script>";
    }
    else if(password_verify($passwd, $db_user[1])){
        echo "
        <html>
        <head> 
            <link rel='stylesheet' href='./static/main.css'>
            <title> Home </title>
        </head>
        <body>
            <div id='container-register'>
                <div class='profile'>
                <strong>Name</strong>: $db_user[2]
                </div>
                <div class='profile'>
                <strong>Date of Joining</strong>: $db_user[3]
                </div>
                <div class='profile'>
                <strong>Salary</strong>: $db_user[4]
                </div>
                <div class='profile'>
                <strong>Department</strong>: $db_user[5]
                </div>
                <div class='profile'>
                <strong>Mobile number</strong>: $db_user[6]
                </div>
                <div class='profile'>
                    <strong>Email</strong>: $db_user[7]
                </div>
                <div class='register'>
                <a href='./static/update.html'><button id='register-link'>Update information</button></a>
                <a href='./static/index.html'><button id='register-link'>Home</button></a>
                </div>
            </div>
        </body>
    </html>
    ";

    }
    else{
        echo
        "<script>
        alert('The entered employee ID or password is wrong');
        window.location.href = '/static/login.html';
        </script>";
    }
?>