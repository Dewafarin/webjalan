<?php
require 'function.php';
$id = $_GET["id"];
hapusdes($id);
header("Location:admin?page=destinasi");
?>