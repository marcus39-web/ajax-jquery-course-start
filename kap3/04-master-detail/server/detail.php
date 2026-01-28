<?php
header("Content-Type: application/json");

$id = (int)($_GET["id"] ?? 0);

$details = [
  1 => ["id" => 1, "title" => "Item A", "description" => "Details zu Item A."],
  2 => ["id" => 2, "title" => "Item B", "description" => "Details zu Item B."],
  3 => ["id" => 3, "title" => "Item C", "description" => "Details zu Item C."]
];

echo json_encode($details[$id] ?? ["error" => "Not found"]);