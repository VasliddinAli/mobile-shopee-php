<?php
ob_start();
include('./functions.php');

$row = $Cart->getProduct();
$item_brand = $row['item_brand'];
$item_name = $row['item_name'];
$item_price = $row['item_price'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit product</title>
</head>

<body>

    <div class="container mt-3 mb-3 d-flex justify-content-between">

        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand [Apple, Samsung, Redmi]</label>
                    <input type="text" value="<?= $item_brand?>" name="item_brand" class="form-control" id="brand">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?= $item_name?>" name="item_name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" value="<?= $item_price?>" name="item_price" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="item_image" class="form-control" id="image">
                </div>
                <button type="submit" name="update_item" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</body>
</html>


<?php

if(isset($_POST['update_item'])){
    $item_brand = $_POST['item_brand'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];

    if($_FILES['item_image']['name']){
        $uploads_dir = './assets/products';
        $tmp_name = $_FILES["item_image"]["tmp_name"];
        $name = $_FILES["item_image"]["name"];
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $item_image = "$uploads_dir/$name";
        $result = $Cart->updateProduct($item_brand, $item_name, $item_price, $item_image);
        unlink($row['item_image']);
    }else{
        $result = $Cart->updateProduct($item_brand, $item_name, $item_price, $row['item_image']);
    }
}
?>