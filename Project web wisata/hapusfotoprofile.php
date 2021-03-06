<?php
require 'function.php';
$id = $_GET["id"];
hapusf($id);
header("Location:myprofile");
?>