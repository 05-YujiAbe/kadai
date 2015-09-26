<?php
	$catsql = "SELECT * FROM category";
    $catstmt = $pdo->prepare($catsql);
    $catstmt->execute();
    $catArray = $catstmt->fetchAll(PDO::FETCH_ASSOC);
    
?>