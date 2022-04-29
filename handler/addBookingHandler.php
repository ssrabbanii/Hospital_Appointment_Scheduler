<?php
if(isset($_POST['submit'])){
    if(isset($_POST['date'])&& isset($_POST['doctor'])){
        include_once('./../loginVerification/loginHandler.php');
        checkIfLoggedIn();
        $mem = createMemSession();
        include_once('./../queries/query.php');
        include_once('./../queries/config.php');
        createNewBooking($mem->get('id'),$_POST['doctor'],$_POST['date'],$conn);    
    }
}
header('Location: ./../patientView.php');
?>