<?php

include ('connection.php');

$statement = $conn->prepare("SELECT * FROM products LIMIT 4");

$statement->execute();

$products = $statement->get_result();

?>