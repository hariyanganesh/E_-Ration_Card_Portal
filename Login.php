<?php
    $Aadhar_No = $_POST["uname"];
    $Password = $_POST["psw"];
    $mod_pass = md5($Password);

    //Database
    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "ration_card";

    $conn = new mysqli($host,$user,$password,$db_name);

    if($conn->connect_error)
        echo "Connection Failed<br>" ;
    else{
        echo "<br>Connection Established<br>";

        $check_user_id = "SELECT * FROM REGISTERED_USERS WHERE AADHAR_NO = '$Aadhar_No'";
        $val = $conn->query($check_user_id);

        if($val){
            echo $Aadhar_No." is Present<br>";

            $pass = "SELECT USER_PASSWORD FROM REGISTERED_USERS WHERE AADHAR_NO = '$Aadhar_No'";
            $pass_val = $conn->query($pass);

            $password_db  =$pass_val->fetch_assoc()['USER_PASSWORD'];

            if($mod_pass === $password_db)
                header("Location: Login.html");
            else
                echo "Password IS Wrong";
        }
        else
            echo "Not Present<br>";
    }

?>