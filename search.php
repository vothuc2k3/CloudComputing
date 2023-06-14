<?php
include_once 'header.php';
include_once './connect.php/connect.php';
$c = new Connect();
$dblink = $c->connectToPDO();
$nameP = $_GET['search'];
$sql = "SELECT * FROM 001_prod where prod_name LIKE ?";
$re = $dblink->prepare($sql);
$re->execute(array("%$nameP%"));
$rows = $re->fetchAll(PDO::FETCH_BOTH);

?>
<h2>Showing <?= $re->rowCount(); ?>&nbsp;result for"<?= $_GET['search'] ?>"</h2>

<?php
foreach ($rows as $r) :
?>
    <ul id="product">
        <div class="item">
            <img src="./images/product/<?= $r['prod_img'] ?>" class="card-img-top" alt="Product1>" style="margin: auto;
                    width: 300px; height: 250px;" />
            <a href="detail.php?id=<?= $r['prod_id'] ?>" class="text-decoration-none">
                <h5 class="name">
                    <?= $r['prod_name'] ?></h5>
            </a>
            <span>&#8363;</span><?= $r['price'] ?></i>
            <div class="button">
                <a href="" class="btn btn-primary">Add to cart</a>
            </div>
        </div>
    </ul>
<?php
endforeach;
include_once 'footer.php';
?>