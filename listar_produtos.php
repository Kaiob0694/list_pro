<?php
include("conexao.php");

$resultado = $conexao->query("SELECT * FROM produtos ORDER BY nome ASC");
$produtos  = [];

while ($linha = $resultado->fetch_assoc()) {
    $produtos[] = $linha;
}

echo json_encode($produtos);