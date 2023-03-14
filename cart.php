<?php
    ob_start();
    // Include header.php file
    include('header.php');
?>

<?php
    // Include cart items if it is not empty
    count($product->getData('cart')) ? include('Templates/_cart-template.php') : include('Templates/notFound/_cart_notFound.php');
    
    // Include cart wishlist if it is not empty
    count($product->getData('wishlist')) ? include('Templates/_wishlist_template.php') : include('Templates/notFound/_wishlist_notFound.php');

    // Include top sale
    include('Templates/_new-pones.php');
?>

<?php
    // Include footer.php file
    include('footer.php');
?>