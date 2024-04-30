<?php
  include('../helpers/validateForms.php');
  include('../controller/usercontroller.php');
  session_start();

  $validator = new Validate;
  $userControl = new UserController;
  $res = "";

  $options = [
    'cost' => 12,
  ];

  // check if the user is already logged in.
  if(isset($_SESSION['userid'])) {
    $userCheck = $userControl->find_User(base64_decode($_SESSION['userid']));
    if($userCheck) {

    }
  }


  if(isset($_POST['submit'])) {
    $errorEmail = $validator::validateEmail($_POST['email']);
    $errorPass = $validator::validatePassword($_POST['password']);

   

    if(empty($errorEmail) && empty($errorPass)) {

        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, "UTF-8");
        $pass = $_POST['password'];

        $existingUser = $userControl->find_User($email);



        if($existingUser == FALSE) {
          $res = "User does not exist in the system";
        } else {
            if(password_verify($pass, $existingUser['password']) == true) {
              $res = "Thank you for signing in. Redirecting to your page";
              $_SESSION['loggedIntoMDSite'] = true;
              $_SESSION['token'] = md5(uniqid(mt_rand(), true));  
              header("location: userpage.php");
              exit;
            } else {
              $res = "password does not match";
            }
        }
    }
  }


  function debugToConsole($msg) {
    echo "<script>console.log(".json_encode($msg).")</script>";
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

                      <?php echo '<p>',htmlentities($res, ENT_HTML5 | ENT_QUOTES, "UTF-8",'</p>'); ?>

                      <?php
                          if(!empty($errorEmail)) {
                            foreach($errorEmail as $error) {
                              echo '<p>',htmlentities($error, ENT_QUOTES | ENT_HTML5, "UTF-8"),'</p>';
                            }
                          }
                      ?>

                      <?php 
                          if(!empty($errorPass)) {
                            echo '<p>',htmlentities($errorPass, ENT_QUOTES | ENT_HTML5, "UTF-8"), '</p>';
                          }
                      ?>

                      
                      <div class="form-outline mb-4">
                        <input type="email" id="typeEmailX-2" class="form-control form-control-lg border border-dark" name="email"/>
                        <label class="form-label" for="typeEmailX-2">Email</label>
                      </div>

                     
          
                     
                      <div class="form-outline mb-4">
                        <input type="password" id="typePasswordX-2" class="form-control form-control-lg border border-dark" name="password"/>
                        <label class="form-label" for="typePasswordX-2">Password</label>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? ''?>"/>
                      </div>
          
                      <!-- Checkbox -->
                      <div class="form-check d-flex justify-content-start mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                        <label class="form-check-label" for="form1Example3"> Remember password </label>
                      </div>
          
                      <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </form>
</body>
</html>