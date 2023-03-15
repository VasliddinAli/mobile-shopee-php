<?php

// PHP cart class
class Cart{
    public $db = null;

    public function __construct(DBController $db)
    {
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public function insertIntoCart($params = null, $table = "cart"){
        if($this->db->con != null){
            if($params != null){
                // "Insert into cart(user_id) values(0)"
                // get table columns
                $columns = implode(',',array_keys($params));

                $values = implode(',',array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES (%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into cart table
    public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    // delete cart item using cart item id
    public function deleteCart($item_id, $table = 'cart'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // delete cart item using wishlist item id
    public function deleteWishlist($item_id, $table = 'wishlist'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_id of shopping cart list
    public function getCartId($cartArray = null, $key = 'item_id'){
        if($cartArray != null){
            $cart_id = array_map(function($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id, $saveTable = "wishlist", $fromTable = 'cart'){
        if($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id = {$item_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id = {$item_id};";

            // execcute multiple query
            $result = $this->db->con->multi_query($query);
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }
    
    // Admin add product
    public function insertProduct($item_brand, $item_name, $item_price, $item_image){
        $sql = ("INSERT INTO product (item_brand, item_name, item_price, item_image) VALUES ('$item_brand', '$item_name', '$item_price', '$item_image')");
        $result = $this->db->con->query($sql);
        if($result){
            header("Location:" . $_SERVER['PHP_SELF']);
        }
        return $result;
    }

    // delete products item using cart item id
    public function deleteProduct($item_id, $table = 'product'){
        $sql = "SELECT * FROM {$table} WHERE item_id=$item_id";
        $result = $this->db->con->query($sql);
        $row = $result->fetch_assoc();
        $unlink = unlink($row['item_image']);
        if($unlink){
            $res = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($res){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
        }
    }
    
    // get products item using cart item id
    public function getProduct(){
        $item_id = $_GET['item_id'];
        $sql = "SELECT * FROM product WHERE item_id=$item_id";
        $result = $this->db->con->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    
    // get products item using cart item id
    public function updateProduct($item_brand, $item_name, $item_price, $item_image){
        $item_id = $_GET['item_id'];
        $sql_update = "UPDATE `product` SET `item_brand` = '$item_brand', `item_name` = '$item_name', `item_price` = '$item_price', `item_image` = '$item_image' WHERE `product`.`item_id` = $item_id;";
        if ($this->db->con->query($sql_update) == TRUE) {
            header("Location: admin.php");
        } else {
            echo "Error updating record: " . $this->db->con->error;
        }
    }
}
