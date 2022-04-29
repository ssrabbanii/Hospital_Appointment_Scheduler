<!--PROTO TYPE FOR DOCTORS VIEW-->
<?php
include_once('./loginVerification/loginHandler.php');

checkIfLoggedIn();
$mem = createMemSession();
if($mem->get('role') === null || $mem->get('role') !== 'patient' ){
    echo '<script>
    alert("You do not have the right rights!");
    window.location.href = "./index.php";
    </script>';
}

?>
<!DOCTYPE html>
<? require_once('./components/header.php'); ?>
<body  style="background-color: #e1fff3">
    <div class="container">
        <div class="row">
            <h1 class= "display-1" style="text-align:center">Welcome, <?php echo $mem->get('user'); ?></h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-danger rounded-pill" onClick="createNewAppointment()">Create new appointment</button>
            </div>
        </div>
        <br>





        <div class="accordion col-md-12" id="accordionExample">
            <div class=" col-md-12 accordion-item">
                <h2 class=" col-md-12  accordion-header">
                    
                <button class="accordion-button col-md-12" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h2>Upcoming Appointments</h2>
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">



                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark" >
                            <tr>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Appointment Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include_once('./queries/query.php');
                                    include_once('./components/row.php');
                                    $counter = 0;
                                    $stid = getAsPatient($mem->get('id'));
                                    while(($item = oci_fetch_assoc($stid)) != false){
                                        $counter++;
                                        printRow($item['DOCTOR_ID'], $item['DOCTOR_FIRSTNAME'].' '.$item['DOCTOR_LASTNAME'],$item['APPOINTMENT_DATE']);
                                    }
                                    oci_free_statement($stid);
                                    if($counter === 0){
                                        echo "You don't have any Appointments";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    





                </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h2>Upcoming Tests</h2>
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Test id</th>
                                <th scope="col">Doctor name</th>
                                <th scope="col">Test date</th>
                                <th scope="col">Test name</th>
                                <th scope="col">Test description</th>
                                <th scope="col">Test result</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    include_once('./queries/query.php');
                                    include_once('./components/row.php');

                                    $stid = getAsPatientTest($mem->get('id'));

                                    while(($item = oci_fetch_assoc($stid)) != false){
                                        $counter++;
                                        printRowTest($item['TEST_ID'],$item['DOCTOR_FIRSTNAME'].' '.$item['DOCTOR_LASTNAME'],$item['DOCTOR_ID'],$item['TEST_DATE'],$item['TEST_NAME'],$item['TEST_RESULT'],$item['TEST_DESCRIPTION']);
                                    }
                                    oci_free_statement($stid);
                                    if($counter === 0){
                                        echo "You don't have any Tests";
                                    }
                            ?>
                            </tbody>
                        </table>
                    </div>
                   



                </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <h2>Upcoming Treatments</h2>
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Treatment id</th>
                            <th scope="col">Doctor name</th>
                            <th scope="col">Start date</th>
                            <th scope="col">End date</th>
                            <th scope="col">Treatment description</th>
                            <th scope="col">Treatment result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                                include_once('./queries/query.php');
                                include_once('./components/row.php');
                                $stid = getAsPatientTreatment($mem->get('id'));
                                while(($item = oci_fetch_assoc($stid)) != false){
                                    $counter++;
                                    printRowTreatment($item['TREATMENT_ID'],$item['DOCTOR_FIRSTNAME'].' '.$item['DOCTOR_LASTNAME'],$item['DOCTOR_ID'],$item['TREATMENT_START_DATE'],$item['TREATMENT_END_DATE'],$item['TREATMENT_RESULT'],$item['TREATMENT_DESCRIPTION']);
                                }
                                oci_free_statement($stid);
                                if($counter === 0){
                                    echo "You don't have any Treatments";
                                }
                        ?>
                        </tbody>
                    </table>   
                </div>
                   


                </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <h2>Bills</h2>
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Bill type</th>
                                    <th scope="col">Doctor's name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                        include_once('./queries/query.php');
                                        include_once('./components/row.php');

                                        $stid = getAppointmentBill($mem->get('id'));
                                        while(($item = oci_fetch_assoc($stid)) != false){
                                            $counter++;
                                            printRowBill($item['APPOINTMENT_ID'],$item['DOCTOR_FIRST_NAME'].' '.$item['DOCTOR_LAST_NAME'],$item['PRICE'],'appointment');
                                        }
                                        oci_free_statement($stid);
                                        $stid = getTestBill($mem->get('id'));
                                        while(($item = oci_fetch_assoc($stid)) != false){
                                            $counter++;
                                            printRowBill($item['TEST_ID'],$item['DOCTOR_FIRST_NAME'].' '.$item['DOCTOR_LAST_NAME'],$item['PRICE'],'test');
                                        }
                                        oci_free_statement($stid);
                                        $stid = getTreatmentBill($mem->get('id'));
                                        while(($item = oci_fetch_assoc($stid)) != false){
                                            $counter++;
                                            printRowBill($item['TREATMENT_ID'],$item['DOCTOR_FIRST_NAME'].' '.$item['DOCTOR_LAST_NAME'],$item['PRICE'],'treatment');
                                        }
                                        if($counter === 0){
                                            echo "You don't have any Bills";
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                    
                </div>
                </div>
            </div>


        </div>





        <!-- Appointments -->

       

       

        <!-- Tests -->


       

        <!-- Treatments -->


        

        <!-- Bills -->


    

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-inner">
                <form action="./bookAppointmentView.php" method="POST">
                    <input type="date" name="date" min="today.getDate()">
                    <input type="time" name="time" min="today.getTime()">
                    <input class = "btn btn-primary rounded-pill" type="submit" name="submit">
                </form>
            </div>
          </div>
    </div>

    <script>
        function createNewAppointment(){
            var modal = document.getElementById("modal");
                var span = document.getElementsByClassName("close")[0];
                modal.style.display = "block";
                span.onClick = function() {
                    modal.style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>