<?php
header("Content-Type: application/json");

echo json_encode([
  ["id" => 1, "title" => "AJAX verstehen"],
  ["id" => 2, "title" => "jQuery Praxis"]
]);