<?php
    function doctorModalHandler(){
        include_once('./queries/query.php');
        include_once('./components/row.php');
        if(isset($_REQUEST['id']) && isset($_REQUEST['type'])){
            if($_REQUEST['type'] === 'patient'){
                $stid = getPatientDetail($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p1").innerHTML = "'.$item["FIRST_NAME"].' '.$item["LAST_NAME"].'";
                    document.getElementById("p3").innerHTML = "'.$item["EMAIL"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
                oci_free_statement($stid);
            }
            else if($_REQUEST['type'] === 'test'){
                $stid = getTestDetails($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p1").innerHTML = "Test name: '.$item["TEST_NAME"].'";
                    document.getElementById("p2").innerHTML = "Test date: '.$item["TEST_DATE"].'";
                    document.getElementById("p3").innerHTML = "Test description: '.$item["TEST_DESCRIPTION"].'";
                    document.getElementById("p4").innerHTML = "Test result: '.$item["TEST_RESULT"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
            }
            else if($_REQUEST['type'] === 'treatment'){
                $stid = getTreatmentDetails($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    $endDate = $item["TREATMENT_END_DATE"] === null ? 'N/A' : $item["TREATMENT_END_DATE"];
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p2").innerHTML = "Treatment start date: '.$item["TREATMENT_START_DATE"].'";
                    document.getElementById("p3").innerHTML = "Treatment end date: '.$endDate.'";
                    document.getElementById("p4").innerHTML = "Treatment result: '.$item["TREATMENT_RESULT"].'";
                    document.getElementById("p5").innerHTML = "Treatment description: '.$item["TREATED_FOR"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
            }
        }
    }
    function patientModalHandler(){
        
        include_once('./queries/query.php');
        include_once('./components/row.php');
        if(isset($_REQUEST['id']) && isset($_REQUEST['type'])){
            if($_REQUEST['type'] === 'doctor'){
                $stid = getDoctorDetail($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p1").innerHTML = "'.$item["FIRST_NAME"].' '.$item["LAST_NAME"].'";
                    document.getElementById("p3").innerHTML = "'.$item["EMAIL"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
                oci_free_statement($stid);
            }
            
            else if($_REQUEST['type'] === 'test'){
                $stid = getTestDetails($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p1").innerHTML = "Test name: '.$item["TEST_NAME"].'";
                    document.getElementById("p2").innerHTML = "Test date: '.$item["TEST_DATE"].'";
                    document.getElementById("p3").innerHTML = "Test description: '.$item["TEST_DESCRIPTION"].'";
                    document.getElementById("p4").innerHTML = "Test result: '.$item["TEST_RESULT"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
            }
            else if($_REQUEST['type'] === 'treatment'){
                $stid = getTreatmentDetails($_REQUEST['id']);
                while(($item = oci_fetch_assoc($stid)) != false){
                    $endDate = $item["TREATMENT_END_DATE"] === null ? 'N/A' : $item["TREATMENT_END_DATE"];
                    echo '<script>
                    var modal = document.getElementById("modal");
                    var span = document.getElementsByClassName("close")[0];
                    document.getElementById("p2").innerHTML = "Treatment start date: '.$item["TREATMENT_START_DATE"].'";
                    document.getElementById("p3").innerHTML = "Treatment end date: '.$endDate.'";
                    document.getElementById("p4").innerHTML = "Treatment result: '.$item["TREATMENT_RESULT"].'";
                    document.getElementById("p5").innerHTML = "Treatment description: '.$item["TREATED_FOR"].'";
                    document.getElementById("p6").innerHTML = "Treatment price: '.$item["PRICE"].'";
                    modal.style.display = "block";
                    span.onClick = function() {
                        modal.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }</script>';
                    //print_r($item);
                }
            }
        }
    }
?>