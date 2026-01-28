<?php
header("Content-Type: application/json");

echo json_encode([
  ["id" => 1, "title" => "Item A"],
  ["id" => 2, "title" => "Item B"],
  ["id" => 3, "title" => "Item C"]
]);