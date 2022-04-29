<?php
    if(isset($_POST['submit'])){
        $date = $_POST['date'].' '.$_POST['time'];
    }else{
        header('Location: ./patientView.php');
    }
?>

<!DOCTYPE html>
<? require_once('./components/header.php'); ?>
<html lang="en">


<body class= "display-1">
    <section class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <h1 class= "display-1">Choose your preferred doctor</h1>
        </div>

        <form action="./handler/addBookingHandler.php" method="post" role="form" class="php-email-form form-control">
        <div class="form-group">

            <select name="doctor" id="doctor" class="form-control">
            <?php
            include_once('./queries/query.php');

            $stid = getAllDoctorsLessThanThree($date);
            
            while(($item = oci_fetch_assoc($stid)) != false){
                echo '<option value="'.$item["DOCTOR_ID"].'">'.$item['DOCTOR_FIRSTNAME'].' '.$item['DOCTOR_LASTNAME'].'</option>';
            }
            ?>
            </select>

            <input type="hidden" name='date' value="<?php echo $date; ?>">
            <br>

            <input type="submit" name="submit" class="btn btn-primary rounded-pill" />
            
            
        </div>
        
        </form>

    </section>
</body>
</html>