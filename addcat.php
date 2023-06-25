<?php
include_once "header.php";
ob_flush();
$conn = new Connect();
$db_link = $conn->connectToPDO();
if (isset($_GET['cat_id'])) :
    $value = $_GET['cat_id'];
    $sqlselect = "SELECT * FROM 002_category WHERE cat_id = ?";
    $stmt = $db_link->prepare($sqlselect);
    $stmt->execute(array("$value"));
    if ($stmt->rowCount() > 0) :
        $re = $stmt->fetch(PDO::FETCH_BOTH);
        $catname = $re['cat_name'];
    endif;
endif;
if (isset($_POST['txtName'])) :
    $cname = $_POST['txtName'];
    if (isset($_POST['btnAdd'])) :
        $cid = $_POST['txtID'];
        $sqlInsert = "INSERT INTO `002_category`(`cat_id`,`cat_name`) VALUES (?,?)";
        $stmt = $db_link->prepare($sqlInsert);
        $execute = $stmt->execute(array("$cid", "$cname"));
        if ($execute) {
            header("Location: categorylist.php");
            ob_clean();
        } else {
        }
    else :
        $cid = $_GET['cat_id'];
        $sqlUpdate = "UPDATE `002_category` SET `cat_id`=?, `cat_name`=? WHERE `cat_id`=?";
        $stmt = $db_link->prepare($sqlUpdate);
        $execute = $stmt->execute(array("$cid", "$cname", "$cid"));
        if ($execute) {
            header("Location: categorylist.php");
        } else {
            echo "Failed" . $execute;
        }
    endif;
endif;
?>
<div id="main" class="container">
    <div className="page-heading pb-2 mt-4 mb-2 ">
        <h1>Product Category</h1>
    </div>
    <?php
    ?>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Category ID(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Category ID" value='<?php echo isset($_GET["cat_id"]) ? ($_GET["cat_id"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Category Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Category Name" value="<?php echo isset($catName) ? ($catName) : ''; ?>">
            </div>
        </div>


        <div class="form-group pb-3">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="<?php echo (isset($_GET["cat_id"])) ? "btnEdit" : "btnAdd"; ?>" id="btnAction" value='<?php echo (isset($_GET["cat_id"])) ? "Edit" : "Add new"; ?>' />
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Back to list" onclick="window.location.href='categorylist.php'" />
            </div>
        </div>
        
    </form>
</div>
<?php
include_once 'footer.php';
?>