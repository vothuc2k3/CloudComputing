`<?php
    include_once "header.php";
    ob_flush();

    $conn = new Connect();
    $db_link = $conn->connectToPDO();
    if (isset($_GET['prod_id'])) :
        $value = $_GET['prod_id'];
        $sqlselect = "SELECT * FROM 001_prod WHERE prod_id = ?";
        $stmt = $db_link->prepare($sqlselect);
        $stmt->execute(array("$value"));
        if ($stmt->rowCount() > 0) :
            $re = $stmt->fetch(PDO::FETCH_BOTH);
            $pname = $re['prod_name'];
        endif;
    endif;
    if (isset($_POST['txtName'])) :
        $pname = $_POST['txtName'];
        $price = $_POST['txtPrice'];
        $desc = $_POST['txtDesc'];
        $quantity = $_POST['txtQuan'];
        $pimg = $_POST['txtImg'];
        $cid = $_POST['txtCid'];
        if (isset($_POST['btnAdd'])) :
            $pid = $_POST['txtID'];
            $sqlInsert = "INSERT INTO `001_prod`(`prod_id`,`prod_name`, `price`, `description`, `quantity`, `prod_img`, `cat_id`) VALUES (?,?,?,?,?,?,?)";
            $stmt = $db_link->prepare($sqlInsert);
            $execute = $stmt->execute(array("$pid", "$pname", "$price", "$desc", "$quantity", "$pimg", "$cid"));
            if ($execute) {
                header("Location: categorylist.php");
                ob_clean();
            } else {
            }
        else : 
            $pid = $_GET['prod_id'];
            $sqlUpdate = "UPDATE `001_prod` SET `prod_id`=?, `prod_name`=? WHERE `prod_id`=?";
            $stmt = $db_link->prepare($sqlUpdate);
            $execute = $stmt->execute(array("$pid", "$pname", "$price", "$desc", "$quantity", "$pimg", "$cid"));
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
        <h1>Product</h1>
    </div>
    <?php
    ?>
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Product ID(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value='<?php echo isset($_GET["prod_id"]) ? ($_GET["prod_id"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value="<?php echo isset($prodName) ? ($prodName) : ''; ?>">
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Product Price(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Product Price" value='<?php echo isset($_GET["price"]) ? ($_GET["price"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Description(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtDesc" id="txtDesc" class="form-control" placeholder="Description" value='<?php echo isset($_GET["description"]) ? ($_GET["description"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Quantity(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtQuan" id="txtQuan" class="form-control" placeholder="Quantity" value='<?php echo isset($_GET["quantity"]) ? ($_GET["quantity"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Image File name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtImg" id="txtImg" class="form-control" placeholder="File name" value='<?php echo isset($_GET["prod_img"]) ? ($_GET["prod_img"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <label for="txtTen" class="col-sm-2 control-label">Category(ID)(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtCid" id="txtCid" class="form-control" placeholder="ID" value='<?php echo isset($_GET["cat_id"]) ? ($_GET["cat_id"]) : ""; ?>'>
            </div>
        </div>
        <div class="form-group pb-3">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="<?php echo (isset($_GET["prod_id"])) ? "btnEdit" : "btnAdd"; ?>" id="btnAction" value='<?php echo (isset($_GET["prod_id"])) ? "Edit" : "Add new"; ?>' />
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Back to list" onclick="window.location.href='categorylist.php'" />
            </div>
        </div>

    </form>
</div>
<?php
include_once 'footer.php';
?>`