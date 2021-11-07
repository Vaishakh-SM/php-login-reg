<?php
    include('database.php');
    $empID = $_POST['empID'];
    $passwd = $_POST['password'];

    $mobileNo = $_POST['mobileNo'];
    $email = $_POST['email'];

    $hashed_input = password_hash($passwd,PASSWORD_DEFAULT);

    $db_user = getUser($empID);

    if(doesIDExist($empID) == false){
        echo
        "<script>
        alert('The entered employee ID does not exist');
        window.location.href = '/static/update.html';
        </script>";
    }
    else if(password_verify($passwd, $db_user[1])){
        // Validate mobile number

        if(preg_match('/^[0-9]{10}+$/', $mobileNo) == false){
            echo
            "<script>
            alert('Invalid mobile number');
            window.location.href = '/static/update.html';
            </script>";
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            echo
            "<script>
            alert('Invalid email');
            window.location.href = '/static/update.html';
            </script>";
        }
        else
        {
            updateEmail($empID,$email);
            updateMobile($empID,$mobileNo);
            echo
                "<html>
                <head> 
                    <link rel='stylesheet' href='/static/main.css'>
                    <title> Home </title>
                </head>
                <body>
                    <div id='container-register'>
                        <div class='register-without-margin'>
                        Updated!
                        </div>
                        <div class='register-without-margin'>
                            <a href='/static/index.html'><button id='register-link'>Home</button></a>
                        </div>
          
                    </div>
                </body>
            </html>
        ";
        }
    }
    else{
        echo
        "<script>
        alert('The entered employee ID or password is wrong');
        window.location.href = '/static/update.html';
        </script>";
    }
?>