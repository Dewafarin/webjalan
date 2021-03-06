<?php
require 'function.php';
$id = $_GET["id"];
hapusu($id);
header("Location:admin?page=pengguna");
?>