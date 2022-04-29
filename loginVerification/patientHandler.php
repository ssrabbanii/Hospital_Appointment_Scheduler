<?php
    if(isset($_POST['submit'])){
        $email =  $_POST['email'];
        $password = $_POST['password'];
        if(strlen($email) === 0 || strlen($password) === 0){
            echo '<script>alert("Email or password has been left blank");
            window.location.href="./../index.php";
            </script>';
        }
        else{
            include_once('./loginHandler.php');
            login($email,$password,'patient');
        }
    }
?>