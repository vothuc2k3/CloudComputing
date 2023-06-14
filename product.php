<?php
include_once 'header.php';
?>

<h2>
    <center>ALL TOYS</center>
</h2>
<div class="container">
    <div class="row">
        <?php
        include_once './connect.php/connect.php';
        $c = new Connect();
        $dblink = $c->connectToMySQL();
        $sql = "Select * FROM `001_prod`";
        $re = $dblink->query($sql);
        $row1 = $re->fetch_row();
        $re->data_seek(0);
        if ($re->num_rows > 0) :
            while ($row = $re->fetch_assoc()) :
        ?>
                <div class="col-md-4 pb-3">
                    <div class="card">
                        <img src="./images/product/<?= $row['prod_img'] ?>" class="card-img-top" alt="Product1>" style="margin: auto;
                    width: 300px; height: 250px;" />
                        <div class="card-body">
                            <a href="detail.php?id=<?= $row['prod_id'] ?>" class="text-decoration-none">
                                <h5 class="card-title"><?= $row['prod_name'] ?></h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted"><span>&#8363;</span> <?= $row['price'] ?></h6>
                            <form action="cart.php" method="GET" id="addToCart" type="submit">
                                <input type="hidden" name="prod_id" value="<?=$row['prod_id'] ?>">
                                <input style="" type="number" class="form-control" id="quantity" name="quantity" value="1" placeholder="Quantity" min="1" max="<?= $row['quantity'] ?>">
                                <button type="submit" class="btn btn-primary" id="btn-cart" name="btn-add">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        else :
            echo "Not found";
        endif;
        ?>
    </div>
</div>

</html>

<?php
include_once 'footer.php';
?>