<?php
include("conexao.php");

$dados = json_decode(file_get_contents("php://input"), true);
$nome  = $dados["nome"];
$valor = $dados["valor"];

$stmt = $conexao->prepare("INSERT INTO produtos (nome, valor) VALUES (?, ?)");
$stmt->bind_param("sd", $nome, $valor);
$stmt->execute();

echo json_encode(["mensagem" => "Produto cadastrado com sucesso!"]);