<?php
$conexao = new mysqli("localhost", "root", "1234", "lista_compras");
$conexao->set_charset("utf8mb4");

if ($conexao->connect_error) {
    die(json_encode(["erro" => $conexao->connect_error]));
}