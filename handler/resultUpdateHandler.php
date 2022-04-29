<?php
if(isset($_REQUEST['id']) && isset($_REQUEST['type']) && isset($_REQUEST['status'])){
    include_once('./../queries/config.php');
    include_once('./../queries/query.php');
    if($_REQUEST['type'] === 'treatment'){
        updateAsDoctorTreatment($_REQUEST['id'],$_REQUEST['status'],$conn);
    }else if($_REQUEST['type'] === 'test'){
        updateAsDoctorTest($_REQUEST['id'],$_REQUEST['status'],$conn);
    }
}
header('Location: ./../doctorView.php');
?>