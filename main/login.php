<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/access.php");

if (isset($_POST['login'])) {
  login($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/devajuLogo.jpeg" rel="icon">
  <title>Dejavu - Dashboard</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <img style="width: 200px; height: 120px" src="img/devajuLogo.jpeg">
                    <hr>

                    <?php

                    if (count($errors) > 0) {
                      echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ' . $errors[0] . '
                  </div>
                    ';
                    }
                    ?>
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>

                  </div>
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputEmail" name="username" required placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" required="" id="id_password" placeholder="Password" name="password">
                
                      <i class="far fa-eye" id="togglePassword" style="cursor: pointer"></i> 
                      <label style="font-style: italic; font-size: 12px; color: red;">See password</label>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Submit" class="btn btn-danger btn-block" name="login">
                    </div>
                    <hr>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="fp.php">forgot password!</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>