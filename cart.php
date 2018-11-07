<?php require 'backEnd.php'; ?>
<?php require 'inc/head.php'; ?>
<section class="cookies container-fluid">
    <div class="row">
        <!--//TODO : Display shopping cart items from $_SESSION here.-->
        <div class="col-xs-offset-1 col-xs-10">
            <table class="table table-responsive">
                <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php
                if (isset($_SESSION['items'])) {
                    $items = $_SESSION['items'];
                    foreach ($items as $item) {
                        echo "<tr>";
                        echo "<td>".$item['id']."</td>";
                        echo "<td>".$item['label']."</td>";
                        echo "<td>".$item['qty']."</td>";
                        echo "<td>".$item['price']."€</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</section>
<?php require 'inc/foot.php'; ?>
