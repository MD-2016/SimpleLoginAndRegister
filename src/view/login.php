<?php
  include('../helpers/validateForms.php');
  include('../controller/usercontroller.php');

  $validator = new Validate;
  $userControl = new UserController;

  // validate the email and password fields for being blank then check for html entities

      $options = [
        'cost' => 12
      ];

      if(isset($_POST['submit'])) {
        $errors = array_filter(['email' => $validator::validateEmail($_POST['email']),
          'password' => $validator::validatePassword($_POST['password'])]);

          if(empty($errors)) {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_DISALLOWED, "UTF-8");
            $pass = htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_DISALLOWED, "UTF-8");

            $encryptedPass = password_hash($pass, PASSWORD_BCRYPT, $options);

            $checkUserExists = $userControl->find_User($email, $encryptedPass);

            if($checkUserExists && password_verify($encryptedPass, $checkUserExists['password'])) {
               session_start();

               $_SESSION['id'] = $_SESSION['user_id'];
               header("location:userpage.php");
            }
          }
      }

  // if validation is good, then post email and password to check against the database

  // if results match database, redirect user to their web page

  // if results dont match, alert the user they need to make an account.

  // TODO: add check for already logged in and redirect the user.
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
    <form action="">
        <section class="vh-100" style="background-color: #162a4e;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem; background-color: #e8e8e8;">
                    <div class="card-body p-5 text-center">
          
                      <h3 class="mb-5">Sign in</h3>
          
                      <?php 
                          if(!empty($errors['email'])) {
                            foreach($errors['email'] as $error) {
                              echo '<p>', htmlentities($error), '</p>';
                            }
                          }
                      ?>
                      <div class="form-outline mb-4">
                        <input type="email" id="typeEmailX-2" class="form-control form-control-lg border border-dark" name="email"/>
                        <label class="form-label" for="typeEmailX-2">Email</label>
                      </div>
          
                      <?php 
                          if(!empty($errors['password'])) {
                            foreach($errors['password'] as $error) {
                              echo '<p>', htmlentities($error), '</p>';
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