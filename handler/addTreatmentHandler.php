<?php
if(isset($_POST['submit'])){
    if(isset($_POST['patient']) && isset($_POST['price']) && isset($_POST['description'])){
        include_once('./../loginVerification/loginHandler.php');
     
        include('./../queries/config.php');
        checkIfLoggedIn();
        $mem = createMemSession();
        $patient = $_POST['patient'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        echo $patient. ' price: '.$price. ' description: '. $description; 
        include_once('./../queries/query.php');
        createTreatment($mem->get('id'),$patient,$description,$price,$conn);
        
        echo '<script>
        alert("Treatment has been created");
        window.location.href= "./../doctorView.php";
        </script>';
        
    }
    //echo $patient. ' price: '.$price. ' description: '. $description; 
    
    echo '<script>
    alert("Values missing");
    window.location.href= "./../doctorView.php";
    </script>';
    
}
?>