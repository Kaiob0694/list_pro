<?php
$host    = "sql305.infinityfree.com";
$usuario = "if0_41954082";
$senha   = "CQOKUWZt26RzxO";
$banco   = "if0_41954082_lista_compras";

$conexao = new mysqli($host, $usuario, $senha, $banco);
$conexao->set_charset("utf8mb4");

if ($conexao->connect_error) {
    die(json_encode(["erro" => $conexao->connect_error]));
}