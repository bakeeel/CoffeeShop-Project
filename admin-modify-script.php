<?php
    include_once("php/DBConn.php");

    $ID = $_POST['ID'];
    $editMode = $_POST['editMode'];
    $name = $_POST['Name'];
    $description = $_POST['Description'];
    $sell_price = $_POST['Sell_Price'];
    $cost_price = $_POST['Cost_Price'];
    $quantity = $_POST['Quantity'];
    $coffee_strength_id = $_POST['Coffee_Strength_Id'];

    if (isset($_POST['submit'])) {
        if ($editMode === "") {
            $sql = "
            INSERT INTO 
            tbl_item (Name, Description, Cost_Price, Quantity, Sell_Price, Coffee_Strength_Id) 
            VALUES 
            ('$name', '$description', $cost_price, $quantity, $sell_price, $coffee_strength_id)";
        } else {
            $sql = "UPDATE tbl_item
            SET Name = '$name', 
            Description = '$description', 
            Sell_Price = $sell_price, 
            Cost_Price = $cost_price, 
            Quantity = $quantity, 
            Coffee_Strength_Id = $coffee_strength_id
            WHERE ID = $ID";
        }

        if ($con->query($sql) === TRUE) {

            //  We only want the ID if we inserted; not updated
            if ($editMode === "") { $ID = $con->insert_id; }

            if (isset($_FILES['Image'])) {
                $temp_name = $_FILES['Image']['tmp_name'];
                resizeImage($temp_name);
                uploadImage($temp_name, $ID);
            }

            header("Location: admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    function uploadImage($file, $ID) {
        $location = "img/shop_coffee/";
        if(move_uploaded_file($file, $location.$ID . ".jpg")){
            echo 'File uploaded successfully';
        }
    }

    /* Resizes the image stored in 'tmp' BEFORE it's actually uploaded somewhere */
    function resizeImage($file_name) {
        $maxDim = 500;
        list($width, $height, $type, $attr) = getimagesize( $file_name );

        //  Only run this code if the dimensions of the image
        //  are greater than what was specified in $maxDimension
        if ($width > $maxDim || $height > $maxDim) {
            $target_filename = $file_name;
            $ratio = $width / $height;

            if( $ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim / $ratio;
            } else {
                $new_width = $maxDim * $ratio;
                $new_height = $maxDim;
            }

            $src = imagecreatefromstring( file_get_contents( $file_name ) );
            $dst = imagecreatetruecolor( $new_width, $new_height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            imagedestroy( $src );
            imagepng( $dst, $target_filename );
            imagedestroy( $dst );
        }
    }
?>