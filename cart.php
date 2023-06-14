<?php
ob_start();
include_once 'header.php';
$total = 0;
$c = new connect();
$dblink = $c->connectToPDO();
if (isset($_SESSION['email'])) {
    $user = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['prod_id'])) {
        $prod_id = $_GET['prod_id'];
        $quantity = $_GET['quantity'];

        $sqlSelect1 = "SELECT cart_id FROM 005_cart WHERE user_id=? AND prod_id=?";
        $re = $dblink->prepare($sqlSelect1);
        $re->execute(array("$user_id", "$prod_id"));

        if ($re->rowCount() == 0) {
            $query = "INSERT INTO `005_cart`(`user_id`, `prod_id`, `prod_count`) VALUES (?,?,$quantity)";
        } else {
            $query = "UPDATE 005_cart SET prod_count = prod_count + $quantity where user_id=? and prod_id=?";
        }
        $stmt = $dblink->prepare($query);
        $stmt->execute(array("$user_id", "$prod_id"));
    }
    if (isset($_GET['del_id'])) {
        $cart_del = $_GET['del_id'];
        $query = "DELETE FROM 005_cart WHERE cart_id=?";
        $stmt = $dblink->prepare($query);
        $stmt->execute(array($cart_del));
    }
    $sqlSelect = "SELECT * FROM 005_cart c, 001_prod p where c.prod_id=p.prod_id and user_id =?";
    $stmt1 = $dblink->prepare($sqlSelect);
    $stmt1->execute(array($user_id));
    $rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
} else {
    header("location:login.php");
    ob_get_flush();
}
?>

<style>
    .container {
        box-shadow: 5px 5px 5px 5px #888888;
        background-color: #97C4C6;
    }
</style>
<div class="container">
    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
    <h6 class="mb-0 text-muted"><?= $stmt1->rowCount() ?> item(s)</h6>
    <table class="table">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($rows as $row) {
        ?>
            <tr>
                <td> <b><?= $row['prod_name'] ?></b> </td>
                <td>  <input id="from1" min="0" name="quantity" value="<?= $row['prod_count'] ?>" type="number" class="form-control form-control-sm" /></td>
                <td>
                    <h6 class="mb-0"> <b><span>&#8363</span> <?= $row['price'] ?> * <?= $row['prod_count'] ?></b> </h6>
                    <?php $total = $total + ($row['prod_count'] * $row['price']) ?>
                </td>
                <td><a href="cart.php?del_id=<?= $row['cart_id'] ?>" class="text-muted text-decoration-non">Delete</a> </td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td> <b>Total Price</b> </td>
            <td></td>
            <td> <b><span>&#8363</span> <?= $total?></b> </td>
        </tr>
    </table>
    <hr class="pt-5">
    <h6 class="mb-0"><a style="text-decoration: none; margin-bottom: 5px;" href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back To Homepage</a></h6>
</div>
 <?php
include_once 'footer.php'
 ?>