<?php
    function getTestDetails($id){
        include('./config.php');
        $sql = "SELECT test_name,test_date,test_result,price,test_description FROM TEST_VIEW where test_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getTreatMentDetails($id){
        include('./config.php');
        $sql = "SELECT treated_for,treatment_start_date,treatment_result,treatment_end_date, price FROM TREATMENT_VIEW where treatment_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsDoctor($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT patient_id,patient_firstname, patient_lastname, appointment_date,appointment_id FROM APPOINTMENT_VIEW where doctor_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsDoctorGrouped($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT DISTINCT patient_id,patient_firstname, patient_lastname FROM APPOINTMENT_VIEW where doctor_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsDoctorTest($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT patient_id,patient_firstname, patient_lastname, test_date,test_id,test_result,test_description,test_name FROM TEST_VIEW where doctor_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getTestTypes(){
        include('./config.php');
        $sql = "SELECT test_type_id, test_name from TESTTYPE";
        $stid = oci_parse($conn,$sql);
        oci_execute($stid);
        return $stid;
    }
    function createTreatment($id, $pid, $description,$price,$conn){
       
        if($id === null || $pid === null || $description === null || $price === null || strlen($id) <= 0 || strlen($pid) <= 0|| strlen($description) <= 0 || $price <= 0){
            echo '<script>
            alert("Value missing");
            window.location.href= "./../doctorView.php";
            </script>';
        }
        $sql = 'INSERT INTO TREATMENT(performed_by,performed_on,treated_for, price) VALUES (:id,:pid,:description,:price)';
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_bind_by_name($stid,':pid',$pid);
        oci_bind_by_name($stid,':description',$description);
        oci_bind_by_name($stid,':price',$price);
        $r = oci_execute($stid);
        oci_commit($conn);
        oci_close($conn);
        print_r($r);
        if(!$r){
            $error = oci_error($r);
            echo '<script>
            alert("There was an error");
            window.location.href= "./../doctorView.php";
            </script>';
        }

    }
    function createTest($id, $pid,$price,$type,$conn){
        if(strlen($id) <= 0 || strlen($pid) <= 0 || strlen($price) <= 0 || strlen($type) <= 0){
            echo '<script>
            alert("Value missing");
            window.location.href= "./../doctorView.php";
            </script>';
        }
        $sql = 'INSERT INTO TEST(assigned_by,patient_id, price,test_type_id) VALUES (:id,:pid,:price,:type)';
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_bind_by_name($stid,':pid',$pid);
        //oci_bind_by_name($stid,':description',$description);
        oci_bind_by_name($stid,':price',$price);
        oci_bind_by_name($stid,':type',$type);
        $r =oci_execute($stid);
        print_r($r);
        oci_commit($conn);
        oci_close($conn);
        if(!$r){
            $error = oci_error($r);
            echo '<script>
            alert("There was an error");
            window.location.href= "./../doctorView.php";
            </script>';
        }

    }
    function getAsDoctorTreatment($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT patient_id,patient_firstname,treated_for,treatment_end_date, patient_lastname, treatment_start_date,treatment_id,treatment_result FROM TREATMENT_VIEW where doctor_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsPatient($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT doctor_id,doctor_firstname, doctor_lastname, appointment_date,appointment_id FROM APPOINTMENT_VIEW where patient_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsPatientTest($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT doctor_id,doctor_firstname, doctor_lastname, test_date,test_id,test_name,test_result,test_description FROM TEST_VIEW where patient_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function getAsPatientTreatment($id){
        include('./config.php');
        //echo $id;
        $sql = "SELECT doctor_id,doctor_firstname, doctor_lastname, treatment_start_date,treatment_id,treatment_end_date, treated_for AS treatment_description,treatment_result FROM TREATMENT_VIEW where patient_id=:id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        //oci_bind_by_name($stid,':view',$view);
        oci_execute($stid);
        return $stid;
    }
    function changeAppointmentBill($id,$conn){
     
        $sql = "UPDATE APPOINTMENT SET is_paid ='true' WHERE appointment_id = :id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        oci_close($conn);
    }
    function changeTestBill($id,$conn){
        $sql = "UPDATE TEST SET is_paid ='true' WHERE test_id = :id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        oci_close($conn);
    }
    function getAllDoctorsLessThanThree($date){
        if(strlen($date) <=0 ){
            echo '<script>
            alert("Values missing");
            window.location.href= "./patientView.php";
            </script>';
        }
        $datearr = explode(" ", $date);
        $date = date("d-M-y", strtotime($datearr[0]));
        $date = strtoupper($date);
        $time = $datearr[1] . ' '. $datearr[2];
        $time = date("h.i.s A",strtotime($datearr[1]));

        $str = $date. ' '. $time;
        include_once('./config.php');
        oci_set_db_operation($conn, "get doctors");
        $sql = "SELECT DISTINCT doctor_id,doctor_firstname,doctor_lastname FROM APPOINTMENT_VIEW WHERE appointment_date != TO_TIMESTAMP(:date_appointment, ' DD-MON-YY HH12.MI.SS PM') ";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':date_appointment',$str);
        $r = oci_execute($stid);

        return $stid;
    }
    function createNewBooking($id,$did,$date,$conn){
        if(strlen($id) <= 0 || strlen($did) <= 0|| strlen($date) <=0){
            echo '<script>
            alert("Values missing");
            window.location.href= "./../patientView.php";
            </script>';
        }
        $datearr = explode(" ", $date);
        $date = date("d-M-y", strtotime($datearr[0]));
        $date = strtoupper($date);
        $time = $datearr[1] . ' '. $datearr[2];
        $time = date("h.i.s A",strtotime($datearr[1]));

        $str = $date. ' '. $time;
        // echo $str;
        $sql = "INSERT INTO appointment(patient_id, doctor_id, appointment_date) VALUES(:id, :doctor, TO_TIMESTAMP(:appointment_date,' DD-MON-YY HH12.MI.SS PM'))";
        $stid= oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_bind_by_name($stid,':appointment_date',$str);
        oci_bind_by_name($stid,':doctor',$did);
        $r =oci_execute($stid);
        // echo $strs;s
        /*
        if(!$r){
            $error = oci_error($r);
            echo '<script>
            alert("There was an error'.$error.'");
            window.location.href= "./../patientView.php";
            </script>';
        }
        */
        print_r(oci_error($r));
        oci_close($conn);
    }
    function changeTreatmentBill($id,$conn){
        
        $sql = "UPDATE TREATMENT SET is_paid ='true' WHERE treatment_id = :id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        oci_close($conn);
    }
    function getAppointmentBill($id){
        include('./config.php');
        $sql = "SELECT doctor_first_name,doctor_last_name, appointment_id,price FROM appointment_bill WHERE patient_id = :id AND is_paid ='false'";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        return $stid;
    }
    function getTestBill($id){
        include('./config.php');
        $sql = "SELECT doctor_first_name,doctor_last_name, test_id,price FROM test_bill WHERE patient_id = :id AND is_paid ='false'";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        return $stid;
    }
    function getTreatmentBill($id){
        include('./config.php');
        $sql = "SELECT doctor_first_name,doctor_last_name, treatment_id,price FROM treatment_bill WHERE performed_on = :id AND is_paid ='false'";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_execute($stid);
        return $stid;
    }
    function getPatientDetail($id){
       // echo $id;
        include('./config.php');
        $sql = "SELECT first_name,last_name,email FROM PATIENT WHERE patient_id = :id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid, ':id', $id);
        oci_execute($stid);
        return $stid;
    }
    function getDoctorDetail($id){
        include('./config.php');
        $sql = "SELECT first_name,last_name,email FROM DOCTOR WHERE doctor_id = :id";
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid, ':id', $id);
        oci_execute($stid);
        return $stid;
    }
    function updateAsDoctorTreatment($id,$status,$conn){
        if($status === 'successful'){
            $sql = 'UPDATE TREATMENT SET treatment_result = :status , treatment_end_date = SYSDATE WHERE treatment_id = :id';
        }else{
            $sql = "UPDATE TREATMENT SET treatment_result = :status WHERE treatment_id = :id";
        }
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_bind_by_name($stid,':status',$status);
        oci_execute($stid);
        oci_commit($conn);
        oci_close($conn);
    }
    function updateAsDoctorTest($id,$status,$conn){
        if($status === 'succesful'){
            $sql = 'UPDATE TEST SET test_result = :status, test_date = SYSDATE WHERE test_id = :id';
        }else{
            $sql = 'UPDATE TEST SET test_result = :status WHERE test_id = :id';
        }
        $stid = oci_parse($conn,$sql);
        oci_bind_by_name($stid,':id',$id);
        oci_bind_by_name($stid,':status',$status);
        oci_execute($stid);
        oci_commit($conn);
        oci_close($conn);
    }
?>