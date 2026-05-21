<?php
include("conexao.php");

$resultado = $conexao->query("SELECT * FROM lista ORDER BY criado_em DESC");
$itens     = [];

while ($linha = $resultado->fetch_assoc()) {
    $itens[] = $linha;
}

echo json_encode($itens);