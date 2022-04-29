
<?php

include_once('./loginVerification/loginHandler.php');
$_SESSION['title'] = 'Prince Kevin Hospital';
?>
<!DOCTYPE html>
<? require_once('./components/header.php'); ?>
<body>



  <main id="main">
  <section class="d-flex align-items-center">
    <div class="container">
            <div class="login-form">
                <div class="row">
                    <div class="col-md-12">
                        <h1 >
                            Welcome to Prince Kevin Hospital!
                        </h1>
                        <h2 >Our goal is to provide you the best online medical experience</h2>
                    </div>
                
                </div>

                <br>

    
                <div class="wrapper ">

           
            
            
                <div id="doctors" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 >Doctor's Login</h2>
                        </div>
                    </div>
                    
                

                <form action="loginVerification\doctorHandler.php" method="POST" role="form" class="php-email-form ">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            
                            <input name="email" type="text" placeholder="Enter email"/> 
                            <div class="validate"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <input name="password" type="password" placeholder="Enter password"/>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <button type="submit" name="submit" class="btn btn-primary">login</button>
                        
                    
                        </div>
                    </div>
                </form>
                

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <h2 >Patient's Login</h2>
                        </div>
                    </div>
                </div>
                

                <form action="./loginVerification/patientHandler.php" method="POST" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            
                            <input name="email" type="text" placeholder="Enter email"/>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <br>
                            
                            <input name="password" type="password" placeholder="Enter password"/>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                        <button type="submit" name="submit" class="btn btn-primary">login</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</main>




  
</body>
</html>