<?php
include_once 'header.php';
include_once './connect.php/connect.php';
if (isset($_POST['btnLogin'])) {
  if (isset($_POST['txtPass1']) && isset($_POST['txtEmail'])) {
    $pwd = $_POST['txtPass1'];
    $usr = $_POST['txtEmail'];
    $c = new Connect();
    $dblink = $c->connectToPDO();
    $sql = "SELECT * FROM `003_user` WHERE email = ? AND password = ?";
    $stmt = $dblink->prepare($sql);
    $re = $stmt->execute(array("$usr", "$pwd"));
    $numrow = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    if ($numrow == 1) {
      echo "Login successfully";
      $_SESSION['email'] = $row['email'];
      $_SESSION['user_id'] = $row['user_id'];
      header("Location:index.php");
    } else {
      echo "<b><center>Something wrong with your info</center></b><br>";
    }
  } else {
    echo "Please enter your info";
  }
}

?>
<style>
  b center {
    color: red;
  }
</style>
<form id="frmLogin" name="frmRegister" action="login.php" method="POST" role="form" onsubmit="return formValid();">
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Please enter your email and password!</p>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmail" class="form-control form-control-lg" name="txtEmail" />
                  <label class="form-label" for="typeEmail">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="txtPass1" />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <input type="submit" value="Login" class="btn btn-primary" name="btnLogin" id="btnLogin">
                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                  <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                  <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                </div>

              </div>

              <div>
                <a href="register.php" class="text-white-50 fw-bold">Register</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  include_once 'footer.php';
  ?>