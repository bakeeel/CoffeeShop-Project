<?php

class ShoppingCart {

    private $database ;
    private $items = array();
    private $shoppingCart = array();

    /* Used to display toasts in the html */
    private $shoppingCartStatus = "";
    private $toastMessage = "";

    public function __construct() {

        $this->database = mysqli_connect("localhost", "root", "","myshop");;
        $this->shoppingCartStatus = "";
    }

    function __destruct()
    {
        $this->database->close();
    }

    function __wakeup()
    {
        include_once("DBConn.php");
        $this->database = mysqli_connect("localhost", "root", "","myshop");;

        //  Toast for displaying information to the user
        $cartStatus = $this->shoppingCartStatus;
        switch($cartStatus) {
            case "Added Item To Cart":
                $this->toastMessage = "toastr.success('{$cartStatus}')";
                break;
            case "Removed Item From Cart":
                $this->toastMessage = "toastr.success('{$cartStatus}')";
                break;
            case "Quantity cannot be less than 1.":
                $this->toastMessage = "toastr.error('{$cartStatus}')";
                break;
            case "Cart is now empty!":
                $this->toastMessage = "toastr.success('{$cartStatus}')";
                break;
            default:
                $this->toastMessage = "";
        }
        $this->shoppingCartStatus = "";
    }

    public function getDatabase() {
        return $this->database;
    }

    public function loadItems() {
        $sql = "SELECT * FROM tbl_item";
        $result = @$this->database->query($sql);

        $this->items = array();
        while ($row = $result->fetch_assoc()) {
            $this->items[$row['ID']] = array();
            $this->items[$row['ID']]['Name'] = $row['Name'];
            $this->items[$row['ID']]['Description'] = $row['Description'];
            $this->items[$row['ID']]['Cost_Price'] = $row['Cost_Price'];
            $this->items[$row['ID']]['Quantity'] = $row['Quantity'];
            $this->items[$row['ID']]['Sell_Price'] = $row['Sell_Price'];
            $this->items[$row['ID']]['Coffee_Strength_Id'] = $row['Coffee_Strength_Id'];
        }
        $_SESSION['cartCount'] = $this->getCartCount();
    }

    public function initializeCart() {
        $this->shoppingCart = array();
        foreach ($this->items as $ID => $item) {
            $this->shoppingCart[$ID] = 0;
        }
    }

    public function getProducts($card_style, $button_style, $title_style, $description_style, $coffee_strength_id) {
        // Pull items from database
        $sql = "SELECT * FROM tbl_item WHERE Coffee_Strength_Id = {$coffee_strength_id}";
        $result = $this->database->query($sql);

        // Don't bother running the rest of the code if it's empty
        if ($result->num_rows <= 0) { return; }

        echo "<div class='row m-auto'>";

        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3 card-padding'>";
                echo "<div class='card mb-3 {$card_style}'>";
                // Item's picture
                echo "<img src='img/shop_coffee/{$row['ID']}.jpg' class='img-fluid loading' alt='Thumbnail of coffee beans'>";
                // Item's Details
                echo "<div class='card-body'>";
                    echo "<h5 class='card-title text-center {$title_style}'>{$row['Name']}</h5>";
                    echo "<p class='card-price'>R {$row['Sell_Price']}</p>";
                    echo "<p class='card-description {$description_style}'>{$row['Description']}</p>";
                    echo "<a href='{$_SERVER['SCRIPT_NAME']}?ItemToAdd={$row['ID']}' id='{$row['ID']}' class='btn {$button_style}'>Add To Cart</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }

        // Closing row
        echo "</div>";
    }

    public function getCart() {
        if ($this->getCartCount() === 0) {
            echo "<p class='text-center'>Your cart is empty. 😔</p>";
            return;
        }

        $total = 0;
        $totalItems = 0;

        foreach ($this->items as $ID => $item) {

            if ($this->shoppingCart[$ID] === 0) continue;

            $minusQuantity = "<a href='{$_SERVER['SCRIPT_NAME']}?ItemToRemove={$ID}' class='btn cart-table-quantity'><i class='fas fa-minus'></i></a>";
            $AddQuantity = "<a href='{$_SERVER['SCRIPT_NAME']}?ItemToAdd={$ID}'class='btn cart-table-quantity'><i class='fas fa-plus'></i></a>";

            echo "<tr>";
            echo "<td><img src='img/shop_coffee/{$ID}.jpg' class='img-thumbnail' alt='Thumbnail of coffee beans'></td>";
            echo "<td>{$item["Name"]}</td>";
            echo "<td class='text-center'>{$minusQuantity} {$this->shoppingCart[$ID]} {$AddQuantity}</td>";
            echo "<td class='text-right'> R{$item["Sell_Price"]}</td>";
            echo "</tr>";

            $total += $item["Sell_Price"] * $this->shoppingCart[$ID];
            $totalItems++;
        }

        echo "<tr class='text-center'>
                <td class='table-heading'> <a href='{$_SERVER['SCRIPT_NAME']}?EmptyCart=TRUE'>Empty Cart</a> </td>
                <td colspan='2' class='table-heading'>Your shopping cart contains {$totalItems} items.</td>
                <td class='table-heading text-right'>Total: R{$total}</td>
            </tr>";
    }

    public function getCartSummary() {

        if ($this->getCartCount() === 0) {
            return;
        }

        $total = 0;
        $index = 1;

        echo "<div class='cart-buybox text-center'>";
        echo "<h6 class='cart-buybox-heading'>Cart Summary</h6>";
        echo "<hr>";

        foreach ($this->items as $ID => $item) {

            if ($this->shoppingCart[$ID] === 0) continue;

            $quantity = $this->shoppingCart[$ID];
            $stripedRow = $index % 2 === 0 ? 'cart-buybox-row-white' : '';

            echo "<div class='row {$stripedRow}'>";
            echo "<div class='col-8 text-left'>";
            echo "<p>{$item["Name"]} x {$quantity}</p>";
            echo "</div>";
            echo "<div class='col-4 text-right cart-buybox-item-price'>R".$item["Sell_Price"] * $quantity."</div>";
            echo "</div>";

            $total += $item["Sell_Price"] * $quantity;
            $index++;
        }

        echo "<hr>";
        echo "<p class='text-right text-dark'>Total: R{$total}</p>";
        echo "<a href='checkout.php' class='btn btn-primary'>Checkout</a>";
        echo "</div>";
    }

   public function getCheckoutTable() {
        $total = 0;
        $totalItems = 0;

        foreach ($this->items as $ID => $item) {

            if ($this->shoppingCart[$ID] === 0) continue;
            echo "<tr>";
                echo "<td><img src='img/shop_coffee/{$ID}.jpg' class='img-thumbnail' alt='Thumbnail of coffee beans'></td>";
                echo "<td>{$item["Name"]}</td>";
                echo "<td class='text-center'>{$this->shoppingCart[$ID]}</td>";
                echo "<td class='text-right'> R{$item["Sell_Price"]}</td>";
                echo "</tr>";

            $total += $item["Sell_Price"] * $this->shoppingCart[$ID];
            $totalItems++;
        }

        echo "<tr class='text-center'>
            <td class='table-heading text-right' colspan='4'>Total: R{$total}</td>
        </tr>";
   }

   public function getOrderHistory() {
        // Pull items from database
        $customerId = $_SESSION['userId'];
        $sql = "SELECT * FROM tbl_order WHERE Customer_ID = {$customerId} ORDER BY Date_Order_Placed DESC";
        $result = $this->database->query($sql);

        // Don't bother running the rest of the code if it's empty
        if ($result->num_rows <= 0) { return; }

        while ($row=$result->fetch_assoc()) {
            echo
            "<div class='col-12 checkout-container mb-3'>
                <div class='container mt-3 mb-3'>
                    <a href='order.php?OrderID={$row['ID']}' class='mb-3 checkout-order-detail'>
                        <span class='text-dark checkout-order'>Order #{$row['ID']}</span> &nbsp; |
                        &nbsp; Ordered {$row['Date_Order_Placed']}
                    </a>
                </div>
            </div>";
        }
   }

    public function getCartCount() {
        if (empty($this->shoppingCart)) return 0;

        $total = 0;
        foreach ($this->shoppingCart as $item) {
            $total += $item;
        }
        return $total;
    }

    public function getToastMessage() {
        return "<script>{$this->toastMessage}</script>";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }

    public function processUserInput() {
        if (!empty($_GET['GetShoppingCartList'])) {
            $this->getShoppingList();
        }
        else if (!empty($_GET['ItemToAdd'])) {
            $this->addItem();
        }
        else if (!empty($_GET['AddOne'])) {
            $this->addOne();
        }
        else if(!empty($_GET['ItemToRemove'])) {
            $this->removeItem();
        }
        else if (!empty($_GET['EmptyCart'])) {
            $this->emptyCart();
        }
        else if (!empty($_GET['RemoveAll'])) {
            $this->removeAll();
        }
    }

    /* Updates the quantity of a specific item */
	private function addItem() {
        $itemId = $_GET['ItemToAdd'];
        $this->shoppingCart[$itemId] += 1;

        //  Create a session so we can just access the cart count anywhere
        $_SESSION['cartCount'] = $this->getCartCount();
        $this->shoppingCartStatus = "Added Item To Cart";
        header("location: {$_SERVER['SCRIPT_NAME']}");
    }

    /* Updates the quantity of a specific item */
    private function removeItem() {
        $itemId = $_GET['ItemToRemove'];

        if($this->shoppingCart[$itemId] > 1){
            $this->shoppingCart[$itemId] -= 1;
            $this->shoppingCartStatus = "Removed Item From Cart";
        } else {
            $this->shoppingCartStatus = "Quantity cannot be less than 1.";
        }

        // Create a session so we can just access the cart count anywhere
        $_SESSION['cartCount'] = $this->getCartCount();
        header("location: {$_SERVER['SCRIPT_NAME']}");
    }

    public function emptyCart() {
        $this->initializeCart();
        $this->shoppingCartStatus = "Cart is now empty!";
        $_SESSION['cartCount'] = $this->getCartCount();
        header("location: {$_SERVER['SCRIPT_NAME']}");
    }

    public function checkout() {
        $customerId = $_SESSION['userId'];

        //  Creating the order
        $createOrderSql = "INSERT INTO tbl_Order (Customer_ID) VALUES ({$customerId})";
        $result = $this->database->query($createOrderSql);
        $orderId = $this->database->insert_id;

        //  Creating the order_item
        $order_item_sql = "";
        $item_quantity_sql = "";
        foreach ($this->items as $ID => $item) {
            $quantity = $this->shoppingCart[$ID];
            if ($quantity === 0) continue;

            $order_item_sql .= "INSERT INTO tbl_order_item (Item_ID, Order_ID, Item_Quantity) VALUES ({$ID}, {$orderId}, {$quantity});";

            $item_quantity = $item["Quantity"] - $quantity;
            $item_quantity_sql .= "UPDATE tbl_item SET Quantity={$item_quantity} WHERE ID = {$ID};";
        }

        $result = mysqli_multi_query($this->database, $order_item_sql);
        $item_quantity_result = mysqli_multi_query($this->database, $item_quantity_sql);

        $this->initializeCart();
        $_SESSION['cartCount'] = $this->getCartCount();
    }

   public function getOrder($ID) {
        $total = 0;
        $totalItems = 0;

        // Pull items from database
        $sql = "SELECT * FROM tbl_order_item INNER JOIN tbl_item ON tbl_item.ID = tbl_order_item.Item_ID WHERE Order_ID = {$ID}";
        $result = $this->database->query($sql);

        // Don't bother running the rest of the code if it's empty
        if ($result->num_rows <= 0) { return; }

        while ($row=$result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='img/shop_coffee/{$row['Item_ID']}.jpg' class='img-thumbnail' alt='Thumbnail of coffee beans'>
            </td>";
            echo "<td>{$row['Name']}</td>";
            echo "<td class='text-center'>{$row['Item_Quantity']}</td>";
            echo "<td class='text-right'> R{$row['Sell_Price']}</td>";
            echo "</tr>";

            $total += $row['Sell_Price'] * $row['Item_Quantity'];
            $totalItems++;
        }

        echo "<tr class='text-center'>
            <td class='table-heading text-right' colspan='4'>Total: R{$total}</td>
        </tr>";
    }
}