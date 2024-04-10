<?php
  include('../helpers/validateForms.php');
  include('../controller/usercontroller.php');
  include('../helpers/tokenCheck.php');

  $validator = new Validate;
  $userControl = new UserController;
  $errorPage = "";
  $errorLogin = "";
  $errorEmail = [];
  $errorPass = [];

  // validate the email and password fields for being blank then check for html entities

      $options = [
        'cost' => 12
      ];


      if(isset($_POST['submit'])) {
        #$errors = array_filter(['email' => $validator::validateEmail($_POST['email']),
         # 'password' => $validator::validatePassword($_POST['password'])]);

         $errorEmail = $validator::validateEmail($_POST['email']);
         $errorPass = $validator::validatePassword($_POST['password']);

         var_dump($errorEmail);
         var_dump($errorPass);

         
         

        // session_start();
         //$token = bin2hex(random_bytes(32));

        

          if(empty($errorEmail) && empty($errorPass)) {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_DISALLOWED, "UTF-8");
            $pass = htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_DISALLOWED, "UTF-8");

            $encryptedPass = password_hash($pass, PASSWORD_BCRYPT, $options);

            $checkUserExists = $userControl->find_User($email, $encryptedPass);

            if($checkUserExists && password_verify($encryptedPass, $checkUserExists['password'])) {
              
               $_SESSION['token'] = $token;
               $_SESSION['id'] = $checkUserExists['user_id'];

               header("location:userpage.php");
               exit;
            } else {

              $errorLogin = "<p> Either user does not exist or password doesnt match. Please try again </p>";
            }
          } else {
            $errorPage = "<p> Please fix errors with input no blanks </p>";
          }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
          
                      <h3 class="mb-5">Sign in</h3>

                      <?php
                          if(!empty($errorEmail)) {
                            foreach($errorEmail as $error) {
                              echo '<p>',htmlentities($error),'</p>'; 
                            }
                          }
                      ?>
                      
                      <div class="form-outline mb-4">
                        <input type="email" id="typeEmailX-2" class="form-control form-control-lg border border-dark" name="email"/>
                        <label class="form-label" for="typeEmailX-2">Email</label>
                      </div>

                      <?php
                          if(!empty($errorPass)) {
                            foreach($errorPass as $error) {
                              echo '<p>',htmlentities($error),'</p>'; 
                            }
                          }
                      ?>
          
                     
                      <div class="form-outline mb-4">
                        <input type="password" id="typePasswordX-2" class="form-control form-control-lg border border-dark" name="password"/>
                        <label class="form-label" for="typePasswordX-2">Password</label>
                      </div>
          
                      <!-- Checkbox -->
                      <div class="form-check d-flex justify-content-start mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                        <label class="form-check-label" for="form1Example3"> Remember password </label>
                      </div>
          
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </form>
</body>
</html>