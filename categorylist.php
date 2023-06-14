<?php
include_once 'header.php';
?>
<body>
    <div id="main" class="container">
        <div className="page-heading pb-2 mt-4 mb-2 ">
            <h1>Product Category</h1>
        </div>
        <form name="frm" method="post" action="">
            <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><strong>Category ID</strong></th>
                        <th><strong>Category Name</strong></th>
                        <th><strong>Add Category</strong></th>
                        <th><strong>Delete</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new connect();
                    $db_link = $conn->connectToMySQL();
                    $sql = "SELECT * FROM 002_category";
                    $re = $db_link->query($sql);
                    while ($row = $re->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?= $row['cat_id'] ?></td>
                            <td><?= $row['cat_name'] ?></td>
                            <td style='text-align:center'><a href="addcat.php" class="text-decoration-none"> Add</a></td>
                            <td style='text-align:center'><a href="delcat.php" class="text-decoration-none"> Delete</a></td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    
    <?php
    include_once 'footer.php';
    ?>