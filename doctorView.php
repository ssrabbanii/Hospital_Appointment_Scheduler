<!--PROTO TYPE FOR DOCTORS VIEW-->
<?php
include_once('./loginVerification/loginHandler.php');

checkIfLoggedIn();
$mem = createMemSession();
if($mem->get('role') === null || $mem->get('role') !== 'doctor'){
    echo '<script>
    alert("You do not have the right rights!");
    window.location.href = "./index.php";
    </script>';
}

//checkIfLoggedIn();

?>
<!DOCTYPE html>
<? require_once('./components/header.php'); ?>
<body style="background-color: #E4E7E7">
     
    <div class="container ">
        <div class="row">
            <h1 class = "display-1 " style="text-align:center">Welcome, Dr.<?php echo $mem->get('user'); ?></h1>
        </div>
        <!--
        <div class="row">
            <?php//require_once('./components/filter.php');?>
        </div>

-->     <!-- Add Treatment or Test -->

        <div class="row ">
            <div class="col-md-6 ">
                <button type="btn" onClick="addTreatment()" class="btn btn-danger rounded-pill ">
                    Add treatment
                </button>
                <button type="btn" onClick="addTest()" class="btn btn-danger rounded-pill">
                    Add test
                </button>
            </div>
        </div>

        <br>




<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <h2>Upcoming Appointments</h2>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">

        <div class="row">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php 
                            include_once('./queries/query.php');
                            include_once('./components/row.php');
                            $counter = 0;
                            $stid = getAsDoctor($mem->get('id'));
                            while(($item = oci_fetch_assoc($stid)) != false){
                                $counter++;
                                printRow($item['PATIENT_ID'], $item['PATIENT_FIRSTNAME'].' '.$item['PATIENT_LASTNAME'], $item['APPOINTMENT_DATE']);
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
                    <thead class="thead-dark" >
                        <tr>
                            <td scope="col">Test id</td>
                            <td scope="col">Patient Name</td>
                            <td scope="col">Date</td>
                            <td scope="col">Test name</td>
                            <td scope="col">Description</td>
                            <td scope="col">Result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once('./queries/query.php');
                        include_once('./components/row.php');
                        $counter = 0;
                            $stid = getAsDoctorTest($mem->get('id'));
                            while(($item = oci_fetch_assoc($stid)) != false){
                                $counter++;
                                printRowTest($item['TEST_ID'], $item['PATIENT_FIRSTNAME'].' '.$item['PATIENT_LASTNAME'],$item['PATIENT_ID'],$item['TEST_DATE'],$item['TEST_NAME'],$item['TEST_RESULT'],$item['TEST_DESCRIPTION']);
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
                            <td scope="col">Treatment id</td>
                            <td scope="col">Patient name</td>
                            <td scope="col">Start Date</td>
                            <td scope="col">End Date</td>
                            <td scope="col">Description</td>
                            <td scope="col">Result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once('./queries/query.php');
                        include_once('./components/row.php');
                        $stid = getAsDoctorTreatment($mem->get('id'));
                        while(($item = oci_fetch_assoc($stid)) != false){
                            $counter++;
                            printRowTreatment($item['TREATMENT_ID'], $item['PATIENT_FIRSTNAME'].' '.$item['PATIENT_LASTNAME'],$item['PATIENT_ID'],$item['TREATMENT_START_DATE'],$item['TREATMENT_END_DATE'],$item['TREATMENT_RESULT'],$item['TREATED_FOR']);
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
  </div>
</div>

    <!-- Button trigger modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-inner">
                <h1 id="p1"></h1>
                <h2 id="p2"></h2>
                <h2 id="p3"></h2>
                <h2 id="p4"></h2>
                <h2 id="p5"></h2>
                <h2 id="p6"></h2>
            </div>
          </div>
    </div>

    <div class="modal display-6" id="treatmentModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-inner">
                <form action="./handler/addTreatmentHandler.php" method="POST" role="form" class="php-email-form" >
                    <label for="patient">Patient Name: </label><br>
                    <select name="patient" id="patient">
                        <?php 
                            include_once('./queries/query.php');
                            $stid = getAsDoctorGrouped($mem->get('id'));
                            while(($item = oci_fetch_assoc($stid)) != false){
                                echo '<option value="'.$item["PATIENT_ID"].'">'.$item['PATIENT_FIRSTNAME'].' '.$item["PATIENT_LASTNAME"].'</option>';
                            }
                        ?>
                    </select><br>
                    <label for="price">Price: </label><br>
                    <input type="text" id="price" name="price" placeholder="enter price"/><br>
                    <label for="description">Description: </label><br>
                    <input type="text" name="description" id="description" placeholder="enter description" maxlength="100"><br>
                    <input type="submit" name="submit" class="btn btn-primary rounded-pill "/>
                </form>
            </div>
        </div>
    </div>

    <div class="modal display-6" id="testModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-inner">
                <form action="./handler/addTestHandler.php" method="POST">
                    <label for="patient">Patient Name: </label><br>
                    <select name="patient" id="patient">
                        <?php 
                            include_once('./queries/query.php');
                            $stid = getAsDoctorGrouped($mem->get('id'));
                            while(($item = oci_fetch_assoc($stid)) != false){
                                echo '<option value="'.$item["PATIENT_ID"].'">'.$item['PATIENT_FIRSTNAME'].' '.$item["PATIENT_LASTNAME"].'</option>';
                            }
                        ?>
                    </select><br>
                    <label for="testtype">Test type:</label><br>
                    <select name="testtype" id="testtype">
                        <?php
                        include_once('./queries/query.php');
                        $stid = getTestTypes();
                        while(($item = oci_fetch_assoc($stid)) != false){
                            echo '<option value="'.$item["TEST_TYPE_ID"].'">'.$item['TEST_NAME'].'</option>';
                        }
                        ?>
                    </select><br>
                    <label for="price">Price: </label><br>
                    <input type="text" id="price" name="price" placeholder="enter price"/><br>
                    <input type="submit" name="submit" class="btn btn-primary rounded-pill"/>
                </form>
            </div>
        </div>
    </div>


    <script>
        function onClick(id, type){
            console.log(id);
            console.log(type);
            if(type === "patient"){
                window.location.href = './doctorView.php?id='+id+'&type=patient';
            }
        }
        function processResult(id){
            console.log('dropdownResult '+id);
            document.getElementById('dropdownResult '+id).classList.toggle("show");
        }
        function addTreatment(){
                var modal = document.getElementById("treatmentModal");
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
        function addTest(){
                var modal = document.getElementById("testModal");
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
    <?php
        include_once('./modalHandler.php');
        doctorModalHandler();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>