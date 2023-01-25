
<?php
session_start();
include_once("php/DBConn.php");

$editMode = isset($_GET['ID']); // Whether we are editing or creating a new item
$GET_ID = $editMode ? $_GET['ID'] : "";

$name = $description = "";
$sell_price = $cost_price = $quantity = $coffee_strength_id = 1;

if ($editMode) {
    $sql = "SELECT * FROM tbl_item INNER JOIN tbl_coffee_strength c ON c.ID = tbl_Item.Coffee_Strength_ID WHERE tbl_item.ID = {$GET_ID}";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $count = mysqli_num_rows($result);
    if ($count != 1) {
        $editMode = false;
        return;
    }
    $name = $row['Name'];
    $description = $row['Description'];
    $sell_price = $row['Sell_Price'];
    $cost_price = $row['Cost_Price'];
    $quantity = $row['Quantity'];
    $coffee_strength_id = $row['Coffee_Strength_Id'];
}

// Get different coffee strengths for drop down list
function getCoffeeStrengthDropDown($db, $coffee_strength_id) {
    $sql = "SELECT * FROM tbl_coffee_strength";
    $result = $db->query($sql);
    while ($row=$result->fetch_assoc()) {
        $selected = $row['Id'] === $coffee_strength_id ? "selected='selected'" : "";

        echo "<option $selected value=". $row['Id'] .">";
        echo $row['Strength'];
        echo "</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>
    <title> <?php echo $editMode ? "Edit Item" : "Create Item" ?></title>
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

<div class="container container-table mb-5">
    <h2 class="text-center line-under-text"><?php echo $editMode ? "Edit Item" : "Create Item" ?></h2>
    <form action="admin-modify-script.php" method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $GET_ID ?>" name="ID" id="ID">
        <input type="hidden" value="<?php echo $editMode ?>" name="editMode" id="editMode">

        <!-- NAME -->
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" placeholder="Enter Name" name="Name"
                   value="<?php echo $name ?>">
        </div>
        <!-- DESCRIPTION -->
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea row="3" type="text" class="form-control" id="Description" name="Description"
                      placeholder="Enter Description"><?php echo $description ?></textarea>
        </div>
        <!-- COST PRICE -->
        <div class="form-group">
            <label for="CostPrice">Cost Price</label>
            <input type="number" class="form-control" id="CostPrice" placeholder="Enter Price" min="1"
                   name="Cost_Price" value="<?php echo $cost_price ?>">
        </div>
        <!-- SELL PRICE -->
        <div class="form-group">
            <label for="SellPrice">Sell Price</label>
            <input type="number" class="form-control" id="SellPrice" placeholder="Enter Price" min="1"
                   name="Sell_Price" value="<?php echo $sell_price ?>">
        </div>
        <!-- Quantity -->
        <div class="form-group">
            <label for="Quantity">Quantity</label>
            <input type="number" class="form-control" id="Quantity" placeholder="Enter Quantity" min="1"
                   name="Quantity" value="<?php echo $quantity ?>">
        </div>
        <!-- Coffee Strength -->
        <div class="form-group">
            <label for="strength">Coffee Strength</label>
            <select class="form-control" id="strength" name="Coffee_Strength_Id">
                <?php getCoffeeStrengthDropDown($con, $coffee_strength_id) ?>
            </select>
        </div>
        <!-- IMAGE -->
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="Image" name="Image">
            <small id="fileHelp" class="form-text text-muted">Images may not appear correctly if the aspect ratio is
                not 1:1</small>
        </div>
        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once("footer.php"); ?>

<!-- JAVASCRIPT REQUIRED -->
<script src="js/loader.js"></script>
</body>

</html>