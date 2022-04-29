<?php
if(isset($_POST['submit'])){
    if(isset($_POST['patient']) && isset($_POST['price']) && isset($_POST['testtype'])){
        include_once('./../loginVerification/loginHandler.php');
        include('./../queries/config.php');
        checkIfLoggedIn();
        $mem = createMemSession();
        $patient = $_POST['patient'];
        $type = $_POST['testtype'];
        echo $type;
        $price = $_POST['price'];
        //$description = $_POST['description'];
        include_once('./../queries/query.php');
        createTest($mem->get('id'),$patient,$price,$type,$conn);
        echo '<script>
        alert("Test has been created");
        window.location.href= "./../doctorView.php";
        </script>';
    }
    echo '<script>
    alert("Values missing");
    window.location.href= "./../doctorView.php";
    </script>';
}
?>