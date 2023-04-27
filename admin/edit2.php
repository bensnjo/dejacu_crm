<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/access.php");
session_start();

access();


if (isset($_REQUEST['user'])) {

  if (isset($_POST['editPP'])) {
    update();
  }

  $succcess = null;

  if (isset($_SESSION['successUp']) && $_SESSION['successUp'] == "Profile updated success") {
    $succcess = "Profile updated success";

    unset($_SESSION['successUp']);
  }

  $uid = $_REQUEST['user'];
  $user = getUser($uid);
  $GLOBALS['usere'] = $user['username'];
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
  <title>Dejavu -Edit Users</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">

  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    include('sidebar.php');
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php
        include('topbar.php');
        ?>



        <!-- Register Content -->
        <div class="container-login">
          <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
              <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="login-form">
                        <div class="text-center">

                          <hr>

                          <h1 class="h4 text-gray-900 mb-4">Staff Profile</h1>
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

                          if (isset($succcess)) {
                            echo  '<div class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                        ' . $succcess . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';

                            echo '<script>
                    setTimeout(()=>{
                      window.open("/crm/admin/editusers.php", "_self");
                    }, 2000)
                   </script>';
                          }
                          ?>
                        </div>
                        <form action="" method="POST">

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Staff No" name="username" value="<?php echo ($user['username']); ?>" required readonly>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="exampleInputLastName" placeholder="Full Name" name="fullname" value="<?php echo ($user['full_names']); ?>" required>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Mobile No</label>
                                <input type="text" class="form-control" id="exampleInputEmail" pattern="[0-9]{10,12}" placeholder="Mobile No" name="telephone" value="<?php echo ($user['mobile_phone']); ?>" required>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" value="<?php echo ($user['email_addr']); ?>" required>
                              </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                              <label>Department</label>
                              <select name="department" required class="form-control" id="exampleInputEmail">

                                <?php
                                $db = getConnection();
                                $query = "SELECT * FROM `departments`";
                                $dpts = mysqli_query($db, $query);

                                foreach ($dpts as $dpt) {

                                  $user['department'] == $dpt['name'] ? $select = " selected>" : $select = ">";

                                  echo '<option' . $select . $dpt['name'] . '</option>';
                                }
                                ?>

                              </select>

                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                            <div class="form-group">
                              <label class="label label-danger">POSITION</label>
                              <select name="position" id="color" class="form-control" id="exampleInputEmail" required>
                                <option <?php if ($user['grade'] == '3') {
                                          echo 'selected';
                                        } ?> value="3">Technician</option>
                                <option <?php if ($user['grade'] == '4') {
                                          echo 'selected';
                                        } ?> value="4">Sale Person</option>
                                <option <?php if ($user['grade'] == '5') {
                                          echo 'selected';
                                        } ?> value="5">Finance</option>
                                <option <?php if ($user['grade'] == '6') {
                                          echo 'selected';
                                        } ?>value="6">Human Resource</option>
                                <option <?php if ($user['grade'] == '7') {
                                          echo 'selected';
                                        } ?> value="7">Executive</option>
                              </select>
                            </div>
                            </div>
                            
                            <div class="col">
                            <div class="form-group">
                              <label class="label label-danger">TEAM</label>
                              <select type="text" name="teams" class="form-control" id="exampleInputEmail" required>

                                <?php
                                $teams = allteams();

                                foreach ($teams as $team) {

                                  $user['team'] == $team['teamName'] ? $select = " selected>" : $select = ">";

                                  echo '<option' . $select . $team['teamName'] . '</option>';
                                }
                                ?>

                              </select>

                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group">
                              <label class="label label-danger">STATUS</label>
                              <select name="status" id="color" class="form-control" id="exampleInputEmail" required>
                                <option <?php if ($user['status'] == 'Active') {
                                          echo 'selected';
                                        } ?> value="Active">Active</option>
                                <option <?php if ($user['status'] == 'Closed') {
                                          echo 'selected';
                                        } ?> value="Inactive">Inactive</option>
                                <option <?php if ($user['status'] == 'Suspended') {
                                          echo 'selected';
                                        } ?> value="Suspended">Suspended</option>
                                <option <?php if ($user['status'] == 'Disabled') {
                                          echo 'selected';
                                        } ?> value="Disabled">Disabled</option>
                              </select>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            
                            <div class="col">
                            <div class="form-group">
                              <button type="submit" class="btn btn-success btn-block" name="editPP">Update</button>
                            </div>
                            </div>
                            <div class="col">
                              
                            </div>
                            </div>
                        </form>
                        <hr>

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
        <!-- Register Content -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/ruang-admin.min.js"></script>
</body>

</html>