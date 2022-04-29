<?php
function checkIfLoggedIn(){
    $mem =createMemSession();
    if($mem->get('id') === null || $mem->get('user') ===null || $mem->get('role') ===null ){
        if($_SERVER['REQUEST_URI'] !== '/~20100594d/index.php'){
            returnToMainScreen();
        }
    }
}
function createMemSession(){
    $mem = new MemCache($_SERVER['REMOTE_ADDR']);
    $mem->connect('localhost',11211);
    return $mem;
}
function returnToMainScreen(){
    echo '
    <script>
    alert("Failed to login, returning to main screen!");
    window.location.href = "/~20100594d/index.php";
    </script>
    ';
    
}
function login($email,$password,$role){
    $verified = false;
    include_once('./../config.php');
    $statement = ':email';
    //echo $email."\n";
    if($role === 'patient' || $role ==='doctor'){
        if($role === 'patient'){
            $sql = 'SELECT patient_id AS id, first_name AS name, password FROM patient WHERE email=:email';
            $stid= oci_parse($conn,$sql);
            oci_define_by_name($stid, 'PATIENT_ID', $id);
        }else{
            $sql = "SELECT doctor_id AS id,first_name AS name, password FROM doctor WHERE email = :email";
           // echo $sql;
            $stid= oci_parse($conn,$sql);
        }
        oci_bind_by_name($stid,$statement,$email);
        oci_execute($stid);
        while(($row = oci_fetch_assoc($stid)) != false){
            if($row['PASSWORD'] === $password){
               $mem = createMemSession();
                $mem->add('user',$row['NAME']);
                $mem->add('id',$row['ID']);
                $mem->add('role',$role);
                $mem->add('loggedIn','true',0,0.1);
                $mem->set('user',$row['NAME']);
                $mem->set('id',$row['ID']);
                $mem->set('role',$role);

                //echo $mem->get('id');
                //echo $mem->get('user');
                $verified = true;
                
                $url = ($role === 'doctor') ? './../doctorView.php': './../patientView.php';
                echo 'redirecting';
                echo '<script>
                alert("Logged in");
                window.location.href="'.$url.'";
                </script>
                ';
                
            }

        // echo "User id is: ".$row['ID']. " & role is: ". $role;
        }
        oci_free_statement($stid);
        oci_close($conn);
        returnToMainScreen();
    }
}
?>