<?php
// Dakota Bourne - db2nb
// Matthew Reid - mrr7rn

$item["name"] = $user["name"];
$item["email"] = $user["email"];

header('Content-Type: application/json');
echo json_encode($item, JSON_PRETTY_PRINT);

?>