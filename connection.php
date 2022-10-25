<?php
$HOST = "82.180.175.0";
$DATABASE = "u352396458_shedule";
$USER = "u352396458_shedule";
$PASSWORD = "Awesome1234";

try {
  $conn = new PDO("mysql:host=$HOST;dbname=$DATABASE", $USER, $PASSWORD);
  // Active error module
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
  // Error conection
  $error = $e->getMessage();
  echo "Erro: $error";
}
