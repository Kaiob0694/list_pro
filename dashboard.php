<?php
include("conexao.php");

// Total de produtos cadastrados
$totalProdutos = $conexao->query("SELECT COUNT(*) as total FROM produtos")->fetch_assoc()["total"];

// Total de itens na lista atual
$totalItens = $conexao->query("SELECT SUM(quantidade) as total FROM lista")->fetch_assoc()["total"] ?? 0;

// Valor total da lista atual
$valorTotal = $conexao->query("SELECT SUM(valor * quantidade) as total FROM lista")->fetch_assoc()["total"] ?? 0;

// Itens da lista com maior valor
$maioresGastos = $conexao->query("
    SELECT nome, (valor * quantidade) as subtotal
    FROM lista
    ORDER BY subtotal DESC
    LIMIT 5
");

$topItens = [];
while ($row = $maioresGastos->fetch_assoc()) {
    $topItens[] = $row;
}

// Quantidade de itens por faixa de preço
$faixas = [
    "Até R$ 10"      => $conexao->query("SELECT COUNT(*) as total FROM lista WHERE valor <= 10")->fetch_assoc()["total"],
    "R$ 10 a R$ 30"  => $conexao->query("SELECT COUNT(*) as total FROM lista WHERE valor > 10 AND valor <= 30")->fetch_assoc()["total"],
    "Acima de R$ 30" => $conexao->query("SELECT COUNT(*) as total FROM lista WHERE valor > 30")->fetch_assoc()["total"],
];

echo json_encode([
    "totalProdutos" => (int)$totalProdutos,
    "totalItens"    => (int)$totalItens,
    "valorTotal"    => (float)$valorTotal,
    "topItens"      => $topItens,
    "faixas"        => $faixas,
]);
