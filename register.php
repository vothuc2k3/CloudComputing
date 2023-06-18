<?php
include_once 'header.php';
include_once './connect.php/connect.php';
if (isset($_POST['btnRegister'])) {
      $c = new Connect();
      $dblink = $c->connectToPDO();
      $gender = $_POST['grpGender'];
      $fname = $_POST['txtFullname'];
      $email = $_POST['txtEmail'];
      $phone = $_POST['txtPhone'];
      $pwd = $_POST['txtPass1'];
      $dateBirth = date('Y-m-d', strtotime($_POST['txtBirth']));

      $sql = "INSERT INTO `003_user`(`email`, `fullname`, `gender`, `address`, `password`, `role`, `phone`, `birthday`) VALUES 
(?,?,?,?,?,?,?,?)";
      $re = $dblink->prepare($sql);

      $stmt = $re->execute(array("$email", "$fname", "$gender", "Can Tho", "$pwd", "user", "$phone", "$dateBirth"));
      if ($stmt) {
            echo "Congratulations, you registered successfully!";
      } else {
            echo "Failed! Please register again!";
      }
}
?>


<div class="container">
      <h2>Register</h2>
      <form id="form1" name="form1" method="post" action="" class="form-horizontal needs-validation" role="form">
            <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Password(*): </label>
                  <div class="col-sm-10">
                        <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password" required />
                  </div>
            </div>

            <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Confirm Password(*): </label>
                  <div class="col-sm-10">
                        <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password" required />
                  </div>
            </div>

            <div class="form-group">
                  <label for="lblFullName" class="col-sm-2 control-label">Full name(*): </label>
                  <div class="col-sm-10">
                        <input type="text" name="txtFullname" id="txtFullname" value="" class="form-control" placeholder="Enter Fullname" required />
                  </div>
            </div>

            <div class="form-group">
                  <label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
                  <div class="col-sm-10">
                        <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email" required />
                  </div>
            </div>
            <div class="form-group">
                  <label for="lblEmail" class="col-sm-2 control-label">Phone: </label>
                  <div class="col-sm-10">
                        <input type="text" name="txtPhone" id="txtPhone" value="" class="form-control" placeholder="Phone" required />
                  </div>
            </div>

            <div class="form-group">
                  <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*): </label>
                  <div class="col-sm-10">
                        <div class="form-check">
                              <label class="radio-inline"><input type="radio" name="grpGender" value="0" id="grpRender" class="form-check-input" />
                                    Male</label>
                        </div>
                        <div class="form-check">
                              <label class="radio-inline"><input type="radio" name="grpGender" value="1" id="grpRender" class="form-check-input" />

                                    Female</label>
                        </div>

                  </div>
            </div>

            <div class="form-group">
                  <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*): </label>
                  <div class="col-sm-10">
                        <input type="date" id="txtBirth" name="txtBirth" class="form-control" style="margin-bottom: 15px;">
                  </div>
            </div>
            <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register" />
                  </div>
            </div>
      </form>

</div>
<?php
include_once 'footer.php';
?>