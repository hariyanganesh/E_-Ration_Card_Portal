<?php
// Extracting data from Form
    $Aadhar_No_1 = $_POST["aadhar_no_1"];
    $Aadhar_No_2 = $_POST["aadhar_no_2"];

    $password_1 = $_POST["password1"];
    $password_2 = $_POST["password2"];

    if($password_1 === $password_2){
        echo nl2br("Proceed Further"."\r\t");
        $mod_pass = md5($password_2);
    }
    else
        echo "Passwords Don't Match";

    $User_Name = $_POST["name"];
    $Phone_No = $_POST["phone"];
    $Location = $_POST["location"];
    
    $User_Dob = $_POST["dob"];
    $User_gender = $_POST["gender"];

    echo nl2br($User_gender."\n");
    echo nl2br($User_Name."\n");
    echo nl2br($Phone_No);

    //Database
    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "ration_card";

    $conn = new mysqli($host,$user,$password,$db_name);

    if($conn->connect_error)
        echo "Connection Failed<br>" ;
    else
        echo "<br>Connection Established<br>";
    
    $val = $conn->query("select 1 from REGISTERED_USERS LIMIT 1");
    
    if($val === FALSE){

        $query_create = "CREATE TABLE REGISTERED_USERS(
            AADHAR_NO INT(12) PRIMARY KEY,
            USER_PASSWORD VARCHAR(255) NOT NULL,
            NAME_USER VARCHAR(255) NOT NULL,
            user_LOCATION VARCHAR(255) NOT NULL,
            PHONE_NO INT(10) NOT NULL,
            GENDER VARCHAR(10) NOT NULL,
            DOB DATE NOT NULL
        )";

        echo "About to Create Table<br>";
        
        $val1 = $conn->query($query_create);

        if($val1 === TRUE)
            echo "<br>Table Created<br>";
        else
            echo "Table Create Failed<br>".$val1;
    }
    else{
        echo "Table Exists, Inserting New Data<br>  ";
        // echo $mod_pass."<br>";
        $insert_data_query = "INSERT INTO registered_users(
            AADHAR_NO,USER_PASSWORD,NAME_USER,user_LOCATION,PHONE_NO,GENDER,DOB
        )
        VALUES('$Aadhar_No_1','$mod_pass','$User_Name','$Location','$Phone_No','$User_gender','$User_Dob')";
        
        $added = $conn->query($insert_data_query);

        if($added === TRUE)
            echo "Data Added into Table<br>";
        else
            echo "Data Insertion Failed<br>".$conn->error;
    }

    header("Location: Login.html");
?>