<?php
include("conexao.php");

$dados = json_decode(file_get_contents("php://input"), true);
$id    = $dados["id"];

$stmt = $conexao->prepare("DELETE FROM lista WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["mensagem" => "Item removido!"]);