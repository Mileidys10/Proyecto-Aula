<?php
$conn = mysqli_connect("localhost:3307", "root", "", "classy");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
