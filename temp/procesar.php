<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dato = $_POST["dato"];
  $resultado = $dato;
  echo $resultado;
}
?>
