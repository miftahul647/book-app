<?php
function connect_DB()
{
  $conn = new mysqli('localhost', 'root', '', 'book_app');
  return $conn;
}

$conn = connect_DB();

// Check connection
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn->connect_error;
  exit();
}
