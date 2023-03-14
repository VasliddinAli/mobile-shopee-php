<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>

<body>

    <div class="container mt-3 mb-3 d-flex justify-content-between">
        <div class="tables">
            <table class="table table-hover table-bordered border-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Register</th>
                        <th scope="col">Buttons</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('./functions.php');
                    $item_id = $_GET['item_id'] ?? 1;
                    foreach ($product->getData() as $item) :
                    ?>
                        <tr>
                            <th scope="row"><?= $item['item_id'] ?></th>
                            <td><img src="<?= $item['item_image'] ?>" width="80px"></td>
                            <td><?= $item['item_brand'] ?></td>
                            <td><?= $item['item_name'] ?></td>
                            <td>$<?= $item['item_price'] ?></td>
                            <td><?= $item['item_register'] ?></td>
                            <td class="d-flex gap-2">
                                <form method="post">
                                    <input type="hidden" value="<?= $item['item_id'] ?? 0 ?>" name="item_id">
                                    <button type="submit" name="item-delete" class="btn btn-danger">Delete</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" value="<?= $item['item_id'] ?? 0 ?>" name="item_id">
                                    <button type="submit" name="item-edit" class="btn btn-warning">Edit</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>


        <div class="form">
            <form method="post">
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand [Apple, Samsung, Redmi]</label>
                    <input type="text" name="item_brand" class="form-control" id="brand" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="item_name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="item_price" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="item_image" class="form-control" id="image">
                </div>
                <button type="submit" name="add_item" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>


<?php
if(isset($_POST['add_item'])){
    $item_brand = $_POST['item_brand'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_image = $_POST['item_image'];
    
}
?>