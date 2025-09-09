<?php
$servername = "localhost:3306";
$username = "root";
$password = "Pl@yjox101234";
$database = "senacpi";

// Cria conexão
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica conexão
if (!$conn) {
    die("Falha de conexão: " . mysqli_connect_error());
}

// Aqui NÃO fecha a conexão
// mysqli_close($conn);
?>
