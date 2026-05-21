<?php
include("conexao.php");

$dados      = json_decode(file_get_contents("php://input"), true);
$produto_id = $dados["produto_id"] ?? null;
$nome       = $dados["nome"];
$valor      = $dados["valor"];
$quantidade = $dados["quantidade"];

$stmt = $conexao->prepare("
    INSERT INTO lista (produto_id, nome, valor, quantidade)
    VALUES (?, ?, ?, ?)
");
$stmt->bind_param("isdi", $produto_id, $nome, $valor, $quantidade);
$stmt->execute();

echo json_encode(["mensagem" => "Item adicionado!"]);