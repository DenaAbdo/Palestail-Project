<nav>
    <li><a href="viewOrder.php">View Order</a></li>
    <?php if(isset($_SESSION['userType']) == "Employee"){
        ?><li><a href="addProduct.php">Add Product</a></li><?php
    }  ?>
</nav> 