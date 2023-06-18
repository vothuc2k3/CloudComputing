<?php
    ob_start(); // Start output buffering

    include_once "header.php";

    $conn = new Connect();
    $db_link = $conn->connectToPDO();
    
    if (isset($_GET['prod_id'])) {
        $value = $_GET['prod_id'];
        $sqlselect = "SELECT * FROM `001_prod` WHERE `prod_id` = ?";
        $stmt = $db_link->prepare($sqlselect);
        $stmt->execute(array($value));
        
        if ($stmt->rowCount() > 0) {
            $re = $stmt->fetch(PDO::FETCH_BOTH);
            $pname = $re['prod_name'];
        }
    }
    
    if (isset($_POST['prod_name'])) {
        $pname = $_POST['prod_name'];
        $price = $_POST['prod_price'];
        $desc = $_POST['prod_desc'];
        $quantity = $_POST['prod_quan'];
        $pimg = $_POST['prod_img'];
        $cid = $_POST['prod_cat'];
        
        if (isset($_POST['btnAdd'])) {
            $pid = $_POST['prod_id'];
            $sqlInsert = "INSERT INTO `001_prod`(`prod_id`, `prod_name`, `price`, `description`, `quantity`, `prod_img`, `cat_id`) VALUES (?,?,?,?,?,?,?)";
            $stmt = $db_link->prepare($sqlInsert);
            $execute = $stmt->execute(array($pid, $pname, $price, $desc, $quantity, $pimg, $cid));
            
            if ($execute) {
                ob_clean(); // Clean the output buffer
                header("Location: index.php");
                // exit();
            } else {
                echo "Failed";
            }
        } else {
            $pid = $_GET['prod_id'];
            $sqlUpdate = "UPDATE `001_prod` SET `prod_name`=? WHERE `prod_id`=?";
            $stmt = $db_link->prepare($sqlUpdate);
            $execute = $stmt->execute(array($pname, $pid));
            
            if ($execute) {
                header("Location: index.php");
                // exit();
            } else {
                echo "Failed";
            }
        }
    }
?>

<div id="main" class="container">
    <div class="page-heading pb-2 mt-4 mb-2">
        <h1>Product</h1>
    </div>
    
    <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
        <div class="form-group pb-3">
            <label for="txtID" class="col-sm-2 control-label">Product ID(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_id" id="txtID" class="form-control" placeholder="Product ID" value="<?php echo isset($_GET['prod_id']) ? $_GET['prod_id'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtName" class="col-sm-2 control-label">Product Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_name" id="txtName" class="form-control" placeholder="Product Name" value="<?php echo isset($pname) ? $pname : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtPrice" class="col-sm-2 control-label">Product Price(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_price" id="txtPrice" class="form-control" placeholder="Product Price" value="<?php echo isset($_GET['price']) ? $_GET['price'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtDesc" class="col-sm-2 control-label">Description(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_desc" id="txtDesc" class="form-control" placeholder="Description" value="<?php echo isset($_GET['description']) ? $_GET['description'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtQuan" class="col-sm-2 control-label">Quantity(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_quan" id="txtQuan" class="form-control" placeholder="Quantity" value="<?php echo isset($_GET['quantity']) ? $_GET['quantity'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtImg" class="col-sm-2 control-label">Image File name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_img" id="txtImg" class="form-control" placeholder="File name" value="<?php echo isset($_GET['prod_img']) ? $_GET['prod_img'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
            <label for="txtCid" class="col-sm-2 control-label">Category ID(*): </label>
            <div class="col-sm-10">
                <input type="text" name="prod_cat" id="txtCid" class="form-control" placeholder="Category ID" value="<?php echo isset($_GET['cat_id']) ? $_GET['cat_id'] : ''; ?>">
            </div>
        </div>
        
        <div class="form-group pb-3">
        <button type="submit" value="Add" name="btnAdd">Add</button>
        </div>
    </form>
</div>

<?php
    include_once 'footer.php';
    ob_end_flush();
?>
