<?php
include_once 'header.php';
?>

<div class="cat-container">
    <?php
    $query = "SELECT DISTINCT c.cat_id, c.cat_name FROM 002_category c INNER JOIN 001_prod p
    ON c.cat_id = p.cat_id";
    $conn = new Connect();
    $dblink = $c->connectToMySQL();
    $re = $dblink->query($query);

    while ($row = $re->fetch_assoc()) :
    ?>
        <center>
            <h6 style="display: inline-block;">
                <div class="cat-box">
                    <a href="category.php?cat_id=<?= $row['cat_id'] ?>"><?= $row['cat_name'] ?> Switches</a>
                </div>
            </h6>
            
        </center>
        
    <?php
    endwhile;
    ?>
</div>

<?php
include_once 'footer.php';
?>

<style>
.cat-box {
  width: 300px;
  border: 15px solid #3b619e ;
  padding: 50px;
  margin: 20px;
}
</style>