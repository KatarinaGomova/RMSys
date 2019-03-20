<?php
    
    if(isset($_POST['loginSubmit'])) {

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = $conn->query("SELECT * FROM usermanagement WHERE username='{$username}' AND password='{$password}'");

        
        if($res =mysqli_fetch_object($query)) {
            echo "<script>alert(\"Login successful\");</script>";
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $res->userId;
            $_SESSION['firstName'] = $res->firstName;
            $_SESSION['lastName'] = $res->lastName;
        } else {
            echo "<script>alert(\"Login Failed\");</script>";
        }
    }
?>