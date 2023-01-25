<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
include_once("php/shoppingCart.php");
session_start();

// Make sure the user is an admin...
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === false) {
    header("Location: login.php?redirect_url=admin.php");
    die();
}

if (isset($_SESSION["cart"])) {
    $cart = unserialize($_SESSION["cart"]);
    $cart->processUserInput();
} else {
    $cart = new ShoppingCart;
}

function loadItems($db) {
    $data = array();
    $sql = "SELECT * FROM tbl_item INNER JOIN tbl_coffee_strength c ON c.ID = tbl_Item.Coffee_Strength_ID";
    $result = $db->query($sql);

    // Don't bother running the rest of the code if it's empty
    if ($result->num_rows < 0) { return null; }

    while ($row=$result->fetch_assoc()) {
        array_push($data, $row);
    }

    return $data;
}

if (isset($_GET['ID'])) {
    deleteItem($_GET['ID'], $cart);
}

function deleteItem($ID, $cart) {
    $db = $cart->getDatabase();
    $sql = "DELETE FROM tbl_Item WHERE ID = {$ID}";
    $result = $db->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>
    <link href="css/datatables.min.css" rel="stylesheet" />
    <title>Admin</title>
</head>

<body>
<!-- LOADING CIRCLE
<div class="loader-background">
    <div class="loader">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>-->

<?php include_once("header.php"); ?>

<div class="container container-table table-responsive">
    <a href='admin-modify.php' class='btn btn-outline-primary mb-3'>Add New Item</a>
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Cost Price</th>
            <th class="th-sm">Sell Price</th>
            <th class="th-sm">Quantity</th>
            <th class="th-sm">Strength</th>
            <th class="th-sm">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $db = $cart->getDatabase();
        $items = loadItems($db);
        foreach ($items as $item) {
            echo "<tr>";

            echo "<td>". $item["Name"] ."</td>";
            echo "<td>". $item["Description"] ."</td>";
            echo "<td> R". $item["Cost_Price"] ."</td>";
            echo "<td> R". $item["Sell_Price"] ."</td>";
            echo "<td>". $item["Quantity"] ."</td>";
            echo "<td>". $item["Strength"] ."</td>";
            echo
            "<td class='text-center'>
                    <a href='admin-modify.php?ID={$item['ID']}' class='btn btn-primary btn-table-action'><i class='fas fa-edit'></i></a>
                    <a href='{$_SERVER['SCRIPT_NAME']}?ID={$item['ID']}' class='btn btn-primary btn-table-action'><i class='fas fa-trash'></i></a>
                    </td>";

            echo "</tr>";
        }

        ?>
    </table>
</div>

<?php include_once("footer.php"); ?>

<!-- JAVASCRIPT REQUIRED -->
<script type="text/javascript" src="js/datatables.min.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script src="js/loader.js"></script>
</body>

</html>