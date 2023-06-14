<?php
include_once 'header.php';
include_once './connect.php/connect.php';
$c = new Connect();
$dblink = $c->connectToPDO();
$nameP = $_GET['cat_id'];
$sql = "SELECT * FROM 001_prod where cat_id = ?";
$re = $dblink->prepare($sql);
$re->execute(array("$nameP"));
$rows = $re->fetchAll(PDO::FETCH_BOTH);
?>

<div class="row container mx-auto">
    <?php
    foreach ($rows as $r) :
    ?>
        <div class="item col-md-4">
            <img src="./images/product/<?= $r['prod_img'] ?>" class="card-img-top" alt="Product1>" style="margin: auto;
                    width: 300px; height: 250px;" />
            <a href="detail.php?id=<?= $r['prod_id'] ?>" class="text-decoration-none">
                <h5 class="name">
                    <?= $r['prod_name'] ?></h5>
            </a>
            <span>&#8363;</span><?= $r['price'] ?></i>
            <div class="button">
                <a href="" class="btn btn-primary" style="margin-top: 5px; margin-bottom: 5px;">Add to cart</a>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</div>
<?php
include_once 'footer.php';
?>