<?php
    ob_start();
    // Include header.php file
    include('header.php');
?>

<?php
    // Include banner area
    include('Templates/_banner-area.php');

    // Include top sale
    include('Templates/_top-sale.php');

    // Include special price
    include('Templates/_special-price.php');

    // Include banner ads
    include('Templates/_banner-ads.php');

    // Include new phones
    include('Templates/_new-pones.php');

    // Include blogs
    include('Templates/_blogs.php');
?>

<?php
    // Include footer.php file
    include('footer.php');
?>