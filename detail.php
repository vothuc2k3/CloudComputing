<?php
include_once 'header.php';
?>

<div class="container px-4 py-5">
    <?php
    if (isset($_GET['id'])) :
        $prod_id = $_GET['id'];
        require_once './connect.php/connect.php';
        $conn = new Connect();
        $dblink = $conn->connectToPDO();
        $sql = "SELECT * FROM 001_prod WHERE prod_id = ?";
        $stmt = $dblink->prepare($sql);
        $stmt->execute(array($prod_id));
        $re = $stmt->fetch(PDO::FETCH_BOTH);
    ?>
        <h2><?= $re['prod_name'] ?></h2>
        <img src="./images/product/<?= $re['prod_img'] ?>" class="card-img-top" alt="Product1>" style="margin: auto;
            width: 300px; height: 250px;" />
        <ul style="list-style-type: none;" class="list-group">
            Price: <li class="list-group-item"><?= $re['price'] ?></li>
            Quantity: <li class="list-group-item"><?= $re['quantity'] ?></li>
            Description: <li class="list-group-item"><?= $re['description'] ?></li>
        </ul>
        
    <?php
    else :
    ?>
        <h2>Nothing to show</h2>
    <?php
    endif;
    ?>

</div>


<?php
include_once 'footer.php';
?>