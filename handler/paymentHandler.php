<?php
if(isset($_REQUEST['id']) && isset($_REQUEST['type'])){
    include('./../queries/config.php');
    include_once('./../queries/query.php');
    if($_REQUEST['type'] === 'appointment'){
        changeAppointmentBill($_REQUEST['id'],$conn);
    }else if($_REQUEST['type'] === 'treatment'){
        changeTreatmentBill($_REQUEST['id'],$conn);
    }else if($_REQUEST['type'] === 'test'){
        changeTestBill($_REQUEST['id'],$conn);
    }
}
header('Location: ./../patientView.php');
?>