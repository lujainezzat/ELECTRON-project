<?php

include ('connection.php');

if (isset($_POST['sensors'])) 
    $category = 'sensors' ;

elseif (isset($_POST['lc']))
    $category = 'LCD Modules | Key Pads' ;

elseif (isset($_POST['ec']))
    $category = 'Electronic Components' ;

elseif (isset($_POST['connectors']))
    $category = 'Connectors' ;

elseif (isset($_POST['batteries']))
    $category = 'Batteries & Chargers' ;

elseif (isset($_POST['printer']))
    $category = '3d Printer Parts & Filament' ;

    
$statement = $conn->prepare("SELECT * FROM products WHERE product_category= '$category'");

$statement->execute();

$cat_product = $statement->get_result();

?>