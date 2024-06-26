<?php

include "../helpers/validateForms.php";
include "../controller/usercontroller.php";

    /*
        tasks with register...
            1. Redirect user to login page to sign in after successful addition to database
            2. alert the user if they already exist and redirect them to login
            3. alert user to errors in the input
            4. 
    */

    $options = [
      'cost' => 12,
    ];

    $validator = new Validate();
    $userControl = new UserController();
    $res = "";

    if(isset($_POST['submit'])) {

        // check if the input is blank
        $errorEmail = $validator::validateEmail($_POST['email']);
        $errorPass = $validator::validatePassword($_POST['password']);
        $errorConfirm = $validator::validateRepeatPassword($_POST['password'], $_POST['confirmpassword']);

       if(empty($errorEmail) && empty($errorPass) && empty($errorConfirm)) {
          $email = htmlspecialchars($_POST['email'], ENT_QUOTES, "UTF-8");
          $pass = $_POST['password'];
          $encryptedPass = password_hash($pass, PASSWORD_DEFAULT, $options);

          $checkExisting = $userControl->find_User($email);

          if($checkExisting == false) {
            $added = $userControl->add_User($email, $encryptedPass);
            if($added) {
              $res = "User was added successfully. Now going to login";
              header("location: login.php");
              exit();
            } else {
              $res = "User could not be added";
            }
          } else {
            $res = "User already exists... cannot re register";
          }

         
      }

    function debugToConsole($msg) {
      echo "<script>console.log(".json_encode($msg).")</script>";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <section class="vh-100" style="background-color: #162a4e;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem; background-color: #e8e8e8;">
                    <div class="card-body p-5 text-center">

                      <?php echo '<p>',htmlentities($res), '</p>';?>
          
                      <h3 class="mb-5">Sign Up</h3>

                      <?php 
                        if(!empty($errorEmail)) {
                          foreach($errorEmail as $error) {
                            echo '<p>',htmlentities($error),'</p>';
                          }
                        }
                      ?>

                      <?php 
                        if(!empty($errorPass)) {
                          echo '<p>',htmlentities($errorPass),'</p>';
                        }
                      ?>

                      <?php 
                        if(!empty($errorConfirm)) {
                          foreach($errorConfirm as $error) {
                            echo '<p>',htmlentities($error),'</p>';
                          }
                        }
                      ?>
          
                      <div class="form-outline mb-4">
                        <label class="form-label" for="typeEmailX-2">Email</label>
                        <input type="email" id="typeEmailX-2" class="form-control form-control-lg border border-dark" name="email"/>
                      </div>

                     
                      <div class="form-outline mb-4">
                        <label class="form-label" for="typePasswordX-2">Password</label>
                        <input type="password" id="typePasswordX-2" class="form-control form-control-lg border border-dark" name="password"/>
                      </div>

                      

                      <div class="form-outline mb-4">
                        <label class="form-label" for="typePasswordX-3">Confirm Password</label>
                        <input type="password" id="typePasswordX-2" class="form-control form-control-lg border border-dark" name="confirmpassword"/>
                      </div>
          
                      <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Register</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </form>
</body>
</html>